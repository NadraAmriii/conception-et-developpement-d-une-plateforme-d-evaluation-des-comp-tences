<?php
		include('config.php');
		session_start();
		$username = $_POST['username'];
		$password = $_POST['password'];
		/* student */
			$query = "SELECT * FROM developper WHERE username='$username' AND password='$password'";
			$result = mysqli_query($conn,$query)or die(mysqli_error());
			$row = mysqli_fetch_array($result);
			$num_row = mysqli_num_rows($result);
		/* teacher */
		$query_teacher = mysqli_query($conn,"SELECT * FROM entreprise WHERE username='$username' AND password='$password'")or die(mysqli_error());
		$num_row_teacher = mysqli_num_rows($query_teacher);
		$row_teahcer = mysqli_fetch_array($query_teacher);
		if( $num_row > 0 ) { 
		$_SESSION['id']=$row['id'];
		echo 'true_developper';	
		}else if ($num_row_teacher > 0){
		$_SESSION['id']=$row_teahcer['id'];
		echo 'true';
		
		 }else{ 
				echo 'false';
		}	
				
		?>