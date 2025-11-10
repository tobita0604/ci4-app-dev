/**
 * Alpine.js: ドロップダウンコンポーネント
 * 
 * ドロップダウンメニューの動作を制御します。
 */

document.addEventListener('alpine:init', () => {
    Alpine.data('dropdown', () => ({
        open: false,
        
        toggle() {
            this.open = !this.open;
        },
        
        close() {
            this.open = false;
        }
    }));
});
