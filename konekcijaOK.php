<?php

$user="root";
$password="";
$database="ocna_kuca";
$host="localhost";

$db=mysqli_connect($host,$user,$password,$database);

if($db) {
    print" ";
 }

else{
print "Neuspesna";
}



?>