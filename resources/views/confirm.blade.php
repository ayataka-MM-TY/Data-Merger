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
    @component("components.header")
    @endcomponent
    <div class="confirm-container">
        <p>{{ $filename }}を{{ $project }}に保存しますか？</p>
        <form action="download" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" value="yes" name="save">
            <div class="buttons">
                @component("components.button")
                    @slot("name")
                        save
                    @endslot
                    @slot("value")
                        no
                    @endslot
                    @slot("text")
                        キャンセル
                    @endslot
                    @slot("href")
                    @endslot
                @endcomponent
                @component("components.button")
                    @slot("name")
                        save
                    @endslot
                    @slot("value")
                        yes
                    @endslot
                    @slot("text")
                        保存
                    @endslot
                @endcomponent
                <!-- <button id="btn" type="submmit" name="save" value="no">キャンセル</button>
                <button id="btn" type="submmit" name="save" value="yes">保存</button> -->
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
