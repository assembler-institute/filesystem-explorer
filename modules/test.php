<?php
function generateFoldersTreeFun($ruta){
    // Se comprueba que realmente sea la ruta de un directorio
    if (is_dir($ruta)){
        // Abre un gestor de directorios para la ruta indicada
        $gestor = opendir($ruta);
        echo "<ul>";

        // Recorre todos los elementos del directorio
        $count=0;
        while (($archivo = readdir($gestor)) !== false)  {

            $ruta_completa = $ruta . "/" . $archivo;

            // Se muestran todos los archivos y carpetas excepto "." y ".."
            if ($archivo != "." && $archivo != "..") {
                // Si es un directorio se recorre recursivamente
                if (is_dir($ruta_completa)) {
                    $count++;

?>
                    <div class="accordion" id="accordionPanelsStayOpenExample">
                    <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
<?= "<li><a href="."./index.php?root=$ruta_completa".">$archivo</a></li>" ?>
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                        <div class="accordion-body">

                            <?php generateFoldersTreeFun($ruta_completa); ?>

                        </div>
                    </div>
                    </div>
                    </div>
<?php

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

?>
