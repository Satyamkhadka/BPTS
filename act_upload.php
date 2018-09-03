<?php 
require 'my_library.php';
insert();
function insert(){
	$conn=connect();
	$title=$_POST["title"];
	$dets=$_POST["details"];
mysqli_query($conn,"create table if not exists notice (nid int primary key AUTO_INCREMENT , title varchar(80), details varchar(400) ) ") or die("error in creating able");
$insert="insert into notice (title,details) values ('$title','$dets')";
mysqli_query($conn,$insert) or die("error in inserting data to the database");
echo "data inserted successfully! <br/> following is the result! <br/>";

$sel="select * from notice";
$result = mysqli_query($conn, $sel);
echo "<table border='1'>";
$i=0;
while($data=mysqli_fetch_assoc($result))
{
	//print_r($data);
	if($i==0){echo "<tr> <th>nid</th>  <th>title </th><th>details </th></tr>"; $i++;}
	{echo "<tr> <td>$i</td><td>$data[title] </td><td>$data[details]</td></tr>"; $i++; }

}
mysqli_close($conn);
}
?>