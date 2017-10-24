<?php
	session_start();
	use Aws\S3\Exception\S3Exception;
	require 'start.php';
	require 'dbinfo.php';

	if (isset($_POST['login'])) {
		$userName = $_POST['username'];
		$password = $_POST['password'];
		$_SESSION['valid'] = true;
		$_SESSION['username'] = $userName;
		$_SESSION['password'] = $password;
	}	
	if (isset($_SESSION['valid'])) {
		if($_SESSION['username'] == "swetha") { 
			if($_SESSION['password'] = "cmpe281") {
			}
			else {
			    echo "<br> <h1> Click here to go back to <a href=\"login.php\"> login page</a><br></h1>";
			    die ("NO PROPER AUTHENTICATION due to incorrect password");
			
   			     header('Refresh: 2; URL = login.php');

			}
			
		} else {
			    echo "<br> <h1> Click here to go back to <a href=\"login.php\"> login page</a><br></h1>";
			    die ("NO PROPER AUTHENTICATION due to incorrect password");

   				header('Refresh: 2; URL = login.php');
		}
	
		echo "<font color=green> <h1> Logged in user:".$_SESSION['username']."</h1></font><br>";
        } else {
	    echo "<br> <h1> Click here to go back to <a href=\"login.php\"> login page</a><br></h1>";
	    die ("NO PROPER AUTHENTICATION");
   header('Refresh: 2; URL = login.php');
	}

	if (isset($_FILES['file'])) {
		$file = $_FILES['file'];
		$name = $file['name'];
		$tmp_name = $file['tmp_name'];
		$extension = explode('.', $name);
		$extension = strtolower(end($extension));
		$tmp_file_name = 'files/'.$user_name.$name;
		$result  = move_uploaded_file($tmp_name, $tmp_file_name);

		if ($result == TRUE) {
		   try {
	           $s3->putObject(
                        [
                          'Bucket' => $config['s3']['bucket'],
                          'Key' => $name,
                          'Body' => fopen($tmp_file_name, 'rb'),
			   'ACL' => 'public-read'
                        ]
                   );
                   unlink($tmp_file_path);
		   if (isset($_POST['description'])) {
			$description = $_POST['description'];	
			$date = date("D M d, Y G:i");
			$select_query = "SELECT * FROM s3object";
			$result = mysqli_query($connection, $select_query);
			$flag = 1;
			while ($query_data = mysqli_fetch_row($result)) {
				if ($query_data[0] == $name) {
					echo "<br><b>Looks like this file had been uploaded already and this an update</b><br>";
					echo "created time or original description will not be changed<br><br><br>";
					$flag = 0;
					break;
				}
			}
			if ($flag == 1) {
				$insert_query = "INSERT INTO s3object values('".$name."','".$description."','".$date."')";
				$result= mysqli_query($connection, $insert_query);
			}
				
		   }
		} catch(S3Exception $e) {
			echo "There was an error uploading the file to S3<br>";
			echo $e;
		}
		} else {
			echo "not successful";
			echo "<br> Check one of the following reasons:<br>";
			echo "It could be because of network issue<br>";
			echo "Reduce file size, i had imposed a file size of 10 MB<br>";
			echo "memory limit exceeded as i am using a smaller instance";
		}
		$Log = date("D M d, Y G:i");
		$eventString = "<b>[".$Log."] ".$_SESSION['username']." is uploading a file <font color=red>".$name."</font> to S3 bucket</b><br>";
		echo $eventString;

		echo "Log recorded in <font color=red> RDS & Cloudwatch</font><br>";
		echo "<font color=green> Amazon SNS </font> would have sent email notification to swetha's sjsu account sent <br>";
		echo "</b><br><br> <br>";
		$insert_query = "insert into events values('".$eventString."')";
		$result= mysqli_query($connection, $insert_query);
		if (substr($name, -3) == 'pem') {
			$eventString = "<b>[".$Log."] "." Suffix is .pem.<font color=red> Amazon Lambda will trigger and delete the object</font></b><br>";
			echo $eventString;
			$insert_query = "insert into events values('".$eventString."')";
			$result= mysqli_query($connection, $insert_query);

		}
	}
	mysqli_close($connection);
?>
<html>
	<head>
	</head>
	<body>
	<br>
	<h3> Use this page to upload file </h3>
	<h5>*dont upload .pem file (Amazon lambda will delete it automatically) </h5>
	<form action="" method="post" enctype="multipart/form-data">
		<table>
		<tr>
		<td> Description of your file </td> <td>  <input type="text" size=100 value ="default description" name="description"> </td>
		</tr>

		<tr> <td> Browse locally to upload a file </td><td>  <input type="file" name="file"> </td> </tr>
		<tr> <td> push to S3 </td><td><input type="submit" value="upload"> </td></tr>
	</form>

		</table>

	<br><h3> List all files uploaded to S3><a href="listS3.php"> Click Here </h3></a>
	<h3> List files from replication bucket><a href="replication.php"> Click Here </h3></a>
	<h3> View entire Activity Log><a href="activitylog.php"> Click Here </h3></a>
        <h4>Admin debug page with all objects across all regions <a href="listall.php"> Click Here </h4</a>
	<h3><font color="brown"><b><h4> Log out <a href="logout.php">Click Here</a></h3></b></font>
	</body>

</html>

