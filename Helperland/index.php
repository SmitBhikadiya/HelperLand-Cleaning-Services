<?php

$controller = "Users";
if(file_exists("controllers/".$controller."Controller.php")){
    header("Location: controllers/".$controller."Controller.php");
}else{
    header("Location: controllers/".$controller."Controller.php");
}

?>