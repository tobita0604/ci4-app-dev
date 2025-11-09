/**
 * ドロップダウンメニュー機能 - Alpine.js実装
 * 
 * Bootstrap JSのドロップダウンをAlpine.jsで置き換え
 * キーボード操作、アクセシビリティ対応
 */

document.addEventListener('alpine:init', () => {
    Alpine.data('dropdown', (options = {}) => ({
        isOpen: false,
        placement: options.placement || 'bottom',
        
        init() {
            // ESCキーで閉じる
            this.$el.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && this.isOpen) {
                    this.close();
                }
            });
        },
        
        toggle() {
            this.isOpen = !this.isOpen;
            if (this.isOpen) {
                this.$nextTick(() => {
                    this.positionDropdown();
                });
            }
        },
        
        open() {
            this.isOpen = true;
            this.$nextTick(() => {
                this.positionDropdown();
            });
        },
        
        close() {
            this.isOpen = false;
        },
        
        positionDropdown() {
            // ドロップダウンの位置調整
            const dropdown = this.$refs.menu;
            const trigger = this.$refs.trigger;
            
            if (!dropdown || !trigger) return;
            
            const triggerRect = trigger.getBoundingClientRect();
            const dropdownRect = dropdown.getBoundingClientRect();
            const viewportHeight = window.innerHeight;
            
            // 下にスペースがない場合は上に表示
            if (triggerRect.bottom + dropdownRect.height > viewportHeight) {
                dropdown.classList.add('dropdown-menu-end');
            } else {
                dropdown.classList.remove('dropdown-menu-end');
            }
        },
        
        // 外側クリックで閉じる
        handleClickOutside(event) {
            if (this.isOpen && !this.$el.contains(event.target)) {
                this.close();
            }
        }
    }));
});
