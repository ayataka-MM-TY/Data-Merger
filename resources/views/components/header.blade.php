<style>
    .header {
        height: 120px;
        left: 0;
        top: 0;
        width: 100vw;
        display: flex;
        align-items: center;
        justify-content: space-around;
        margin-bottom: 32px;
    }

    .header button {
        margin: -32px 32px 0 0;
    }
</style>

<div class="header">
    <h1>Data Merger</h1>
    <div class="buttons">
        @component("components.button")
            @slot("name")
            @endslot
            @slot("value")
            @endslot
            @slot("text")
                アップロード
            @endslot
        @endcomponent
        @component("components.button")
            @slot("name")
            @endslot
            @slot("value")
            @endslot
            @slot("text")
                ダウンロード
            @endslot
        @endcomponent
        @component("components.button")
            @slot("name")
            @endslot
            @slot("value")
            @endslot
            @slot("text")
                チーム管理
            @endslot
        @endcomponent
    </div>
</div>
