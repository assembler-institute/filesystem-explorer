<?php
function isaFolder($archivo,$ruta){
  
        $extension = pathinfo($archivo, PATHINFO_EXTENSION);
    
        // print_r($extension);
        switch ($extension) {
            case 'txt':
                if(isset($_GET['fileName'])){
                    if($_GET['fileName']==$archivo){
                        echo "<li class='txt selected-li'><i class='fa-li fas fa-file-word'></i><a class='linkStyles selected-a' href="."./index.php?root=$ruta&fileName=$archivo".">$archivo</a></li>";
                    }else{
                        echo "<li class='txt'><i class='fa-li fas fa-file-word'></i><a class='linkStyles' href="."./index.php?root=$ruta&fileName=$archivo".">$archivo</a></li>";
                    }
                }else{
                    echo "<li class='txt'><i class='fa-li fas fa-file-word'></i><a class='linkStyles' href="."./index.php?root=$ruta&fileName=$archivo".">$archivo</a></li>";
                }
                
                break;

                case 'pptx':
                    if(isset($_GET['fileName'])){
                        if($_GET['fileName']==$archivo){
                            echo "<li class='txt selected-li'><i class='fa-li fas fa-file-powerpoint'></i><a class='linkStyles selected-a' href="."./index.php?root=$ruta&fileName=$archivo".">$archivo</a></li>";
                        }else{
                            echo "<li class='txt'><i class='fa-li fas fa-file-powerpoint'></i><a class='linkStyles' href="."./index.php?root=$ruta&fileName=$archivo".">$archivo</a></li>";
                        }
                    }else{
                        echo "<li class='txt'><i class='fa-li fas fa-file-powerpoint'></i><a class='linkStyles' href="."./index.php?root=$ruta&fileName=$archivo".">$archivo</a></li>";
                    }
                    
                    break;



                    case 'xlsx':
                        if(isset($_GET['fileName'])){
                            if($_GET['fileName']==$archivo){
                                echo "<li class='txt selected-li'><i class='fa-li fas fa-file-excel'></i><a class='linkStyles selected-a' href="."./index.php?root=$ruta&fileName=$archivo".">$archivo</a></li>";
                            }else{
                                echo "<li class='txt'><i class='fa-li fas fa-file-excel'></i><a class='linkStyles' href="."./index.php?root=$ruta&fileName=$archivo".">$archivo</a></li>";
                            }
                        }else{
                            echo "<li class='txt'><i class='fa-li fas fa-file-excel'></i><a class='linkStyles' href="."./index.php?root=$ruta&fileName=$archivo".">$archivo</a></li>";
                        }
                        
                        break;

                        case 'jpg':
                            if(isset($_GET['fileName'])){
                                if($_GET['fileName']==$archivo){
                                    echo "<li class='txt selected-li'><i class='fa-li fas fa-file-image'></i><a class='linkStyles selected-a' href="."./index.php?root=$ruta&fileName=$archivo".">$archivo</a></li>";
                                }else{
                                    echo "<li class='txt'><i class='fa-li fas fa-file-image'></i><a class='linkStyles' href="."./index.php?root=$ruta&fileName=$archivo".">$archivo</a></li>";
                                }
                            }else{
                                echo "<li class='txt'><i class='fa-li fas fa-file-image'></i><a class='linkStyles' href="."./index.php?root=$ruta&fileName=$archivo".">$archivo</a></li>";
                            }
                            
                            break;


                case 'img':
                    echo "<li class='img'>" . $archivo . "</li>";
                    break;
            }
    }
