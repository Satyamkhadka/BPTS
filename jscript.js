           function validate(){
           

if((frm.password.value).length < 8)
{
	document.getElementById("up").innerHTML="Password should be minimum 8 characters.";
	frm.password.value="";
	frm.cpassword.value="";
	frm.password.focus();
	return false;
}

if(frm.cpassword.value != frm.password.value)
{
	document.getElementById("down").innerHTML="Password confirmation does not match.";
	frm.password.value="";
	frm.cpassword.value="";
	frm.password.focus();
	return false;
}
alert("your registration data was received");
return true;
}
