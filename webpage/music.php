<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
 "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Music Viewer</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link href="viewer.css" type="text/css" rel="stylesheet" />
	</head>
	<body>
		<div id="header">

			<h1>190M Music Playlist Viewer</h1>
			<h2>Search Through Your Playlists and Music</h2>

			<?php 
				$playlist="";
				if (isset($_REQUEST["playlist"])){
					$playlist = $_REQUEST["playlist"];	
					$handle = fopen("songs/".$playlist, "r");
				}?>
		</div>


		<div id="listarea">
			<ul id="musiclist">
			<?php
			
		 	
			if (isset($handle)) {
			    while (($line = fgets($handle)) !== false) {
					$filename=trim("songs/".$line);
					$size = filesize($filename)>1024 ? round(filesize($filename)/(1024*1024), 2)." MB" : filesize($filename)." B"
					?>
					<li class='mp3item'><a href='<?= $filename ?>'><?= basename($line) ?></a> (<?=$size;?>)</li>
			    <?php
			    }

			    fclose($handle);
			} else {
				foreach (glob("songs/*.mp3") as $filename) {
					$size = filesize($filename)>1024 ? round(filesize($filename)/(1024*1024), 2)." MB" : filesize($filename)." B"
					
					?>
					<li class='mp3item'><a href='<?=$filename ?>'><?= basename($filename) ?></a> (<?=$size?>)</li>
			    <?php
				}
				foreach (glob("songs/*.txt") as $filename) {
					$size = filesize($filename)>1024 ? round(filesize($filename)/(1024*1024), 2)." MB" : filesize($filename)." B"
					
					?>
					<li class='mp3item'><a href='<?=$filename ?>'><?= basename($filename) ?></a> (<?=$size?>)</li>
			    <?php
				}
			}
			?>
			</ul>
		</div>
	</body>
</html>
