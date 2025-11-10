<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <h1><?= esc($title) ?></h1>
        
        <!-- TODO: 会員一覧実装 -->
        <div class="card">
            <div class="card-body">
                <p>会員一覧がここに表示されます</p>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
