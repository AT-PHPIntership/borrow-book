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
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="category dropdown-toggle" id="menu1" data-toggle="dropdown">Categories<span class="caret"></span></a>
                            <ul class="dropdown-menu category-list" role="menu" aria-labelledby="menu1">
                            </ul>
                        </li>
                        <li><a href=""></a></li>
                        <li><a href=""></a></li>
                        <li><a href=""></a></li>
                        <li><a href=""></a></li>
                        <li id="login" class="dropdown">
                            <a href="{{ route('login') }}">{{ trans('homepage.login') }}</a>
                        </li>
                        <li id="register"><a href="">{{ trans('homepage.register') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
