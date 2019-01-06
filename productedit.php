<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Brand.php' ?>
<?php include '../classes/Product.php' ?>
<?php include '../classes/Category.php' ?>

<?php

 if (!isset($_GET['product_id']) || ($_GET['product_id'] ==NULL  )) {
        echo "<script>window.location ='productlist.php'; </script>";
    }else{
        $id = preg_replace('/[^-a-zA-Z0-9_]/', '',$_GET['product_id']);
    }

    $pd = new Product();
    if ($_SERVER['REQUEST_METHOD']== 'POST' && isset($_POST['submit'])) {
        $updateproduct = $pd->productUpdate($_POST, $_FILES,$id);
    }
?>

  <?php 
     $getproduct = $pd->getProductById($id);
     if ($getproduct) {
     while($value = $getproduct->fetch_assoc()){
       
 ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Product</h2>
        <div class="block">    
        <?php 
        if (isset($updateproduct)) {
            echo $updateproduct;
        }
         ?>           
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" name="product_name" value="<?php echo $value['product_name']?>" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>
                        <select id="select" name="cat_id">
                            <option>Select Category</option>
                             <?php  
                            $cat = new Category();
                            $getCat = $cat->getAllCat();
                            if ($getCat) {
                                while ($result =$getCat->fetch_assoc()) {
                            ?>
                                    
                             
                            <option

                            <?php  
                            if ($value['cat_id'] == $result['cat_id']) { ?>
                                selected = "selected"
                           <?php } ?>
                            
                             value="<?php echo $result['cat_id']; ?>"><?php echo $result['cat_name']; ?></option>
                            <?php }} ?>
                            
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Brand</label>
                    </td>
                    <td>
                        <select id="select" name="brand_id">
                            <option>Select Brand</option>
                            <?php  
                            $brand = new Brand();
                            $getBrand = $brand->getAllbrand();
                            if ($getBrand) {
                                while ($result =$getBrand->fetch_assoc()) {
                            ?>
                             
                            <option
                    <?php  
                     if ($value['brand_id'] == $result['brand_id']) { ?>
                                
                                selected = "selected"
                           <?php } ?> 
                           value="<?php echo $result['brand_id']; ?>"> 
                           <?php echo $result['brand_name']; ?></option>
                            <?php }} ?>
                        </select>
                    </td>
                </tr>
                
                 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Description</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name="body">
                            
                            <?php echo $value['body'];?>

                        </textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Price</label>
                    </td>
                    <td>
                        <input type="text" name="price" value="<?php echo $value['price']?>" class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <td><img src="<?php echo $value['image']; ?>" height="80px" width="300px"/><br/>
                        </td>
                        <input type="file" name="image" />
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <label>Product Type</label>
                    </td>
                    <td>
                        <select id="select" name="type">
                            <option>Select Type</option>

                            <?php if ($value['type']== 0) { ?>
                            <option selected="selected" value="0">Featured</option>
                            <option value="1">genarel</option>
                           <?php } else { ?>
                            <option value="0">Featured</option>
                            <option selected="selected" value="1">genarel</option>

                            <?php } ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
                </tr>
            </table>
            </form>
            <?php }} ?>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


