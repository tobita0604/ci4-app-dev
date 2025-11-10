<?= $this->extend('front/layouts/main') ?>

<?= $this->section('content') ?>
<div class="container my-5">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">オプション選択</h1>
            
            <!-- TODO: オプション選択フォーム実装 -->
            <div class="card">
                <div class="card-body">
                    <form action="<?= base_url('reservation/confirm') ?>" method="POST">
                        <!-- オプション選択フォーム -->
                        <p>オプション選択フォームがここに表示されます</p>
                        <button type="submit" class="btn btn-primary">確認画面へ</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
