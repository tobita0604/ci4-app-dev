/**
 * サイドバートグル機能 - Alpine.js実装
 * 
 * Bootstrap JSのサイドバーコンポーネントをAlpine.jsで置き換え
 * レスポンシブ対応、状態管理、ローカルストレージ連携
 */

document.addEventListener('alpine:init', () => {
    Alpine.data('sidebar', () => ({
        // サイドバーの表示状態
        isOpen: true,
        isMobile: false,
        
        init() {
            // ローカルストレージから前回の状態を復元
            const savedState = localStorage.getItem('sidebarOpen');
            if (savedState !== null) {
                this.isOpen = savedState === 'true';
            }
            
            // モバイルサイズの判定
            this.checkMobile();
            window.addEventListener('resize', () => this.checkMobile());
            
            // 初期状態を適用
            this.applySidebarState();
        },
        
        checkMobile() {
            this.isMobile = window.innerWidth < 992; // Bootstrap lg breakpoint
            if (this.isMobile && this.isOpen) {
                // モバイルでは初期状態で閉じる
                this.isOpen = false;
                this.applySidebarState();
            }
        },
        
        toggle() {
            this.isOpen = !this.isOpen;
            this.applySidebarState();
            // 状態をローカルストレージに保存
            localStorage.setItem('sidebarOpen', this.isOpen.toString());
        },
        
        applySidebarState() {
            const wrapper = document.getElementById('layout-wrapper');
            if (wrapper) {
                if (this.isOpen) {
                    wrapper.classList.remove('vertical-sidebar-closed');
                } else {
                    wrapper.classList.add('vertical-sidebar-closed');
                }
            }
        },
        
        // モバイルでサイドバー外をクリックしたら閉じる
        handleOutsideClick(event) {
            if (this.isMobile && this.isOpen) {
                const sidebar = document.querySelector('.app-menu');
                if (sidebar && !sidebar.contains(event.target)) {
                    this.isOpen = false;
                    this.applySidebarState();
                }
            }
        }
    }));
});
