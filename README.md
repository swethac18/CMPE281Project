# CMPE281Project
Professor: Mr. Sanjay Garge <br>
Instructor Assistant: Divyankitha Mahesh Urs <br>
Student: Swetha Chandrasekar <br>
public URL : http://swethacmpe281project.com/cmpe/app/login.php <br>
linkedin URL : https://www.linkedin.com/in/swetha-chandrasekar-76aa18129 <br>


<u><br> <b> How to deploy locally ? </b> <br></u>
<u>apache2 server and php5 are the pre-requisites.</u>
On a ubuntu machine, <br>
1. sudo apt-get install apache2 <br>
2. sudo apt-get install php5 <br>
3. sudo service apache2 start <br>
4. cd /var/www/html <br>
5. (Search for the file Swetha_CMPE281_Project.tar.gz in the repository)
6. (unzip it) tar -zxvf Swetha_CMPE281_Project.tar.gz	
7. Files will be copied to /var/www/html/cmpe/app
8. Hit http://localhost/cmpe/app/login.php on browser.

<u><b>Issues you might face:</b></u>
1. If you face any issues with permission, please provide read & execute option for /var/www/html/cmpe/app directory and write permissions for /var/www/html/cmpe/app/files directory.
2. The tar.gz file is self contained. If you face issues with dependent aws-sdk php library, please install composer for php and reinstall dependent AWS SDK.
3. Have write access to /var/www/html/
<b><br>Listing objects on S3</b>
<img src="listing%20objects.png">
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
