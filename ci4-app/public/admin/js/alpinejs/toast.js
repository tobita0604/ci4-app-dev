/**
 * Alpine.js: トーストメッセージコンポーネント
 * 
 * 成功/エラーメッセージの表示を制御します。
 */

document.addEventListener('alpine:init', () => {
    Alpine.data('toast', () => ({
        messages: [],
        
        add(message, type = 'info', duration = 3000) {
            const id = Date.now();
            this.messages.push({ id, message, type });
            
            // 自動で削除
            setTimeout(() => {
                this.remove(id);
            }, duration);
        },
        
        remove(id) {
            this.messages = this.messages.filter(m => m.id !== id);
        }
    }));
});
