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
					<h4 class="page-title pull-left">ユーザーリスト</h4>
				</div>
			</div>
		</div>
	</div>
	<!-- page title area end -->
	<div class="main-content-inner">
		<div class="text-right mb-3">
			<a class="btn btn-primary" href="<?= base_url('user/create') ?>">ユーザー追加</a>
		</div>
		<div class="card">
			<div class="card-body">
				<div class="single-table">
					<div class="table-responsive">
						<table class="table table-hover text-center" id="users">
							<thead class="text-uppercase">
							<tr>
								<th scope="col">#</th>
								<th scope="col">お名前</th>
								<th scope="col">ユーザーID</th>
								<th scope="col">ライセンス</th>
								<th scope="col">ステータス</th>
								<th scope="col">アクション</th>
							</tr>
							</thead>
							<tbody>
							
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="passwordModal">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">新しいパスワードを設定する</h5>
					<button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
				</div>
				<?php echo form_open('user/api/update'); ?>
				<div class="modal-body">
					<input type="hidden" id="userid" name="id">
					<div class="form-group">
						<label for="password" class="col-form-label">パスワード</label>
						<input class="form-control" type="password" id="password" name="password">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
					<button type="submit" class="btn btn-primary">確認する</button>
				</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>
<!-- main content area end -->