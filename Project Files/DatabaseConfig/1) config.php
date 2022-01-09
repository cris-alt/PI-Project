<?php
session_start(); 
set_time_limit(0); 
error_reporting(E_ALL);  
// Informatii baza de date 
$AdresaBazaDate = "localhost"; 
$UtilizatorBazaDate = "root"; 
$ParolaBazaDate = ""; 
$NumeBazaDate = "reviewsite"; 
$conexiune = mysqli_connect($AdresaBazaDate,$UtilizatorBazaDate,$ParolaBazaDate,$NumeBazaDate) 
or die("Fail to connect to MySQL!"); 
?>