@extends('layout')

@section('content')
<h3>Score: {{ $score }}/5</h3>

@foreach($feedback as $f)
<p>
<b>{{ $f['question'] }}</b><br>
Your Answer: {{ $f['user'] ?? 'Not answered' }}<br>
Correct Answer: {{ $f['correct'] }}
</p>
@endforeach
@endsection
