/**
 * コラプス（折りたたみ）機能 - Alpine.js実装
 * 
 * Bootstrap JSのcollapseをAlpine.jsで完全置き換え
 * サイドバーナビゲーション、アコーディオンメニュー対応
 * スムーズなアニメーション、状態管理機能付き
 */

document.addEventListener('alpine:init', () => {
    /**
     * 単一コラプスコンポーネント
     * data-bs-toggle="collapse"の完全代替
     */
    Alpine.data('collapse', (options = {}) => ({
        isOpen: options.defaultOpen || false,
        targetId: options.targetId || null,
        parent: options.parent || null,
        
        init() {
            // URLハッシュから初期状態を復元（ページリロード対応）
            if (this.targetId && window.location.hash === `#${this.targetId}`) {
                this.isOpen = true;
            }
            
            // 親要素が指定されている場合、同階層の他のコラプスと連動
            if (this.parent) {
                this.$watch('isOpen', (value) => {
                    if (value && this.parent) {
                        this.closeOthers();
                    }
                });
            }
        },
        
        toggle() {
            this.isOpen = !this.isOpen;
            
            // URLハッシュを更新（ブックマーク・共有対応）
            if (this.targetId && this.isOpen) {
                history.replaceState(null, null, `#${this.targetId}`);
            } else if (this.targetId && !this.isOpen) {
                history.replaceState(null, null, ' ');
            }
        },
        
        open() {
            this.isOpen = true;
        },
        
        close() {
            this.isOpen = false;
        },
        
        // 同じ親の他のコラプスを閉じる（アコーディオン動作）
        closeOthers() {
            if (!this.parent) return;
            
            const parentEl = document.querySelector(this.parent);
            if (!parentEl) return;
            
            // 親要素配下のすべてのコラプスコンポーネントを取得
            const allCollapses = parentEl.querySelectorAll('[x-data*="collapse"]');
            allCollapses.forEach(collapseEl => {
                if (collapseEl !== this.$el && collapseEl.__x) {
                    const collapseData = collapseEl.__x.$data;
                    if (collapseData && collapseData.isOpen !== undefined) {
                        collapseData.isOpen = false;
                    }
                }
            });
        }
    }));
    
    /**
     * メニューグループコンポーネント（複数のコラプスを管理）
     * サイドバーナビゲーション専用
     */
    Alpine.data('menuGroup', () => ({
        openMenus: [],
        
        init() {
            // ローカルストレージから開いているメニューを復元
            const saved = localStorage.getItem('openMenus');
            if (saved) {
                try {
                    this.openMenus = JSON.parse(saved);
                } catch (e) {
                    this.openMenus = [];
                }
            }
            
            // アクティブなページのメニューを自動的に開く
            this.$nextTick(() => {
                this.expandActiveMenu();
            });
        },
        
        isOpen(menuId) {
            return this.openMenus.includes(menuId);
        },
        
        toggle(menuId) {
            if (this.isOpen(menuId)) {
                this.close(menuId);
            } else {
                this.open(menuId);
            }
        },
        
        open(menuId) {
            if (!this.openMenus.includes(menuId)) {
                this.openMenus.push(menuId);
                this.saveState();
            }
        },
        
        close(menuId) {
            const index = this.openMenus.indexOf(menuId);
            if (index > -1) {
                this.openMenus.splice(index, 1);
                this.saveState();
            }
        },
        
        closeAll() {
            this.openMenus = [];
            this.saveState();
        },
        
        saveState() {
            localStorage.setItem('openMenus', JSON.stringify(this.openMenus));
        },
        
        // アクティブなページのメニューを自動展開
        expandActiveMenu() {
            const activeLink = document.querySelector('.nav-link.active');
            if (!activeLink) return;
            
            // 親メニューを探して展開
            let parent = activeLink.closest('.collapse');
            while (parent) {
                const menuId = parent.id;
                if (menuId && !this.isOpen(menuId)) {
                    this.open(menuId);
                }
                parent = parent.parentElement?.closest('.collapse');
            }
        }
    }));
});
