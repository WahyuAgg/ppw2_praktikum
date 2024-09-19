<!DOCTYPE html>
<html>
<head>
    <!-- Menetapkan judul halaman. Default ke 'Default Title' jika tidak ditentukan dari home.blade.php-->
    <title>@yield('title', 'Default Title')</title>

    <!-- Menautkan file'css' -->
    <link rel="stylesheet" href="{{ asset('css/style_home.css') }}">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

</head>
<body>
    <!-- Bagian header, judul situs dan menu navigasi -->
    <header>
        <h1>@yield('name_page', 'Default Title')</h1>
        <nav>
            <ul>
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><a href="{{ url('/about') }}">About</a></li>
                <li><a href="{{ url('/contact') }}">Contact</a></li>
            </ul>
        </nav>
    </header>

    <!-- Kontainer untuk konten utama halaman -->
    <div class="container">
        @yield('content')
        <!-- Ini akan digantikan oleh konten dari home.blade.php -->
    </div>

    <!-- Bagian footer -->
    <footer>
        <p>&copy; 2024 Laravel</p>
    </footer>
</body>
</html>
