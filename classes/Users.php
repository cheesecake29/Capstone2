<?php
require_once('../config.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

class Users extends DBConnection
{
	private $settings;
	public function __construct()
	{
		global $_settings;
		$this->settings = $_settings;
		parent::__construct();
	}
	public function __destruct()
	{
		parent::__destruct();
	}
	public function save_users()
	{
		extract($_POST);
		$data = '';
		$chk = $this->conn->query("SELECT * FROM `users` where username ='{$username}' " . ($id > 0 ? " and id!= '{$id}' " : ""))->num_rows;
		if ($chk > 0) {
			return 3;
			exit;
		}
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id', 'password'))) {
				if (!empty($data)) $data .= " , ";
				$data .= " {$k} = '{$v}' ";
			}
		}
		if (!empty($password)) {
			$password = md5($password);
			if (!empty($data)) $data .= " , ";
			$data .= " `password` = '{$password}' ";
		}

		if (isset($_FILES['img']) && $_FILES['img']['tmp_name'] != '') {
			$fname = 'uploads/' . strtotime(date('y-m-d H:i')) . '_' . $_FILES['img']['name'];
			$move = move_uploaded_file($_FILES['img']['tmp_name'], '../' . $fname);
			if ($move) {
				$data .= " , avatar = '{$fname}' ";
				if (isset($_SESSION['userdata']['avatar']) && is_file('../' . $_SESSION['userdata']['avatar']) && $_SESSION['userdata']['id'] == $id)
					unlink('../' . $_SESSION['userdata']['avatar']);
			}
		}
		if (empty($id)) {
			$qry = $this->conn->query("INSERT INTO users set {$data}");
			if ($qry) {
				$this->settings->set_flashdata('success', 'User Details successfully saved.');
				return 1;
			} else {
				return 2;
			}
		} else {
			$qry = $this->conn->query("UPDATE users set $data where id = {$id}");
			if ($qry) {
				$this->settings->set_flashdata('success', 'User Details successfully updated.');
				foreach ($_POST as $k => $v) {
					if ($k != 'id') {
						if (!empty($data)) $data .= " , ";
						$this->settings->set_userdata($k, $v);
					}
				}
				if (isset($fname) && isset($move))
					$this->settings->set_userdata('avatar', $fname);

				return 1;
			} else {
				return "UPDATE users set $data where id = {$id}";
			}
		}
	}
	public function delete_users()
	{
		extract($_POST);
		$avatar = $this->conn->query("SELECT avatar FROM users where id = '{$id}'")->fetch_array()['avatar'];
		$qry = $this->conn->query("DELETE FROM users where id = $id");
		if ($qry) {
			$this->settings->set_flashdata('success', 'User Details successfully deleted.');
			if (is_file(base_app . $avatar))
				unlink(base_app . $avatar);
			$resp['status'] = 'success';
		} else {
			$resp['status'] = 'failed';
		}
		return json_encode($resp);
	}

	public function verification_code()
	{
		$email = $_POST['email'];
		$verificationCode = $_POST['verification'];

		$qry = $this->conn->query("UPDATE client_list SET status = 2 WHERE email = '$email' AND verification_code = '$verificationCode'");
		if ($qry) {
			$this->settings->set_flashdata('success', 'User Details successfully deleted.');
			$resp['status'] = 'success';
		} else {
			$resp['status'] = 'failed';
		}
		return json_encode($resp);
	}


	public function save_client(){
		if (!empty($_POST['password'])) {
			$_POST['password'] = md5($_POST['password']);
		} else {
			unset($_POST['password']);
		}
		function generateOTP() {
			return bin2hex(random_bytes(16));
		}
		
		// Check if the old password was provided
		$oldPasswordProvided = isset($_POST['oldpassword']);
	
		// If old password was provided, check if it's correct
		if ($oldPasswordProvided) {
			if ($this->settings->userdata('id') > 0 && $this->settings->userdata('login_type') == 2) {
				$get = $this->conn->query("SELECT * FROM `client_list` where id = '{$this->settings->userdata('id')}'");
				$res = $get->fetch_array();
				if ($res['password'] != md5($_POST['oldpassword']) && !empty($_POST['password'])) {
					return json_encode([
						'status' => 'failed',
						'msg' => 'Current Password is incorrect.'
					]);
				}
			}
			unset($_POST['oldpassword']);
		}
	
		extract($_POST);
		
		$otp = generateOTP();
		$data = "`verification_code` = '{$otp}', `status` = '2'";

		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id'))) {
				if (!empty($data)) $data .= ", ";
				$data .= " `{$k}` = '{$v}' ";
			}
		}
	
		// Your code for checking email uniqueness remains unchanged
	
		if (empty($id)) {
			$sql = "INSERT INTO `client_list` SET $data";
		} else {
			$sql = "UPDATE `client_list` SET $data WHERE id = '{$id}'";
		}
	
		$save = $this->conn->query($sql);
	
		if ($save) {
			$resp['status'] = 'success';
			if (empty($id)) {
				$resp['msg'] = "Account is successfully registered Kindly check your email for verification before logging in.";
				// Send email to the new client
				$mail = new PHPMailer(true);

				try {
					// ... Your email sending code ...
					$mail->isSMTP();
					$mail->Host = "smtp.hostinger.com";
					$mail->SMTPAuth = true;
					$mail->Username = "testemail@celesment.com";
					$mail->Password = "Test@12345";
					$mail->SMTPSecure = 'ssl';
					$mail->Port = 465;
		
					$mail->setFrom('testemail@celesment.com', 'Arnold TV Motoshop');
					$mail->addAddress($_POST['email']);
					$mail->Subject = 'Welcome to Arnold TV Motoshop';
					$mail->Body = 'Thank you for registering with our system. Please use this otp to validate your account:
					https://atvmotoshop.online/verification.php?token='.$otp.' ';
		
					$mail->send();
				} catch (Exception $e) {
					// Handle exceptions if the email fails to send
					return json_encode([
						'status' => 'failed',
						'msg' => 'Error sending email: ' . $e->getMessage()
					]);
				}
			} else if ($this->settings->userdata('id') == $id && $this->settings->userdata('login_type') == 2) {
				$resp['msg'] = "Account Details have been updated successfully.";
				foreach ($_POST as $k => $v) {
					if (!in_array($k, ['password'])) {
						$this->settings->set_userdata($k, $v);
					}
				}
			} else {
				$resp['msg'] = "Client's Account Details have been updated successfully.";
			}

			


		} else {
			$resp['status'] = 'failed';
			if (empty($id)) {
				$resp['msg'] = "Account has failed to register for some reason.";
			} else if ($this->settings->userdata('id') == $id && $this->settings->userdata('login_type') == 2) {
				$resp['msg'] = "Account Details have failed to update.";
			} else {
				$resp['msg'] = "Client's Account Details have failed to update.";
			}
		}
	
		if ($resp['status'] == 'success') {
			$this->settings->set_flashdata('success', $resp['msg']);
		}
		return json_encode($resp);
	}

	function reset_pass(){
		//TODO:

	}

	function delete_client()
	{
		extract($_POST);
		$del = $this->conn->query("UPDATE `client_list` set delete_flag = 1 where id='{$id}'");
		if ($del) {
			$resp['status'] = 'success';
			$resp['msg'] = ' Client Account has been deleted successfully.';
		} else {
			$resp['status'] = 'failed';
			$resp['msg'] = " Client Account has failed to delete";
		}
		if ($resp['status'] == 'success')
			$this->settings->set_flashdata('success', $resp['msg']);
		return json_encode($resp);
	}
}

$users = new users();
$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);
switch ($action) {
	case 'save':
		echo $users->save_users();
		break;
	case 'delete':
		echo $users->delete_users();
	case 'save_client':
		echo $users->save_client();
		break;
	case 'delete_client':
		echo $users->delete_client();
		break;

	default:
		// echo $sysset->index();
		break;
}
