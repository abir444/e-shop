<?php //include files
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helper/Format.php');
?>


<?php 
class Product
{
	private $db;
	private $fm;
	
	public function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
		
	}
	public function productInsert($data, $file){


		$product_name = $this->fm->validation($data['product_name']);
		$cat_id = $this->fm->validation($data['cat_id']);
		$brand_id = $this->fm->validation($data['brand_id']);
		$body = $this->fm->validation($data['body']);
		$price = $this->fm->validation($data['price']);
		$type = $this->fm->validation($data['type']);

		$product_name = mysqli_real_escape_string($this->db->link,$data['product_name']);
		$cat_id 	  = mysqli_real_escape_string($this->db->link,$data['cat_id']);
		$brand_id	  = mysqli_real_escape_string($this->db->link,$data['brand_id']);
		$body         = mysqli_real_escape_string($this->db->link,$data['body']);
		$price 		  = mysqli_real_escape_string($this->db->link,$data['price']);
		$type 		  = mysqli_real_escape_string($this->db->link,$data['type']);

		$permited  = array('jpg', 'jpeg', 'png', 'gif');
	    $file_name = $file['image']['name'];
	    $file_size = $file['image']['size'];
	    $file_temp = $file['image']['tmp_name'];

	    $div = explode('.', $file_name);
	    $file_ext = strtolower(end($div));
	    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
	    $uploaded_image = "uploads/".$unique_image;
	    
	    if ($product_name == "" || $cat_id == "" || $brand_id == "" || $body == "" || $price == "" || $file_name == "" || $type == "") {
	    	$msg = "<span class='error'>field must not be empty .</span>";
			return $msg;

	    }elseif (in_array($file_ext, $permited) === false) {
     echo "<span class='error'>You can upload only:-"
     .implode(', ', $permited)."</span>";
   	 }  else{
	    	move_uploaded_file($file_temp, $uploaded_image);
	    	$query = "INSERT INTO tbl_product(product_name,cat_id,brand_id,body,price,image,type) VALUES('$product_name','$cat_id','$brand_id','$body','$price','$uploaded_image','$type')";

	    $inserted_row= $this->db->INSERT($query);
		if ($inserted_row) {
			$msg = "<span class='success'>Product inserted successfully.</span>";
			return $msg;
		}else{
			$msg = "<span class='error'>Product not inserted .</span>";
			return $msg;
			}
	    }

	}
	public function getAllProduct(){
		/*
		$query ="SELECT tbl_product.*,tbl_category.cat_name,tbl_brand.brand_name 
		FROM tbl_product
		INNER JOIN tbl_category
		ON tbl_product.cat_id = tbl_category.cat_id
		INNER JOIN tbl_brand
		ON tbl_product.brand_id = tbl_brand.brand_id
		ORDER BY tbl_product.product_id DESC";
		$result= $this->db->SELECT($query);
		return $result;

*/
		$query = "SELECT p.*,c.cat_name,b.brand_name
		FROM tbl_product as p, tbl_category as c,tbl_brand as b
		WHERE p.cat_id = c.cat_id AND p.brand_id = b.brand_id
		ORDER BY p.product_id DESC";
		$result= $this->db->SELECT($query);
		return $result;
	}

	public function getProductById($id){
	$query ="SELECT * FROM tbl_product WHERE product_id = '$id' ";
		$result= $this->db->SELECT($query);
		return $result;
}

	public function productUpdate($data,$file,$id){

		$product_name = $this->fm->validation($data['product_name']);
		$cat_id = $this->fm->validation($data['cat_id']);
		$brand_id = $this->fm->validation($data['brand_id']);
		$body = $this->fm->validation($data['body']);
		$price = $this->fm->validation($data['price']);
		$type = $this->fm->validation($data['type']);

		$product_name = mysqli_real_escape_string($this->db->link,$data['product_name']);
		$cat_id 	  = mysqli_real_escape_string($this->db->link,$data['cat_id']);
		$brand_id	  = mysqli_real_escape_string($this->db->link,$data['brand_id']);
		$body         = mysqli_real_escape_string($this->db->link,$data['body']);
		$price 		  = mysqli_real_escape_string($this->db->link,$data['price']);
		$type 		  = mysqli_real_escape_string($this->db->link,$data['type']);

		$permited  = array('jpg', 'jpeg', 'png', 'gif');
	    $file_name = $file['image']['name'];
	    $file_size = $file['image']['size'];
	    $file_temp = $file['image']['tmp_name'];

	    $div = explode('.', $file_name);
	    $file_ext = strtolower(end($div));
	    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
	    $uploaded_image = "uploads/".$unique_image;
	    
	    if ($product_name == "" || $cat_id == "" || $brand_id == "" || $body == "" || $price == "" ||  $type == "") {
	    	$msg = "<span class='error'>field must not be empty .</span>";
			return $msg;

	    }else {

		if (!empty($file_name)) {
			


	    if($file_size> 1048567) {
   	 	echo "<span class='error'>image size should be less then 1 MB";

   	 }elseif (in_array($file_ext, $permited) === false) {
     echo "<span class='error'>You can upload only:-"
     .implode(', ', $permited)."</span>";
   	 }
   	 else{
	    	move_uploaded_file($file_temp, $uploaded_image);
	    	// $query = "INSERT INTO tbl_product(product_name,cat_id,brand_id,body,price,image,type) VALUES('$product_name','$cat_id','$brand_id','$body','$price','$uploaded_image','$type')";

	    	$query = "UPDATE tbl_product
	    			 SET
	    			 product_name	='$product_name',
	    			 cat_id  		='$cat_id',
	    			 brand_id='$brand_id',
	    			 body='$body',
	    			 price='$price',
	    			 image='$uploaded_image',
	    			 type='$type',
	    			 WHERE product_id= '$id'";

	    $updated_row= $this->db->UPDATE($query);
		if ($updated_row) {
			$msg = "<span class='success'>Product updated successfully.</span>";
			return $msg;
		}else{
			$msg = "<span class='error'>Product not updated .</span>";
			return $msg;
			}
	    }
	} //.................................if (!empty($file_name))

	else{

	    	// $query = "INSERT INTO tbl_product(product_name,cat_id,brand_id,body,price,image,type) VALUES('$product_name','$cat_id','$brand_id','$body','$price','$uploaded_image','$type')";

	    	$query = "UPDATE tbl_product
	    			 SET
	    			 product_name	='$product_name',
	    			 cat_id  		='$cat_id',
	    			 brand_id='$brand_id',
	    			 body='$body',
	    			 price='$price',
	    			 type='$type'
	    			 WHERE product_id= '$id'
	    			 ";

	    $updated_row= $this->db->UPDATE($query);
		if ($updated_row) {
			$msg = "<span class='success'>Product updated successfully.</span>";
			return $msg;
		}else{
			$msg = "<span class='error'>Product not updated .</span>";
			return $msg;
			}

			}
		}
	}
	public function delProductById($id){
		$query = "SELECT * FROM tbl_product WHERE product_id = '$id'";
		$getData = $this->db->select($query);
		if ($getData) {
			while ($delImg = $getData->fetch_assoc()) {
				$dellink=$delImg['image'];
				unlink($dellink);
			}
		}
		$delquery = "DELETE FROM tbl_product WHERE product_id = '$id'";
		$deldata = $this->db->delete($delquery);
			if ($deldata) {
					$msg = "<span class='success'> Product deleted!!!</span>";
					return $msg;
	      }else{
			      	$msg = "<span class='error'> Product not deleted  ...try again.</span>";
					return $msg;
	      }	
	}
	public function getFeturedProduct(){
		$query ="SELECT * FROM tbl_product WHERE type = '0' ORDER BY product_id DESC LIMIT 4";
		$result= $this->db->SELECT($query);
		return $result;
	}

}
?>