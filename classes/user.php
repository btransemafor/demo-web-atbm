<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/session.php');
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../lib/PHPMailer.php');
include_once($filepath . '/../lib/SMTP.php');

use PHPMailer\PHPMailer\PHPMailer;

/*
 * 
 */
class user
{
	private $db;
	public function __construct()
	{
		$this->db = new Database();
	}


	public function login($email, $password)
	{
		$stmt = $this->db->link->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
		$stmt->bind_param("s", $email);
		$stmt->execute();
		$result = $stmt->get_result();
	
		if ($result && $result->num_rows > 0) {
			$user = $result->fetch_assoc();
	
			// So sánh mật khẩu gốc với mật khẩu đã mã hóa trong DB
			if (password_verify($password, $user['password'])) {
				Session::set('user', true);
				Session::set('userId', $user['id']);
				Session::set('role_id', $user['role_id']);
				header("Location: index.php");
				exit();
			} else {
				return "Email Hoặc Mật khẩu không đúng!";
			}
		} else {
			return "Email Hoặc Mật khẩu không đúng !!!";
		}
	}

	public function insert($data)
	{
		$fullName = $data['fullName'];
		$email = $data['email'];
		$dob = $data['dob'];
		$address = $data['address'];
		$password = md5($data['password']);


		$check_email = "SELECT * FROM users WHERE email='$email' LIMIT 1";
		$result_check = $this->db->select($check_email);
		if ($result_check) {
			return 'Email đã tồn tại!';
		} else {
			// Genarate captcha
			$captcha = rand(10000, 99999);

			$query = "INSERT INTO users VALUES (NULL,'$email','$fullName','$dob','$password',2,1,'$address',0,'" . $captcha . "') ";
			$result = $this->db->insert($query);
			if ($result) {
				// Send email
				$mail = new PHPMailer();
				$mail->IsSMTP();
				$mail->Mailer = "smtp";

				$mail->SMTPDebug  = 0;
				$mail->SMTPAuth   = TRUE;
				$mail->SMTPSecure = "tls";
				$mail->Port       = 587;
				$mail->Host       = "smtp.gmail.com";
				$mail->Username   = "khuongip564gb@gmail.com";
				$mail->Password   = "googlekhuongip564gb";

				$mail->IsHTML(true);
				$mail->CharSet = 'UTF-8';
				$mail->AddAddress($email, "recipient-name");
				$mail->SetFrom("khuongip564gb@gmail.com", "Instrument Store");
				$mail->Subject = "Xác nhận email tài khoản - Instruments Store";
				$mail->Body = "<h3>Cảm ơn bạn đã đăng ký tài khoản tại website InstrumentStore</h3></br>Đây là mã xác minh tài khoản của bạn: " . $captcha . "";

				$mail->Send();

				return true;
			} else {
				return false;
			}
		}
	}

	public function get()
	{
		$userId = Session::get('userId');
		$query = "SELECT * FROM users WHERE id = '$userId' LIMIT 1";
		$mysqli_result = $this->db->select($query);
		if ($mysqli_result) {
			$result = mysqli_fetch_all($this->db->select($query), MYSQLI_ASSOC)[0];
			return $result;
		}
		return false;
	}

	public function getLastUserId()
	{
		$query = "SELECT * FROM users ORDER BY id DESC LIMIT 1";
		$mysqli_result = $this->db->select($query);
		if ($mysqli_result) {
			$result = mysqli_fetch_all($this->db->select($query), MYSQLI_ASSOC)[0];
			return $result;
		}
		return false;
	}

	public function confirm($userId, $captcha)
	{
		$query = "SELECT * FROM users WHERE id = '$userId' AND captcha = '$captcha' LIMIT 1";
		$mysqli_result = $this->db->select($query);
		if ($mysqli_result) {
			// Update comfirmed
			$sql = "UPDATE users SET isConfirmed = 1 WHERE id = $userId";
			$update = $this->db->update($sql);
			if ($update) {
				return true;
			}
		}
		return 'Mã xác minh không đúng!';
	}
}
?>