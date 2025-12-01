@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Student Record</h2>

    @if ($errors->any())
        <div class="alert" style="background:#ffcccc; padding:10px; border-radius:6px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li style="color:red;">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('student.update', $student->id) }}" method="POST" style="background:#f9f9f9; padding:20px; border-radius:10px;">
        @csrf
        @method('PUT')

        <div style="margin-bottom:10px;">
            <label>Name:</label>
            <input type="text" name="name" value="{{ old('name', $student->name) }}" required style="width:100%; padding:8px;">
        </div>

        <div style="margin-bottom:10px;">
            <label>Email:</label>
            <input type="email" name="email" value="{{ old('email', $student->email) }}" required style="width:100%; padding:8px;">
        </div>

        <div style="margin-bottom:10px;">
            <label>Department:</label>
            <input type="text" name="department" value="{{ old('department', $student->department) }}" required style="width:100%; padding:8px;">
        </div>

        <hr>
        <h4>Update Marks (Out of 100)</h4>

        @for ($i = 1; $i <= 5; $i++)
            <div style="margin-bottom:10px;">
                <label>Subject {{ $i }}:</label>
                <input type="number" name="subject{{ $i }}" min="0" max="100" value="{{ old('subject'.$i, $student->{'subject'.$i}) }}" required style="width:100%; padding:8px;">
            </div>
        @endfor

        <div style="text-align:center;">
            <button type="submit" style="background:#28a745; color:white; padding:10px 20px; border:none; border-radius:8px; cursor:pointer;">
                Update Student
            </button>
        </div>
    </form>
</div>
@endsection
