<?php 

session_start();


$con=mysqli_connect('localhost','root');

if ($con) 
  {
		echo "connection successful";
  }
else
	{
		echo "no connection";
	}

 mysqli_select_db($con,'uniquedeveloper');
 $name=$_POST['name'];
 $pass=$_POST['password'];
 $email=$_POST['email'];
 $role=$_POST['user_type'];

 $q="select * from login where username='$name' && password='$pass'";

 $result=mysqli_query($con,$q);
 $id = $result['id'];
 $num=mysqli_num_rows($result);
 if ($num==1)
  {
 	"duplicate data";
 	header('location:signup.html');
 }
 else
 {
 	$qy="insert into login(username,password,email,namee) values('$name','$pass','$email','$role')";
 	mysqli_query($con,$qy);
	 $_SESSION['id']=$id;
 	echo "inserted";
 	header('location:login.php');
 }





 ?>