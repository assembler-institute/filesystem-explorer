<?php 
    function renderDirBrowsingNavBar(){

        // Splitting Main path and getting start index for navBar
        $splitMainPath =  explode("/", $_SESSION["currentPath"]);
        $startIndexNavbar = array_search("root", $splitMainPath, true) + 1;
        
        // $hrefDirPath = $splitMainPath[$startIndexNavbar];
        // $hrefDirPath = $splitMainPath[$startIndexNavbar]."/";
        echo "
        <a class='render__route' href='./includes/updateDir.php?updateDir=".$_SESSION['mainRootPath']."'>
            My Unity
        </a>";
        // <a class='renderUpdateLink' href='./includes/updateDir.php?updateDir=".$_SESSION['mainRootPath']."/'>

        // Aux variable for dir path
        $hrefDirPath = "/";

        for($i = $startIndexNavbar; $i < sizeof($splitMainPath); $i++){
            
            // Rendering NavBar  in relation to Main path
            $hrefDirPath = $hrefDirPath.$splitMainPath[$i];
            // $hrefDirPath = $hrefDirPath.$splitMainPath[$i]."/";
            echo "
                <a class='render__route' href='./includes/updateDir.php?updateDir=".$_SESSION['mainRootPath'].$hrefDirPath."'>/".
                    $splitMainPath[$i]."
                </a>";

            $hrefDirPath = $hrefDirPath."/";     
        }
        
    }

?>