<!doctype html>
<html class="no-js" lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>ログイン | 認証管理</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/png" href="public/assets/images/favicon.png">
	<link rel="stylesheet" href="public/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="public/assets/css/font-awesome.min.css">
	<link rel="stylesheet" href="public/assets/css/themify-icons.css">
	<link rel="stylesheet" href="public/assets/css/metisMenu.css">
	<link rel="stylesheet" href="public/assets/css/owl.carousel.min.css">
	<link rel="stylesheet" href="public/assets/css/slicknav.min.css">

	<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />

	<link rel="stylesheet" href="public/assets/css/typography.css">
	<link rel="stylesheet" href="public/assets/css/default-css.css">
	<link rel="stylesheet" href="public/assets/css/styles.css">
	<link rel="stylesheet" href="public/assets/css/responsive.css">

	<script src="public/assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>

<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<!-- preloader area start -->
<div id="preloader">
	<div class="loader"></div>
</div>
<!-- preloader area end -->

<!-- login area start -->
<div class="login-area login-bg">
	<div class="container">
		<div class="login-box ptb--100">
			<?php
			$url = $this->input->get('redirect');
			if ($url) {
				echo form_open('auth?redirect=' . urlencode($url));
			} else {
				echo form_open('auth');
			}
			?>
				<div class="login-form-head">
					<h4>ログイン</h4>
				</div>
				<div class="login-form-body">
					<div class="form-gp">
						<label for="admin_name">管理者名</label>
						<input type="text" id="admin_name" name="username" />
						<i class="ti-user"></i>
					</div>
					<div class="form-gp">
						<label for="admin_password">パスワード</label>
						<input type="password" id="admin_password" name="password">
						<i class="ti-lock"></i>
					</div>
					<div class="form-gp text-center">
						<?php if (strlen($error) > 1) echo '<p class="text-danger">' . $error . '</p>'; ?>
					</div>
					<div class="submit-btn-area mt-5">
						<button type="submit">ログイン <i class="ti-arrow-right"></i></button>
					</div>
				</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>
<!-- login area end -->

<script src="public/assets/js/vendor/jquery-2.2.4.min.js"></script>

<script src="public/assets/js/popper.min.js"></script>
<script src="public/assets/js/bootstrap.min.js"></script>
<script src="public/assets/js/owl.carousel.min.js"></script>
<script src="public/assets/js/metisMenu.min.js"></script>
<script src="public/assets/js/jquery.slimscroll.min.js"></script>
<script src="public/assets/js/jquery.slicknav.min.js"></script>

<script src="public/assets/js/plugins.js"></script>
<script src="public/assets/js/scripts.js"></script>
</body>

</html>