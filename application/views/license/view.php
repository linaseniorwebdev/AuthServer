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
					<h4 class="page-title pull-left">ライセンス情報</h4>
				</div>
			</div>
		</div>
	</div>
	<!-- page title area end -->
	<div class="main-content-inner">
		<div class="card">
			<div class="card-body">
				<div class="single-table">
					<div class="table-responsive">
						<table class="table table-hover text-center" id="users">
							<tbody>
							<tr>
								<td class="text-right">ユーザーID</td>
								<td class="text-left text-primary"><?= $user['uniqueid']; ?></td>
							</tr>
							<tr>
								<td class="text-right">ライセンス</td>
								<td class="text-left text-primary"><?= $license['license']; ?></td>
							</tr>
							<tr>
								<td class="text-right">ステータス</td>
								<?php
								if ($license['machine']) {
									echo '<td class="text-left text-primary">使用中...　　<a href="javascript:remove(\'' . base_url('licenses/unuse/' . $license['id']) . '\');" class="text-danger">設定解除</a></td>';
								} else {
									echo '<td class="text-left text-success">使用されていない。</td>';
								}
								?>
							</tr>
							<tr>
								<td class="text-right">使用期間</td>
								<?php
								if ($license['expires']) {
									$now  = date_create();
									$new  = date_create($license['expires']);
									$diff = date_diff($new, $now);
									$days = $diff->days;
									if ($now > $new) {
										echo '<td class="text-left text-danger">期限切れ　　<a href="' . base_url('licenses/extend/' . $license['id']) . '" class="text-success">延期する</a></td>';
									} else {
										echo '<td class="text-left text-primary">アクティブ、残り' . $days . '日</td>';
									}
								} else {
									echo '<td class="text-left text-success">無制限</td>';
								}
								?>
							</tr>
							<tr>
								<td class="text-right">ユーザー名</td>
								<td class="text-left text-primary"><?= $user['firstname'] . $user['lastname']; ?></td>
							</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- main content area end -->