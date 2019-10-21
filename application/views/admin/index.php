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
					<h4 class="page-title pull-left">管理者リスト</h4>
				</div>
			</div>
		</div>
	</div>
	<!-- page title area end -->
	<div class="main-content-inner">
		<div class="text-right mb-3">
			<a class="btn btn-primary" href="<?= base_url('admin/create') ?>">管理者追加</a>
		</div>
		<div class="card">
			<div class="card-body">
				<div class="single-table">
					<div class="table-responsive">
						<table class="table table-hover text-center" id="admins">
							<thead class="text-uppercase">
							<tr>
								<th scope="col">#</th>
								<th scope="col">管理者名</th>
								<th scope="col">ステータス</th>
								<th scope="col">登録日付</th>
								<th scope="col">変更日付</th>
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
	<div class="modal fade" id="modifyModal">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">新しいパスワードを設定する</h5>
					<button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="password" class="col-form-label">パスワード</label>
						<input class="form-control" type="password" id="password" name="password">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
					<button type="button" class="btn btn-primary" onclick="changePassAction()">確認する</button>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- main content area end -->