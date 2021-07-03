<?php 

    require("./updateDir.php");

    if(isset($_POST['submitRename'])){
        
        // Getting current dirPath
        $dirRenamePath = $_SESSION['currentPath'];

        // Initializing newName and
        $newName = $_POST['newName'];
        
        // Getting all items in this dirPath
        $dirItemList = scandir($dirRenamePath);

        // Checking if newName is duplicated and setting a new value to newName
        foreach($dirItemList as $dirItem){
            if($dirItem === $newName){
               
                if(strrpos($dirItem, ".", 0)){
                    $fileExt = end(explode(".", $dirItem));

                    if(strrpos($dirItem, "Copy", 0)){
                        $copyIndexString = end(explode("Copy", $dirItem));
                        $actualCopyIndexString = (explode(".", $copyIndexString))[0];

                        if(empty($actualCopyIndexString)){
                            $newName = str_replace("Copy.".$fileExt, "Copy1.".$fileExt, $newName);

                        }else{
                            $newCopyIndex = (int)$actualCopyIndexString;
                            $newCopyIndex +=1;
                            $newCopyIndex = (string)($newCopyIndex);
                            $newName = str_replace("Copy".$actualCopyIndexString.".".$fileExt, "Copy".$newCopyIndex.".".$fileExt, $newName);

                        }
                    }else{
                        $newName = str_replace(".".$fileExt, "Copy".".".$fileExt, $newName);

                    }
                }else{
                    if(strrpos($dirItem, "Copy", 0)){
                        $copyIndexString = (end(explode("Copy", $dirItem)));
                        if(empty($copyIndexString)){
                            $copyIndex = 1;
                            $newCopyIndex = (string)($copyIndex);

                        }else{
                            $copyIndex = (int)$copyIndexString;
                            $copyIndex +=1;
                            $newCopyIndex = (string)($copyIndex);
                        }
                        $newName = str_replace("Copy".$copyIndexString, "Copy".$newCopyIndex, $newName);

                    }else{
                        $newName.="Copy";
                    }
                }
            }
        }

        // Searching item name to change and changing its name
        $itemToChangeIndex = array_search($_POST['oldName'], $dirItemList);
        rename($dirRenamePath."/".$dirItemList[$itemToChangeIndex],$dirRenamePath."/".$newName);
       
        // Redirect to index.php
       header("Location: ../index.php?renamesuccess");
    }

?>