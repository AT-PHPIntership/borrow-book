<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="bower_components/admin-lte/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">{{trans('admin.title.left_bar')}}</li>
            <li>
                <a href="{{route('admin.users.index')}}">
                    <i class="fa fa-users"></i> <span>{{trans('user.title')}}</span>
                </a>
            </li>
            <li>
                <a href="{{route('admin.books.index')}}">
                    <i class="fa fa-book"></i> <span>{{trans('book.title')}}</span>
                </a>
            </li>
            <li>
                <a href="{{route('admin.posts.index')}}">
                    <i class="fa fa-comment"></i> <span>{{trans('post.title')}}</span>
                </a>
            </li>
            <li>
                <a href="{{route('admin.borrows.index')}}">
                    <i class="fa fa-dashboard"></i> <span>{{trans('borrow.title')}}</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
