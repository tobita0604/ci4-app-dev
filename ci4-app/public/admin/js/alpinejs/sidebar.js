/**
 * Alpine.js: サイドバーコンポーネント
 * 
 * サイドバーの開閉、メニューの折りたたみなどの動作を制御します。
 */

document.addEventListener('alpine:init', () => {
    Alpine.data('sidebar', () => ({
        open: true,
        
        toggle() {
            this.open = !this.open;
        },
        
        close() {
            this.open = false;
        }
    }));
});
