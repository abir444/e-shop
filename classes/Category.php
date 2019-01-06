<?php //include files
	
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helper/Format.php');
?>


<?php
/**
* This is for add category
*/
class Category
{
	private $db;
	private $fm;
	
	public function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
		
	}
	public function catInsert($cat_name){
		$cat_name = $this->fm->validation($cat_name);
		$cat_name = mysqli_real_escape_string($this->db->link,$cat_name);

		if (empty($cat_name)){
			$msg = "<span class='error'> category must not be empty!</span>";
			return $msg;
	}else{
		$query = "INSERT INTO tbl_category(cat_name) VALUES('$cat_name')";
		$catInsert= $this->db->INSERT($query);
		if ($catInsert) {
			$msg = "<span class='success'>Categoty inserted successfully.</span>";
			return $msg;
		}else{
			$msg = "<span class='error'>Categoty not inserted .</span>";
			return $msg;
			}
		}
	}
	public function getAllCat(){
		$query ="SELECT * FROM tbl_category ORDER BY cat_id DESC";
		$result= $this->db->SELECT($query);
		return $result;

	}

	public function getCatById($id){
		$query ="SELECT * FROM tbl_category WHERE cat_id = '$id' ";
		$result= $this->db->SELECT($query);
		return $result;
	}

	public function catupdate($cat_name,$id){
		$cat_name = $this->fm->validation($cat_name);
		$cat_name = mysqli_real_escape_string($this->db->link,$cat_name);
		 $id = mysqli_real_escape_string($this->db->link,$id);

		if (empty($cat_name)){
			$msg = "<span class='error'> category must not be empty!</span>";
			return $msg;
	}else{
		$query ="UPDATE tbl_category
				SET 
				cat_name = '$cat_name'
				WHERE cat_id = '$id'";

			$updated_row = $this->db->update($query);	
			if ($updated_row) {
					$msg = "<span class='success'> category updated!!!</span>";
					return $msg;
	      }else{
			      	$msg = "<span class='error'> category not updated properly...try again.</span>";
					return $msg;
	      }		

		}
	}

	public function delCatById($id){
		$query = "DELETE FROM tbl_category WHERE cat_id = '$id'";
		$deldata = $this->db->delete($query);
			if ($deldata) {
					$msg = "<span class='success'> category deleted!!!</span>";
					return $msg;
	      }else{
			      	$msg = "<span class='error'> category not deleted  ...try again.</span>";
					return $msg;
	      }	


	}
}	

?>