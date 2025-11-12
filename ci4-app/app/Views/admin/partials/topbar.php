<header id="page-topbar">
    <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box horizontal-logo">
                    <a href="<?= base_url('admin') ?>" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="<?= base_url('assets/') ?>images/logo-sm.png" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="<?= base_url('assets/') ?>images/logo-dark.png" alt="" height="17">
                        </span>
                    </a>

                    <a href="<?= base_url('admin') ?>" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="<?= base_url('assets/') ?>images/logo-sm.png" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="<?= base_url('assets/') ?>images/logo-light.png" alt="" height="17">
                        </span>
                    </a>
                </div>

                <!-- ハンバーガーメニューボタン -->
                <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger material-shadow-none" 
                    id="topnav-hamburger-icon"
                    onclick="toggleSidebar()">
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>

                <!-- 検索フォーム -->
                <form class="app-search d-none d-md-block" @submit.prevent="performSearch()">
                    <div class="position-relative">
                        <input type="text" class="form-control" placeholder="検索..." autocomplete="off" 
                            id="search-options" 
                            x-model="searchQuery">
                        <span class="mdi mdi-magnify search-widget-icon"></span>
                        <span class="mdi mdi-close-circle search-widget-icon search-widget-icon-close d-none" 
                            id="search-close-options"
                            @click="clearSearch()"></span>
                    </div>
                </form>
            </div>

            <div class="d-flex align-items-center">

                <!-- モバイル検索ボタン（Alpine.js版） -->
                <div class="dropdown d-md-none topbar-head-dropdown header-item" 
                    x-data="{ open: false }" 
                    @click.away="open = false">
                    <button type="button" 
                        class="btn btn-icon btn-topbar material-shadow-none btn-ghost-secondary rounded-circle" 
                        @click="open = !open"
                        :aria-expanded="open">
                        <i class="bx bx-search fs-22"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" 
                        :class="{ 'show': open }">
                        <form class="p-3" @submit.prevent="performSearch()">
                            <div class="form-group m-0">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="検索..." x-model="searchQuery">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="mdi mdi-magnify"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- 言語切替（Alpine.js版） -->
                <div class="dropdown ms-1 topbar-head-dropdown header-item" 
                    x-data="{ open: false }" 
                    @click.away="open = false">
                    <button type="button" 
                        class="btn btn-icon btn-topbar material-shadow-none btn-ghost-secondary rounded-circle" 
                        @click="open = !open"
                        :aria-expanded="open">
                        <img id="header-lang-img" src="<?= base_url('assets/') ?>images/flags/us.svg" 
                            alt="Language" height="20" class="rounded">
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" :class="{ 'show': open }">
                        <a href="javascript:void(0);" class="dropdown-item notify-item language py-2" 
                            data-lang="ja" @click="changeLanguage('ja')">
                            <img src="<?= base_url('assets/') ?>images/flags/japan.svg" 
                                alt="日本語" class="me-2 rounded" height="18">
                            <span class="align-middle">日本語</span>
                        </a>
                        <a href="javascript:void(0);" class="dropdown-item notify-item language" 
                            data-lang="en" @click="changeLanguage('en')">
                            <img src="<?= base_url('assets/') ?>images/flags/us.svg" 
                                alt="English" class="me-2 rounded" height="18">
                            <span class="align-middle">English</span>
                        </a>
                    </div>
                </div>

                <!-- フルスクリーンボタン -->
                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" 
                        class="btn btn-icon btn-topbar material-shadow-none btn-ghost-secondary rounded-circle" 
                        @click="toggleFullscreen()">
                        <i class='bx bx-fullscreen fs-22'></i>
                    </button>
                </div>

                <!-- ダークモード切替 -->
                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" 
                        class="btn btn-icon btn-topbar material-shadow-none btn-ghost-secondary rounded-circle light-dark-mode"
                        @click="toggleDarkMode()">
                        <i class='bx bx-moon fs-22'></i>
                    </button>
                </div>

                <!-- 通知（Alpine.js版） -->
                <div class="dropdown topbar-head-dropdown ms-1 header-item" 
                    x-data="{ open: false, notifications: [] }" 
                    @click.away="open = false"
                    x-init="notifications = []">
                    <button type="button" 
                        class="btn btn-icon btn-topbar material-shadow-none btn-ghost-secondary rounded-circle" 
                        @click="open = !open"
                        :aria-expanded="open">
                        <i class='bx bx-bell fs-22'></i>
                        <span class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-danger" 
                            x-show="notifications.length > 0"
                            x-text="notifications.length"></span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" 
                        :class="{ 'show': open }">
                        <div class="dropdown-head bg-primary bg-pattern rounded-top">
                            <div class="p-3">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="m-0 fs-16 fw-semibold text-white">通知</h6>
                                    </div>
                                    <div class="col-auto dropdown-tabs">
                                        <span class="badge bg-light text-body fs-13" 
                                            x-text="notifications.length + ' 件'"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="py-2 ps-2">
                            <div data-simplebar style="max-height: 300px;" class="pe-2">
                                <template x-if="notifications.length === 0">
                                    <div class="text-center p-4">
                                        <p class="text-muted">新しい通知はありません</p>
                                    </div>
                                </template>
                                <template x-for="notification in notifications" :key="notification.id">
                                    <div class="text-reset notification-item d-block dropdown-item">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <h6 class="mt-0 mb-1 fs-13 fw-semibold" x-text="notification.title"></h6>
                                                <p class="mb-0 fs-13 text-muted" x-text="notification.message"></p>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ユーザープロフィール（Alpine.js版） -->
                <div class="dropdown ms-sm-3 header-item topbar-user" 
                    x-data="{ open: false }" 
                    @click.away="open = false">
                    <button type="button" 
                        class="btn material-shadow-none" 
                        @click="open = !open"
                        :aria-expanded="open">
                        <span class="d-flex align-items-center">
                            <img class="rounded-circle header-profile-user" 
                                src="<?= base_url('assets/') ?>images/users/avatar-1.jpg" 
                                alt="Header Avatar">
                            <span class="text-start ms-xl-2">
                                <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">管理者</span>
                                <span class="d-none d-xl-block ms-1 fs-12 user-name-sub-text">管理者</span>
                            </span>
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" :class="{ 'show': open }">
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
            </div>
        </div>
    </div>
</header>

<script>
// ユーティリティ関数（Alpine.js非依存）
function toggleSidebar() {
    const wrapper = document.getElementById('layout-wrapper');
    if (wrapper) {
        wrapper.classList.toggle('vertical-sidebar-closed');
    }
}

function toggleFullscreen() {
    if (!document.fullscreenElement) {
        document.documentElement.requestFullscreen();
    } else {
        if (document.exitFullscreen) {
            document.exitFullscreen();
        }
    }
}

function toggleDarkMode() {
    const html = document.documentElement;
    const currentTheme = html.getAttribute('data-bs-theme');
    html.setAttribute('data-bs-theme', currentTheme === 'dark' ? 'light' : 'dark');
    localStorage.setItem('theme', currentTheme === 'dark' ? 'light' : 'dark');
}

function changeLanguage(lang) {
    // 言語変更処理（実装予定）
    console.log('Language changed to:', lang);
}

function performSearch() {
    // 検索処理（実装予定）
    console.log('Search performed');
}

function clearSearch() {
    document.getElementById('search-options').value = '';
}

// 初期化：テーマの復元
document.addEventListener('DOMContentLoaded', () => {
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme) {
        document.documentElement.setAttribute('data-bs-theme', savedTheme);
    }
});
</script>
