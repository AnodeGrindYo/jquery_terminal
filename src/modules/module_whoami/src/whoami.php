<?php

function whoami()
{
  //echo "function whoami";
	$ip = get_client_ip_env();
	$os = getOS();
	$browser = getBrowser();
	$htmltable = "
		<table>
			<caption>γνῶθι σεαυτόν</caption>
			<tbody>
				<tr>
					<td>IP</td><td>".$ip."</td>
				</tr>
				<tr>
					<td>OS</td><td>".$os."</td>
				</tr>
				<tr>
					<td>Browser &nbsp;&nbsp;&nbsp;</td><td>".$browser."</td>
				</tr>
			</tbody>
		</table>
	";
  /*$caption = "
    <video autoplay></video>
    <script>
    const constraints = {
      video: true
    };

    const video = document.querySelector('video');

    function handleSuccess(stream) {
      video.srcObject = stream;
    }

    function handleError(error) {
      console.error('Reeeejected!', error);
    }

    navigator.mediaDevices.getUserMedia(constraints).
      then(handleSuccess).catch(handleError);
    </script>
  ";*/
  $caption = '
  <link rel="stylesheet" href="public/css/ascii_cam.css">
  <pre id="ascii_cam" class="ascii_cam"></pre>
  <script src="public/js/ascii_cam_camera.js"></script>
  <script src="public/js/ascii_cam_ascii.js"></script>
  <script src="public/js/ascii_cam_app.js"></script>
  ';
	echo $caption.$htmltable;
}

function get_client_ip_env() 
{
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
 
    return $ipaddress;
}

function getOS() 
{ 
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $os_platform  = "Unknown OS Platform";
    $os_array     = array(
                          '/windows nt 10/i'      =>  'Windows 10',
                          '/windows nt 6.3/i'     =>  'Windows 8.1',
                          '/windows nt 6.2/i'     =>  'Windows 8',
                          '/windows nt 6.1/i'     =>  'Windows 7',
                          '/windows nt 6.0/i'     =>  'Windows Vista',
                          '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                          '/windows nt 5.1/i'     =>  'Windows XP',
                          '/windows xp/i'         =>  'Windows XP',
                          '/windows nt 5.0/i'     =>  'Windows 2000',
                          '/windows me/i'         =>  'Windows ME',
                          '/win98/i'              =>  'Windows 98',
                          '/win95/i'              =>  'Windows 95',
                          '/win16/i'              =>  'Windows 3.11',
                          '/macintosh|mac os x/i' =>  'Mac OS X',
                          '/mac_powerpc/i'        =>  'Mac OS 9',
                          '/linux/i'              =>  'Linux',
                          '/ubuntu/i'             =>  'Ubuntu',
                          '/iphone/i'             =>  'iPhone',
                          '/ipod/i'               =>  'iPod',
                          '/ipad/i'               =>  'iPad',
                          '/android/i'            =>  'Android',
                          '/blackberry/i'         =>  'BlackBerry',
                          '/webos/i'              =>  'Mobile'
                    );
    foreach ($os_array as $regex => $value)
    {
        if (preg_match($regex, $user_agent))
            $os_platform = $value;
    }
    return $os_platform;
}


function getBrowser() {
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $browser        = "Unknown Browser";
    $browser_array = array(
                            '/msie/i'      => 'Internet Explorer',
                            '/firefox/i'   => 'Firefox',
                            '/safari/i'    => 'Safari',
                            '/chrome/i'    => 'Chrome',
                            '/edge/i'      => 'Edge',
                            '/opera/i'     => 'Opera',
                            '/netscape/i'  => 'Netscape',
                            '/maxthon/i'   => 'Maxthon',
                            '/konqueror/i' => 'Konqueror',
                            '/mobile/i'    => 'Handheld Browser'
                     );
    foreach ($browser_array as $regex => $value)
        if (preg_match($regex, $user_agent))
            $browser = $value;
    return $browser;
}