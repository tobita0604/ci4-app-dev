<!-- 管理画面サイドバー -->
<aside class="sidebar" x-data="{ open: true }">
    <div class="sidebar-header">
        <h3>管理画面</h3>
    </div>
    
    <nav class="sidebar-nav">
        <ul>
            <li>
                <a href="<?= base_url('admin') ?>" class="nav-link">
                    <i class="bi bi-speedometer2"></i> ダッシュボード
                </a>
            </li>
            <li>
                <a href="<?= base_url('admin/reserver') ?>" class="nav-link">
                    <i class="bi bi-people"></i> 予約者管理
                </a>
            </li>
            <li>
                <a href="<?= base_url('admin/member') ?>" class="nav-link">
                    <i class="bi bi-person-badge"></i> 会員管理
                </a>
            </li>
            <li>
                <a href="<?= base_url('admin/option') ?>" class="nav-link">
                    <i class="bi bi-ticket"></i> オプション管理
                </a>
            </li>
            <li>
                <a href="<?= base_url('admin/car-rental') ?>" class="nav-link">
                    <i class="bi bi-car-front"></i> レンタカー管理
                </a>
            </li>
        </ul>
    </nav>
</aside>
