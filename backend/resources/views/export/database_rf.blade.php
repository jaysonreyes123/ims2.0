<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<table>
    <tr>
        <th>Time</th>
        <th>Current</th>
        <th>24 Hours</th>
    </tr>
    @foreach ($data as $item)
        <tr>
            <td>{{$item["time"]}}</td>
            <td>{{$item["current"]}}</td>
            <td>{{$item["24_hrs"]}}</td>
        </tr>
    @endforeach
</table>
</body>
</html>