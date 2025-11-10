<?php
/**
 * 管理画面メインレイアウト
 * 
 * Bootstrap 5 + Velzonテンプレートを使用した管理画面の共通レイアウト
 */
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? '管理画面') ?> - 旅行予約管理システム</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Admin CSS -->
    <link href="<?= base_url('admin/css/app.css') ?>" rel="stylesheet">
    
    <?= $this->renderSection('styles') ?>
</head>
<body>
    <!-- サイドバー -->
    <?= $this->include('admin/layouts/sidebar') ?>
    
    <!-- メインコンテンツ -->
    <main class="main-content">
        <div class="container-fluid">
            <?= $this->renderSection('content') ?>
        </div>
    </main>
    
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Admin JS -->
    <script src="<?= base_url('admin/js/app.js') ?>"></script>
    
    <?= $this->renderSection('scripts') ?>
</body>
</html>
