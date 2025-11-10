<?php
/**
 * フロントページメインレイアウト
 * 
 * Bootstrap 5を使用したフロントサイトの共通レイアウト
 */
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'ホーム') ?> - 旅行予約システム</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Front CSS -->
    <link href="<?= base_url('front/css/app.css') ?>" rel="stylesheet">
    
    <?= $this->renderSection('styles') ?>
</head>
<body>
    <!-- ヘッダー -->
    <?= $this->include('front/layouts/header') ?>
    
    <!-- メインコンテンツ -->
    <main>
        <?= $this->renderSection('content') ?>
    </main>
    
    <!-- フッター -->
    <?= $this->include('front/layouts/footer') ?>
    
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Front JS -->
    <script src="<?= base_url('front/js/app.js') ?>"></script>
    
    <?= $this->renderSection('scripts') ?>
</body>
</html>
