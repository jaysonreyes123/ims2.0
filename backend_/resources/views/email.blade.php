<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FMS</title>
</head>
<style>
    p{
        margin: 0;
        padding: 0;
    }
</style>
<body>
    <h4>Dear {{ucfirst($content["recipient_name"])}},</h4>
   <span>{!! $content["body"] !!}</span>
   <p>Please take immediate precautions to ensure your safety.</p>
   <br>
   <p>
    Stay safe,<br>Flood Monitoring System
   </p>
</body>
</html>