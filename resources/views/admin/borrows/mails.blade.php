<h1>Mail from Borrow Book</h1>
<h3>Hi {{ $name }}</h3>
@if ($status == 0)
<p>{{ trans('mails.message.message_borrowing') }}</p>
<p>{{ trans('borrow.table_head.from_date') }} {{ $from_date }}</p>
<p>{{ trans('borrow.table_head.to_date') }} {{ $to_date }}</p>
@elseif ($status == 1)
<p>{{ trans('mails.message.message_give_back') }}</p>
@elseif ($status == 2)
<p>{{ trans('mails.message.message_waitting') }}</p>
@else
<p>{{ trans('mails.message.message_cancel') }}</p>
@endif
<ul>    
@foreach ($borrow_details as $borrow_detail)
    <li>
        <div>
            <p>{{ trans('book.table_head.title') }} {{ $borrow_detail->book->title }}</p>
            <p>{{ trans('borrow.table_head.number_book') }} {{ $borrow_detail->quantity }}</p>
        </div>
    </li>
@endforeach
</ul>
