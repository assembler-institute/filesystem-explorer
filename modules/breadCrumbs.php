<?php

function printBreadCrumbs()

{
    if (!isset($_SESSION['curr_path'])) {
        $_SESSION['curr_path'] = './root';

        echo "<div class='bread-crumbs-container'>";
        echo '<p>./root</p>';
        echo "</div>";
    } else {
        $breadCrumbs = explode("/", $_SESSION['curr_path']);
        $initialRoute = '';

        echo "<div class='bread-crumbs-container'>";
            foreach ($breadCrumbs as $path) {
                $initialRoute = $initialRoute . $path . "/";
                echo "<a onclick=(navigateToFolder(event)) path='$initialRoute'>$path</a>";
            }
        echo "</div>";
    }
}
