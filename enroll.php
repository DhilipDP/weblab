
<?php
	$mysqli = new mysqli("localhost", "root", '', "acoe");
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
		<h1> Staff Selection </h1>
		<h2> Subjects </h2>
		<?php
			$arr = array();

			$query = mysqli_query($mysqli, "select subject_name from subjects;");
			echo("<form method='post' action=''>");
			while($re = mysqli_fetch_assoc($query)){
			
				$temp = $re['subject_name'];
				array_push($arr, $temp);
				echo $temp;
				$q = mysqli_query($mysqli, "select staff_name from staffs natural join subjects where subject_name = '$temp';");
				
				echo ("<select name='$temp'>");
					$t =0;
				while($qr = mysqli_fetch_assoc($q)){
					$stn = $qr['staff_name'];
					if($t==0)
					echo("<option selected='selected' value='$stn'>");
					else
					echo("<option value='$stn'>");
						echo $qr['staff_name'];
					echo("</option>");
					$t = $t+1;

				}
			echo("</select> <br>");
			}	
			echo("<input type='submit' id='submit' name='submit'>");
		echo("</form>");

		if(isset($_POST["submit"])){
				foreach($arr as $a){
				if(isset($_POST['$a']))
				echo "<script>alert('hi');</script>";
			} 
	}	
		?>
</body>
</html>