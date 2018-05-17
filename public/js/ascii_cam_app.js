(function() {
	var asciiElement = document.getElementById("ascii_cam");
	var capturing = false;

	camera.init({
		width: 160,
		height: 120,
		fps: 30,
		mirror: true,

		onFrame: function(canvas) {
			ascii.fromCanvas(canvas, {
				// contrast: 128,
				callback: function(asciiString) {
					asciiElement.innerHTML = asciiString;
				}
			});
		},

		onSuccess: function() {
			capturing = true;
		},

		onError: function(error) {
			// TODO: log error
		},
	});
})();