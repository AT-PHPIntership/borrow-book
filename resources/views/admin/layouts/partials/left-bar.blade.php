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
                <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('user.online') }}</a>
            </div>
        </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">{{trans('admin.title.left_bar')}}</li>
            <li class="{{ request()->is('admin/users*') ? 'active' : '' }}">
                <a href="{{route('admin.users.index')}}">
                    <i class="fa fa-users"></i> <span>{{trans('user.title')}}</span>
                </a>
            </li>
            <li class="{{ request()->is('admin/categories*') ? 'active' : '' }}">
                <a href="{{route('admin.categories.index')}}">
                    <i class="fa fa-folder-open"></i> <span>{{trans('category.title')}}</span>
                </a>
            </li>
            <li class="{{ request()->is('admin/books*') ? 'active' : '' }}">
                <a href="{{route('admin.books.index')}}">
                    <i class="fa fa-book"></i> <span>{{trans('book.title')}}</span>
                </a>
            </li>
            <li class="{{ request()->is('admin/posts*') ? 'active' : '' }}">
                <a href="{{route('admin.posts.index')}}">
                    <i class="fa fa-comment"></i> <span>{{trans('post.title')}}</span>
                </a>
            </li>
            <li class="{{ request()->is('admin/borrows*') ? 'active' : '' }}">
                <a href="{{route('admin.borrows.index')}}">
                    <i class="fa fa-dashboard"></i> <span>{{trans('borrow.title')}}</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
