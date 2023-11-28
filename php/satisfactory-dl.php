<?php
//usage https://home.gamer.com.tw/artwork.php?sn=5836924
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header($_SERVER["SERVER_PROTOCOL"] . " 200 OK");
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Methods: POST, GET, OPTION");
	header("Access-Control-Allow-Headers: *");
	die();
}else{
	$files = scandir('server', SCANDIR_SORT_DESCENDING);
	$newest_file = $files[0];
	$f_time = 0;
	foreach($files AS $f_name){
		if (!str_starts_with($f_name,".") && filemtime(dirname(__FILE__)."/server/".$f_name) > $f_time) {
			$newest_file = $f_name;
			$f_time = filemtime(dirname(__FILE__)."/server/".$f_name);
		}
	}
	
	$attachment_location = dirname(__FILE__)."/server/".$newest_file;
	if (file_exists($attachment_location)) {
		header($_SERVER["SERVER_PROTOCOL"] . " 200 OK");
		header("Cache-Control: public");
		header("Content-Type: application/sav");
		header("Content-Transfer-Encoding: Binary");
		header("Content-Length:".filesize($attachment_location));
		header("Content-Disposition: attachment; filename=sf_newest.sav");
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Methods: POST, GET, OPTION");
		header("Access-Control-Allow-Headers: *");
		readfile($attachment_location);
		die();        
	} else {
		die("Error: File not found.");
	} 
}
?>
