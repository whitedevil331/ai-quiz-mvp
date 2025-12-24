@extends('layout')

@section('content')
<form method="POST" action="/submit">
@csrf
@foreach($quiz['questions'] as $i => $q)
    <p><b>{{ $q['question'] }}</b></p>
    @foreach($q['options'] as $opt)
        <label>
            <input type="radio" name="answers[{{ $i }}]" value="{{ $opt }}">
            {{ $opt }}
        </label><br>
    @endforeach
@endforeach
<button>Review & Submit</button>
</form>
@endsection
