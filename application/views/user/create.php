<!-- main content area start -->
<div class="main-content">
	<!-- header area start -->
	<div class="header-area">
		<div class="row align-items-center no-gutters">
			<!-- nav and search button -->
			<div class="col-1 clearfix">
				<div class="nav-btn pull-left">
					<span></span>
					<span></span>
					<span></span>
				</div>
			</div>
			<!-- profile info & task notification -->
			<div class="col-11 clearfix">
				<ul class="notification-area pull-right">
					<li id="full-view"><i class="ti-fullscreen"></i></li>
					<li id="full-view-exit"><i class="ti-zoom-out"></i></li>
					<li class="settings-btn">
						<i class="ti-settings"></i>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- header area end -->
	<!-- page title area start -->
	<div class="page-title-area">
		<div class="row align-items-center" style="height: 60px;">
			<div class="col-sm-6">
				<div class="breadcrumbs-area clearfix">
					<h4 class="page-title pull-left">ユーザー追加</h4>
				</div>
			</div>
		</div>
	</div>
	<!-- page title area end -->
	<div class="main-content-inner">
		<div class="card card-form">
			<div class="card-body">
				<?php echo form_open('user/create'); ?>
				<div class="row no-gutters">
					<div class="col-md-6">
						<div class="form-group row no-gutters">
							<label for="firstname" class="col-form-label col-md-6 pr-3">名</label>
							<div class="col-md-6">
								<input class="form-control" type="text" value="" id="firstname" name="firstname" autofocus required>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group row no-gutters">
							<label for="lastname" class="col-form-label col-md-6 pr-3">姓</label>
							<div class="col-md-6">
								<input class="form-control" type="text" value="" id="lastname" name="lastname" required>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group row no-gutters">
					<label for="password" class="col-form-label col-md-3 pr-3">パスワード</label>
					<div class="col-md-9">
						<input class="form-control" type="password" value="" id="password" name="password" required>
					</div>
				</div>
				<div class="text-center">
					<button type="submit" class="btn btn-primary">確認する</button>
				</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>
<!-- main content area end -->