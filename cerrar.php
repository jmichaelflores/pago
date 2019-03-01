<?php session_start();

require 'conexion.php';

session_destroy();

header('Location: index.php');


 ?>