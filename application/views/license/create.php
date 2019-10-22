<!-- main content area start -->
<div class="main-content">
	<!-- header area start -->
	<div class="header-area">
		<div class="row align-items-center no-gutters">
			<input type="hidden" id="extend_url" value="<?php echo base_url('license/extend'); ?>" />
			<input type="hidden" id="issue_url" value="<?php echo base_url('license/reissue'); ?>" />
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
					<h4 class="page-title pull-left">ライセンス生成</h4>
				</div>
			</div>
		</div>
	</div>
	<!-- page title area end -->
	<div class="main-content-inner">
		<div class="row no-gutters mb-3">
			<div class="col-sm-6 text-left">
				<label for="users" class="col-form-label mr-1">ユーザー選択</label>
				<select class="custom-select" id="users" style="width: calc(100% - 92px); max-width: 110px;">
					<?php
					if (empty($users)) {
						echo '<option selected="selected">ユーザーがいません。</option>';
					} else {
						if (isset($current)) {
							foreach ($users as $user) {
								if ($user['id'] == $current) {
									$first = $user;
									echo '<option value="' . $user['uniqueid'] . '" selected>' . $user['firstname'] .  $user['lastname'] . '</option>';
								} else {
									echo '<option value="' . $user['uniqueid'] . '">' . $user['firstname'] .  $user['lastname'] . '</option>';
								}
							}
						} else {
							foreach ($users as $user) {
								if (!isset($first)) { $first = $user; }
								echo '<option value="' . $user['uniqueid'] . '">' . $user['firstname'] .  $user['lastname'] . '</option>';
							}
						}
					}
					?>
				</select>
			</div>
			<div class="col-sm-6 d-sm-none text-right">
				<a class="btn btn-primary" href="<?= base_url('licenses') ?>">ライセンスリストへ</a>
			</div>
		</div>
		<div class="card" style="margin: 0 auto; max-width: 550px;">
			<div class="card-body">
				<input type="hidden" id="baseurl" value="<?= base_url('licenses/api/generate') ?>">
				<div id="license_none">
					<p class="text-success" style="font-size: 20px; margin-bottom: 15px;">ライセンスがありません。新たに作成してください。</p>
					<hr>
					<?php echo form_open('licenses/generate'); ?>
					<div class="form-group row">
						<label for="userid" class="col-form-label col-sm-3">ユーザーID</label>
						<div class="col-sm-7">
							<input class="form-control" type="text" id="userid" name="userid" readonly required value="<?php if (isset($first)) echo $first['uniqueid']; ?>">
						</div>
						<div class="col-sm-2 pl-sm-0">
							<button type="button" class="btn btn-warning w-100" style="padding: 11.5px 10px;" id="generate"><i class="ti-link"></i></button>
						</div>
					</div>
					<div class="form-group row">
						<label for="license" class="col-form-label col-sm-3">ライセンス</label>
						<div class="col-sm-9">
							<input class="form-control" type="text" id="license" name="license" required>
						</div>
					</div>
					<div class="form-group row">
						<label for="expires" class="col-form-label col-sm-3">ライセンス</label>
						<div class="col-sm-9">
							<select class="custom-select" id="expires" name="expires" style="max-width: 85px;">
								<option value="30">1ヶ月</option>
								<option value="90" selected>3ヶ月</option>
								<option value="180">6ヶ月</option>
								<option value="360">一年</option>
								<option value="99999">無制限</option>
							</select>
						</div>
					</div>
					<div class="form-group text-center mb-0">
						<button type="submit" class="btn btn-lg btn-success">セーブ</button>
					</div>
					<?php echo form_close(); ?>
				</div>
				<div id="license_exist" style="display: none;">
					<p style="font-size: 20px;">ライセンスが既に存在します。変更する場合は<a href="#" id="extend_link">拡張<a>または<a href="#" id="reissue_link">再発行<a>してください。</p>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- main content area end -->