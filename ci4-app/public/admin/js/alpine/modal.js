/**
 * モーダルウィンドウ機能 - Alpine.js実装
 * 
 * Bootstrap JSのモーダルをAlpine.jsで置き換え
 * フォーカストラップ、アクセシビリティ対応
 */

document.addEventListener('alpine:init', () => {
    Alpine.data('modal', (options = {}) => ({
        isOpen: false,
        backdrop: options.backdrop !== false,
        keyboard: options.keyboard !== false,
        
        init() {
            // キーボードイベントの設定
            if (this.keyboard) {
                document.addEventListener('keydown', (e) => {
                    if (e.key === 'Escape' && this.isOpen) {
                        this.close();
                    }
                });
            }
        },
        
        open() {
            this.isOpen = true;
            document.body.classList.add('modal-open');
            
            // フォーカスをモーダル内に移動
            this.$nextTick(() => {
                const modal = this.$refs.modal;
                if (modal) {
                    const focusable = modal.querySelector('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])');
                    if (focusable) focusable.focus();
                }
            });
        },
        
        close() {
            this.isOpen = false;
            document.body.classList.remove('modal-open');
        },
        
        // バックドロップクリックで閉じる
        handleBackdropClick(event) {
            if (this.backdrop && event.target === event.currentTarget) {
                this.close();
            }
        },
        
        // フォーカストラップ（モーダル内でタブキー移動を制限）
        trapFocus(event) {
            if (event.key !== 'Tab') return;
            
            const modal = this.$refs.modal;
            const focusableElements = modal.querySelectorAll(
                'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'
            );
            
            const firstElement = focusableElements[0];
            const lastElement = focusableElements[focusableElements.length - 1];
            
            if (event.shiftKey) {
                if (document.activeElement === firstElement) {
                    lastElement.focus();
                    event.preventDefault();
                }
            } else {
                if (document.activeElement === lastElement) {
                    firstElement.focus();
                    event.preventDefault();
                }
            }
        }
    }));
    
    // グローバルモーダル管理
    Alpine.store('modals', {
        activeModal: null,
        
        open(modalName) {
            this.activeModal = modalName;
        },
        
        close() {
            this.activeModal = null;
        },
        
        isOpen(modalName) {
            return this.activeModal === modalName;
        }
    });
});
