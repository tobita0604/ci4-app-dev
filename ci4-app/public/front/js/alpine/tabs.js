/**
 * タブ切り替え機能 - Alpine.js実装
 * 
 * Bootstrap JSのタブをAlpine.jsで置き換え
 * キーボードナビゲーション、履歴管理
 */

document.addEventListener('alpine:init', () => {
    Alpine.data('tabs', (options = {}) => ({
        activeTab: options.defaultTab || 0,
        tabs: [],
        
        init() {
            // タブ情報を収集
            this.collectTabs();
            
            // URLハッシュからアクティブタブを復元
            if (options.useHash && window.location.hash) {
                const tabName = window.location.hash.substring(1);
                const index = this.tabs.findIndex(tab => tab === tabName);
                if (index > -1) {
                    this.activeTab = index;
                }
            }
            
            // キーボード操作
            this.$el.addEventListener('keydown', (e) => {
                this.handleKeyboard(e);
            });
        },
        
        collectTabs() {
            const tabButtons = this.$el.querySelectorAll('[role="tab"]');
            this.tabs = Array.from(tabButtons).map(btn => btn.dataset.tab || btn.id);
        },
        
        switchTab(index) {
            if (index >= 0 && index < this.tabs.length) {
                this.activeTab = index;
                
                // URLハッシュを更新
                if (this.tabs[index]) {
                    window.location.hash = this.tabs[index];
                }
                
                // カスタムイベントを発火
                this.$dispatch('tab-changed', { 
                    index, 
                    tab: this.tabs[index] 
                });
            }
        },
        
        isActive(index) {
            return this.activeTab === index;
        },
        
        handleKeyboard(event) {
            const { key } = event;
            
            if (key === 'ArrowLeft' || key === 'ArrowUp') {
                event.preventDefault();
                this.switchTab(this.activeTab - 1 >= 0 ? this.activeTab - 1 : this.tabs.length - 1);
            } else if (key === 'ArrowRight' || key === 'ArrowDown') {
                event.preventDefault();
                this.switchTab(this.activeTab + 1 < this.tabs.length ? this.activeTab + 1 : 0);
            } else if (key === 'Home') {
                event.preventDefault();
                this.switchTab(0);
            } else if (key === 'End') {
                event.preventDefault();
                this.switchTab(this.tabs.length - 1);
            }
        },
        
        // タブボタンのARIA属性を取得
        getTabAttrs(index) {
            return {
                'aria-selected': this.isActive(index),
                'tabindex': this.isActive(index) ? '0' : '-1',
                'role': 'tab'
            };
        },
        
        // タブパネルのARIA属性を取得
        getPanelAttrs(index) {
            return {
                'role': 'tabpanel',
                'aria-hidden': !this.isActive(index),
                'tabindex': '0'
            };
        }
    }));
});
