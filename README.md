# CMPE281Project
Code Organization <br><br>
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
