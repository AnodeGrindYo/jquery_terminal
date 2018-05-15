<?php
require_once("src/util/get_visitor_infos.php");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>developpeur-logiciel.fr</title>
    
    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    
    
    <link rel="stylesheet" href="public/css/terminal.css">
</head>

<body>
   <div class="container-fluid terminal">
    <?php include("ascii_art.php"); ?>
    <div>
        Tip: tappez help pour afficher la liste des commandes.
    </div>
         <div class="input">
            <span class="prompt"><?php echo  get_client_ip_env();?>@developpeur-logiciel.fr<span class="separator">&nbsp;&#62;&nbsp;</span></span><span class="userinput"></span><span class="cursor">&nbsp; </span>
         </div>
   </div>
    <script src="public/js/terminal.js"></script>
</body>
</html>
