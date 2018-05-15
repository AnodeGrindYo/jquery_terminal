<?php
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
    var_dump($folders);
    return $folders;
}

function echo_directories($directory)
{
    //get all files in specified directory
    $files = glob($directory . "*");

    //print each file name
    foreach($files as $file)
    {
        //check to see if the file is a folder/directory
        if(is_dir($file))
        {
            echo $file."<br>";
        }
    }
}

//echo "test";
// test des fonctions
if(isset($_GET) && isset($_GET["debug"]))
{
    if($_GET["debug"] == "true")
    {
        // test de la fonction echo_directories
        echo "test de echo_directories<br>";
        echo_directories("../");
        
        // test de la fonction list_directories
        echo " test de list_directories<br>";
        list_directories("../");
    }
}
