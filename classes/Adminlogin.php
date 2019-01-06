<?php 
	// include '../lib/Session.php'; 
	
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Session.php');
	Session::checkLogin();
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helper/Format.php');


?>

<?php 
/**
* admin login
*/
class Adminlogin
{
	private $db;
	private $fm;
	
	public function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
		
	}

	public function AdminLogin($admin_user,$admin_pass)
	{
		$admin_user = $this->fm->validation($admin_user);
		$admin_pass = $this->fm->validation($admin_pass);


		$admin_user = mysqli_real_escape_string($this->db->link,$admin_user);
		$admin_pass = mysqli_real_escape_string($this->db->link,$admin_pass);

		if (empty($admin_user)|| empty($admin_pass)) {
			$loginmsg = "User name and password must not be empty!!!";
			return $loginmsg;
		}else{
			$query = "SELECT * FROM tbl_admin WHERE admin_user='$admin_user' AND admin_pass='$admin_pass'";

			$result = $this->db->select($query);

			if($result != false){
				$value=$result->fetch_assoc();
				Session::set("adminlogin",true);
				Session::set("admin_id",$value['admin_id']);
				Session::set("admin_user",$value['admin_user']);
				Session::set("admin_name",$value['admin_name']);
				Session::set("admin_email",$value['admin_email']);
				header("Location:Dashbord.php");

			}else{
				$loginmsg="username or password is incorrect!!!!!";
				return $loginmsg;
			}

		}



	}
}
?>