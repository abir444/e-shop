<?php include '../classes/Brand.php' ?>
<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php

     if (!isset($_GET['brand_id']) || ($_GET['brand_id'] ==NULL  )) {
        echo "<script>window.location ='brandlist.php'; </script>";
    }else{
        $id = preg_replace('/[^-a-zA-Z0-9_]/', '',$_GET['brand_id']);
    }

    $brand = new Brand();
    if ($_SERVER['REQUEST_METHOD']== 'POST') {
        $brand_name = $_POST['brand_name'];   
        $updatebrand = $brand->brandupdate($brand_name,$id);   
     } 

?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Brand</h2>
               <div class="block copyblock"> 

                <?php 
                if (isset($updatebrand)) {
                    echo $updatebrand;
                }
                ?>

                <?php 
                $getBrand = $brand->getBrandById($id);
                if ($getBrand) {
                while($result = $getBrand->fetch_assoc()){
                ?>

                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="brand_name" value="<?php echo $result['brand_name']; ?>" class="medium" />
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