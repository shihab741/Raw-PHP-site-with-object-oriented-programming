<?php

/**
 *
 * This class takes care of login and logout process.
 *
 */

namespace App\classes;


class Login extends Database
{

	protected $connection;

	public function __construct(){
		parent::__construct();
	}

	public function admin_login_check($data)
	{
		$password = md5($data['password']);
		$sql = "SELECT * FROM tbl_admin WHERE email_address = '$data[email_address]' AND password = '$password'";

		$query_result = $this->run_query_for_data($sql);
		$admin_info = mysqli_fetch_assoc($query_result);


		if ($admin_info) {

			$_SESSION['admin_id'] = $admin_info['admin_id'];
			$_SESSION['admin_name'] = $admin_info['admin_name'];

			header('Location: dashboard.php');
		}
		else{
			// $_SESSION['message'] = 'Your email address or password did not match';
			// header('Location: index.php');
			$message = 'Your email address or password did not match';
			return $message;
		}
	}

	public function admin_logout()
	{
		unset($_SESSION['admin_id']);
		unset($_SESSION['admin_name']);
		header('Location: ../admin');
	}
}