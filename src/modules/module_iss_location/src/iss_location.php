<?php
require_once(dirname(dirname(dirname(dirname(__DIR__))))."\src\util\pretty_print_json.php"); // because LOL

function iss_location()
{
	echo prettyPrint(file_get_contents("http://api.open-notify.org/iss-now.json"));
}
