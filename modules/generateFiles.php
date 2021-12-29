<?php
function generateFilesFun($ruta){
    // Se comprueba que realmente sea la ruta de un directorio
    if (is_dir($ruta)){
        // Abre un gestor de directorios para la ruta indicada
        $gestor = opendir($ruta);
        echo "<ul class='fa-ul'>";
        // Recorre todos los elementos del directorio
        while (($archivo = readdir($gestor)) !== false)  {
            $ruta_completa = $ruta . "/" . $archivo;
            // Se muestran todos los archivos y carpetas excepto "." y ".."
            if ($archivo != "." && $archivo != "..") {
                // Si es un directorio se recorre recursivamente
                if (is_dir($ruta_completa)) {
                    if (isset($_GET["rename"])){
                        if($archivo == "new_folder"){
                            echo "<li ><a class='linkStyles' href="."./index.php?root=$ruta_completa&fileName=$archivo".">$archivo"."nuevo</a></li>","nuevo";
                        }else{
                            echo "<li><a class='linkStyles' href="."./index.php?root=$ruta_completa&fileName=$archivo".">$archivo</a></li>","algo nuevo";
                        }
                    }else{
                        echo "<li><i class='fa-li fas fa-folder'></i><a class='linkStyles' href="."./index.php?root=$ruta_completa&fileName=$archivo".">$archivo</a></li>";
                    }
                    // generateFilesFun($ruta_completa);
                } else {
                    require_once("./modules/whatEsxtension.php");
                    isaFolder($archivo,$ruta);
                }
            }
        }
        // Cierra el gestor de directorios
        closedir($gestor);
        echo "</ul>";
    } else {
        echo "No es una ruta de directorio valida<br/>";
    }
}