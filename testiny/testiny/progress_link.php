<div class="span3" id="sidebar">
	<img id="avatar" src="admin/<?php echo $row['location']; ?>" class="img-polaroid">
		<ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">
				<li class=""><a href="dashboard_student.php"><i class="icon-chevron-right"></i><i class="icon-chevron-left"></i>&nbsp;Back</a></li>
				
				<li class=""><a href="online_quize/quizhome.php<?php echo '?id='.$get_id; ?>"><i class="icon-chevron-right"></i><i class="icon-reorder"></i>&nbsp;Quiz</a></li>
		</ul>
	<?php /* include('search_other_class.php');  */?>	
</div>