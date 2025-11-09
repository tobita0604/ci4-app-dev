# Alpine.js コンポーネント使用ガイド

## 概要
このプロジェクトでは、jQuery や Bootstrap JS の代わりに Alpine.js を使用して UI コンポーネントを実装しています。
Alpine.js は軽量（~15KB）で、セキュリティ脆弱性のリスクが低く、メンテナンス負担が小さいフレームワークです。

## セキュリティ方針
- **Bootstrap JS は完全削除**: JavaScriptコンポーネントはすべて Alpine.js で実装
- **jQuery は不使用**: レガシーな依存関係を排除
- **CDN利用**: Alpine.js は CDN から読み込み、バージョン管理を簡素化

## コンポーネント一覧

### 1. サイドバートグル (`sidebar.js`)
管理画面のサイドバーの開閉を制御します。

#### 使用方法
```html
<div x-data="sidebar()" @click.outside="handleOutsideClick($event)">
    <button @click="toggle()" class="btn btn-toggle">
        <i class="ri-menu-line"></i>
    </button>
</div>
```

#### 機能
- ✅ レスポンシブ対応（モバイル自動判定）
- ✅ ローカルストレージで状態保存
- ✅ 外側クリックで自動クローズ（モバイル）

---

### 2. ドロップダウンメニュー (`dropdown.js`)
ドロップダウンメニューの表示・非表示を制御します。

#### 使用方法
```html
<div x-data="dropdown()" @click.outside="handleClickOutside($event)">
    <button @click="toggle()" x-ref="trigger" class="btn">
        メニュー <i class="ri-arrow-down-s-line"></i>
    </button>
    <div x-show="isOpen" 
         x-transition
         x-ref="menu" 
         class="dropdown-menu">
        <a href="#" class="dropdown-item">アイテム1</a>
        <a href="#" class="dropdown-item">アイテム2</a>
    </div>
</div>
```

#### 機能
- ✅ ESCキーで閉じる
- ✅ 外側クリックで閉じる
- ✅ 自動位置調整（画面外判定）
- ✅ アクセシビリティ対応

---

### 3. モーダルウィンドウ (`modal.js`)
モーダルダイアログの表示・非表示を制御します。

#### グローバルストアを使用する方法（推奨）
```html
<!-- モーダルトリガー -->
<button @click="$store.modals.open('myModal')">モーダルを開く</button>

<!-- モーダル本体 -->
<div x-data="modal()" 
     x-show="$store.modals.isOpen('myModal')"
     @click="handleBackdropClick($event)"
     class="modal">
    <div x-ref="modal" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>タイトル</h5>
                <button @click="$store.modals.close()">×</button>
            </div>
            <div class="modal-body">コンテンツ</div>
        </div>
    </div>
</div>
```

#### 機能
- ✅ ESCキーで閉じる
- ✅ バックドロップクリックで閉じる
- ✅ フォーカストラップ（タブキー移動制限）
- ✅ グローバルストアで複数モーダル管理

---

### 4. トースト通知 (`toast.js`)
一時的な通知メッセージを表示します。

#### 使用方法
```html
<!-- トーストコンテナ（レイアウトに1箇所配置） -->
<div x-data="toastContainer('top-right')" 
     class="toast-container position-fixed top-0 end-0 p-3">
    <template x-for="toast in toasts" :key="toast.id">
        <div x-show="toast.show" x-transition>
            <div x-text="toast.message"></div>
        </div>
    </template>
</div>

<!-- JavaScript で呼び出し -->
<script>
    Alpine.store('toasts').success('保存しました！');
    Alpine.store('toasts').error('エラーが発生しました');
</script>
```

---

## 参考リンク
- [Alpine.js 公式ドキュメント](https://alpinejs.dev/)
- [Bootstrap 5 CSS（スタイリングのみ使用）](https://getbootstrap.com/)
