@extends('layouts.app')

@section('content')
<h3> Top Performing Students (Above 80%)</h3>

<a href="{{ route('student.index') }}" class="btn" style="background:gray;">← Back</a>

@if ($students->count() > 0)
<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Percentage</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($students as $student)
        <tr>
            <td>{{ $student->name }}</td>
            <td>{{ $student->email }}</td>
            <td>{{ $student->percentage }}%</td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<p>No toppers found.</p>
@endif
@endsection
