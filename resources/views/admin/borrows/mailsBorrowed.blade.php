<h1>{{ __('Dear') }} <strong>{{ $borrow->user->name }}</strong> {{ __('ID#') }}{{ $borrow->id }}</h1>
<p>{{ trans('borrow.reminder') }}</p>
<p>{{ trans('borrow.table_head.from_date') }} {{ $borrow->from_date }}</p>
<p>{{ trans('borrow.table_head.to_date') }} {{ $borrow->to_date }}</p>
