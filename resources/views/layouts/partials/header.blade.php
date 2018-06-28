<nav class="colorlib-nav" role="navigation">
    <div class="top-menu">
        <div class="container">
            <div class="row">
                <div class="col-xs-2">
                    <div id="colorlib-logo"><a href="{{ route('welcome') }}">{{ config('app.name') }}</a></div>
                </div>
                <div class="col-xs-10 text-right menu-1">
                    <ul>
                        <li class="active"><a href="#">Home</a></li>
                        <li class="dropdown">
                            <a href="javascript:void();" class="category dropdown-toggle" id="menu1" data-toggle="dropdown">{{ trans('homepage.categories') }}<span class="caret"></span></a>
                            <ul class="dropdown-menu category-list" role="menu" aria-labelledby="menu1">
                            </ul>
                        </li>
                        <li><a href="{{ route('cart') }}"><i class="fa fa-shopping-cart"></i> {{ trans('homepage.cart') }}[<span class="text-primary" id="number-item"></span>]</a></li>
                        <li id="login" class="dropdown">
                            <a href="{{ route('login') }}">{{ trans('homepage.login') }}</a>
                        </li>
                        <li id="register">
                            <a href="{{ route('register') }}">{{ trans('homepage.register') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
