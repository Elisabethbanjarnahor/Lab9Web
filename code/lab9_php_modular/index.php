<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'home';


$parts = explode('/', $page);

$folder = $parts[0];       
$file   = isset($parts[1]) ? $parts[1] : 'list'; 

$path = "";

if ($folder == "user") {
    
    $path = "user/" . $file . ".php";
} else {

    $path = "pages/" . $folder . ".php";
}

if (!file_exists($path)) {
    echo "<h2>404 - Halaman tidak ditemukan!</h2>";
    exit;
}


require "header.php";

require $path;
require "footer.php";
?>
