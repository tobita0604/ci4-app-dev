<!doctype html>
<html lang="ja">

<head>
    <meta charset="utf-8" />
    <title>新規登録 | 旅行予約システム</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="旅行予約システム新規登録" name="description" />
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
                                    <h5 class="text-primary">新規アカウント登録</h5>
                                    <p class="text-muted">情報を入力してアカウントを作成してください</p>
                                </div>

                                <?php if (session()->has('errors')): ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <ul class="mb-0">
                                            <?php foreach (session('errors') as $error): ?>
                                                <li><?= esc($error) ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                <?php endif; ?>

                                <div class="p-2 mt-4">
                                    <form action="<?= site_url('auth/register') ?>" method="post" x-data="registerForm()">
                                        <?= csrf_field() ?>

                                        <div class="mb-3">
                                            <label for="reserver-code" class="form-label">招待コード <span class="text-danger">*</span></label>
                                            <input type="text" 
                                                   class="form-control" 
                                                   id="reserver-code" 
                                                   name="code" 
                                                   placeholder="招待コードを入力"
                                                   value="<?= old('code') ?>"
                                                   required
                                                   x-model="code">
                                            <div class="form-text">招待コードは事前にお送りしたメールをご確認ください</div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="reserver-id" class="form-label">予約者ID（任意） <span class="text-danger">*</span></label>
                                            <input type="text" 
                                                   class="form-control" 
                                                   id="reserver-id" 
                                                   name="reserver_id" 
                                                   placeholder="ログインIDを入力（半角英数字）"
                                                   value="<?= old('reserver_id') ?>"
                                                   required
                                                   x-model="reserverId"
                                                   @input="validateId()">
                                            <div class="form-text" x-show="!idValid && reserverId.length > 0">
                                                <span class="text-danger">半角英数字のみ使用できます</span>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="password-input">パスワード <span class="text-danger">*</span></label>
                                            <div class="position-relative auth-pass-inputgroup">
                                                <input type="password" 
                                                       class="form-control pe-5 password-input" 
                                                       placeholder="パスワードを入力（8文字以上）"
                                                       id="password-input" 
                                                       name="password"
                                                       required
                                                       x-model="password"
                                                       @input="validatePassword()"
                                                       :type="showPassword ? 'text' : 'password'">
                                                <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon material-shadow-none" 
                                                        type="button" 
                                                        @click="showPassword = !showPassword">
                                                    <i class="ri-eye-fill align-middle" x-show="!showPassword"></i>
                                                    <i class="ri-eye-off-fill align-middle" x-show="showPassword"></i>
                                                </button>
                                            </div>
                                            <div class="form-text" x-show="!passwordValid && password.length > 0">
                                                <span class="text-danger">パスワードは8文字以上で入力してください</span>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="password-confirm">パスワード（確認） <span class="text-danger">*</span></label>
                                            <div class="position-relative auth-pass-inputgroup">
                                                <input type="password" 
                                                       class="form-control pe-5 password-input" 
                                                       placeholder="パスワードを再入力"
                                                       id="password-confirm" 
                                                       name="password_confirm"
                                                       required
                                                       x-model="passwordConfirm"
                                                       @input="validatePasswordMatch()"
                                                       :type="showPasswordConfirm ? 'text' : 'password'">
                                                <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon material-shadow-none" 
                                                        type="button" 
                                                        @click="showPasswordConfirm = !showPasswordConfirm">
                                                    <i class="ri-eye-fill align-middle" x-show="!showPasswordConfirm"></i>
                                                    <i class="ri-eye-off-fill align-middle" x-show="showPasswordConfirm"></i>
                                                </button>
                                            </div>
                                            <div class="form-text" x-show="!passwordMatch && passwordConfirm.length > 0">
                                                <span class="text-danger">パスワードが一致しません</span>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="auth-terms-check" name="terms" required>
                                                <label class="form-check-label" for="auth-terms-check">
                                                    <a href="#" class="text-decoration-underline">利用規約</a>と<a href="#" class="text-decoration-underline">プライバシーポリシー</a>に同意します
                                                </label>
                                            </div>
                                        </div>

                                        <div class="mt-4">
                                            <button class="btn btn-success w-100" 
                                                    type="submit"
                                                    :disabled="isSubmitting || !formValid"
                                                    x-text="isSubmitting ? '登録中...' : 'アカウント作成'">
                                                アカウント作成
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->

                        <div class="mt-4 text-center">
                            <p class="mb-0">すでにアカウントをお持ちの方は <a href="<?= site_url('auth/login') ?>" class="fw-semibold text-primary text-decoration-underline">ログイン</a></p>
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
    <script src="<?= base_url('assets/libs/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/libs/simplebar/simplebar.min.js') ?>"></script>
    <script src="<?= base_url('assets/libs/node-waves/waves.min.js') ?>"></script>
    <script src="<?= base_url('assets/libs/feather-icons/feather.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/pages/plugins/lord-icon-2.1.0.js') ?>"></script>
    <script src="<?= base_url('assets/js/plugins.js') ?>"></script>

    <!-- particles js -->
    <script src="<?= base_url('assets/libs/particles.js/particles.js') ?>"></script>
    <!-- particles app js -->
    <script src="<?= base_url('assets/js/pages/particles.app.js') ?>"></script>

    <!-- Alpine.js Register Component -->
    <script>
        function registerForm() {
            return {
                code: '',
                reserverId: '',
                password: '',
                passwordConfirm: '',
                showPassword: false,
                showPasswordConfirm: false,
                isSubmitting: false,
                idValid: true,
                passwordValid: true,
                passwordMatch: true,

                validateId() {
                    const pattern = /^[a-zA-Z0-9]+$/;
                    this.idValid = pattern.test(this.reserverId);
                },

                validatePassword() {
                    this.passwordValid = this.password.length >= 8;
                    if (this.passwordConfirm.length > 0) {
                        this.validatePasswordMatch();
                    }
                },

                validatePasswordMatch() {
                    this.passwordMatch = this.password === this.passwordConfirm;
                },

                get formValid() {
                    return this.code.length > 0 &&
                           this.reserverId.length > 0 &&
                           this.idValid &&
                           this.password.length >= 8 &&
                           this.passwordValid &&
                           this.passwordMatch;
                }
            }
        }
    </script>
</body>

</html>
