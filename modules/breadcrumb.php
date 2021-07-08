<?php

function renderBreadcrumb()
{
    if (isset($_SESSION["currentPath"]) && $_SESSION["currentPath"] !== "/") {
        echo "<nav aria-label='breadcrumb'>";
        echo "<ol class='breadcrumb mb-0'>";
        echo "<li class='breadcrumb-item'><a href='./modules/open-directory.php?directory='>Home</a></li>";

        $currentPath = $_SESSION["currentPath"];
        $pathArray = array_values(array_filter(explode("/", substr($currentPath, 2))));
        for ($i = 0; $i < count($pathArray); $i++) {
            $fullPath = ".//";
            for ($j = 0; $j <= $i; $j++) {
                $fullPath .= $pathArray[$j] . "/";
            }
            echo "<li class='breadcrumb-item'><a href='./modules/open-directory.php?directory=" . $fullPath . "'>" . $pathArray[$i] . "</a></li>";
        }
        echo "</ol>";
        echo "</nav>";
    } else {
        echo "<nav aria-label='breadcrumb'>";
        echo "<ol class='breadcrumb mb-0'>";
        echo "<li class='breadcrumb-item'><a href='./modules/open-directory.php?directory='>Home</a></li>";
        echo "</ol>";
        echo "</nav>";
    }
}
