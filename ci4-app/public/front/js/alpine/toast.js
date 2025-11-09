/**
 * トースト通知機能 - Alpine.js実装
 * 
 * Bootstrap JSのトーストをAlpine.jsで置き換え
 * 自動消去、スタック管理、位置指定
 */

document.addEventListener('alpine:init', () => {
    // グローバルトースト管理ストア
    Alpine.store('toasts', {
        items: [],
        nextId: 1,
        
        /**
         * トーストを追加
         * @param {Object} options - {message, type, duration, position}
         */
        add(options = {}) {
            const toast = {
                id: this.nextId++,
                message: options.message || '',
                type: options.type || 'info', // success, error, warning, info
                duration: options.duration || 3000,
                position: options.position || 'top-right',
                show: true
            };
            
            this.items.push(toast);
            
            // 自動削除
            if (toast.duration > 0) {
                setTimeout(() => {
                    this.remove(toast.id);
                }, toast.duration);
            }
            
            return toast.id;
        },
        
        remove(id) {
            const index = this.items.findIndex(item => item.id === id);
            if (index > -1) {
                this.items[index].show = false;
                // アニメーション完了後に配列から削除
                setTimeout(() => {
                    const idx = this.items.findIndex(item => item.id === id);
                    if (idx > -1) {
                        this.items.splice(idx, 1);
                    }
                }, 300);
            }
        },
        
        clear() {
            this.items = [];
        },
        
        // 便利なメソッド
        success(message, duration = 3000) {
            return this.add({ message, type: 'success', duration });
        },
        
        error(message, duration = 5000) {
            return this.add({ message, type: 'error', duration });
        },
        
        warning(message, duration = 4000) {
            return this.add({ message, type: 'warning', duration });
        },
        
        info(message, duration = 3000) {
            return this.add({ message, type: 'info', duration });
        }
    });
    
    // トーストコンテナコンポーネント
    Alpine.data('toastContainer', (position = 'top-right') => ({
        position,
        
        get toasts() {
            return this.$store.toasts.items.filter(item => item.position === this.position);
        },
        
        getIcon(type) {
            const icons = {
                success: 'ri-checkbox-circle-line',
                error: 'ri-error-warning-line',
                warning: 'ri-alert-line',
                info: 'ri-information-line'
            };
            return icons[type] || icons.info;
        },
        
        getColorClass(type) {
            const colors = {
                success: 'bg-success',
                error: 'bg-danger',
                warning: 'bg-warning',
                info: 'bg-info'
            };
            return colors[type] || colors.info;
        }
    }));
});
