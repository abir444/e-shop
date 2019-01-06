<?php include '../classes/Category.php' ?>
<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php
	$cat = new Category();

	if (isset($_GET['delcat'])) {
		$id = $_GET['delcat'];
		$delcat = $cat->delCatById($id);
	}

?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
                <div class="block">       
                	<?php
                	if (isset($delcat)) {
                		echo $delcat;
                	}

                	?>


                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>

					<?php   
						$getCat= $cat->getAllCat();
						if ($getCat) {
							$i=0;
							while($result = $getCat->fetch_assoc()){	//starting
								$i++;
							
					?>
						<tr class="odd gradeX">
			<td><?php echo $i;?></td>
			<td><?php echo $result['cat_name']; ?></td>
			<td><a href="catedit.php?cat_id= <?php echo $result['cat_id']; ?>">Edit</a> ||
			<a onclick="return confirm('Are you sure that you want to delete??')" href="?delcat=<?php echo $result['cat_id']; ?>">Delete</a></td>
						</tr>

						<?php  }}else{						//end of while loop

						}  ?>
					
					</tbody>
				</table>
               </div>
            </div>
        </div>
<script type="text/javascript">
	$(document).ready(function () {
	    setupLeftMenu();

	    $('.datatable').dataTable();
	    setSidebarHeight();
	});
</script>
<?php include 'inc/footer.php';?>

