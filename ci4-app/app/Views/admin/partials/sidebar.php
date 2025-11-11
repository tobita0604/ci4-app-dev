<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="<?= base_url('admin') ?>" class="logo logo-dark">
            <span class="logo-sm">
                <img src="<?= base_url('assets/') ?>images/logo-sm.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="<?= base_url('assets/') ?>images/logo-dark.png" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="<?= base_url('admin') ?>" class="logo logo-light">
            <span class="logo-sm">
                <img src="<?= base_url('assets/') ?>images/logo-sm.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="<?= base_url('assets/') ?>images/logo-light.png" alt="" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <!-- ユーザー情報ドロップダウン（Alpine.js版） -->
    <div class="dropdown sidebar-user m-1 rounded" x-data="{ open: false }" @click.away="open = false">
        <button type="button" class="btn material-shadow-none" 
            @click="open = !open"
            :aria-expanded="open">
            <span class="d-flex align-items-center gap-2">
                <img class="rounded header-profile-user" src="<?= base_url('assets/') ?>images/users/avatar-1.jpg" alt="Header Avatar">
                <span class="text-start">
                    <span class="d-block fw-medium sidebar-user-name-text">管理者</span>
                    <span class="d-block fs-14 sidebar-user-name-sub-text">
                        <i class="ri ri-circle-fill fs-10 text-success align-baseline"></i>
                        <span class="align-middle">オンライン</span>
                    </span>
                </span>
            </span>
        </button>
        <div class="dropdown-menu dropdown-menu-end" :class="{ 'show': open }">
            <!-- item-->
            <h6 class="dropdown-header">ようこそ！</h6>
            <a class="dropdown-item" href="<?= base_url('admin/profile') ?>">
                <i class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i>
                <span class="align-middle">プロフィール</span>
            </a>
            <a class="dropdown-item" href="<?= base_url('admin/settings') ?>">
                <i class="mdi mdi-cog-outline text-muted fs-16 align-middle me-1"></i>
                <span class="align-middle">設定</span>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?= base_url('admin/auth/logout') ?>">
                <i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i>
                <span class="align-middle">ログアウト</span>
            </a>
        </div>
    </div>

    <!-- メニューナビゲーション（Alpine.js版） -->
    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu"></div>
            <ul class="navbar-nav" id="navbar-nav" x-data="menuGroup()">
                <li class="menu-title"><span>メニュー</span></li>
                
                <!-- ダッシュボード -->
                <li class="nav-item">
                    <a class="nav-link menu-link" href="<?= base_url('admin') ?>">
                        <i class="ri-dashboard-2-line"></i> <span>ダッシュボード</span>
                    </a>
                </li>

                <!-- 予約者管理 -->
                <li class="nav-item" x-data="{ menuId: 'sidebarReserver' }">
                    <a class="nav-link menu-link" href="#" 
                        @click.prevent="toggle(menuId)"
                        :class="{ 'collapsed': !isOpen(menuId) }"
                        :aria-expanded="isOpen(menuId)">
                        <i class="ri-user-3-line"></i> <span>予約者管理</span>
                    </a>
                    <div class="collapse menu-dropdown" 
                        :class="{ 'show': isOpen(menuId) }"
                        x-show="isOpen(menuId)"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 transform scale-95"
                        x-transition:enter-end="opacity-100 transform scale-100"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 transform scale-100"
                        x-transition:leave-end="opacity-0 transform scale-95">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="<?= base_url('admin/reservers') ?>" class="nav-link">予約者一覧</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('admin/reservers/create') ?>" class="nav-link">新規登録</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('admin/reservers/search') ?>" class="nav-link">検索</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- メンバー管理 -->
                <li class="nav-item" x-data="{ menuId: 'sidebarMember' }">
                    <a class="nav-link menu-link" href="#" 
                        @click.prevent="toggle(menuId)"
                        :class="{ 'collapsed': !isOpen(menuId) }"
                        :aria-expanded="isOpen(menuId)">
                        <i class="ri-team-line"></i> <span>メンバー管理</span>
                    </a>
                    <div class="collapse menu-dropdown" 
                        :class="{ 'show': isOpen(menuId) }"
                        x-show="isOpen(menuId)"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 transform scale-95"
                        x-transition:enter-end="opacity-100 transform scale-100"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 transform scale-100"
                        x-transition:leave-end="opacity-0 transform scale-95">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="<?= base_url('admin/members') ?>" class="nav-link">メンバー一覧</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('admin/members/passport') ?>" class="nav-link">パスポート情報</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('admin/members/esta') ?>" class="nav-link">ESTA情報</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- オプションツアー管理 -->
                <li class="nav-item" x-data="{ menuId: 'sidebarOption' }">
                    <a class="nav-link menu-link" href="#" 
                        @click.prevent="toggle(menuId)"
                        :class="{ 'collapsed': !isOpen(menuId) }"
                        :aria-expanded="isOpen(menuId)">
                        <i class="ri-map-pin-line"></i> <span>オプションツアー</span>
                    </a>
                    <div class="collapse menu-dropdown" 
                        :class="{ 'show': isOpen(menuId) }"
                        x-show="isOpen(menuId)"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 transform scale-95"
                        x-transition:enter-end="opacity-100 transform scale-100"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 transform scale-100"
                        x-transition:leave-end="opacity-0 transform scale-95">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="<?= base_url('admin/options') ?>" class="nav-link">予約一覧</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('admin/options/farm') ?>" class="nav-link">ファーム見学</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('admin/options/golf') ?>" class="nav-link">ゴルフ</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('admin/options/stock') ?>" class="nav-link">在庫管理</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- レンタカー管理 -->
                <li class="nav-item" x-data="{ menuId: 'sidebarCarRental' }">
                    <a class="nav-link menu-link" href="#" 
                        @click.prevent="toggle(menuId)"
                        :class="{ 'collapsed': !isOpen(menuId) }"
                        :aria-expanded="isOpen(menuId)">
                        <i class="ri-car-line"></i> <span>レンタカー管理</span>
                    </a>
                    <div class="collapse menu-dropdown" 
                        :class="{ 'show': isOpen(menuId) }"
                        x-show="isOpen(menuId)"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 transform scale-95"
                        x-transition:enter-end="opacity-100 transform scale-100"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 transform scale-100"
                        x-transition:leave-end="opacity-0 transform scale-95">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="<?= base_url('admin/car-rentals') ?>" class="nav-link">予約一覧</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('admin/car-rentals/stock') ?>" class="nav-link">在庫管理</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('admin/car-rentals/license') ?>" class="nav-link">運転免許証情報</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="menu-title"><i class="ri-more-fill"></i> <span>システム管理</span></li>

                <!-- システム設定 -->
                <li class="nav-item" x-data="{ menuId: 'sidebarSystem' }">
                    <a class="nav-link menu-link" href="#" 
                        @click.prevent="toggle(menuId)"
                        :class="{ 'collapsed': !isOpen(menuId) }"
                        :aria-expanded="isOpen(menuId)">
                        <i class="ri-settings-3-line"></i> <span>システム設定</span>
                    </a>
                    <div class="collapse menu-dropdown" 
                        :class="{ 'show': isOpen(menuId) }"
                        x-show="isOpen(menuId)"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 transform scale-95"
                        x-transition:enter-end="opacity-100 transform scale-100"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 transform scale-100"
                        x-transition:leave-end="opacity-0 transform scale-95">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="<?= base_url('admin/system/chargers') ?>" class="nav-link">担当者管理</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('admin/system/ip-restrictions') ?>" class="nav-link">IP制限</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('admin/system/backup') ?>" class="nav-link">バックアップ</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('admin/system/logs') ?>" class="nav-link">ログ閲覧</a>
                            </li>
                        </ul>
                    </div>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
