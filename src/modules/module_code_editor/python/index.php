<!DOCTYPE html>
<html lang="en">
<head>
<title>Python Editor</title>
<script src="grammar/piethon.js"></script>
<script src="main.js"></script>
<script src="examples.js"></script>

<!-- Bootstrap -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js" integrity="sha384-u/bQvRA/1bobcXlcEYpsEdFVK/vJs3+T+nXLsBYJthmdBuavHvAW6UsmqO2Gd/F9" crossorigin="anonymous"></script>


<link rel="stylesheet" type="text/css" media="screen" href="styles.css">
</head>



<body>

<div id="navbar">
	<button id="runbtn" class="btn-success">Démarrer</button>
	<!-- <select id="examples" name="Examples">
	  <option value="-1">Exemples</option>
	</select> -->
</div>

<div class="container-fluid">
	<div id="editor">
# Dit Bonjour !
x = "Bonjour, Monde!"
print x
	</div>	
</div>



<div id="console"  class="container-fluid">
	<button id="clearbtn" class="btn-danger">Effacer</button>
</div>

<script src="lib/jquery.js" type="text/javascript" charset="utf-8"></script>
<script src="lib/jqconsole.js" type="text/javascript" charset="utf-8"></script>
<script src="lib/ace/ace.js" type="text/javascript" charset="utf-8"></script>
<script>
	// paramètre la console
	var jqconsole = $('#console').jqconsole('', '>>>');
	var startPrompt = function () {
	  // lance le prompt avec l'historique activé.
	  jqconsole.Prompt(true, function (input) {
	    // Affiche la sortie avec la classe jqconsole-output.
	    jqconsole.Write(input + '\n', 'jqconsole-output');
	    // Redémarre le prompt.
	    startPrompt();
	  });
	};
	//startPrompt();
	jqconsole.Write('>> ','jqconsole-output');
	// Paramètre l'éditeur
	var editor = ace.edit("editor");
	editor.setTheme("ace/theme/monokai");
	editor.getSession().setMode("ace/mode/python");

	// Récupère le clic sur le bouton Run
	$( "#runbtn" ).click(function() {
		resetForRun();
		try {
			// Grammar n'est pas parfait, il faut qu'il finisse avec un line break
			var output = piethon.parse(editor.getValue()+'\n')
			if(output == true) {
				jqconsole.Write('piethon\nSyntaxe correcte: '+(output==true?"tout à fait!":"Nope!")+'\nProgramme en cours d\'exécution:\n', 'jqconsole-output');
				eval(finalprogram);
				jqconsole.Write('\n', 'jqconsole-output');
			} 
		} catch(exception) {
			jqconsole.Write(exception + '\n\n', 'jqconsole-output');
		}
		jqconsole.Write('>> ','jqconsole-output');
	});
	
	// Bouton pour effacer la console
	$( "#clearbtn" ).click(function() {
		jqconsole.Reset();
	});
	
	// Peuple le dropdown des exemples (pas affiché pour l'instant)
	var select = $('#examples');
	for(var i =0;i<examples.length;i++) {
		select.append('<option value="'+i+'">--'+examples[i].name+'</option>');
	}
	select.change(function() {
		var selectedndx = parseInt($( "#examples option:selected" ).attr('value'), 10);
		if(selectedndx > -1) {
			editor.setValue(examples[selectedndx].code);
			editor.gotoLine(1);
		}
	});
	 
	
</script>
</body>
</html>