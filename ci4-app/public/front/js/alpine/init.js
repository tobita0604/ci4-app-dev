/**
 * Alpine.js メイン初期化ファイル
 * 
 * 全コンポーネントの初期化とグローバル設定
 */

// Alpine.js プラグインの設定
document.addEventListener('alpine:init', () => {
    // グローバルマジックプロパティ
    Alpine.magic('clipboard', () => {
        return (text) => {
            if (navigator.clipboard) {
                navigator.clipboard.writeText(text).then(() => {
                    Alpine.store('toasts').success('コピーしました');
                }).catch(() => {
                    Alpine.store('toasts').error('コピーに失敗しました');
                });
            }
        };
    });
    
    // グローバル設定ストア
    Alpine.store('config', {
        theme: localStorage.getItem('theme') || 'light',
        locale: localStorage.getItem('locale') || 'ja',
        
        setTheme(theme) {
            this.theme = theme;
            localStorage.setItem('theme', theme);
            document.documentElement.setAttribute('data-theme', theme);
        },
        
        toggleTheme() {
            this.setTheme(this.theme === 'light' ? 'dark' : 'light');
        },
        
        setLocale(locale) {
            this.locale = locale;
            localStorage.setItem('locale', locale);
        }
    });
    
    // ページロード時の設定適用
    const theme = Alpine.store('config').theme;
    document.documentElement.setAttribute('data-theme', theme);
});

// Alpine.js の開発ツール有効化（本番環境では削除）
if (window.location.hostname === 'localhost' || window.location.hostname === '127.0.0.1') {
    window.Alpine = Alpine;
}
