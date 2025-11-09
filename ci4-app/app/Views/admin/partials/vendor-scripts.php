<!-- JAVASCRIPT -->
<!-- Alpine.js CDN (v3.x) - jQuery/Bootstrap JS 完全代替 -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<!-- Alpine.js コンポーネント（Bootstrap JS代替） -->
<script src="<?= base_url('admin/js/alpine/init.js') ?>"></script>
<script src="<?= base_url('admin/js/alpine/sidebar.js') ?>"></script>
<script src="<?= base_url('admin/js/alpine/dropdown.js') ?>"></script>
<script src="<?= base_url('admin/js/alpine/modal.js') ?>"></script>
<script src="<?= base_url('admin/js/alpine/toast.js') ?>"></script>
<script src="<?= base_url('admin/js/alpine/accordion.js') ?>"></script>
<script src="<?= base_url('admin/js/alpine/tabs.js') ?>"></script>

<!-- Note: Bootstrap JS は削除しました。すべてAlpine.jsで実装 -->
<!-- 必要な機能: simplebar, feather-icons は軽量なためそのまま使用 -->
<script src="<?= base_url('assets/') ?>libs/simplebar/simplebar.min.js"></script>
<script src="<?= base_url('assets/') ?>libs/node-waves/waves.min.js"></script>
<script src="<?= base_url('assets/') ?>libs/feather-icons/feather.min.js"></script>
<script src="<?= base_url('assets/') ?>js/pages/plugins/lord-icon-2.1.0.js"></script>
<script src="<?= base_url('assets/') ?>js/plugins.js"></script>