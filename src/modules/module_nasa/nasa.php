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

/*apod();*/
