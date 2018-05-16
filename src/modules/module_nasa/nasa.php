<?php

$nasa_key = "cgb1QhXIcvUNgJkwCt589Yr2CvzH2tkcvkaTdy1b";

function apod($key = "cgb1QhXIcvUNgJkwCt589Yr2CvzH2tkcvkaTdy1b")
{

	$treasure = json_decode(file_get_contents("https://api.nasa.gov/planetary/apod?api_key=".$key), true);
	/*var_dump($treasure);*/
	//$explaination = chunk_split($treasure['explanation'], 145);
	$explanation = wordwrap($treasure['explanation'], 100, "<br>", true);
	echo "<div style='display: flex;justify-content:center; word-wrap:break-word; align-items: center;'>&nbsp;&nbsp;&nbsp;
	
	<div>
		<table style='width: 500px; word-wrap:break-word; table-layout: fixed;'>
			<caption><div><img src=\"".$treasure['hdurl']."\" alt=\"".$treasure['title']."\" style='width:300px;height=300px'></div></caption>
			<tbody>
				<tr>
					<td>titre</td><td>".$treasure['title']."<br></td>
				</tr>
				<tr>
					<td>explications&nbsp;&nbsp;&nbsp;</td><td>".$explanation."</td>
				</tr>
				<tr>
					<td>date</td><td>".$treasure['date']."</td>
				</tr>
				<tr>
					<td>copyright</td><td>".$treasure['copyright']."</td>
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
	<table>
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
				<td>google map&nbsp;&nbsp;&nbsp;</td><td><a href='https://maps.google.com/maps?t=k&q=".$iss['latitude']."+".$iss['longitude']."&z=4' title='map' target='_blank'>https://maps.google.com/maps?q=".$iss['latitude']."+".$iss['longitude']."&z=4</a></td>
			</tr>
		</tbody>
	</table>
	";
}

function iss_live()
{
	echo '<iframe width="560" height="315" src="https://www.youtube.com/embed/ddFvjfvPnqk" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
}

/*apod();*/
