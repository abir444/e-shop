<?php //include files
	
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helper/Format.php');
?>



<?php 

/**
* 
*/
class Brand
{
	private $db;
	private $fm;
	
	public function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
		
	}

		public function brandInsert($brand_name){
		$brand_name = $this->fm->validation($brand_name);
		$brand_name = mysqli_real_escape_string($this->db->link,$brand_name);

		if (empty($brand_name)){
			$msg = "<span class='error'> brand must not be empty!</span>";
			return $msg;
	}else{
		$query = "INSERT INTO tbl_brand(brand_name) VALUES('$brand_name')";
		$brandInsert= $this->db->INSERT($query);
		if ($brandInsert) {
			$msg = "<span class='success'>Brand name inserted successfully.</span>";
			return $msg;
		}else{
			$msg = "<span class='error'>Brand name not inserted .</span>";
			return $msg;
			}
		}
	}


	public function getAllBrand(){
		$query ="SELECT * FROM tbl_brand ORDER BY brand_id DESC";
		$result= $this->db->SELECT($query);
		return $result;
	}

	public function getBrandById($id){
		$query ="SELECT * FROM tbl_brand WHERE brand_id = '$id' ";
		$result= $this->db->SELECT($query);
		return $result;
	}

	public function brandupdate($brand_name,$id){
		$brand_name = $this->fm->validation($brand_name);
		$brand_name = mysqli_real_escape_string($this->db->link,$brand_name);
		 $id = mysqli_real_escape_string($this->db->link,$id);

		if (empty($brand_name)){
			$msg = "<span class='error'> brand must not be empty!</span>";
			return $msg;
	}else{
		$query ="UPDATE tbl_brand
				SET 
				brand_name = '$brand_name'
				WHERE brand_id = '$id'";

			$updated_row = $this->db->update($query);	
			if ($updated_row) {
					$msg = "<span class='success'> Brand name updated!!!</span>";
					return $msg;
	      }else{
			      	$msg = "<span class='error'> Brand name is not updated properly...try again!.</span>";
					return $msg;
	      }		

		}
	}


		public function delBrandById($id){
		$query = "DELETE FROM tbl_brand WHERE brand_id = '$id'";
		$deldata = $this->db->delete($query);
			if ($deldata) {
					$msg = "<span class='success'> Brand name deleted!!!</span>";
					return $msg;
	      }else{
			      	$msg = "<span class='error'> Brand Name not deleted  ...try again.</span>";
					return $msg;
	      }	


		}
}

 ?>