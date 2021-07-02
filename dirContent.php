

    <?php
    require('./functions/dirManege.php');
        $prevPath=$_POST["prevPath"];
        $inicialPath="./directories";
        $path=$_POST["path"];
        $_SESSION["currentPath"]=$path;
        scanDirsContent($_SESSION["currentPath"]);   
    ?>
    <script>
        rightButton();
        dubleClick();
        showSureToRemove();
        editModal();
    </script>


