# Bootstrap JS から Alpine.js への移行ガイド

## 概要
このドキュメントでは、Bootstrap JSコンポーネントをAlpine.jsに移行する方法を説明します。

## 移行方針

### なぜAlpine.jsに移行するのか？

#### 問題点
- **Bootstrap JS**: セキュリティ脆弱性の対応が頻繁に必要
- **jQuery**: レガシーな依存関係、バンドルサイズが大きい
- **メンテナンスコスト**: 脆弱性対応とバージョンアップの負担

#### 解決策
- **Alpine.js**: 軽量（~15KB）、脆弱性リスクが低い
- **宣言的アプローチ**: HTMLに直接記述、理解しやすい
- **長期的なメンテナンス**: 更新頻度が少なく、安定している

## コンポーネント別移行ガイド

### 1. ドロップダウンメニュー

#### Before (Bootstrap JS)
```html
<div class="dropdown">
    <button class="btn btn-primary dropdown-toggle" 
            type="button" 
            data-bs-toggle="dropdown">
        ドロップダウン
    </button>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="#">アイテム1</a></li>
        <li><a class="dropdown-item" href="#">アイテム2</a></li>
    </ul>
</div>
```

#### After (Alpine.js)
```html
<div x-data="dropdown()" @click.outside="handleClickOutside($event)">
    <button @click="toggle()" 
            x-ref="trigger" 
            class="btn btn-primary">
        ドロップダウン <i class="ri-arrow-down-s-line"></i>
    </button>
    <div x-show="isOpen" 
         x-transition
         x-ref="menu" 
         class="dropdown-menu"
         :class="{ 'show': isOpen }">
        <a href="#" class="dropdown-item">アイテム1</a>
        <a href="#" class="dropdown-item">アイテム2</a>
    </div>
</div>
```

---

### 2. モーダルウィンドウ

#### Before (Bootstrap JS)
```html
<!-- トリガー -->
<button type="button" 
        class="btn btn-primary" 
        data-bs-toggle="modal" 
        data-bs-target="#myModal">
    モーダルを開く
</button>

<!-- モーダル -->
<div class="modal fade" id="myModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">タイトル</h5>
                <button type="button" 
                        class="btn-close" 
                        data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">コンテンツ</div>
        </div>
    </div>
</div>
```

#### After (Alpine.js)
```html
<!-- トリガー -->
<button @click="$store.modals.open('myModal')" 
        class="btn btn-primary">
    モーダルを開く
</button>

<!-- モーダル -->
<div x-data="modal()" 
     x-show="$store.modals.isOpen('myModal')"
     x-transition
     @click="handleBackdropClick($event)"
     class="modal"
     :class="{ 'show': $store.modals.isOpen('myModal') }"
     style="display: none;"
     x-bind:style="$store.modals.isOpen('myModal') ? 'display: block' : 'display: none'">
    <div x-ref="modal" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">タイトル</h5>
                <button @click="$store.modals.close()" 
                        type="button" 
                        class="btn-close"></button>
            </div>
            <div class="modal-body">コンテンツ</div>
        </div>
    </div>
</div>
```

---

### 3. トースト通知

#### Before (Bootstrap JS)
```javascript
// JavaScriptで表示
const toastEl = document.getElementById('myToast');
const toast = new bootstrap.Toast(toastEl);
toast.show();
```

```html
<div class="toast" id="myToast" role="alert">
    <div class="toast-header">
        <strong class="me-auto">通知</strong>
        <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
    </div>
    <div class="toast-body">メッセージ</div>
</div>
```

#### After (Alpine.js)
```javascript
// JavaScriptで表示
Alpine.store('toasts').success('保存しました！');
Alpine.store('toasts').error('エラーが発生しました');
```

```html
<!-- レイアウトに1箇所配置 -->
<div x-data="toastContainer('top-right')" 
     class="toast-container position-fixed top-0 end-0 p-3">
    <template x-for="toast in toasts" :key="toast.id">
        <div x-show="toast.show"
             x-transition
             :class="['toast', 'show', getColorClass(toast.type)]"
             role="alert">
            <div class="d-flex">
                <i :class="getIcon(toast.type)" class="me-2"></i>
                <div class="toast-body" x-text="toast.message"></div>
                <button @click="$store.toasts.remove(toast.id)" 
                        type="button" 
                        class="btn-close me-2"></button>
            </div>
        </div>
    </template>
</div>
```

---

### 4. アコーディオン

#### Before (Bootstrap JS)
```html
<div class="accordion" id="accordionExample">
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button" 
                    type="button" 
                    data-bs-toggle="collapse" 
                    data-bs-target="#collapseOne">
                セクション1
            </button>
        </h2>
        <div id="collapseOne" 
             class="accordion-collapse collapse show">
            <div class="accordion-body">コンテンツ1</div>
        </div>
    </div>
</div>
```

#### After (Alpine.js)
```html
<div x-data="accordion({ allowMultiple: false })">
    <div x-data="accordionItem('item1')">
        <h2 class="accordion-header">
            <button @click="toggle()" 
                    class="accordion-button"
                    :class="{ 'collapsed': !isOpen }">
                セクション1
                <i :class="isOpen ? 'ri-arrow-up-s-line' : 'ri-arrow-down-s-line'"></i>
            </button>
        </h2>
        <div x-show="isOpen" 
             x-transition
             class="accordion-collapse">
            <div class="accordion-body">コンテンツ1</div>
        </div>
    </div>
</div>
```

---

### 5. タブ

#### Before (Bootstrap JS)
```html
<ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
        <button class="nav-link active" 
                data-bs-toggle="tab" 
                data-bs-target="#tab1">
            タブ1
        </button>
    </li>
    <li class="nav-item">
        <button class="nav-link" 
                data-bs-toggle="tab" 
                data-bs-target="#tab2">
            タブ2
        </button>
    </li>
</ul>
<div class="tab-content">
    <div class="tab-pane active" id="tab1">タブ1の内容</div>
    <div class="tab-pane" id="tab2">タブ2の内容</div>
</div>
```

#### After (Alpine.js)
```html
<div x-data="tabs({ defaultTab: 0 })">
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <button @click="switchTab(0)" 
                    :class="{ 'active': isActive(0) }"
                    class="nav-link"
                    data-tab="tab1">
                タブ1
            </button>
        </li>
        <li class="nav-item">
            <button @click="switchTab(1)" 
                    :class="{ 'active': isActive(1) }"
                    class="nav-link"
                    data-tab="tab2">
                タブ2
            </button>
        </li>
    </ul>
    <div class="tab-content">
        <div x-show="isActive(0)" class="tab-pane">タブ1の内容</div>
        <div x-show="isActive(1)" class="tab-pane">タブ2の内容</div>
    </div>
</div>
```

---

## Alpine.js ベストプラクティス

### 1. x-data スコープを適切に設計
```html
<!-- Good: 独立したコンポーネント -->
<div x-data="dropdown()">...</div>
<div x-data="modal()">...</div>

<!-- Bad: 過度にネストしない -->
<div x-data="{ outer: true }">
    <div x-data="{ inner: true }">
        <div x-data="{ deep: true }">...</div>
    </div>
</div>
```

### 2. グローバルストアを活用
```javascript
// 複数コンポーネント間でデータ共有
Alpine.store('myStore', {
    data: [],
    add(item) { this.data.push(item); }
});
```

### 3. トランジションでUX向上
```html
<div x-show="isOpen" 
     x-transition:enter="transition ease-out duration-300"
     x-transition:leave="transition ease-in duration-200">
    ...
</div>
```

### 4. カスタムマジックプロパティの活用
```html
<!-- クリップボードコピー -->
<button @click="$clipboard('コピーするテキスト')">
    コピー
</button>
```

---

## チェックリスト

移行作業時のチェックリスト：

- [ ] Bootstrap JS の `<script>` タグを削除
- [ ] Alpine.js CDN を追加（defer属性付き）
- [ ] `data-bs-*` 属性を Alpine.js ディレクティブに置き換え
- [ ] イベントハンドラーを `@click` などに変更
- [ ] トランジション効果を `x-transition` に変更
- [ ] グローバル状態管理を `Alpine.store()` に移行
- [ ] 動作確認（すべてのインタラクションをテスト）
- [ ] ブラウザコンソールでエラーがないか確認

---

## トラブルシューティング

### Alpine.js が動作しない
1. CDN が正しく読み込まれているか確認
2. `defer` 属性が付いているか確認
3. コンソールでエラーを確認

### 既存のBootstrap CSSとの互換性
- Bootstrap CSS は引き続き使用可能
- クラス名はそのまま使用できる
- Bootstrap JS のみを Alpine.js に置き換える

### パフォーマンスの懸念
- Alpine.js は軽量（~15KB）で高速
- Bootstrap JS（~80KB）より軽量
- 複雑な状態管理も効率的に処理

---

## 参考リンク
- [Alpine.js 公式ドキュメント](https://alpinejs.dev/)
- [Alpine.js チートシート](https://devhints.io/alpinejs)
- [プロジェクト Alpine.js コンポーネントガイド](ALPINEJS_COMPONENTS.md)
