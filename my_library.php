<?php function connect(){
	$conn=mysqli_connect("localhost","root","") or die("error in connecting to server");
	mysqli_query($conn,"create database if not exists bpts_db") or die("00x1");
	mysqli_select_db($conn,"bpts_db") or die("00x2");
	return $conn;
	}
	function getSub($fac,$sem)
	{
		if($fac=="bim")
	{
		if($sem==1)
		{
		$ret=array("s"=>"Principle Of Management",
				"a"=>"English",
				"t"=>"Basic Math",
				"y"=> "Computer Information System",
				"m"=>"Digital Logic");
		}
		if($sem==2)
		{
			$ret=array("s"=>"Sociology",
				"a"=>"Discrete Math",
				"t"=>"Business Communication",
				"y"=> "Structured Programming",
				"m"=>"DCCN");
		}
		if($sem==3)
		{
			$ret=array("s"=>"Financial Accounting",
				"a"=>"Business Statastics",
				"t"=>"Web Programming-I",
				"y"=> "Java Programming",
				"m"=>"Computer Organization");
		}
	}

	if($fac=="bba")
	{
		if($fac==1)
			{//codes;}
	}
	
	}
	return $ret;
}
function make_safe($var) {
	$con=connect();
    $var = mysqli_real_escape_string($con,trim($var));
    return $var;
}
	?>