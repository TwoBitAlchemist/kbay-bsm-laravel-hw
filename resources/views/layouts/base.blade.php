<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>@yield('title') | PHPBookmarks.IO</title>
    <!-- Bootstrap v3.3.6 Compiled & Minified Stylesheet -->
    <link rel="stylesheet" 
    href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
    integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7"
    crossorigin="anonymous">
    <!-- Bootstrap v3.3.6 Default Theme -->
    <link rel="stylesheet"
    href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css"
    integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r"
    crossorigin="anonymous">
    @if ($show_logo)
    <!-- Google Fonts 'Chewy' (for "logo") -->
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Chewy">
    <link rel="stylesheet" href="{{ url('css/logostyle.css') }}">
    @else
        <style>form { margin-top: 5%; }</style>
    @endif
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
    @yield('extrastyles')
  </head>
  <body>
    @if ($show_logo) @include('layouts.logo') @endif
    <div class="container-fluid">
      <!-- Display validation errors -->
      @include('common.errors')
      <!-- Content section -->
      @yield('content')
    </div>
    <script src="//code.jquery.com/jquery-2.2.0.min.js"></script>
    <!-- Bootstrap v3.3.6 Compiled & Minified JavaScript -->
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
    integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
    crossorigin="anonymous"></script>
    <script src="/js/main.js"></script>
    @yield('extrascripts')
  </body>
</html>
