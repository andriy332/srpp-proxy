<?php
error_reporting(0);

$url = htmlentities($_GET['url']);

if (!$url){
	header('HTTP/1.1 400 Bad Request');
	die;
}

$d = hex2bin($url);
function getUrlMimeType($url) {
    $buffer = file_get_contents($url);
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    return $finfo->buffer($buffer);
}

$opts = array(
  'http'=>array(
    'method'=>"GET",
    "header" => "Accept: */*\r\n" .
    "User-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36"
  )
);

$context = stream_context_create($opts);

echo file_get_contents($url, false, $context);

