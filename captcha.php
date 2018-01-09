<!DOCTYPE html>
<?php
	$mysqli = new mysqli("localhost", "root", '', "acoe");
?>
<html>
<head>
	<title></title>
	<style type="text/css">
		.capbox {
	background-color: #92D433;
	border: #B3E272 0px solid;
	border-width: 0px 12px 0px 0px;
	display: inline-block;
	*display: inline; zoom: 1; /* FOR IE7-8 */
	padding: 8px 40px 8px 8px;
	}

.capbox-inner {
	font: bold 11px arial, sans-serif;
	color: #000000;
	background-color: #DBF3BA;
	margin: 5px auto 0px auto;
	padding: 3px;
	-moz-border-radius: 4px;
	-webkit-border-radius: 4px;
	border-radius: 4px;
	}

#CaptchaDiv {
	font: bold 17px verdana, arial, sans-serif;
	font-style: italic;
	color: #000000;
	background-color: #FFFFFF;
	padding: 4px;
	-moz-border-radius: 4px;
	-webkit-border-radius: 4px;
	border-radius: 4px;
	}

#CaptchaInput { margin: 1px 0px 1px 0px; width: 135px; }

body{
	text-align: center;

}

.login-div{
	margin-top: 10%;
	display: inline-block;
	text-align: center;
	border-style: solid;
	padding: 0% 5% 5% 5%;
	background: white;
}

.login-div *{
	margin-bottom: 2%;
}

	</style>

</head>
<body bgcolor="gray">
<div class="login-div">
<h1 style="margin-bottom: 30%;"> LOGIN </h1>

<form method="post" action="captcha.php" onsubmit="return checkform(this);"> 

<input type="text" name="username" id="username" placeholder="Enter Username"/><br>
<input type="text" name="password" id="password" placeholder="Enter password"/><br>
<div class="capbox">

<div id="CaptchaDiv"></div>

<div class="capbox-inner">
Type the above number:<br>

<input type="hidden" id="txtCaptcha"/>
<input type="text" name="CaptchaInput" id="CaptchaInput" size="15"/><br>

</div>
</div>
<br><br>
<input type="submit" name="submit" id="submit">
</form>
</div>
<?php
	$user = "";
	$pass="";
	if(isset($_POST["submit"])){
		if(isset($_POST["username"])){
			$user = $_POST["username"];
		}
		if(isset($_POST["password"])){
			$pass = $_POST["password"];
		}
	}
	$query = mysqli_query($mysqli, "SELECT username from users where username = '$user' and password = '$pass';");
	$result = mysqli_fetch_array($query);
	if($result[0] != ''){
		header("Location: enroll.php");
	}
	else{
		echo("<script>alert('Wrong Credentials');</script>");
	}
?>


<script type="text/javascript">

// Captcha Script

function checkform(theform){
var why = "";

if(theform.CaptchaInput.value == ""){
why += "- Please Enter CAPTCHA Code.\n";
}
if(theform.CaptchaInput.value != ""){
if(ValidCaptcha(theform.CaptchaInput.value) == false){
why += "- The CAPTCHA Code Does Not Match.\n";
}
}
if(why != ""){
alert(why);
return false;
}
}

var a = Math.ceil(Math.random() * 9)+ '';
var b = Math.ceil(Math.random() * 9)+ '';
var c = Math.ceil(Math.random() * 9)+ '';
var d = Math.ceil(Math.random() * 9)+ '';
var e = Math.ceil(Math.random() * 9)+ '';

var code = a + b + c + d + e;
document.getElementById("txtCaptcha").value = code;
document.getElementById("CaptchaDiv").innerHTML = code;

// Validate input against the generated number
function ValidCaptcha(){
var str1 = removeSpaces(document.getElementById('txtCaptcha').value);
var str2 = removeSpaces(document.getElementById('CaptchaInput').value);
if (str1 == str2){
return true;
}else{
return false;
}
}

// Remove the spaces from the entered and generated code
function removeSpaces(string){
return string.split(' ').join('');
}
</script>

</body>
</html>