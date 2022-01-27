<?php 

				// in this file --> code for add a new course ,update a course and delete a course by admin from manage_courses.php

 session_start();

   $con=mysqli_connect('localhost','root');

mysqli_select_db($con,'uniquedeveloper');

// ==========================================================================================

					// code to add a new course by admin from manage_courses.php

if (isset($_POST['btn_add'])) {
$username=$_POST['user_name'];
$useremail=$_POST['user_email'];
$userpass=$_POST['password'];
$userrole=$_POST['user_role'];
/*
$filename=$languageimg['name'];
print_r($languageimg);		
$fileerror=$languageimg['error'];   
$filetmp=$languageimg['tmp_name'];


$fileext=explode('.', $filename);
$filecheck=strtolower(end($fileext));

$fileextstored= array('png','jpg','jpeg' );


if (in_array($filecheck,$fileextstored)) {
	$destinationfile='uploadimg/'.$filename;
	move_uploaded_file($filetmp,'../../uploadimg/'.$filename);

	$q="insert into programming_languages(language_name,language_image,language_description) values('$languagename','$destinationfile','$languagedesc')";
	$r=mysqli_query($con,$q);

 if ($r==true) {
 header("location:manage_courses.php?status=added");
    }

	
 }
 */
}


// ============================================================================================

				// code to add a new course by admin from manage_courses.php

if (isset($_POST['btn-delete-course'])) {
	
	$user_name=$_POST['selected_course'];
	$q="DELETE FROM login WHERE namee ='$user_name'";
	$r=mysqli_query($con,$q);
	if ($r) 
	{
		header("location:manage_users.php?status=deleted");
	}

}


// ==============================================================================
					// code to update course by admin from manage_courses.php


if (isset($_POST['btn_update'])) {
$username=$_POST['selected-course-to-update'];
$useremail=$_POST['user_email'];
$userpass=$_POST['user_pass'];
$userrole=$_POST['user_role'];


$q=" UPDATE login SET username='$username', email='$useremail',password='$userpass' WHERE namee='$username'";
	$r=mysqli_query($con,$q);

 if ($r==true) {
 header("location:manage_users.php?status=updated");
    }


 }




// =====================================================================================================================================
// ========================================================================================================================
     // in this section add videos ,update videos and delete videos is going on from manage_videos.php


if (isset($_POST['btn_add'])) {
$username=$_POST['user_name'];
$useremail=$_POST['user_email'];
$userpass=$_POST['user_pass'];
$userrole=$_POST['user_role'];


	$q="insert into login(username,password,email,namee) values('$username','$userpass','$useremail','$userrole')";
	$r=mysqli_query($con,$q);

 if ($r==true) {
 header("location:manage_users.php?status=added");
    }
	
 }




