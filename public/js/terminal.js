var userinput = "";
var toeval = "";
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
    $('.userinput').html(userinput);
}
// évalue la touche appuyée et lance les bonnes fonctions en conséquence
$('html').keydown(function (event) {
    console.log(event.keyCode);
    switch (event.keyCode) {
    case 8:
        delchar(event); // touche backspace
        break;
    case 13:
        validateinput(); // touche entrée
        break;
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
        addchar(event); // autres touches du clavier
        break;
    }
});