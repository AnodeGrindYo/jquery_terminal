<?php

$nasa_key = "cgb1QhXIcvUNgJkwCt589Yr2CvzH2tkcvkaTdy1b";

function apod($key = "cgb1QhXIcvUNgJkwCt589Yr2CvzH2tkcvkaTdy1b")
{

	$treasure = json_decode(file_get_contents("https://api.nasa.gov/planetary/apod?api_key=".$key), true);

	if(isset($treasure["explanation"]))
		$explanation = $treasure['explanation'];
	else
		$explanation = "pas d'explication disponible";
	if(isset($treasure['hdurl']))
		$hdurl = $treasure['hdurl'];
	if(isset($treasure["title"]))
		$title = $treasure["title"];
	else
		$title = "pas de titre";
	if(isset($treasure['date']))
		$date = $treasure['date'];
	else
		$date = "pas de date";
	if(isset($treasure["copyright"]))
		$copyright = $treasure["copyright"];
	else
		$copyright = "pas de copyright";

	echo "<div class=row style='display: flex;justify-content:center; word-wrap:break-word; align-items: center;'>&nbsp;&nbsp;&nbsp;
	
	<div>
		<table class='table' style='word-wrap:break-word;'>
			<caption><div><img src=\"".$treasure['hdurl']."\" alt=\"".$title."\" class='img-fluid'></div></caption>
			<tbody>
				<tr>
					<td>titre</td><td>".$title."<br></td>
				</tr>
				<tr>
					<td>explications&nbsp;&nbsp;&nbsp;</td><td>".$explanation."</td>
				</tr>
				<tr>
					<td>date</td><td>".$date."</td>
				</tr>
				<tr>
					<td>copyright</td><td>".$copyright."</td>
				</tr>
			</tbody>
		</table>
	</div>
	</div>
	";
}

function where_is_iss()
{
	$iss = json_decode(file_get_contents("https://api.wheretheiss.at/v1/satellites/25544"), true);
	echo "
	<table class='table'>
		<caption>position actuelle de l'iss</caption>
		<tbody>
			<tr>
				<td>latitude</td><td>".$iss['latitude']."</td>
			</tr>
			<tr>
				<td>longitude</td><td>".$iss['longitude']."</td>
			</tr>
			<tr>
				<td>altitude</td><td>".$iss['altitude']."</td>
			</tr>
			<tr>
				<td>vélocité</td><td>".$iss['velocity']."</td>
			</tr>
			<tr>
				<td>visibilité&nbsp;&nbsp;&nbsp;</td><td>".$iss['visibility']."</td>
			</tr>
			<tr>
				<td>google map&nbsp;&nbsp;&nbsp;</td><td>
					<a href='https://maps.google.com/maps?t=k&q=".$iss['latitude']."+".$iss['longitude']."&z=4' title='map' target='_blank'>https://maps.google.com/maps?q=".$iss['latitude']."+".$iss['longitude']."&z=4
					</a>
				</td>
			</tr>
		</tbody>
	</table>
	";
}

function iss_live()
{
	/*
	x = 560; x = 100
	y = 315; y = 56.25
	 */
	echo '
	<iframe width="250vw" height="168.75vw" src="https://www.youtube.com/embed/ddFvjfvPnqk" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
}

/*apod();*/
