<?php 
session_start();
if(isset($_SESSION["symb"]) && isset($_SESSION["pass"]) && isset($_SESSION["fname"]))
{
    $sym=$_SESSION["symb"];$pa=$_SESSION["pass"];$nam="Welcome back ".$_SESSION["fname"];
   
  
}
else{
   $sym="";$pa="";$nam="Sign In";
}
?>
<!- DOCTYPE html >
<html lang="en">
<head> <title > Home</title>
  <meta charset="utf-8">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Comfortaa">
  <link rel="stylesheet" type="text/css" href="maincss.css">
</head>
<body>
     <p class="same pinmainone"> Back Paper Tracking System </p>
<div class="same navigation"> <div class="col"> <a href="#login">Login</a> </div> <div class="col"><a href="#notice">Notice</a> </div> <div class="col"> <a href="#signup">Signup</a> </div><div class="col"><a href=mailto:"admins@bcpaper.com">Contact us</a> </div> <div class="col"><a href="aboutus.php"">About Us</a> </div><div class="col"><a href="feedback.html"">Feedback</a> </div>
</div>
<center>
<div class="loginBox">

			 <img src="user.png" class="user"/>
			<h2 class="hd2"><?php echo $nam; ?></h2>
			<form action="user.php" method="post">
				<p>Symbol.No</p>
				<input type="text" name="uname" value='<?php  echo $sym; ?>' placeholder="Username" autofocus="autofocus" required="required">
				<p>Password</p>
				<input type="password"  name="password" value='<?php  echo $pa; ?>' placeholder="Password" required="required">
				 <input  type="reset"  name="clear" value="Reset"/> 
				<input type="submit" name="" value="Sign In">
				       <div class="niceborder"> <a href="#signup">Or Sign Up </a> </div>
			</form>
		</div>
<br/><br/><br/><br/><br/>

<?php 
require 'my_library.php';
function retrive()
{
	$conn=connect();
$sel= "select * from notice";
$res=mysqli_query($conn,$sel);
if(mysqli_num_rows($res)>0)
{
	$i=0;
	echo "<div class='notice full' id='notice'>";
	echo "<table class='notice nshadow' align='center'>";
	echo "<tr> <th colspan='3'> Notice </th> </tr>";
while($data=mysqli_fetch_assoc($res))
{
	//print_r($data);
	if($i==0){ echo "<tr> <th>.</th>  <th>Title </th><th>Description </th></tr>"; $i++; }

	echo "<tr> <td>$i</td> <td>$data[title] </td> <td>$data[details]</td></tr>"; $i++; 
}
echo "</table>";
}
else
{
		print <<< _HTML_
		<div id='notice' class="notice khali";
	No new notice for today.  ;)..
_HTML_;
}
mysqli_close($conn) or die("00x4");
}
retrive();
?>

</div>
<h2 class="hd3" id="signup"> Lets Sign you up! </h2>
<div class="signup">
<form class="form" name="frm" align="center"  action="signup.php" method="post">
 		<p> Personal Credentials </p>
 <input type="text" name="fname" placeholder="First Name" required="required"> 

 	<input type="text" name="lname" placeholder="Last Name" required="required"> 
 	<br/>
 	<input type="password" name="pass" placeholder="Password" required="required"> 
 	<br/>
 	<p style="font-size:12pt; color:red; margin-top:-5px;"> ! Don't use your facebook or email password</p>
<p> Academic credentials</p>
<select name="fac" required="required">
	        <option name=""> Faculty  </option>
      <option value="bim"> BIM </option>
      <option value="bba"> BBA </option>
	</select>
	<br/>
<input type="text"  name="sym" placeholder="xxxx/xx Symbol.No.(this will be your username)" required="required"><br/>
<input type="submit" value="Sign-up"> 
<input type="reset" value="Reset"> 
 </form>
</div>


<br/> <br/> <br/>
<div id="aboutus">
	
</div>


<br/>
<hr/>
</body>
</html>