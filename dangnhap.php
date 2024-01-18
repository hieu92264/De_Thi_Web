<?php
	session_start();
	include "connect.php";
	if(isset($_POST['dangnhap'])) {
		if(isset($_POST['username']) && isset($_POST['password'])) {
			$conn = null;
			try {
				$conn = new PDO("mysql:host=$server;dbname=$database", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				if(isset($conn)) {
					$stmt = $conn->prepare("select * from user where username = :username and matkhau = :password");
					$stmt->bindParam(':username', $_POST['username']);
					$stmt->bindParam(':password', $_POST['password']);
					$stmt->execute();
					if($stmt->rowCount()>0) {
						$_SESSION['username'] = $_POST['username'];
						$row = $stmt->fetch(PDO::FETCH_ASSOC);
						$_SESSION['fullname'] = $row['tendaydu'];
						header("location: index.php");
					} else {
						echo "error";
					}
				}
			} catch(PDOException $e) {
				echo $e->getMessage();
			}
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Document</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
	</head>
	<body>
		<header>
			<img src="https://scontent.fhan20-1.fna.fbcdn.net/v/t39.30808-6/313907511_6008037232550059_1400294275399937016_n.jpg?_nc_cat=109&ccb=1-7&_nc_sid=efb6e6&_nc_eui2=AeEftHg9N_YniO-50oq2cBbyNT3TttbH7ms1PdO21sfua6ZBGHJqiW3Zfh9WXNsnfC7nr3RAc934MhYmNLI-O4Kv&_nc_ohc=4NFLKEYErpUAX8nSLw4&_nc_ht=scontent.fhan20-1.fna&oh=00_AfA-GQPoVlAJz5p-IInqfIEnG8U-XQUoOSP_Cy793TNBRg&oe=65ACFA76" class="img-fluid img-thumbnail" alt="Responsive image" style="width: 100px; height=100px;">
			<div class="header">
				Thư viện
			</div>
		</header>
		<content>
			<div class="container">
				<form method="post">
				<fieldset class="form-group">
					<label for="formGroupExampleInput">Tài khoản</label>
					<input type="text" class="form-control" id="formGroupExampleInput" name="username" placeholder="Nhập tài khoản">
				</fieldset>
				<fieldset class="form-group">
					<label for="formGroupExampleInput2">Mật khẩu</label>
					<input type="text" class="form-control" id="formGroupExampleInput2" name="password" placeholder="Nhập mật khẩu">
				</fieldset>
				<input type="submit" name="dangnhap" value="Đăng nhập">
			</form>
			</div>
			
		</content>
		<footer>
			92264 - Nguyen The Hieu - PTUDWEB N01
		</footer>
	</body>
</html>