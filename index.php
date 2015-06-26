<?php
	require 'curl.php';

	if(isset($_POST['submit'])) {
		$curl = new Curl();
		$page = $curl->getContent($_POST['url']);

		$keywords = explode(";", $_POST['keywords']);

		foreach($keywords as $k) {
			$result[$k] = substr_count($page, $k);
		}

		krsort($result);
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<div class="container">
		<div id="main">
			<h1>統計網頁上出現的關鍵字次數</h1>
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
				<input type="text" name="url" class="form-control" placeholder="這裡是網頁的 URL（網址）">
				<input type="text" name="keywords" class="form-control" placeholder="這裡是關鍵字；多個關鍵字可用「;」隔開。">
				<input type="submit" name="submit" class="btn btn-lg"  value="來吧！"/>
			</form>
		</div>
		<div id="result">
			<?php if(isset($keywords)) {?>
			<table class="table">
				<tr>
					<th>關鍵字</th>
					<th>出現次數</th>
				</tr>
				<?php
					foreach($result as $k => $v) {
						echo "<tr><td>$k</td><td>$v</td></tr>";
					} 
				?>
			</table>
			<?php } ?>
		</div>
	</div>
</body>
</html>