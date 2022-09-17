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
        <form action="file" method="post" enctype="multipart/form-data">
            @csrf
            <input id="file" type="file" name="file" accept=".csv" required>
        </form>
        </div>
        <div class="forms-cntainer">
            <div class="forms">
                <form action="file" method="post" enctype="multipart/form-data">
                    @csrf
                    <select name="project" required>
                        <option value="">プロジェクトを選択</option>
                        <option value="test">テスト</option>
                    </select>
                </form>
                <form action="file" method="post" enctype="multipart/form-data">
                    @csrf
                    <input class="date" type="date" name="example1">
                </form>
            </div>
            <button type="submmit">決定</button>
        </div>
    </div>
</body>
</html>
