<nav class="colorlib-nav" role="navigation">
    <div class="top-menu">
        <div class="container">
            <div class="row">
                <div class="col-xs-2">
                    <div id="colorlib-logo"><a href="#">Laravel</a></div>
                </div>
                <div class="col-xs-10 text-right menu-1">
                    <ul>
                        <li class="active"><a href="#">Home</a></li>
                        <li class="has-dropdown">
                            <a href=""></a>
                            <ul class="dropdown">
                                <li><a href="#"></a></li>
                                <li><a href="#"></a></li>
                                <li><a href="#"></a></li>
                                <li><a href="#"></a></li>
                                <li><a href="#"></a></li>
                            </ul>
                        </li>
                        <li><a href=""></a></li>
                        <li><a href=""></a></li>
                        <li><a href=""></a></li>
                        <li><a href=""></a></li>
                        <li id="login"><a href="{{ route('login') }}">{{ trans('homepage.login') }}</a></li>
                        <li id="register"><a href="">{{ trans('homepage.register') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
