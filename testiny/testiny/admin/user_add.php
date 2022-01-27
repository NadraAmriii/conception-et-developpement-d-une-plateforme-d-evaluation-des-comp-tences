<?php 

				// in this file --> code for add a new course ,update a course and delete a course by admin from manage_courses.php

 session_start();

   $con=mysqli_connect('localhost','root');

mysqli_select_db($con,'uniquedeveloper');

// ==========================================================================================

					// code to add a new course by admin from manage_courses.php

if (isset($_POST['btn_add'])) {
	$languagename=$_POST['name'];
$languageimg=$_FILES['password'];
$languagedesc=$_POST['email'];

$filename=$languageimg['img'];
print_r($languageimg);		
$fileerror=$languageimg['error'];   
$filetmp=$languageimg['tmp_name'];


$fileext=explode('.', $filename);
$filecheck=strtolower(end($fileext));

$fileextstored= array('png','jpg','jpeg' );


if (in_array($filecheck,$fileextstored)) {
	$destinationfile='uploadimg/'.$filename;
	move_uploaded_file($filetmp,'../../uploadimg/'.$filename);

	$q="insert into users(language_name,language_image,language_description) values('$languagename','$destinationfile','$languagedesc')";
	$r=mysqli_query($con,$q);

 if ($r==true) {
 header("location:manage_users.php?status=added");
    }
	
 }
}


// ============================================================================================

				// code to add a new course by admin from manage_courses.php

if (isset($_POST['btn-delete-course'])) {
	
	$user_name=$_POST['selected_course'];
	$q="DELETE FROM users WHERE language_name='$user_name'";
	$r=mysqli_query($con,$q);
	if ($r) 
	{
		header("location:manage_users.php?status=deleted");
	}

}


// ==============================================================================
					// code to update course by admin from manage_courses.php


if (isset($_POST['btn_update'])) {
	$languagename=$_POST['selected-course-to-update'];
$languageimg=$_FILES['course_image'];
$languagedesc=$_POST['course_desc'];

$filename=$languageimg['name'];
print_r($languageimg);		
$fileerror=$languageimg['error'];   
$filetmp=$languageimg['tmp_name'];


$fileext=explode('.', $filename);
$filecheck=strtolower(end($fileext));

$fileextstored= array('png','jpg','jpeg' );

if (in_array($filecheck,$fileextstored)) {
	$destinationfile='uploadimg/'.$filename;
	move_uploaded_file($filetmp,$destinationfile);

	$q=" UPDATE programming_languages SET language_image='$destinationfile',language_description='$languagedesc' WHERE language_name='$languagename'";
	$r=mysqli_query($con,$q);

 if ($r==true) {
 header("location:manage_users.php?status=updated");
    }
	
 }
}



// =====================================================================================================================================
// ========================================================================================================================
     // in this section add videos ,update videos and delete videos is going on from manage_videos.php


if (isset($_POST['btn_add'])) {
	$coursename=$_POST['course_name'];
$courseimg=$_FILES['course_image'];
$coursedesc=$_POST['course_desc'];

$filename=$courseimg['name'];
print_r($courseimg);		
$fileerror=$courseimg['error'];   
$filetmp=$courseimg['tmp_name'];


$fileext=explode('.', $filename);
$filecheck=strtolower(end($fileext));

$fileextstored= array('png','jpg','jpeg' );

if (in_array($filecheck,$fileextstored)) {
	$destinationfile='uploadimg/'.$filename;
	move_uploaded_file($filetmp,$destinationfile);

	$q="insert into users(name,email,password) values('$destinationfile','$coursedesc','$coursename')";
	$r=mysqli_query($con,$q);

 if ($r==true) {
 header("location:manage_users.php?status=added");
    }
	
 }
}



