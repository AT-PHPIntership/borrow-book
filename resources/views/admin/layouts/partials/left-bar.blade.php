<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ Auth::user()->avatar_url }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> {{ __('Online') }}</a>
            </div>
        </div>
      <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">{{trans('admin.title.left_bar')}}</li>
            <li>
                <a href="{{route('admin.users.index')}}">
                    <i class="fa fa-dashboard"></i> <span>{{trans('user.title')}}</span>
                </a>
            </li>
            <li>
                <a href="{{route('admin.books.index')}}">
                    <i class="fa fa-dashboard"></i> <span>{{trans('book.title')}}</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
