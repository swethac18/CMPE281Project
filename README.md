# CMPE281Project
Professor: Mr. Sanjay Garge <br>
Instructor Assistant: Divyankitha Urs <br>
Student: Swetha Chandrasekar <br>
public URL : http://swethacmpe281project.com/cmpe/app/login.php <br>
linkedin URL : https://www.linkedin.com/in/swetha-chandrasekar-76aa18129 <br>


<br> <b> How to deploy locally ? </b> <br>

1. sudo apt-get install apache2 <br>
2. sudo apt-get install libphp5 <br>
3. sudo service apache2 start <br>
4. cd /var/www/html <br>
5. tar -zxvf <gzip file> 

<b>Code Organization </b><br><br>
1. Directory App
	Contains all critical PHP files to perform <br>
		1. login/logout <br>
		2. upload to S3 bucket, <br> 
		3. view objects on main S3 bucket and replication bucket, 
		4. update objects in S3,
		5. delete objects in S3,
		6. Create a short-lived presigned URL to share
		7. Connecting to RDS database to fetch activity log, s3 object description
2. Directory vendor<br>
		1. Contains php aws sdk <br>
3. Composer.json <br>
		1. Responsibile for downloading needed libraries <br>
