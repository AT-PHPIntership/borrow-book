@extends('admin.layouts.admin')

@section('title', trans('admin.title.index'))

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <h3>{{ trans('statistical.time.total') }}</h3>
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-user"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ trans('statistical.title.users') }}</span>
                        <span class="info-box-number total-users">{{ $users }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="ion-ios-book-outline"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ trans('statistical.title.books') }}</span>
                        <span class="info-box-number total-books">{{ $books }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fa fa-comments-o"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ trans('statistical.title.posts') }}</span>
                        <span class="info-box-number total-posts">{{ $posts }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="ion ion-clipboard"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ trans('statistical.title.borrowes') }}</span>
                        <span class="info-box-number total-borrowes">{{ $borrowes }}</span>
                    </div>
                </div>
            </div>
        </div>
        <h3>{{ trans('statistical.time.weekly') }}</h3>
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-aqua">
                    <span class="info-box-icon"><i class="ion ion-person-add"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ trans('statistical.title.users') }}</span>
                        <span class="info-box-number last-week-users">{{ $usersLastWeek }}</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar" style="width: 100%"></div>
                    </div>
                    <a href="#" class="small-footer">
                        {{ trans('statistical.title.more_info') }} <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-green">
                    <span class="info-box-icon"><i class="ion ion-ios-book-outline"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ trans('statistical.title.books') }}</span>
                        <span class="info-box-number  last-week-books">{{ $booksLastWeek }}</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar" style="width: 100%"></div>
                    </div>
                    <a href="#" class="small-footer">
                        {{ trans('statistical.title.more_info') }} <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-yellow">
                    <span class="info-box-icon"><i class="fa fa-comments-o"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ trans('statistical.title.posts') }}</span>
                        <span class="info-box-number last-week-posts">{{ $postsLastWeek }}</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar" style="width: 100%"></div>
                    </div>
                    <a href="#" class="small-footer">
                        {{ trans('statistical.title.more_info') }} <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-red">
                    <span class="info-box-icon"><i class="ion ion-clipboard"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ trans('statistical.title.borrowes') }}</span>
                        <span class="info-box-number last-week-borrowes">{{ $borrowesLastWeek }}</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar" style="width: 100%"></div>
                    </div>
                    <a href="#" class="small-footer">
                        {{ trans('statistical.title.more_info') }} <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <h3>{{ trans('statistical.time.monthly') }}</h3>
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3 class="last-month-users">{{ $usersLastMonth }}</h3>
                        <p>{{ trans('statistical.title.new_users') }}</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        {{ trans('statistical.title.more_info') }} <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3 class="last-month-books">{{ $booksLastMonth }}</h3>
                        <p>{{ trans('statistical.title.new_books') }}</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-book-outline"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        {{ trans('statistical.title.more_info') }} <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3 class="last-month-posts">{{ $postsLastMonth }}</h3>
                        <p>{{ trans('statistical.title.new_posts') }}</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-comments-o"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        {{ trans('statistical.title.more_info') }} <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3 class="last-month-borrowes">{{ $borrowesLastMonth }}</h3>
                        <p>{{ trans('statistical.title.new_borrowes') }}</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-clipboard"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        {{ trans('statistical.title.more_info') }} <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <h3>{{ trans('statistical.table.title') }}</h3>
        <div class="row">
            <div class="col-md-6">
                <table id="table-index" class="table box">
                    <thead>
                        <tr>
                            <th></th>
                            <th>{{ trans('statistical.table.books') }}</th>
                            <th>{{ trans('statistical.table.times') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($topBookMonthly as $key => $topBook)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $topBook->name }}</td>
                            <td>{{ $topBook->number_borrow }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
@endsection
