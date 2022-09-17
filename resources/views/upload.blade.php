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

    <form class="upload-container" action="file" method="post" enctype="multipart/form-data">
        @csrf
        <div class="uploader">
            <input id="file" type="file" name="file" accept=".csv" required>
        </div>
        <div class="forms-cntainer">
            <div class="forms">
                <select name="project" required>
                    <option value="">プロジェクトを選択</option>
                    <option value="test">テスト</option>
                </select>
                <input class="date" type="date" name="example1">
            </div>
            <button type="submmit">決定</button>
        </div>
    </form>
</body>
</html>
