<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Product.php' ?>
<?php include_once '../lib/Database.php';?>
<?php include_once '../helper/Format.php';?>
<?php 
	$pd = new Product();
	$fm = new Format();

?>
<?php
	

	if (isset($_GET['delproduct'])) {
		$id = $_GET['delproduct'];
		$delproduct = $pd->delProductById($id);
	}

?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        <div class="block">  

        	<?php
                	if (isset($delproduct)) {
                		echo $delproduct;
            }

			?>


            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>sl</th>
					<th>Product name</th>
					<th>Category</th>
					<th>Brand=</th>
					<th>Description</th>
					<th>Price</th>
					<th>Image</th>
					<th>Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$getPd = $pd->getAllProduct();
					if ($getPd) {
						$i=0;
						while ($result = $getPd->fetch_assoc()) {
							$i++;
					
				?>
				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $result['product_name']; ?></td>
					<td><?php echo $result['cat_name']; ?></td>
					<td><?php echo $result['brand_name']; ?></td>
					<td><?php echo $fm->textShorten($result['body'],50); ?></td>
					<td>Tk<?php echo $result['price']; ?></td>
					<td><img src="<?php echo $result['image']; ?>" height="40px" width="60px"/></td>
					<td><?php
					 if ($result['type']==0) {
					 	echo "Fetured";
					 }else{
					 	echo "Genarel";
					 }

					 ?>
					
					</td>
					<td><a href="productedit.php?product_id= <?php echo $result['product_id']; ?>">Edit</a> ||
			<a onclick="return confirm('Are you sure that you want to delete??')" 
			href="?delproduct=<?php echo $result['product_id']; ?>">Delete</a></td>
				</tr>
				<?php  } } ?>
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
