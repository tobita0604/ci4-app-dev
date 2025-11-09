<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta content="noindex,nofollow" name="robots">
<meta name="keywords" content="">
<meta name="description" content="">
<link rel="stylesheet" href="<?php echo base_url();?>css/main.css" />
<title>画像確認</title>
</head>
<body>
<div style = "width:500px; margin-left: 20px; margin-top: 10px;">パスポート顔写真ページデータ</div>
<br>
<?php
	echo '<img src="data:image/jpeg;base64,'.base64_encode( $img_content['R00_Passport_Img_File'] ).'"/>';
?>
</body>
</html>
