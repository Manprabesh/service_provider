<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
</head>

<body>
    @php
        $user = session('user');
    @endphp
    <h1>Welcome, {{ $user['email'] }}</h1>
    <button> <a href="/service">Search for services</a> </button>

    <div>
        <img src="https://i.pinimg.com/736x/84/64/82/8464826d795c3a32fff669b37aba806d.jpg" height="200px" width="200px"
            alt="">
    </div>

    <form action="/user/profile-photo" id="form" enctype="multipart/form-data   ">
        <input type="file" name="profile" id="profile_input" style="display:none">
        <button type="button" onclick="document.getElementById('profile_input').click()">
            Upload Profile Picture
        </button>
    </form>
</body>
<script>
    document.getElementById('profile_input').addEventListener('change', function () {
        document.getElementById('form').submit();
    });
</script>

</html>