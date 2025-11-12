# Velzon Alpine.js実装ガイド

## 概要
本ガイドでは、VelzonテンプレートをjQuery/Bootstrap JS不要のAlpine.js実装に変換した詳細を説明します。

---

## 1. アーキテクチャ概要

### 従来の構成（削除済み）
```
jQuery → Bootstrap JS → Velzon Components
```

### 新しい構成
```
Alpine.js → Velzon Components (Alpine.js実装)
```

**利点:**
- バンドルサイズ: ~60KB削減
- セキュリティ: jQuery脆弱性リスクゼロ
- メンテナンス: Alpine.jsのみの更新管理
- パフォーマンス: より軽量で高速

---

## 2. Alpine.jsコンポーネント一覧

### 2.1 Collapse (折りたたみメニュー)
**ファイル**: `public/admin/js/alpine/collapse.js`

**用途**: サイドバーメニューの折りたたみ、アコーディオン動作

**使用例**:
```html
<!-- 単一のコラプス -->
<div x-data="collapse({ targetId: 'menu1' })">
    <button @click="toggle()">メニュー1を開く</button>
    <div x-show="isOpen" x-transition>
        メニュー内容
    </div>
</div>

<!-- メニューグループ（複数メニュー管理） -->
<ul x-data="menuGroup()">
    <li x-data="{ menuId: 'menu1' }">
        <a @click.prevent="toggle(menuId)">メニュー1</a>
        <div x-show="isOpen(menuId)" x-transition>
            サブメニュー
        </div>
    </li>
</ul>
```

**機能**:
- ローカルストレージで状態保存
- URLハッシュ対応
- アコーディオン動作（親要素指定時）
- スムーズアニメーション

### 2.2 Dropdown (ドロップダウンメニュー)
**ファイル**: `public/admin/js/alpine/dropdown.js`

**用途**: トップバーのユーザーメニュー、通知メニューなど

**使用例**:
```html
<div x-data="{ open: false }" @click.away="open = false">
    <button @click="open = !open">
        メニュー
    </button>
    <div x-show="open" x-transition class="dropdown-menu">
        <a href="#">項目1</a>
        <a href="#">項目2</a>
    </div>
</div>
```

**機能**:
- クリック外で自動クローズ
- ESCキーでクローズ
- キーボードナビゲーション
- 位置調整（自動）

### 2.3 Modal (モーダルウィンドウ)
**ファイル**: `public/admin/js/alpine/modal.js`

**用途**: 確認ダイアログ、フォーム入力、詳細表示

**使用例**:
```html
<div x-data="modal()">
    <button @click="open()">モーダルを開く</button>
    
    <div x-show="isOpen" 
         @click="handleBackdropClick($event)"
         class="modal"
         style="display: block;">
        <div class="modal-dialog" x-ref="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>タイトル</h5>
                    <button @click="close()">×</button>
                </div>
                <div class="modal-body">
                    内容
                </div>
            </div>
        </div>
    </div>
</div>
```

**機能**:
- フォーカストラップ
- ESCキーでクローズ
- バックドロップクリックでクローズ
- bodyクラス管理（スクロール制御）

### 2.4 Toast (通知表示)
**ファイル**: `public/admin/js/alpine/toast.js`

**用途**: 成功/エラーメッセージの表示

**使用例**:
```javascript
// Alpine.js store経由
Alpine.store('toast').show({
    title: '成功',
    message: 'データを保存しました',
    type: 'success',
    duration: 3000
});
```

**機能**:
- 自動消去（設定可能）
- 複数表示対応
- アニメーション
- 位置指定（top-right, bottom-center等）

### 2.5 Tabs (タブUI)
**ファイル**: `public/admin/js/alpine/tabs.js`

**用途**: タブ切り替えUI

**使用例**:
```html
<div x-data="tabs()">
    <ul class="nav nav-tabs">
        <li><a @click="setActive('tab1')" :class="{ 'active': isActive('tab1') }">タブ1</a></li>
        <li><a @click="setActive('tab2')" :class="{ 'active': isActive('tab2') }">タブ2</a></li>
    </ul>
    
    <div x-show="isActive('tab1')" x-transition>タブ1の内容</div>
    <div x-show="isActive('tab2')" x-transition>タブ2の内容</div>
</div>
```

### 2.6 Accordion (アコーディオン)
**ファイル**: `public/admin/js/alpine/accordion.js`

**用途**: FAQ、設定パネルなど

**使用例**:
```html
<div x-data="accordion({ allowMultiple: false })">
    <div x-data="accordionItem('item1')">
        <button @click="toggle()">項目1</button>
        <div x-show="isOpen" x-transition>内容1</div>
    </div>
    <div x-data="accordionItem('item2')">
        <button @click="toggle()">項目2</button>
        <div x-show="isOpen" x-transition>内容2</div>
    </div>
</div>
```

### 2.7 Sidebar (サイドバー管理)
**ファイル**: `public/admin/js/alpine/sidebar.js`

**用途**: サイドバーの開閉、状態管理

**機能**:
- レスポンシブ対応
- ローカルストレージ連携
- モバイル対応（外側クリックで閉じる）

---

## 3. 実装パターン

### 3.1 ビューファイルでの使用

#### Before (Bootstrap JS依存)
```html
<!-- 削除推奨 -->
<button data-bs-toggle="dropdown">メニュー</button>
<div class="dropdown-menu">
    <a class="dropdown-item" href="#">項目</a>
</div>
```

#### After (Alpine.js)
```html
<!-- 推奨 -->
<div x-data="{ open: false }" @click.away="open = false">
    <button @click="open = !open">メニュー</button>
    <div x-show="open" x-transition class="dropdown-menu" :class="{ 'show': open }">
        <a class="dropdown-item" href="#">項目</a>
    </div>
</div>
```

### 3.2 フォーム処理

```html
<div x-data="{
    formData: { name: '', email: '' },
    errors: {},
    isSubmitting: false,
    
    async submit() {
        this.isSubmitting = true;
        try {
            const response = await fetch('/api/submit', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(this.formData)
            });
            
            if (response.ok) {
                Alpine.store('toast').show({
                    title: '成功',
                    message: '送信しました',
                    type: 'success'
                });
            }
        } catch (error) {
            this.errors = { general: 'エラーが発生しました' };
        } finally {
            this.isSubmitting = false;
        }
    }
}">
    <form @submit.prevent="submit()">
        <input type="text" x-model="formData.name" placeholder="名前">
        <input type="email" x-model="formData.email" placeholder="メール">
        <button type="submit" :disabled="isSubmitting">送信</button>
    </form>
</div>
```

---

## 4. マイグレーションガイド

### 既存ページをAlpine.jsに移行する手順

#### ステップ1: Bootstrap JS削除
```php
// Before
<script src="<?= base_url('assets/libs/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

// After (削除)
```

#### ステップ2: Alpine.jsコンポーネント読み込み確認
```php
<?= $this->include('admin/partials/vendor-scripts') ?>
```

#### ステップ3: HTMLをAlpine.js形式に変換

**Collapse**:
```html
<!-- Before -->
<a data-bs-toggle="collapse" href="#menu1">メニュー</a>
<div id="menu1" class="collapse">内容</div>

<!-- After -->
<div x-data="{ open: false }">
    <a @click.prevent="open = !open">メニュー</a>
    <div x-show="open" x-transition class="collapse" :class="{ 'show': open }">内容</div>
</div>
```

**Dropdown**:
```html
<!-- Before -->
<button data-bs-toggle="dropdown">ドロップダウン</button>
<div class="dropdown-menu">項目</div>

<!-- After -->
<div x-data="{ open: false }" @click.away="open = false">
    <button @click="open = !open">ドロップダウン</button>
    <div class="dropdown-menu" :class="{ 'show': open }">項目</div>
</div>
```

**Modal**:
```html
<!-- Before -->
<button data-bs-toggle="modal" data-bs-target="#modal1">開く</button>
<div id="modal1" class="modal">内容</div>

<!-- After -->
<div x-data="modal()">
    <button @click="open()">開く</button>
    <div x-show="isOpen" class="modal" style="display: block;">内容</div>
</div>
```

---

## 5. パフォーマンス最適化

### 5.1 遅延読み込み
大きなリストやテーブルには`x-show`の代わりに`x-if`を使用:

```html
<!-- 重い処理 -->
<template x-if="isOpen">
    <div><!-- 大量のコンテンツ --></div>
</template>
```

### 5.2 デバウンス
検索入力などには`x-model.debounce`を使用:

```html
<input x-model.debounce.500ms="searchQuery" type="text">
```

### 5.3 メモ化
繰り返し計算される値には`Alpine.store`を使用:

```javascript
Alpine.store('cart', {
    items: [],
    get total() {
        return this.items.reduce((sum, item) => sum + item.price, 0);
    }
});
```

---

## 6. トラブルシューティング

### 問題: x-dataが動作しない
**原因**: Alpine.jsが読み込まれていない、または後から読み込まれている

**解決**: Alpine.jsを`defer`付きで読み込み、コンポーネントスクリプトを先に読み込む

```html
<script src="<?= base_url('admin/js/alpine/collapse.js') ?>"></script>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
```

### 問題: x-transitionがカクつく
**原因**: CSSトランジションの設定不足

**解決**: Bootstrap標準のトランジションクラスを使用

```html
<div x-show="open" 
     x-transition:enter="transition ease-out duration-200"
     x-transition:enter-start="opacity-0 transform scale-95"
     x-transition:enter-end="opacity-100 transform scale-100">
</div>
```

### 問題: メモリリーク
**原因**: イベントリスナーの削除忘れ

**解決**: Alpine.jsの`x-on`を使用（自動クリーンアップ）

```html
<!-- Good -->
<button @click="doSomething()">クリック</button>

<!-- Bad -->
<button id="btn">クリック</button>
<script>
    document.getElementById('btn').addEventListener('click', ...);
</script>
```

---

## 7. セキュリティベストプラクティス

### 7.1 XSS対策
Alpine.jsは自動エスケープするが、HTMLを挿入する場合は要注意:

```html
<!-- Good: 自動エスケープ -->
<div x-text="userInput"></div>

<!-- Bad: XSSリスク -->
<div x-html="userInput"></div>

<!-- Good: サニタイズ後に使用 -->
<div x-html="sanitize(userInput)"></div>
```

### 7.2 CSRF対策
すべてのフォームにCSRFトークンを含める:

```html
<form @submit.prevent="submit()">
    <?= csrf_field() ?>
    <!-- フォーム内容 -->
</form>
```

### 7.3 認証チェック
機密データにアクセスする前に認証状態を確認:

```javascript
if (!isAuthenticated()) {
    window.location.href = '/login';
    return;
}
```

---

## 8. 今後の拡張

### 追加予定の機能
- [ ] テーブルソート機能
- [ ] ページネーション
- [ ] 無限スクロール
- [ ] ドラッグ&ドロップ
- [ ] リアルタイム通知（WebSocket）

### Alpine.js プラグイン検討
- `@alpinejs/persist`: ローカルストレージ永続化
- `@alpinejs/focus`: フォーカス管理
- `@alpinejs/collapse`: より高度な折りたたみ

---

## 9. 参考リンク

- [Alpine.js公式ドキュメント](https://alpinejs.dev/)
- [Velzon公式](https://themesbrand.com/velzon/)
- [CodeIgniter 4ドキュメント](https://codeigniter.com/user_guide/)
- [Bootstrap 5ドキュメント](https://getbootstrap.com/)

---

## 10. サポート

質問や問題がある場合は、GitHubのIssuesで報告してください。

**リポジトリ**: https://github.com/tobita0604/ci4-app-dev
