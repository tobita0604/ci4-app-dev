/**
 * Alpine.js: モーダルコンポーネント
 * 
 * モーダルダイアログの表示・非表示を制御します。
 */

document.addEventListener('alpine:init', () => {
    Alpine.data('modal', () => ({
        open: false,
        
        show() {
            this.open = true;
        },
        
        hide() {
            this.open = false;
        },
        
        toggle() {
            this.open = !this.open;
        }
    }));
});
