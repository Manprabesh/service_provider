<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <button><a href="/provider-profile">Go to profile</a></button>
    <h1>Provider dashboard</h1>
    @foreach ($users as $task)
    <ol>
    <li>user id: {{ $task['user_id'] }}</li>
    <li>user name: {{ $task['name'] }}</li>
    <li>user email: {{ $task['email'] }}</li>
    <li>Task status: {{ $task['status'] }}</li>
   
</ol>
    @endforeach
</body>
</html>