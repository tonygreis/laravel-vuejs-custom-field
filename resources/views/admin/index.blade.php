@extends('layouts.main')

@section('content')
    <div class="mb-2">
        <admin-index></admin-index>
    </div>
@endsection
@section('footer')
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>
@endsection
