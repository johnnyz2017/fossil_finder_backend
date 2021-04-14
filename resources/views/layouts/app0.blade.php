<!doctype html>
<html lang="en">
 <head>
 <!-- Required meta tags -->
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">

 <!-- CoreUI CSS -->
 <link rel="stylesheet" href="https://unpkg.com/@coreui/coreui/dist/css/coreui.min.css" crossorigin="anonymous">

 <title>{{ config('app.name', 'Laravel') }}</title>
 </head>
 <body class="c-app">

@include('partials.menu')

<div class="c-wrapper">
    <header class="c-header c-header-light c-header-fixed">
    
    </header>
    <div class="c-body">
    <main class="c-main">
    <div class="container-fluid">
        @yield('content')
    </div>
    </main>
    </div>
    <footer class="c-footer">
    <div class="mfs-auto">Powered by&nbsp;<a href="https://coreui.io/pro/">CoreUI Pro</a></div>
    </footer>
</div>

 <script src="https://unpkg.com/@popperjs/core@2"></script>
 <script src="https://unpkg.com/@coreui/coreui/dist/js/coreui.min.js"></script>

</body>
</html>