<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name='csrf-token' content="{{ csrf_token() }}">
    <title>Store Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    @include('layouts.partials.styles')

</head>
<body>
    <div class="colorlib-loader"></div>
    <div id="page">
        @include('layouts.partials.header')
        <!--Banner-->
        @if (!request()->is('login') && !request()->is('register') && !request()->is('cart') && !request()->is('password/email') && !request()->is('password/reset/*'))
        @include('layouts.partials.banner')
        @endif
        <!--Banner2-->
        @if(request()->is('cart'))
        @include('layouts.partials.banner2')
        @endif()
        <!-- Content Wrapper. Contains page content -->
        @yield('content')
        <!-- /.content-wrapper -->
        @include('layouts.partials.footer')
    </div>
    @include('layouts.partials.scripts')
    @yield('scripts')
</body>
</html>
