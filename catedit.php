<?php include '../classes/Category.php' ?>
<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php

    if (!isset($_GET['cat_id']) || ($_GET['cat_id'] ==NULL  )) {
        echo "<script>window.location ='catlist.php'; </script>";
    }else{
        $id = preg_replace('/[^-a-zA-Z0-9_]/', '',$_GET['cat_id']);
    }

    $cat = new Category();
    if ($_SERVER['REQUEST_METHOD']== 'POST') {
        $cat_name = $_POST['cat_name'];   
        $updatecat = $cat->catupdate($cat_name,$id);   
     } 

?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Category</h2>
               <div class="block copyblock"> 

                <?php 
                if (isset($updatecat)) {
                    echo $updatecat;
                }
                ?>

                <?php 
                $getCat = $cat->getCatById($id);
                if ($getCat) {
                while($result = $getCat->fetch_assoc()){
                ?>

                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="cat_name" value="<?php echo $result['cat_name']; ?>" class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>

                    <?php }} ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>