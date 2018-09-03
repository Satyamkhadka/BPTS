<?php
session_start();
		require 'my_library.php';


		function retrive($usern,$fac,$upto)
{	
	$show="";
			$conn= connect();
			$table=$fac."_".$upto;
			$sel= "select * from ".$table." where symbol_no='$usern' order by sid asc";
$cres=mysqli_query($conn,$sel) or die("<div class='notice full'><a href='signout.php'> Click to Signout </a> </div> </body> </html>");
if(mysqli_num_rows($cres)>0)
{
	while($res=mysqli_fetch_assoc($cres))
	{
	$fail=0;
	$status=array();
	$sub=getSub($fac,$upto);

	if($res["info"]=="reg"){

	if($res["s_grd"]=="F")
	{
	if($res["one_grd"]=="F")
		{$fail++;$status[]="s";}
	if($res["two_grd"]=="F")
		{$fail++;$status[]="a";}
	if($res["three_grd"]=="F")
		{$fail++;$status[]="t";}
	if($res["four_grd"]=="F")
		{$fail++;$status[]="y";}
	if($res["five_grd"]=="F")
		{$fail++;$status[]="m";}
 		}
 		else $show="No backpaper";
 	}

 		if($res["info"]=="back")
 		{
 			if($res["one_grd"]!="F")
		{$fail--;str_replace("s","",$status);}
	if($res["two_grd"]!="F")
		{$fail--;str_replace("a","",$status);}
	if($res["three_grd"]!="F")
		{$fail--;str_replace("t","",$status);}
	if($res["four_grd"]!="F")
		{$fail--;str_replace("y","",$status);}
	if($res["five_grd"]!="F")
		{$fail--;str_replace("m","",$status);}
 		}

	for($i=0;$i<$fail;$i++)
	{	
		$temp=$status["$i"];
		$show.="<u>".$sub["$temp"]."</u> ";
	}
	$show.=" in $upto sem <br/>";
}
}
else
{
	 $show.="No records found contact the webmaster";

}
mysqli_close($conn) or die("00x4");
		return $show;
}
		function go($user,$pass)
		{
			$conn=connect();
			$sel="select * from userbase where symbol='$user' and pass='$pass'";
			$res=mysqli_query($conn,$sel) or die("err: 00x5");
			if(mysqli_num_rows($res)==1)
			{
				$userdata=mysqli_fetch_assoc($res);
				$_SESSION["symb"]=$user;
				$_SESSION["pass"]=$pass;
				$_SESSION["fname"]=ucwords($userdata["fname"]);
				$_SESSION["name"]=ucwords($userdata["fname"])." ".ucwords($userdata["lname"]);
				intro($_SESSION["name"]);
				//echo "<b> Welcome $_SESSION[name] </b> <br/>";
				$upto=1;
				while($upto<9)
			{
			showw(retrive($userdata["symbol"],$userdata["fac"],$upto));
			$upto++;
            }
            
			}
			else intro("Wrong Login Info");
			            

		}


		if(isset($_POST["uname"]) && isset($_POST["password"]))
			{
				go(make_safe($_POST["uname"]),make_safe($_POST["password"]));

			}
			else
				{
					if(isset($_SESSION["symb"]) && isset($_SESSION["pass"]))
						{		
							go($_SESSION["symb"],$_SESSION["pass"]);
							}
					else
						intro("LOGIN FIRST");
				}

				function intro($toshow)
				{
					print <<< _HTML_
					<!DOCTYPE html>
<html lang="en">
<head>
	<title> $toshow </title>
	 <meta charset="utf-8">
	 <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Comfortaa">
<link rel="stylesheet" type="text/css" href="user.css">

</head>
<body>
<div class="notice full"> <p> $toshow </p> </div>
_HTML_;
}
	function showw($det)
	{
		print <<< _HTML_
		<div class="notice full"> <p> $det </p> </div>
_HTML_;
	}	
?>