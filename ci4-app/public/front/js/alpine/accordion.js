/**
 * アコーディオン機能 - Alpine.js実装
 * 
 * Bootstrap JSのアコーディオンをAlpine.jsで置き換え
 * スムーズアニメーション、複数開閉オプション
 */

document.addEventListener('alpine:init', () => {
    Alpine.data('accordion', (options = {}) => ({
        activeItems: [],
        allowMultiple: options.allowMultiple || false,
        
        isOpen(id) {
            return this.activeItems.includes(id);
        },
        
        toggle(id) {
            if (this.isOpen(id)) {
                this.close(id);
            } else {
                this.open(id);
            }
        },
        
        open(id) {
            if (!this.allowMultiple) {
                // 単一モード：他をすべて閉じる
                this.activeItems = [id];
            } else {
                // 複数モード：追加する
                if (!this.activeItems.includes(id)) {
                    this.activeItems.push(id);
                }
            }
        },
        
        close(id) {
            const index = this.activeItems.indexOf(id);
            if (index > -1) {
                this.activeItems.splice(index, 1);
            }
        },
        
        closeAll() {
            this.activeItems = [];
        },
        
        openAll(items) {
            if (this.allowMultiple) {
                this.activeItems = [...items];
            }
        }
    }));
    
    // アコーディオンアイテムコンポーネント
    Alpine.data('accordionItem', (id) => ({
        id,
        
        get isOpen() {
            return this.$parent.isOpen(this.id);
        },
        
        toggle() {
            this.$parent.toggle(this.id);
        },
        
        // アニメーション用のスタイル計算
        getContentStyle() {
            if (this.isOpen) {
                return 'max-height: 1000px; opacity: 1;';
            }
            return 'max-height: 0; opacity: 0;';
        }
    }));
});
