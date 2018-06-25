@extends('layouts.master')
@section('content')
    <div class="colorlib-shop">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-md-push-3" >
                    <div class="row row-pb-lg" id="books">
                    </div>
                    <div class="text-center">
                        <ul class="pagination" id="pagination">
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-md-pull-9">
                    <div class="sidebar">
                        <div class="side">
                            <button class="btn btn-default btn-md btn-block reset-filter" type="submit">Reset Filter <i class="fa fa-refresh"></i></button>
                        </div>
                        <div class="side">
                            <h2>{{ trans('listBook.filter.search') }}</h2>
                            <form method="post" class="colorlib-form-2" id="filter-search">
                                <div class="form-group" >
                                    <input name="search" id="search" type="text" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-default center-block"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                        <div class="side">
                            <h2>{{ trans('listBook.filter.category') }}</h2>
                            <div class="color-wrap" id="filter-categories">
                            </div>
                        </div>
                        <div class="side">
                            <h2>{{ trans('listBook.filter.language') }}</h2>
                            <form method="post" class="colorlib-form-2">
                                <div class="form-group" >
                                    <div class="form-field">
                                        <select name="language" id="filter-language" class="form-control">
                                            <option value="#" disabled selected>{{ trans('listBook.filter.select.choose') }}</option>
                                            <option value="English">{{ trans('listBook.filter.select.english') }}</option>
                                            <option value="VietNamese">{{ trans('listBook.filter.select.vietnamese') }}</option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="side">
                            <h2>{{ trans('listBook.filter.number_range') }}</h2>
                            <form method="post" class="colorlib-form-2">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="guests">{{ trans('listBook.filter.select.number_from') }}</label>
                                        <div class="form-field">
                                            <i class="icon icon-arrow-down3"></i>
                                            <select name="from" id="from" class="form-control number-of-page">
                                                <option value="1">1</option>
                                                <option value="200">200</option>
                                                <option value="300">300</option>
                                                <option value="400">400</option>
                                                <option value="1000">1000</option>
                                          </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="guests">{{ trans('listBook.filter.select.number_to') }}</label>
                                        <div class="form-field">
                                            <i class="icon icon-arrow-down3"></i>
                                            <select name="tp" id="to" class="form-control number-of-page">
                                                <option value="2000">2000</option>
                                                <option value="4000">4000</option>
                                                <option value="6000">6000</option>
                                                <option value="8000">8000</option>
                                                <option value="10000">10000</option>
                                          </select>
                                        </div>
                                    </div>
                                </div>
                          </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
@endsection
@section('scripts')
<script src="{{ asset('js/showListBook.js') }}"></script>
@endsection
