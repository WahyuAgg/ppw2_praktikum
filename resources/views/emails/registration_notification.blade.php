<!DOCTYPE html>
<html>
<head>
    <title>Registration Notification</title>
</head>
<body>
    <h1>Hello {{ $user->name }}</h1>
    <p>Anda sudah berhasil melakukan registrasi, berikut adalah detail data Anda:</p>
    <ul>
        <li>Nama: {{ $user->name }}</li>
        <li>Email: {{ $user->email }}</li>
        <li>Password: {{ $user->password }}</li>
    </ul>
</body>
</html>
