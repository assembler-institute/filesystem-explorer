<?php
include "utils/fileBrowser.php";
include "utils/getFileSize.php";
function sidebarFillContent($initFolder = "", $id = -1)
{
    $id++;
    //?loop 0  $initFolder="/storage/*"
    foreach (fileBrowser($initFolder) as $secondFolder) {
        //!is_dir trouble solution
        if (pathinfo($secondFolder, PATHINFO_EXTENSION) === "") {
            $id++;
            $secondFolderName = basename($secondFolder);
            echo
            "<li class='mb-1 p-2' id='folder-$id'>" .
                "<button class='btn btn-toggle align-items-center rounded collapsed' data-bs-toggle='collapse' data-bs-target='#folder-$id-collapse' aria-expanded='false'>" .
                "<h5>$secondFolderName - $id</h5>" .
                '</button>' .
                "<div class='collapse' id='folder-$id-collapse'>";
            if (fileBrowser("$secondFolder/*")) {
                echo
                "<ul class='btn-toggle-nav list-unstyled fw-normal pb-1 small'>";
                //?loop 1 $secondFolder="/storage/insideFolder/*"
                foreach (fileBrowser("$secondFolder/*") as $thirdFolder) {
                    if (pathinfo($thirdFolder, PATHINFO_EXTENSION) === "") {
                        $thirdFolderName = basename($thirdFolder);
                        $id++;
                        echo "<li class='mb-1 p-2' id='folder-$id'>" .
                            "<button class='btn btn-toggle align-items-center rounded collapsed' data-bs-toggle='collapse' data-bs-target='#folder-$id-collapse' aria-expanded='false'>" .
                            "<h5>$thirdFolderName - $id</h5>" .
                            '</button>' .
                            "<div class='collapse' id='folder-$id-collapse'>" .
                            "<ul class='btn-toggle-nav list-unstyled fw-normal pb-1 small'>";
                        //?loop 2 $thirdFolder="/storage/insideFolder/insideFolder/*"
                        sidebarFillContent("$thirdFolder/*", $id);
                        echo '</ul>
                                    </div>
                                </li>';
                    }
                }
                echo '</ul>';
            } else {
                echo '<h5>empty!! </h5><br/> <br/>';
            }
            echo '</div>
            </li>';
        }
    }
}