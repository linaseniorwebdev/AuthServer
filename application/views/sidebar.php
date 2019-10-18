<!-- page container area start -->
<div class="page-container">
	<!-- sidebar menu area start -->
	<div class="sidebar-menu">
		<div class="sidebar-header">
			<div class="logo">
				<a href="<?= base_url('home'); ?>"><img src="public/assets/images/logo.png" alt="logo"></a>
			</div>
		</div>
		<div class="main-menu">
			<div class="menu-inner">
				<nav>
					<ul class="metismenu" id="menu">
						<li class="active">
							<a href="<?= base_url('home') ?>"><i class="ti-home"></i> <span>ダッシュボード</span></a>
						</li>
						<li>
							<a href="javascript:void(0);" aria-expanded="true">
								<i class="ti-medall"></i><span>管理者</span>
							</a>
							<ul class="collapse">
								<li><a href="<?= base_url('admin/list') ?>">管理者リスト</a></li>
								<li><a href="<?= base_url('admin/create') ?>">管理者追加</a></li>
							</ul>
						</li>
						<li>
							<a href="javascript:void(0);" aria-expanded="true">
								<i class="ti-key"></i><span>ライセンス</span>
							</a>
							<ul class="collapse">
								<li><a href="<?= base_url('license/list') ?>">ライセンスリスト</a></li>
								<li><a href="<?= base_url('license/generate') ?>">ライセンス生成</a></li>
							</ul>
						</li>
						<li>
							<a href="javascript:void(0);" aria-expanded="true">
								<i class="ti-user"></i><span>ユーザー</span>
							</a>
							<ul class="collapse">
								<li><a href="<?= base_url('user/list') ?>">ユーザーリスト</a></li>
								<li><a href="<?= base_url('user/create') ?>">ユーザー追加</a></li>
							</ul>
						</li>
						<li>
							<a href="<?= base_url('profile') ?>"><i class="ti-check-box"></i> <span>プロフィール</span></a>
						</li>
						<li>
							<a href="<?= base_url('auth/logout') ?>"><i class="ti-lock"></i> <span>ログアウト</span></a>
						</li>
					</ul>
				</nav>
			</div>
		</div>
	</div>
	<!-- sidebar menu area end -->