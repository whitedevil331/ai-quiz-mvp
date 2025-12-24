@extends('layout')

@section('content')
<form method="POST" action="/generate">
    @csrf
    <input name="topic" placeholder="Enter topic" required>
    <button>Generate Quiz</button>
</form>
@endsection
