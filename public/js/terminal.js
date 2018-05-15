var userinput = "";
var inputlines = 1;
var toeval = "";
var terminalresponse = "";


// permet de récupérer et d'afficher les touches du clavier saisies par l'utilisateur
function addchar(event) {
    userinput += event.key;
    $(".userinput").html(userinput);
};

// permet de supprimer un caractère avec un appui sur backspace
function delchar(event) {
    userinput = userinput.slice(0, -1);
    $(".userinput").html(userinput);
};

// permet de valider la saisie
function validateinput() {
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
};

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
        case "iss_location": terminalresponse = "permet d'afficher la position actuelle de la station spatiale internationale<br>au format JSON (si vous ne savez pas ce que c'est, c'est un format de structure de données standard sur le web... essayez la commande, vous allez comprendre)";
            $(".input").before(terminalresponse);
            break;
        default: terminalresponse = "commande inconnue : '"+arg+"'";
            $(".input").before(terminalresponse);
            break;
    }
};

// fonction d'aide générique qui liste les commandes implémentées
function help_generic()
{
    terminalresponse = $.ajax({
        method: "POST",
        url: "src/ctrl/route.php",
        data: {"input": "help_generic"},
        dataType: "text"
    })
    .done(function(retour){
        console.log(retour);
        $(".input").before(retour);
    });
};

// affiche le cv dans un nouvel onglet
function showcv()
{
    console.log(window.location.pathname);
    window.open(window.location.pathname+"/../public/files/Adrien_Godoy_SoftDev.pdf");
};

// affiche des infos basiques sur le visiteur
function whoami()
{
    terminalresponse = $.ajax({
        method: "POST",
        url: "src/ctrl/route.php",
        data: {"input": "whoami"},
        dataType: "text"
    })
    .done(function(retour){
        console.log(retour);
        $(".input").before(retour);
    });
};

// affiche la position actuelle de l'ISS
function iss_location()
{
    terminalresponse = $.ajax({
        method: "POST",
        url: "src/ctrl/route.php",
        data: {"input": "iss_location"},
        dataType: "text"
    })
    .done(function(retour){
        console.log(retour);
        $(".input").before(retour);
    });
}

// évalue la saisie utilisateur, détecte les commandes implémentées et lance les fonctions correspondantes
function evalinput(input)
{
    console.log("evalinput");
    var arr = input.split(' ');
    switch(arr[0])
    {
        case 'help': 
            if (arr.length > 1)
            {
                help(arr[1]);
            }
            else
            {
                help_generic();
            }
            break;
        case "iss_location": iss_location();
            break;
        case 'showcv': showcv();
        break;
        case 'whoami': whoami();
        break;
        default: terminalresponse = "commande inconnue : '"+arr[0]+"'";
            $(".input").before(terminalresponse);
            break;
    }
};

// évalue la touche appuyée et lance les bonnes fonctions en conséquence
$('html').keydown(function (event) {
    console.log("lines : "+inputlines);
    console.log(event.keyCode);
    console.log("length: "+userinput.length);
    /*if(userinput.length == 206 && inputlines == 1)
    {
        userinput += "<br>";
        inputlines++;
    }
    else if ((userinput.length - 206)%252 == 0)
    {
        userinput += "<br>";
        inputlines++;
    }*/
    switch (event.keyCode) {
    case 8:
        delchar(event); // touche backspace
        break;
    case 13:
        validateinput(); // touche entrée
        break;
    case 9: // touche tab
    case 16: // touche shift
    case 17: // touche control
    case 18: // touche altgraph
    case 19: // touche pause
    case 20: // touche caps lock
    case 27: // touche echap
    case 33: // touche pageup
    case 34: // touche pagedown
    case 35: // touche fin
    case 36: // touche home
    case 37: // arrow left
    case 38: // arrow up
    case 39: // arrow right
    case 40: // arrow down
    case 45: // touche insert
    case 91: // touche meta
    case 93: // touche context menu
    case 112: // touche f1
    case 113:
    case 114:
    case 115:
    case 116:
    case 117:
    case 118:
    case 119:
    case 120:
    case 121:
    case 122:
    case 123: // touche f12
    case 144: // touche verr num
    case 145: // touche scroll lock
    case 226: // touche <
        break;
    default:
        if (userinput.length < 145) { // limite la saisie utilisateur à 144 chars
            addchar(event); // autres touches du clavier
        }
        break;
    }
});