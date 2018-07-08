<?php

$fname=$_GET['fname']; //keep input name "fname"
$lname=$_GET['lname']; // keep input name "lname"
$add=$_GET['addr']; //same

$conn=mysqli_connect("localhost","root","");
$create="create database if not exists detaiiiiiils"; //change the name of database
mysqli_query($conn,$create) or die("1xx");
mysqli_select_db($conn,"detaiiiiiils") or die("2xx");
$table="create table if not exists details (
		 idd int auto_increment primary key,
		 fname varchar(15),
		 lname varchar(15),
		 address varchar(45)	
			)";
mysqli_query($conn,$table)  or die("3xx");


print($insert="insert into details (fname,lname,address) values ('$fname','$lname','$add')");
mysqli_query($conn,$insert)  or die("4xx");
echo "your data is inserterd successfullyy";

?>