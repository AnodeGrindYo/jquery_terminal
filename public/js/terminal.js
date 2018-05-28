var userinput = "";
var inputlines = 1;
var toeval = "";
var terminalresponse = "";
var is_mobile = false;
var command_history = new Array();
var current_command_history_index = 0;

var isMobile = {
    Android: function() {
        return navigator.userAgent.match(/Android/i);
    },
    BlackBerry: function() {
        return navigator.userAgent.match(/BlackBerry/i);
    },
    iOS: function() {
        return navigator.userAgent.match(/iPhone|iPad|iPod/i);
    },
    Opera: function() {
        return navigator.userAgent.match(/Opera Mini/i);
    },
    Windows: function() {
        return navigator.userAgent.match(/IEMobile/i);
    },
    any: function() {
        return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
    }
};

if( isMobile.any() ) // si c'est un mobile
{
    console.log("Mobile détecté");
    is_mobile = true;
}
else
{
	$('html').keydown(function(event) {
		switch(event.keyCode) {
			case 38: current_command_history_index++// touche up
				if (current_command_history_index > (command_history.length-1))
				{
					current_command_history_index = 0;
				}
				$(".userinput").val(command_history[current_command_history_index]);
				console.log(current_command_history_index);
				break;
			case 40: current_command_history_index--// touche down
				if (current_command_history_index < 0)
				{
					current_command_history_index = command_history.length-1;
				}
				$(".userinput").val(command_history[current_command_history_index]);
				console.log(current_command_history_index);
				break;
			default: break;
		}
	});
}

jQuery.fn.removeAttributes = function() {
  return this.each(function() {
    var attributes = $.map(this.attributes, function(item) {
      return item.name;
    });
    var tag = $(this);
    $.each(attributes, function(i, item) {
    tag.removeAttr(item);
    });
  });
}



/*// permet de valider la saisie
function validateinput() {
	console.log($(".input").html());
    var newhistory = $(".input").html();
    newhistory = newhistory.replace('userinput', '');
    newhistory = newhistory.replace('cursor', '');
    newhistory = "<div>" + newhistory + "</div>";
    toeval = userinput;
    userinput = "";
    $(".input").before(newhistory);
    evalinput(toeval); console.log(toeval);
    $('.userinput').html(userinput);
    $(document).scrollTop($(document).height());
    //inputlines = 1;
};*/

// fonction d'aide de l'utilisateur pour une commande spécifique
function help(arg)
{
    switch(arg)
    {
        case "showcv": terminalresponse = "affiche mon cv en pdf dans un nouvel onglet";
            $(".input").before(terminalresponse);
            break;
        case "whoami": terminalresponse = "\"Connais-toi toi-même et tu connaîtras l'univers et les dieux.\"";
            $(".input").before(terminalresponse);
            break;
        case "apod": terminalresponse = "affiche la photo d'astronomie du jour et quelques infos à son sujet";
            $(".input").before(terminalresponse);
            break;
        /*case "iss_location": terminalresponse = "permet d'afficher la position actuelle de la station spatiale internationale<br>au format JSON (si vous ne savez pas ce que c'est, c'est un format de structure de données standard sur le web... essayez la commande, vous allez comprendre)<br>désactivé car l'API est en http et je suis en https";
            $(".input").before(terminalresponse);
            break;
        case "people_in_space": terminalresponse = "permet d'afficher la liste des personnes actuellement dans l'espace, au format JSON<br>désactivé car l'API est en http et je suis en https";
            $(".input").before(terminalresponse);
            break;*/
        default: terminalresponse = "commande inconnue : '"+arg+"'";
            $(".input").before(terminalresponse);
            break;
    }
};


// affiche le cv dans un nouvel onglet
function showcv()
{
    console.log(window.location.pathname);
    window.open(window.location.pathname+"/../public/files/Adrien_Godoy_SoftDev.pdf");
};

function route(arg)
{
    terminalresponse = $.ajax({
        method: "POST",
        url: "src/ctrl/route.php",
        data: {"input": arg},
        dataType: "text"
    })
    .done(function(retour){
        console.log(retour);
        $("#term_form").before("&nbsp;"+$("#term_form").children().text()+"&nbsp;&nbsp;"+command_history[0]);
        $("#term_form").before(retour);
    });    
}

// évalue la saisie utilisateur, détecte les commandes implémentées et lance les fonctions correspondantes
function evalinput(input)
{
    console.log("evalinput");
    var arr = input.split(' ');
    switch(arr[0])
    {
        case "apod": route("apod");
            break;
        case "code_python": window.open('https://developpeur-logiciel.fr/terminal/src/modules/module_code_editor/python/index.php', 'name');
        	break;
        case 'help': 
            if (arr.length > 1)
            {
                help(arr[1]);
            }
            else
            {
                route("help_generic");
            }
            break;
        case "iss_live": route("iss_live");
        break;
        case "learn_machine_learning": route("learn_machine_learning");
        break;
        /*case "iss_location": iss_location();  // désactivé car l'api est en http et pas en https
            break;
        case "people_in_space": people_in_space(); // désactivé car l'api est en http et pas en https
            break;*/
        case 'showcv': showcv();
        break;
        case 'where_is_iss': route("where_is_iss");
        break;
        case 'whoami': route("whoami");
        break;
        default: terminalresponse = "commande inconnue : '"+arr[0]+"'";
            $(".input").before(terminalresponse);
            break;
    }
};


$(document).keyup((function(){
	var _input = $(".userinput").val().replace(/[^a-zA-Z \-_]/g, ""); // modifier ici si on a besoin d'autoriser plus de caractère en front
	$(".userinput").val(_input);
	input = _input;
}));

$("#term_form").submit(function(e){
	e.preventDefault();
	evalinput(input);
	$(".userinput").val("");
	command_history.unshift(input);
	current_command_history_index = -1;
	input = "";
});