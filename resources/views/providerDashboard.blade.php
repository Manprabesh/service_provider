<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Provider dashboard</h1>
    <ol>
    @foreach ($users as $task)
    <li>user id: {{ $task['user_id'] }}</li>
    <li>user name: {{ $task['name'] }}</li>
    <li>user email: {{ $task['email'] }}</li>
   
    @endforeach
</ol>
</body>
</html>