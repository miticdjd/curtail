<?php

/* Setup folders */
define('CACHE', true);
define('CACHE_DIR', realpath(dirname(__FILE__)) . '/cache/');
define('CSS_DIR', realpath(dirname(__FILE__)) . '/css/');
define('JS_DIR', realpath(dirname(__FILE__)) . '/js/');

/* Get type of files we will cache and what files we will cache */
$type = $_GET['type'];
$files = explode(',', $_GET['files']);

/* Let's get base directory */
switch ($type) {
	case 'css':
		$baseDir = CSS_DIR;
	break;
	case 'js':
		$baseDir = JS_DIR;
	break;
	default:
		header ("HTTP/1.0 503 Not Implemented");
		exit;
	break;
}

$lastmodified = 0;
foreach ($files as $file) {
	$path = $baseDir . $file;
	$ext = pathinfo($path, PATHINFO_EXTENSION);

	if (!in_array($ext, array('css', 'js'))) {
		/* We have some file that is not css or js */
		header ("HTTP/1.0 403 Forbidden");
		exit;
	}

	if (!file_exists($path)) {
		/* Some of the files are not found */
		header ("HTTP/1.0 404 Not Found");
        exit;
	}

	$lastmodified = max($lastmodified, filemtime($path));
}

$hash = md5($files);
header ("Etag: \"" . $hash . "\"");

if (isset($_SERVER['HTTP_IF_NONE_MATCH']) && stripslashes($_SERVER['HTTP_IF_NONE_MATCH']) == '"' . $hash . '"') 
{
    /* This is returning visit so don't send anything */
    header ("HTTP/1.0 304 Not Modified");
    header ('Content-Length: 0');
} else {
	/* This is new visit */
}

?>