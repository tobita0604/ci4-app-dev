<!doctype html>
<html lang="ja">

<head>
    <meta charset="utf-8" />
    <title>ログイン | 旅行予約システム</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="旅行予約システム" name="description" />
    <meta content="AXA Travel System" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= base_url('assets/images/favicon.ico') ?>">

    <!-- Bootstrap Css -->
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?= base_url('assets/css/icons.min.css') ?>" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?= base_url('assets/css/app.min.css') ?>" rel="stylesheet" type="text/css" />

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body>
    <div class="auth-page-wrapper pt-5">
        <!-- auth page bg -->
        <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
            <div class="bg-overlay"></div>

            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>

        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mt-sm-5 mb-4 text-white-50">
                            <div>
                                <a href="<?= base_url('/') ?>" class="d-inline-block auth-logo">
                                    <img src="<?= base_url('assets/images/logo-light.png') ?>" alt="" height="20">
                                </a>
                            </div>
                            <p class="mt-3 fs-15 fw-medium">旅行予約システム</p>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4 card-bg-fill">
                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <h5 class="text-primary">おかえりなさい！</h5>
                                    <p class="text-muted">予約者IDとパスワードでログインしてください</p>
                                </div>

                                <?php if (session()->has('errors')): ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <ul class="mb-0">
                                            <?php foreach (session('errors') as $error): ?>
                                                <li><?= esc($error) ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                        <button type="button" class="btn-close" onclick="this.parentElement.remove()" aria-label="Close"></button>
                                    </div>
                                <?php endif; ?>

                                <?php if (session()->has('error')): ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <?= esc(session('error')) ?>
                                        <button type="button" class="btn-close" onclick="this.parentElement.remove()" aria-label="Close"></button>
                                    </div>
                                <?php endif; ?>

                                <?php if (session()->has('success')): ?>
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <?= esc(session('success')) ?>
                                        <button type="button" class="btn-close" onclick="this.parentElement.remove()" aria-label="Close"></button>
                                    </div>
                                <?php endif; ?>

                                <div class="p-2 mt-4">
                                    <form action="<?= site_url('auth/login') ?>" method="post" x-data="loginForm()">
                                        <?= csrf_field() ?>

                                        <div class="mb-3">
                                            <label for="reserver-id" class="form-label">予約者ID</label>
                                            <input type="text" 
                                                   class="form-control" 
                                                   id="reserver-id" 
                                                   name="reserver_id" 
                                                   placeholder="予約者IDを入力"
                                                   value="<?= old('reserver_id') ?>"
                                                   required
                                                   x-model="reserverId">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="password-input">パスワード</label>
                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                <input type="password" 
                                                       class="form-control pe-5 password-input" 
                                                       placeholder="パスワードを入力"
                                                       id="password-input" 
                                                       name="password"
                                                       required
                                                       x-model="password"
                                                       :type="showPassword ? 'text' : 'password'">
                                                <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon material-shadow-none" 
                                                        type="button" 
                                                        @click="showPassword = !showPassword">
                                                    <i class="ri-eye-fill align-middle" x-show="!showPassword"></i>
                                                    <i class="ri-eye-off-fill align-middle" x-show="showPassword"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="auth-remember-check" name="remember">
                                            <label class="form-check-label" for="auth-remember-check">ログイン状態を保持する</label>
                                        </div>

                                        <div class="mt-4">
                                            <button class="btn btn-success w-100" 
                                                    type="submit"
                                                    :disabled="isSubmitting"
                                                    x-text="isSubmitting ? 'ログイン中...' : 'ログイン'">
                                                ログイン
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->

                        <div class="mt-4 text-center">
                            <p class="mb-0">アカウントをお持ちでない方は <a href="<?= site_url('auth/register') ?>" class="fw-semibold text-primary text-decoration-underline">新規登録</a></p>
                        </div>

                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

        <!-- footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0 text-muted">&copy;
                                <script>document.write(new Date().getFullYear())</script> AXA Travel System. 
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>
    <!-- end auth-page-wrapper -->

    <!-- JAVASCRIPT -->
    <script src="<?= base_url('assets/libs/simplebar/simplebar.min.js') ?>"></script>
    <script src="<?= base_url('assets/libs/node-waves/waves.min.js') ?>"></script>
    <script src="<?= base_url('assets/libs/feather-icons/feather.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/pages/plugins/lord-icon-2.1.0.js') ?>"></script>
    <script src="<?= base_url('assets/js/plugins.js') ?>"></script>

    <!-- particles js -->
    <script src="<?= base_url('assets/libs/particles.js/particles.js') ?>"></script>
    <!-- particles app js -->
    <script src="<?= base_url('assets/js/pages/particles.app.js') ?>"></script>

    <!-- Alpine.js Login Component -->
    <script>
        function loginForm() {
            return {
                reserverId: '',
                password: '',
                showPassword: false,
                isSubmitting: false
            }
        }
    </script>
</body>

</html>
