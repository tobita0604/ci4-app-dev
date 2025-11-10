<?= $this->extend('front/layouts/main') ?>

<?= $this->section('content') ?>
<div class="container my-5">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">予約情報入力</h1>
            
            <!-- TODO: 予約フォーム ステップ1実装 -->
            <div class="card">
                <div class="card-body">
                    <form action="<?= base_url('reservation/step2') ?>" method="POST">
                        <!-- 基本情報入力フォーム -->
                        <p>予約者情報入力フォームがここに表示されます</p>
                        <button type="submit" class="btn btn-primary">次へ</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
