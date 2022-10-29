<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>@yield('title', env('APP_NAME'))</title>

    @vite(['resources/css/app.css', 'resources/sass/main.sass', 'resources/js/app.js'])
</head>
<body x-data="{ 'showTaskUploadModal': false, 'showTaskEditModal': false }" x-cloak>

<!-- Site header -->
<header class="header pt-6 xl:pt-12">
    <div class="container">
        <div class="header-inner flex items-center justify-between lg:justify-start">
            <div class="header-logo shrink-0">
                <a href="{{ route('home') }}" rel="home">
                    <img src="{{ Vite::image('logo.svg') }}" class="w-[120px] xs:w-[148px] md:w-[201px] h-[30px] xs:h-[36px] md:h-[50px]" alt="CutCode">
                </a>
            </div>
            @auth
                <form action="{{ route('logOut') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Выйти</button>
                </form>
            @endauth
        </div><!-- /.header-inner -->
    </div><!-- /.container -->
</header>
