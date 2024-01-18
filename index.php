<?php
	include "auth.php";
	include "connect.php";
	$conn = null;
	try {
		$conn = new PDO("mysql:host=$server;dbname=$database", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch(PDOException $e) {
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
			<div class="container">
				<form method="post">
					<input type="text" name="timkiem" placeholder="Tìm kiếm theo tên tác giả hoặc tên sách">
					<input type="submit" name="btn_timkiem" value="Tìm Kiếm">
				</form>
			</div>
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
				<table class="table table-inverse">
					<thead>
						<tr>
							<th>ID sách</th>
							<th>Tên sách</th>
							<th>Tóm tắt</th>
							<th>Tác giả</th>
							<th>Năm xuất bản</th>
							<th>Loại sách</th>
							<th>Hành động</th>

						</tr>
					</thead>
					<tbody>
						<?php
							if(isset($conn)) {
								if(empty($_POST['btn_timkiem'])) {
									$query = "select * from sach";
									$stmt = $conn->prepare($query);
									$stmt->execute();
								} else {
									$keyword = $_POST['timkiem'];
									$query = "SELECT * FROM sach WHERE tacgia LIKE :keyword OR tensach LIKE :keyword";
									$stmt = $conn->prepare($query);
									$stmt->bindValue(':keyword', '%' . $keyword . '%');
									$stmt->execute();
								}
									
									if($stmt->rowCount() > 0) {
										while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
											echo "<tr>
										        <td>{$row['id']}</td>
										        <td>{$row['tensach']}</td>
										        <td>{$row['tomtat']}</td>
										        <td>{$row['tacgia']}</td>
										        <td>{$row['namxb']}</td>
										        <td>{$row['loaisach']}</td>
										        <td><a href='cap_nhat.php?id={$row['id']}'>Sửa</a></td>
										      </tr>
										    ";
										}
									} else  echo "<td>Không có dữ liệu!</td>";
							}

						?>
						
					</tbody>
				</table>
			</div>
		</content>
		<footer>
			92264 - Nguyen The Hieu - PTUDWEB N01
			<div>
				Tên đầy đủ là: <?php
					echo $_SESSION['fullname'];
				?>
			</div>
		</footer>
	</body>
</html>