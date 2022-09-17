<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/confirm.css">
</head>
<body>
    <div class="confirm-container">
        <p>{{ $filename }}を{{ $project }}に保存しますか？</p>
        <form action="/" method="post" enctype="multipart/form-data">
            @csrf
            <div class="buttons">
                <button type="submmit">キャンセル</button>
                <button type="submmit">保存</button>
            </div>
        </form>
        <table>
            <tr>
                @foreach($titles as $title)
                    <th>{{ $title }}</th>
                @endforeach
            </tr>
            @foreach($records as $record)
                <tr>
                    @foreach($record as $value)
                        <td>{{ $value }}</td>
                    @endforeach
                </tr>
            @endforeach
        </table>
    </div>
</body>
</html>
