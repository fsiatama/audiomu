<?php
//print_r($_SERVER);


//if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
include("./config.php");

//valida que la solicitud provenga del reproductor de audiomu.com de lo contrario no deberia dejarla reproducir.
$soundmanager_referer = (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');

require_once(PATH_RAIZ."lib/getid3/getid3/getid3.php");
if(!empty($filename) && !empty($extension) && !empty($type) /*&& $soundmanager_referer !== false*/){
	if ($type == "complete") {
		$filename = PATH_MEDIA.$extension."/completas/".$filename;
	} else {
		$filename = PATH_MEDIA.$extension."/".$filename;
	}
	
	
	//print $filename;
	if(file_exists($filename)){
		$getID3 = new getID3();
		$id3_info = $getID3->analyze($filename);
		
		$handle = fopen($filename, 'r');
		$content = fread($handle, filesize($filename));
		
		$length = strlen($content);
				
		header("Content-Type: {$id3_info['mime_type']}");
		header("Content-Length: {$length}");
		print $content;
		exit();
	}
}
header("HTTP/1.0 404 Not Found");
exit();


function cortar_mp3($filename){
	$getID3 = new getID3();
	$id3_info = $getID3->analyze($filename);
	
	list($t_min, $t_sec) = explode(':', $id3_info['playtime_string']);
	$time = ($t_min * 60) + $t_sec;
	
	$preview = $time / 30; // Preview time of 30 seconds
	
	$handle = fopen($filename, 'r');
	$content = fread($handle, filesize($filename));
	
	$length = strlen($content);
	
	$length = round(strlen($content) / $preview);
	$content = substr($content, $length * .66 /* Start extraction ~20 seconds in */, $length);
	return $content;
}


print_r($_REQUEST);
exit();





// if you want to get more examples or the class with comments, please download this zip file:
// http://www.mfman.net/class.mp3.zip

require_once(PATH_RAIZ."lib/class.mp3.php");

$mp3 = new mp3;

/*

	get the data of mp3 file:

		mp3::get_mp3($filepath, $analysis = false, $getframesindex = false)
		it will return an array or false

*/
$mp3->get_mp3('example.mp3', true, false);

/*

	set the tags of mp3 file

		set_mp3($file_input, $file_output, $id3v2 = array(), $id3v1 = array())
		it will return true or false

*/
$mp3->set_mp3('input.mp3', 'output.mp3', array(), array());

/*

	cut the mp3 file

		cut_mp3($file_input, $file_output, $startindex = 0, $endindex = -1, $indextype = 'frame', $cleantags = false)
		it will return true or false

*/
$mp3->cut_mp3('input.mp3', 'output.mp3', 0, -1, 'frame', false);


?>