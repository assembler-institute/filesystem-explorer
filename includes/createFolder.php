<?php 

    require("./updateDir.php");

    if(isset($_POST['submitFolder'])){

        // Establish folderUploadDir directory
        $folderUploadDir = $_SESSION['currentPath'];

        // Getting folderName input value
        $folderName = $_POST['folderName'];
        echo $folderName."<br>";

        // Getting all dir items
        $dirItemList = scandir($folderUploadDir);
        $dirItemList = array_diff($dirItemList, array('.', '..'));
        print_r($dirItemList); echo "<br>";

        //Checking if folderName already exists and  changing its value if so
        foreach ($dirItemList as $dirItem){
            if($dirItem === $folderName){

                if(!strrpos($dirItem, ".", 0)){
                    echo "I'm in and \$dirItem is --> ".$dirItem."<br>";

                    if(strrpos($dirItem, "Copy", 0)){
                        $copyIndexString = (end(explode("Copy", $dirItem)));
                        echo "\$copyIndexString --> ".$copyIndexString."<br>";
    
                        if(empty($copyIndexString)){
                            $copyIndex = 1;
                            $newCopyIndex = (string)($copyIndex);
            
                        }else{
                            $copyIndex = (int)$copyIndexString;
                            $copyIndex +=1;
                            $newCopyIndex = (string)($copyIndex);
    
                        }
                        $folderName = str_replace("Copy".$copyIndexString, "Copy".$newCopyIndex, $folderName);
                        echo "new \$folderName -->".$folderName."<br>";
    
                    }else{
                        $folderName.="Copy";
                        echo "new \$folderName -->".$folderName."<br>";
                    }
                }
            }
            
        }

        // Completing directory path
        $finalDirectoryPath = $folderUploadDir."/".$folderName;

        // Create new folder permissions (0777 means everything allowed)
        mkdir($finalDirectoryPath, 0777);

        header("Location: ../index.php?foldercreationsuccess");
    }

?>