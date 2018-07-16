<div>
    <h1>Recommend book for you</h1>
    <p>{{ __('Dear') }} <strong>{{ $user->name }}</strong></p>
    <ul>
        @foreach($books as $book)
            <li>
                <div>
                    <div>
                        @foreach ($book->imageBooks as $image)
                            @if ($loop->first)
                                <img src="{{ $message->embed($image->image_url) }}" alt="">
                            @endif
                        @endforeach
                    </div>
                    <div>
                        <h4>{{ trans('book.table_head.title') }} {{ $book->title }} {{ $book->id }}</h4>
                        <p>{{ trans('book.table_head.author') }} {{ $book->author }}</p>
                        <p>{{ trans('category.form.title_inputs.name') }} {{ $book->category->name }}</p>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
</div>
