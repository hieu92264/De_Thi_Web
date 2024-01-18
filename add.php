<?php
	include 'auth.php';
	include 'connect.php';
	try {
		$conn = new PDO("mysql:host=$server;dbname=$database", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		if(isset($_POST['add'])) {
			if($_POST['tensach'] != null || $_POST['tomtat'] !=null || $_POST['tacgia'] != null || $_POST['namxb'] != null || $_POST['loaisach'] != null) {
				try {
				if(isset($conn)) {
					$query = "INSERT INTO sach VALUES (NULL, :tensach, :tomtat, :tacgia, :namxb, :loaisach)";
					$stmt = $conn->prepare($query);
					$stmt->bindParam(':tensach', $_POST['tensach']);
					$stmt->bindParam(':tomtat', $_POST['tomtat']);
					$stmt->bindParam(':tacgia', $_POST['tacgia']);
					$stmt->bindParam(':namxb', $_POST['namxb']);
					$stmt->bindParam(':loaisach', $_POST['loaisach']);
					$stmt->execute();
					header('location: index.php');
				}
				
			} catch (PDOException $e) {
				echo $e->getMessage();
			}
			} else echo "<script>alert('Hãy nhập đủ thông tin') </script>";
			
		}
	} catch (PDOException $e) {
		echo $e->getMessage();
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
			<div class="container" style="padding-top: 20px;">
						<ul class="nav">
							<li class="nav-item">
								<a class="nav-link" href="index.php">Trang chủ</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="add.php">Thêm sách</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="dangxuat.php">Đăng xuất</a>
							</li>
						</ul>
				
				<h3>Vui lòng nhập thông tin!</h3>
			</div>
			<div class="container">
				<form method="post" action="add.php">
					<fieldset class="form-group">
						<label for="formGroupExampleInput">Tên sách</label>
						<input type="text" class="form-control" id="formGroupExampleInput" name="tensach" placeholder="Nhập tên sách">
					</fieldset>
					<fieldset class="form-group">
						<label for="formGroupExampleInput">Tóm tắt</label>
						<input type="text" class="form-control" id="formGroupExampleInput" name="tomtat" placeholder="Tóm tắt">
					</fieldset>
					<fieldset class="form-group">
						<label for="formGroupExampleInput">Tác giả</label>
						<input type="text" class="form-control" id="formGroupExampleInput" name="tacgia" placeholder="Nhập tên tác giả">
					</fieldset>
					<fieldset class="form-group">
						<label for="formGroupExampleInput">Năm xuất bản</label>
						<input type="text" class="form-control" id="formGroupExampleInput" name="namxb" placeholder="Nhập năm xuất bản">
					</fieldset>
					<fieldset class="form-group">
						<label for="formGroupExampleInput">Loại sách</label>
						<input type="text" class="form-control" id="formGroupExampleInput" name="loaisach" placeholder="Nhập loại sách">
					</fieldset>
					<input type="submit" name="add" value="Thêm">
				</form>
			</div>
		</content>
		<footer>
			92264 - Nguyen The Hieu - PTUDWEB N01
		</footer>
	</body>
</html>