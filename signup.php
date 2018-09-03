<?php
session_start();
	require 'my_library.php';
function insert($fnam,$lnam,$fac,$symb,$pass){
	$conn=connect();
	mysqli_query($conn,"create table if not exists userbase (
		fname varchar(20),
		lname varchar(20),
		fac varchar(6),
		symbol varchar(12) primary key,
		pass varchar(255)
				)") or die("00x3");
	mysqli_query($conn,"insert into userbase (fname,lname,fac,symbol,pass) values ('$fnam','$lnam','$fac','$symb','$pass')") or die("<div class='notice full'> <p> <a href='user.php' >User already exists</a> </p> </div> </body> </html>");
	mysqli_close($conn) or die("00x5");
	$_SESSION['symb']=$symb;
	$_SESSION['pass']=$pass;
	echo "<div class='notice full'> <p> <a href='user.php' >Click here to log in </a> </p> </div>  </body> </html> ";

}

function getData()
{
	$fname= $_POST["fname"];
	$lname= $_POST["lname"];
	$pass= $_POST["pass"];
	$fac= $_POST["fac"];
	$symbol= $_POST["sym"];
	$what="lol";
	$what=check($symbol,$fname." ".$lname,$fac);
    if($what=="ok")
	{	
		insert($fname,$lname,$fac,$symbol,$pass);
	}
	else{
		echo "<div class='notice full'> <p> you have entered wrong info !! </p> </div> </body> </html>";}
}

function check($sym,$cname,$fac)
{
	$rv="notok";
$conn=connect();
$sel="select sname from ".$fac."_1"." where symbol_no= '$sym'";
$res=mysqli_query($conn,$sel);
if(mysqli_num_rows($res)>0)
{ 
	$res=mysqli_fetch_assoc($res);
	$gname=$res["sname"];
	mysqli_close($conn);
if(strcasecmp($gname,$cname)==0)
{ $rv="ok";}
else
 { $rv="notok1";}
}
else {$rv="notok2";}
return $rv;
}


function intro()
				{
					$fname= $_POST["fname"];
	$lname= $_POST["lname"];
	$toshow= "Mr. $fname $lname";
					print <<< _HTML_
					<!DOCTYPE html>
<html lang="en">
<head>
	<title> Signing up... </title>
	 <meta charset="utf-8">
	 <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Comfortaa">
<link rel="stylesheet" type="text/css" href="user.css">

</head>
<body>
<div class="notice full"> <p> $toshow </p> </div>
<br/> <br/>
_HTML_;
getData();
}
intro();
?>