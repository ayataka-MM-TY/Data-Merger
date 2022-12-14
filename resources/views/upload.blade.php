<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/upload.css">
    <script type="text/javascript" src="js/upload.js"></script>
</head>
<body>
    @component("components.header")
    @endcomponent
    <form class="upload-container" action="confirm" method="post" enctype="multipart/form-data">
        @csrf
        <div class="uploader">
            <label>
                <input id="file" type="file" name="file" accept=".xlsx, .xlsm" multiple required>
            </label>
        </div>
        <div class="forms-container">
            <div class="forms">
                <select name="project" required>
                    <option value="">プロジェクトを選択</option>
                    <option value="test">テスト</option>
                    <option value="タクシーLog">タクシーLog</option>
                </select>
                <input class="date" type="date" name="date">
            </div>
            @component("components.button")
                @slot("name")
                @endslot
                @slot("value")
                @endslot
                @slot("text")
                    決定
                @endslot
            @endcomponent
        </div>
    </form>
</body>
</html>
