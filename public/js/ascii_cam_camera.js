var camera = (function() {
	var options;
	var video, canvas, context;
	var _timer;

	function videoStreamInit() {
		video = document.createElement("video");
		video.setAttribute('width', options.width);
		video.setAttribute('height', options.height);

		navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia;
		window.URL = window.URL || window.webkitURL || window.mozURL || window.msURL;

		if (navigator.getUserMedia) {
			navigator.getUserMedia({
				video: true
			}, function(stream) {
				options.onSuccess();

				if (video.mozSrcObject !== undefined) { // pour firefox avant la version 19
					video.mozSrcObject = stream;
				} else {
					video.srcObject = stream;
				}
				
				canvasInit();
			}, options.onError);
		} else {
			options.onNotSupported();
		}
	}

	function canvasInit() {
		canvas = options.targetCanvas || document.createElement("canvas");
		canvas.setAttribute('width', options.width);
		canvas.setAttribute('height', options.height);

		context = canvas.getContext('2d');

		// met la vidéo dans l'autre sens (par défaut, la caméra fonctionne en mirroir)
		if (options.mirror) {
			context.translate(canvas.width, 0);
			context.scale(-1, 1);
		}

		streamStart();
	}

	function streamStart() {
		video.play();

		_timer = setInterval(function() {
			try {
				context.drawImage(video, 0, 0, video.width, video.height);
				options.onFrame(canvas);
			} catch (e) {
				// TODO
			}
		}, Math.round(1000 / options.fps));
	}

	return {
		init: function(captureOptions) {
			var doNothing = function(){};

			options = captureOptions || {};

			options.fps = options.fps || 30;
			options.width = options.width || 640;
			options.height = options.height || 480;
			options.mirror = options.mirror || false;
			options.targetCanvas = options.targetCanvas || null; // TBV

			options.onSuccess = options.onSuccess || doNothing;
			options.onError = options.onError || doNothing;
			options.onNotSupported = options.onNotSupported || doNothing;
			options.onFrame = options.onFrame || doNothing;

			videoStreamInit();
		},

		start: streamStart
	};
})();
