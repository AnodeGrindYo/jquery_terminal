<?php
// Afficher les erreurs à l'écran
ini_set('display_errors', 1);
// Afficher les erreurs et les avertissements
//error_reporting(e_all);
require_once("src/util/get_visitor_infos.php");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta name="referrer" content="no-referrer">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>developpeur-logiciel.fr</title>

	<!-- JQuery -->
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
	<script src="public/js/jquery-3.3.1.min.js"></script>
	<!-- Bootstrap -->
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

	<!-- highlight-js python cdn -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/languages/python.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/xt256.min.css" />

	<link rel="stylesheet" href="public/css/terminal.css">
</head>

<body>
	<div class="container-fluid terminal" id="terminal">

		<?php include("ascii_art.php"); ?>
		<div class="container-fluid">		
			<div class="row">
				<p class="text-justify">Tip: tappez help pour afficher la liste des commandes.</p>
			</div>
		</div>
		<!-- <div class="container-fluid">
			<div class="row">
				<div class="input input-group">
					<span class="prompt input-group-prepend"><?php echo  get_client_ip_env();?>@developpeur-logiciel.fr<span class="separator">&nbsp;&#62;&nbsp;</span></span><input type="text" name="userinput" class="userinput input-group-prepend">
				</div>
			</div>
		</div> -->
		<form id="term_form" action="#"  autocomplete="off">
			<div class="input-group mb-3 input">
				<div class="input-group-prepend">
					<span class="input-group-text prompt"><?php echo  get_client_ip_env();?>@developpeur-logiciel.fr<span class="separator">&nbsp;&#62;</span></span>
				</div>
				<input type="text"  name="userinput"  class="form-control userinput"  onblur="this.focus()" autofocus spellcheck="false">
				<!--<div class="input-group-append">
					<span class="input-group-text">.00</span>
				</div>-->
			</div>
		</form>
	</div>


	<footer class="page-footer" id="page_footer">
		<input type="text" id="mk_kbd_appear">		
	</footer>
	<script src="public/js/terminal.js"></script>
	<script>
	// hilight le code affiché quand il y en a - hack temporaire -
	$('pre code').each(function(i, block) {
		hljs.highlightBlock(block);
	});
	$(document).scroll(function(){
		$('pre code').each(function(i, block) {
			hljs.highlightBlock(block);
		});
	});
</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119986103-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-119986103-1');
</script>

</body>
</html>
