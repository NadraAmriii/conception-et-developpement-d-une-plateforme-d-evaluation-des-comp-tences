<!DOCTYPE html>
<html lang="en">
<head>
	</head>
	<?php include('header.php') ?>
	<?php include('auth.php') ?>
	<?php include('db_connect.php') ?>
	<title>History</title>
</head>
<body>
	
	
	<div class="container-fluid admin">
		<div class="col-md-12 alert alert-primary">Quiz Records</div>
		<br>
		<div class="col-md-4 offset-md-4 mb-4">
			<select class="form-control select2" onchange="location.replace('history.php?quiz_id='+this.value)">
				<option value="all" <?php echo isset($_GET['id']) && $_GET['id'] == 'all' ? 'selected' : '' ?>>All</option>
				<?php 
				$where =''; 
				if($_SESSION['username'] ='developper'){
					$where = ' where user_id = '.$_SESSION['namee'].' '; 
				}
				$quiz = $conn->query("SELECT * FROM category ");
				while($row = $quiz->fetch_assoc()){
				?>
				<option value="<?php echo $row['id'] ?>" <?php echo isset($_GET['quiz_id']) && $_GET['quiz_id'] == $row['id']  ? 'selected' : '' ?>><?php echo $row['cat_name'] ?></option>
			<?php } ?>
			</select>
		</div>
		<div class="card">
			<div class="card-body">
				<table class="table table-bordered" id='table'>
					<colgroup>
						<col width="10%">
						<col width="30%">
						<col width="20%">
						<col width="20%">
						<col width="20%">
					</colgroup>
					<thead>
						<tr>
							<th>#</th>
							<th>Student Name</th>
							<th>Quiz</th>
							<th>Score</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$where = '';
					if($_SESSION['username'] == 'developper'){
						$where = ' where q.user_id = '.$_SESSION['namee'].' ';
					}
					if(isset($_GET['quiz_id']) && $_GET['quiz_id'] != 'all'){
						if(empty($where)){
						$where = ' where q.id = '.$_GET['quiz_id'].' ';

						}else{
						$where = ' and q.id = '.$_GET['quiz_id'].' ';

						}
					}
					$qry = $conn->query("SELECT l.namee , c.categ_name from login l  inner join category c on c.log_id = l.id ".$where."  ");
					$i = 1;
					if($qry->num_rows = 0){
						while($row= $qry->fetch_assoc()){
							
						?>
					<tr>
						<td><?php echo $i++ ?></td>
						<td><?php echo ucwords($row['namee']) ?></td>
						<td><?php echo $row['categ_name'] ?></td>
						
					</tr>
					<?php
					}
					}
					?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</body>
<script>
	$(document).ready(function(){
		$('#table').DataTable();
		$('.select2').select2({
		})
		$('#new_faculty').click(function(){
			$('#msg').html('')
			$('#manage_faculty .modal-title').html('Add New Faculty')
			$('#manage_faculty #faculty-frm').get(0).reset()
			$('#manage_faculty').modal('show')
		})
		$('.edit_faculty').click(function(){
			var id = $(this).attr('data-id')
			$.ajax({
				url:'./get_faculty.php?id='+id,
				error:err=>console.log(err),
				success:function(resp){
					if(typeof resp != undefined){
						resp = JSON.parse(resp)
						$('[name="id"]').val(resp.id)
						$('[name="uid"]').val(resp.uid)
						$('[name="name"]').val(resp.name)
						$('[name="subject"]').val(resp.subject)
						$('[name="username"]').val(resp.username)
						$('[name="password"]').val(resp.password)
						$('#manage_faculty .modal-title').html('Edit Faculty')
						$('#manage_faculty').modal('show')

					}
				}
			})

		})
		$('.remove_faculty').click(function(){
			var id = $(this).attr('data-id')
			var conf = confirm('Are you sure to delete this data.');
			if(conf == true){
				$.ajax({
				url:'./delete_faculty.php?id='+id,
				error:err=>console.log(err),
				success:function(resp){
					if(resp == true)
						location.reload()
				}
			})
			}
		})
		$('#faculty-frm').submit(function(e){
			e.preventDefault();
			$('#faculty-frm [name="submit"]').attr('disabled',true)
			$('#faculty-frm [name="submit"]').html('Saving...')
			$('#msg').html('')

			$.ajax({
				url:'./save_faculty.php',
				method:'POST',
				data:$(this).serialize(),
				error:err=>{
					console.log(err)
					alert('An error occured')
					$('#faculty-frm [name="submit"]').removeAttr('disabled')
					$('#faculty-frm [name="submit"]').html('Save')
				},
				success:function(resp){
					if(typeof resp != undefined){
						resp = JSON.parse(resp)
						if(resp.status == 1){
							alert('Data successfully saved');
							location.reload()
						}else{
						$('#msg').html('<div class="alert alert-danger">'+resp.msg+'</div>')

						}
					}
				}
			})
		})
	})
</script>
</html>