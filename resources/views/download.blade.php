<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/download.css">
</head>
<body>
    @component("components.header")
    @endcomponent
    <table>
        <tr>
            <th>プロジェクト名</th> <th>データ件数</th> <th>最終更新</th>
        </tr>
        @foreach($downloads as $download)
        <tr>
            <td><a href="/json/77ba89f2-d35d-4cb7-832a-3a4d046cf1b7" download="/json/77ba89f2-d35d-4cb7-832a-3a4d046cf1b7">{{ $download["project"] }}</a></td>
            <td>{{ $download["count"] }}</td>
            <td>{{ $download["lastDate"] }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>
