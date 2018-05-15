<?php
$debug = true;

// retourne la liste des répertoires de $path sous la forme
// d'un tableau
function list_directories($path)
{
    $folders = [];
    // add / in the end if it's missing
    if(substr($path, -1) != '/')
    {
        $path .= '/';
    }
    //get all files in specified directory
    $files = glob($path . "*");
    
    // adds each folder in $folders array
    foreach($files as $file)
    {
        // check to see if the file is a folder/dir
        if(is_dir($file))
        {
            array_push($folders, $file);
        }
    }
    return $folders;
}

// s'occupe de require_once les modules
function autoload_modules($debug=false)
{
    // récupère la liste des répertoires dans le dossier modules/
    $dirs = list_directories("./");
    $modules = []; // accueillera la liste des modules
    var_dump($dirs); // debug
    foreach($dirs as $dir)
    {
        // vérifie que le dossier est bien un module
        // pour cela, son nom doit commencer par le préfixe
        // 'module_'
        // si c'est le cas, on l'ajoute au tableau $modules
        if (strpos($dir, "./module_") === 0)
        {
            array_push($modules, $dir);
        }
    }
    
    // ajoute un require_once pour chaque module détecté;
    // le point d'entrée d'un module est situé dans un dossier src
    // et porte le nom du dossier sans le prefixe 'module_'
    // par exemple, pour le module 'example', le point d'entrée sera
    // module_example/src/example.php
    foreach ($modules as $module)
    {
        $module_name = str_replace("./module_", "", $module);
        /*if($debug)
        {*/
            echo "ajout d'un require_once : ";
            echo $module."/src/".$module_name.".php<br>";
        /*}*/
        require_once($module."/src/".$module_name.".php");
    }
}

// debug
if(isset($_GET) && isset($_GET["debug"]))
{
    if($_GET["debug"] == "true")
    {
        $debug = true;
        // test de la fonction echo_directories
        echo "test de autoload_modules()<br>";
        autoload_modules($debug);
    }
}

autoload_modules();
