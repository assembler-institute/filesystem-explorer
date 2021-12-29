<?php
function locateFoldersTreeFun($ruta,$count){
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
                    //<span class='material-icons-outlined'>folder</span> google icons
                    if (isset($_GET["root"])){
                        if($_GET["root"] == $ruta_completa){
                            echo "<li class='foldersTitle'>
                                    <i class='fa-li fas fa-folder'></i>
                                    <a class='linkStyles selected-a' href='./index.php?root=$ruta_completa'>$archivo</a>
                                </li>";
                        }else{
                            echo "<li class='foldersTitle'>
                        <i class='fa-li fas fa-folder'></i>
                        <a class='linkStyles' href='./index.php?root=$ruta_completa'>$archivo</a>
                    </li>";

                        }
                    }else{
                        echo "<li class='foldersTitle'>
                        <i class='fa-li fas fa-folder'></i>
                        <a class='linkStyles' href='./index.php?root=$ruta_completa'>$archivo</a>
                    </li>";

                    }
                
                locateFoldersTreeFun($ruta_completa,$count);
                } else {
                    //echo "<li>" . $archivo . "</li>";
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