<?= $this->extend('front/layouts/main') ?>

<?= $this->section('content') ?>
<div class="container my-5">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">予約内容確認</h1>
            
            <!-- TODO: 予約内容確認実装 -->
            <div class="card">
                <div class="card-body">
                    <p>予約内容の確認画面がここに表示されます</p>
                    <form action="<?= base_url('reservation/complete') ?>" method="POST">
                        <button type="submit" class="btn btn-success">予約を確定する</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
