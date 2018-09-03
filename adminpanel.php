<?php
require 'my_library.php';

function insert($da,$fac,$sem,$stat){
	$conn=connect();
	$create="create table if not exists ".$fac."_".$sem."  
 ( 
sid int primary key auto_increment,
 symbol_no varchar(10),
    sname varchar(50),
    regd_no varchar(15),
    one_gpa varchar(4),
    one_grd varchar(2),
    two_gpa varchar(4)	,
    two_grd varchar(2),
    three_gpa varchar(4),
    three_grd varchar(2),
    four_gpa varchar(4),
    four_grd varchar(2),
    five_gpa varchar(4),
    five_grd varchar(2),
    s_gpa 	varchar(4),
    s_grd varchar(2),
    remarks varchar(10),
    info varchar(10)
);";
	mysqli_query($conn,$create) or die("00x3");
	$stat=="reg"?$st=0:$st=1;
	$num=str_replace(' ','',$da[0]);
	$insert="insert into ".$fac."_".$sem." (symbol_no,
    sname,regd_no,
    one_gpa,one_grd,
    two_gpa,two_grd,
    three_gpa,three_grd,
    four_gpa,four_grd,
    five_gpa,five_grd,
    s_gpa,s_grd,remarks,info) values ( ";
	for($i=0;$i<17;$i++)
		{	
			$insert.="'";
			if($i==0){
				$insert.=$num;
			}
			else if($i==16)
				$insert.=$stat;
			 else
			 {$insert.=$da[$i];}
			$insert.="'";
			$i!=16? $insert.=",": $insert.=")";
		}
	mysqli_query($conn,$insert) or die("00x4");
	
}

	if(!isset($_POST['upload']))
	{
			print <<< _HTML_

           <!DOCTYPE html>
<html>
<head>
	<title> admin panel</title>
</head>
<body>
<div id="topic"> Admin panel: </div>
	<div id="form">
<form action="" method="post">
		<fieldset>
		<legend> FACULTY </legend>
		BIM<input type="radio" name="faculty" value="bim"  />
		BBA<input type="radio" name="faculty" value="bba"/>
		</fieldset>
		<fieldset>
		<legend> STATUS </legend>
		REGULAR<input type="radio" name="status" value="reg"  />
		BACKPPR<input type="radio" name="status" value="back"/>
		</fieldset>
		<fieldset>
		<legend> semester </legend>
		<select name="semester" >
		<option value="1"> 1 </option>
		<option value="2"> 2 </option>
		<option value="3"> 3 </option>
		<option value="4"> 4 </option>
		<option value="5"> 5 </option>
		<option value="6"> 6 </option>
		<option value="7"> 7 </option>
		<option value="8">  8</option>
		</select>

		</fieldset>
		<fieldset>
 		<input type="file" name="flname"/>
 		<input type="password" placeholder="enter password babes!!" name="pass" />
 		<input type="submit" name="upload" value="upload"/>
 		</fieldset>
</form>
</div>
</body>
</html>
_HTML_;
	}
	else {
		$pass=$_POST['pass'];
		$fac=$_POST['faculty']; $sem=$_POST['semester'];//$batch=$_POST['batch'];
		$status=$_POST['status'];
		if($pass!="lie")
		{
			echo " wrng pass ! At least you tried!! hhahaha ";
		}
		else
			{
			$file=$_POST['flname'];
			$mypointer=fopen($file,'r');
			if($mypointer != false)
			{
				$i=0;
				while(!feof($mypointer))
				{
				$data=fgetcsv($mypointer);
				/*print_r($data);*/
				insert($data,$fac,$sem,$status);
				$i++;
			     }
			 echo "$i record/s inserted!!";
			}
			}			

	}
?>
