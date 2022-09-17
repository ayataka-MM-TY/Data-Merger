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
    <div class="upload-container">
        <div class="uploader">
            <input type="file" name="file" />
        </div>
        <div class="forms-cntainer">
            <div class="forms">
                <select name="project" required>
                    <option value="">プロジェクトを選択</option>
                    <option value="test">テスト</option>
                </select>
                <input class="date" type="date" name="example1">
            </div>
            <button type="button">決定</button>
        </div>
    </div>
</body>
</html>
