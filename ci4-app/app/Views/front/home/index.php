<?= $this->include('front/layouts/main') ?>

<head>
    <?= $this->include('front/layouts/header') ?>
    <title>ホーム | 旅行予約システム</title>
</head>

<body>
    <!-- Hero Section -->
    <section class="hero-section" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 100px 0; color: white;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4">AXA旅行予約システム</h1>
                    <p class="lead mb-4">
                        家族招待キャンペーンの旅行予約をオンラインで簡単に行えます。<br>
                        オプションツアーやレンタカーの予約も一緒にお申し込みいただけます。
                    </p>
                    <div class="d-flex gap-3">
                        <a href="<?= site_url('reservation/step1') ?>" class="btn btn-light btn-lg px-5">
                            <i class="ri-calendar-check-line me-2"></i>予約を開始する
                        </a>
                        <a href="<?= site_url('auth/login') ?>" class="btn btn-outline-light btn-lg px-5">
                            <i class="ri-login-box-line me-2"></i>ログイン
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="<?= base_url('assets/images/travel-hero.svg') ?>" 
                         alt="Travel" 
                         class="img-fluid"
                         style="max-height: 400px;"
                         onerror="this.style.display='none'">
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section py-5">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col">
                    <h2 class="fw-bold mb-3">予約システムの特徴</h2>
                    <p class="text-muted">オンラインで簡単に旅行予約ができます</p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100" x-data="{ hover: false }" @mouseenter="hover = true" @mouseleave="hover = false">
                        <div class="card-body text-center p-4">
                            <div class="mb-3">
                                <i class="ri-user-add-line text-primary" style="font-size: 3rem;"></i>
                            </div>
                            <h5 class="card-title fw-bold">メンバー情報登録</h5>
                            <p class="card-text text-muted">
                                参加者のパスポート情報、ESTA情報を簡単に登録できます。
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center p-4">
                            <div class="mb-3">
                                <i class="ri-map-pin-line text-success" style="font-size: 3rem;"></i>
                            </div>
                            <h5 class="card-title fw-bold">オプションツアー</h5>
                            <p class="card-text text-muted">
                                ファーム見学、ゴルフなど豊富なオプションから選択できます。
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center p-4">
                            <div class="mb-3">
                                <i class="ri-car-line text-danger" style="font-size: 3rem;"></i>
                            </div>
                            <h5 class="card-title fw-bold">レンタカー予約</h5>
                            <p class="card-text text-muted">
                                各種レンタカーのクラスから選択して予約できます。
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How to Use Section -->
    <section class="how-to-section py-5 bg-light">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col">
                    <h2 class="fw-bold mb-3">ご利用の流れ</h2>
                    <p class="text-muted">簡単3ステップで予約完了</p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="text-center">
                        <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center mb-3" 
                             style="width: 80px; height: 80px; font-size: 2rem; font-weight: bold;">
                            1
                        </div>
                        <h5 class="fw-bold">メンバー情報入力</h5>
                        <p class="text-muted">参加者の情報を入力してください</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center">
                        <div class="rounded-circle bg-success text-white d-inline-flex align-items-center justify-content-center mb-3" 
                             style="width: 80px; height: 80px; font-size: 2rem; font-weight: bold;">
                            2
                        </div>
                        <h5 class="fw-bold">オプション選択</h5>
                        <p class="text-muted">お好きなオプションを選択してください</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center">
                        <div class="rounded-circle bg-danger text-white d-inline-flex align-items-center justify-content-center mb-3" 
                             style="width: 80px; height: 80px; font-size: 2rem; font-weight: bold;">
                            3
                        </div>
                        <h5 class="fw-bold">予約確定</h5>
                        <p class="text-muted">内容を確認して予約を確定します</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section py-5 bg-primary text-white">
        <div class="container text-center">
            <h2 class="fw-bold mb-4">今すぐ予約を開始しましょう</h2>
            <p class="lead mb-4">オンラインで24時間いつでも予約できます</p>
            <a href="<?= site_url('reservation/step1') ?>" class="btn btn-light btn-lg px-5">
                <i class="ri-calendar-check-line me-2"></i>予約フォームへ
            </a>
        </div>
    </section>

    <?= $this->include('front/layouts/footer') ?>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>

</html>
