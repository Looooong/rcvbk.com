<?php
	function getBrowser() { 
		$u_agent = $_SERVER['HTTP_USER_AGENT']; 
		$bname = 'Unknown';
		$platform = 'Unknown';
		$version= "";
	
		//First get the platform?
		if (preg_match('/linux/i', $u_agent)) {
			$platform = 'linux';
		} else if (preg_match('/macintosh|mac os x/i', $u_agent)) {
			$platform = 'mac';
		} else if (preg_match('/windows|win32/i', $u_agent)) {
			$platform = 'windows';
		};
		
		// Next get the name of the useragent yes seperately and for good reason
		if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) { 
			$bname = 'Internet Explorer'; 
			$ub = "MSIE"; 
		} else if(preg_match('/Firefox/i',$u_agent)) { 
			$bname = 'Mozilla Firefox'; 
			$ub = "Firefox"; 
		} else if(preg_match('/Chrome/i',$u_agent)) { 
			$bname = 'Google Chrome'; 
			$ub = "Chrome"; 
		} else if(preg_match('/Safari/i',$u_agent)) { 
			$bname = 'Apple Safari'; 
			$ub = "Safari"; 
		} else if(preg_match('/Opera/i',$u_agent)) { 
			$bname = 'Opera'; 
			$ub = "Opera"; 
		} else if(preg_match('/Netscape/i',$u_agent)) { 
			$bname = 'Netscape'; 
			$ub = "Netscape"; 
		};
		
		// finally get the correct version number
		$known = array('Version', $ub, 'other');
		$pattern = '#(?<browser>'.join('|', $known).')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
		if (!preg_match_all($pattern, $u_agent, $matches)) {
			// we have no matching number just continue
		};
		
		// see how many we have
		$i = count($matches['browser']);
		if ($i != 1) {
			//we will have two since we are not using 'other' argument yet
			//see if version is before or after the name
			if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
				$version= $matches['version'][0];
			} else {
				$version= $matches['version'][1];
			};
		} else {
			$version= $matches['version'][0];
		};
		
		// check if we have a number
		if ($version==null || $version=="")
			$version="?";
		
		return array(
			'userAgent' => $u_agent,
			'name'      => $bname,
			'version'   => $version,
			'platform'  => $platform,
			'pattern'    => $pattern
		);
	};

	$browser = getBrowser();
	
	if ($browser['name'] == 'Mozilla Firefox') {
	?>
<style>
html {
	overflow: hidden;	
}
</style>
    <?php
	};
?>
<div id="header">
	<img src="/resource/img/cover.jpg" />
	<div id="eventMap">
	<?php
		include("ajax/eventMap.php");
	?>
	</div>
</div>
<?php
	require_once("main/navigator.php");
?>