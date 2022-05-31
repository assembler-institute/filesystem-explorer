
<form method="GET">
    <input name="search" placeholder="entery query" autocomplete="off">
    <input type="submit" name="submit">
</form>


<?php 


function getSearchResults($search) {
    
    $target_dir = __DIR__. '/root/';
    $files = scandir($target_dir);
    $results = array();
    foreach($files) 
}

if (isset($_GET['submit'])) {
    $search = $_GET["search"];
    
    

    getSearchResults($search);

}




// $target_dir = __DIR__."/root/";

// function listAllFiles($dir) {
//     $array = array_diff(scandir($dir), array('.', '..'));

//     foreach ($array as &$item) {
//       $item = $dir . $item;
//     }
//     unset($item);
//     foreach ($array as $item) {
//       if (is_dir($item)) {
//        $array = array_merge($array, listAllFiles($item . DIRECTORY_SEPARATOR));
//       }
//     }
//     echo "<pre>";
//     print_r($array);
//      echo "</pre>";
//   }

//   listAllFiles($target_dir);