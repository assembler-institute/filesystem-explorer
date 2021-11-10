<?php
/**
 * List rescursive folders
 *
 * @param string $path
 * @return void
 */
function ListFolder($path)
{
    //using the opendir function
    $dir_handle = opendir($path) or die("Unable to open $path");

    //Leave only the lastest folder name
    $array = explode("/", $path);

    $dirname = end($array);

    //display the target folder.
    if ($dirname) {
        echo "<li>$dirname\n";
    }

    echo "<ul>\n";

    while (false !== ($file = readdir($dir_handle))) {
        if ($file != "." && $file != "..") {
            if (is_dir($path . "/" . $file)) {
                //Display a list of sub folders.
                ListFolder($path . "/" . $file);
            } else {
                $ext = substr($path . $file, -3, 3);
                $icon = "./assets/img/icons/" . $ext . ".svg";
                //Display a list of files.
                echo "<li class='tree-max' data-jstree='{\"icon\":\"$icon\"}'>" . $file . "</li>";
            }
        }
    }
    echo "</ul>\n";
    echo "</li>\n";

    //closing the directory
    closedir($dir_handle);
}

/**
 * Upload file
 *
 * @return void
 */
function uploadFile()
{
    if ($_FILES['file']['name'] !== '') {
        $fileName = $_FILES['file']['name'];
        $test = explode(".", $_FILES['file']['name']);
        $extension = end($test);
        $acceptedExtensions = ['doc', 'csv', 'jpg', 'png', 'txt', 'ppt', 'odt', 'pdf', 'zip', 'rar', 'exe', 'svg', 'mp3', 'mp4'];

        if (!in_array($extension, $acceptedExtensions)) echo "wrong type, the accepted extensions are the following: " . print_r($acceptedExtensions);
        else {
            $date = new DateTime();
            $timestamp = $date->getTimestamp();
            $currentFolder = '';
            if(isset($_GET['folder'])){
                $currentFolder = $_GET['folder'];
            }
            $location = getcwd() . '/uploads/'.$currentFolder."/".$test[0]."-".$timestamp.".".$extension;
            //echo $location;
            move_uploaded_file($_FILES['file']['tmp_name'], $location);
            $redirect = '../index.php?folder='.$currentFolder;
            //Location to be discussed
            header("Location: $redirect");
        };
    }
};

function editFile()
{
    if (isset($_POST['newName'])) {
        $newName = $_POST['newName'];
        echo $newName;
        // rename($oldName, $newName);
        $mainPath = getcwd() . '/modules/uploads' . "/";
    }
};


function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

// ESTA FUNCIÓN TIENE QUE:
// - BUSCAR SI HAY RESULTADOS
// SI HAY RESULTADOS -> PRINT DE LOS RESULTADOS EN UN BLOQUE
// - BORRAR DATOS DE LA BÚSQUEDA EN LA SESIÓN


// DISPLAY MATCHING FILES WHEN SEARCHING

// function displayMatchingFiles() {

// }