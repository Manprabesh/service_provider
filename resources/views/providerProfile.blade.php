<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Profile page</h1>
    <h1>{{ session('session_key') }}</h1> 
    <form action="/upload-photo" method="POST" enctype="multipart/form-data">
                @csrf

        <input type="file" name="profile">
        <input type="submit" name="" id="">
    </form>
</body>
</html>