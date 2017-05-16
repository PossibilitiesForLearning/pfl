<?php

/** define the directory **/
$dir = "./tmp/";

/*** cycle through all files in the directory ***/
foreach (glob($dir."*.pfl") as $file) 
{
	/*** if file is 1hr hours (3600 seconds) old then delete it ***/
	if (filemtime($file) < time() - 3600){ unlink($file); }
}

?>
