 @if (!request()->is('login') && !request()->is('register') && !request()->is('cart') && !request()->is('password/email') && !request()->is('password/reset/*'))
<div id="colorlib-subscribe">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="col-md-6 text-center">
                </div>
                <div class="col-md-6">
                    <form class="form-inline qbstp-header-subscribe">
                        <div class="row">
                            <div class="col-md-12 col-md-offset-0">
                                <div class="form-group">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
<footer id="colorlib-footer" role="contentinfo">
    <div class="container">
        <div class="row row-pb-md">
            <div class="col-md-2 colorlib-widget">
                <h4></h4>
                <p>
                </p>
            </div>
        </div>
    </div>
    <div class="copy">
        <div class="row">
            <div class="col-md-12 text-center">
            </div>
        </div>
    </div>
</footer>
<div class="gototop js-top active">
    <a href="#" class="js-gotop"><i class="fa fa-arrow-up"></i></a>
</div>
