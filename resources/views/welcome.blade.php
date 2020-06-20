@extends('layouts.main')

@section('content')
    <div class="container mx-auto">
        <div class="flex justify-center">
            <div class="w-full text-blue-300">
              <h1>Welcome</h1>
                @foreach($posts as $post)
                    <h4>{{ $post->title }}</h4>
                @foreach(\App\Models\FieldPost::posts($post->id) as $f)
                    @dump($f)
                    @if($f->field->type === 'text')<p>{{ $f->value }}</p>@endif
                    @if($f->field->type != 'text')<p>{{ $f->option_id }}</p>@endif
                @endforeach
                @endforeach
            </div>
        </div>
    </div>
@endsection
