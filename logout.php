<?php 
session_start();
session_destroy();

console.log("hsession destruida");

header('Location:index.php');



 ?>
