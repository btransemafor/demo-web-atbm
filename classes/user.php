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

/*
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

	*/ 


	/*
	public function login($email, $password)
	{
		$query = "SELECT * FROM users WHERE email = '$email' AND password = '$password' LIMIT 1 ";
		$result = $this->db->select($query);
		if ($result) {
			$value = $result->fetch_assoc();
			Session::set('user', true);
			Session::set('userId', $value['id']);
			Session::set('role_id', $value['role_id']);
			header("Location:index.php");
			exit();
		} else {
			$alert = "Tên đăng nhập hoặc mật khẩu không đúng!";
			return $alert;
		}
	}
	*/
	
	public function login($email, $password)
{
    // Truy vấn thông tin user theo email
    $stmt = $this->db->link->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
    if (!$stmt) {
        die("SQL Error: " . $this->db->link->error);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Nếu tìm thấy user
    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Dùng password_verify để so sánh mật khẩu gốc với chuỗi hash
        if (password_verify($password, $user['password'])) {
            // Nếu đúng, thiết lập session
            Session::set('user', true);
            Session::set('userId', $user['id']);
            Session::set('role_id', $user['role_id']);
            header("Location: index.php");
            exit(); // Thêm exit() để chắc chắn script dừng lại sau khi redirect
        } else {
            return "Email hoặc mật khẩu không đúng!";
        }
    } else {
        return "Email hoặc mật khẩu không đúng!";
    }
}

public function insert($data)
{
    $fullName = $data['fullName'];
    $email = $data['email'];
    $dob = $data['dob'];
    $address = $data['address'];
    $passwordRaw = $data['password'];

    // Băm mật khẩu bằng bcrypt
    $password = password_hash($passwordRaw, PASSWORD_DEFAULT);

    if (!$password) {
        return "Lỗi khi mã hóa mật khẩu!";
    }

    // Kiểm tra trùng email
    $stmt = $this->db->link->prepare("SELECT id FROM users WHERE email = ? LIMIT 1");
    if (!$stmt) {
        die("SQL Error (check email): " . $this->db->link->error);
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        return "Email đã tồn tại!";
    }

    // Tạo mã captcha xác nhận email
    $captcha = rand(10000, 99999);

    // Thêm người dùng mới
    $query = "INSERT INTO users (email, fullname, dob, password, role_id, status, address, isConfirmed, captcha)
              VALUES (?, ?, ?, ?, 2, 1, ?, 0, ?)";
    $stmt = $this->db->link->prepare($query);
    $stmt->bind_param("ssssss", $email, $fullName, $dob, $password, $address, $captcha);
    $success = $stmt->execute();

    if (!$success) {
        return "Lỗi khi thêm tài khoản!";
    }

    // Gửi email xác minh
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->Host = 'smtp.gmail.com';
    $mail->Username = "omgniceten@gmail.com";
    $mail->Password = "uhik jxta kghm rfou";
    $mail->SMTPSecure = "tls";
    $mail->Port = 587;

    $mail->CharSet = "UTF-8";
    $mail->isHTML(true);
    $mail->setFrom("omgniceten@gmail.com", "Instrument Store");
    $mail->addAddress($email, $fullName);

    $mail->Subject = "Xác nhận tài khoản - Instrument Store";
    $mail->Body = "<h3>Mã xác minh tài khoản của bạn: <strong>$captcha</strong></h3>";

    if (!$mail->send()) {
        return "Tạo thành công, nhưng gửi email lỗi: " . $mail->ErrorInfo;
    }

    return true;
}

	

public function getInfoById($userId)
{
	$query = "SELECT * FROM users WHERE id = ? LIMIT 1";
	$stmt = $this->db->link->prepare($query);
	$stmt->bind_param("i", $userId);
	$stmt->execute();
	$result = $stmt->get_result();

	if ($result && $result->num_rows > 0) {
		return $result->fetch_assoc();
	}
	return false;
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