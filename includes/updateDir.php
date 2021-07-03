<?php 
   if(!isset($_SESSION)) 
   { 
       session_start(); 
   } 

    if(!isset($_SESSION['currentPath'])){
        // echo "I'm in <br>";
        $_SESSION['currentPath'] = $_SESSION['base_url'] . "/root";
        $_SESSION['mainRootPath'] = $_SESSION['base_url'] . "/root";
        
    }else if(isset($_GET['updateDir'])){

        $_SESSION['currentPath'] = $_GET['updateDir'];
        header("Location: ../index.php");
    }

    // echo $_SESSION['currentPath'];
    // echo "I am the main root path --> ".$_SESSION['mainRootPath'];
    
?>