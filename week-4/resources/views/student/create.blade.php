@extends('layouts.app')

@section('content')
<div class="container">
    <h2> Student Marks Entry Form</h2>

    @if ($errors->any())
        <div class="alert" style="background:#ffcccc; padding:10px; border-radius:6px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li style="color:red;">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('student.store') }}" method="POST" style="background:#f9f9f9; padding:20px; border-radius:10px;">
        @csrf

        <div style="margin-bottom:10px;">
            <label>Name:</label>
            <input type="text" name="name"  required style="width:100%; padding:8px;">
        </div>

        <div style="margin-bottom:10px;">
            <label>Email:</label>
            <input type="email" name="email"  required style="width:100%; padding:8px;">
        </div>

        <div style="margin-bottom:10px;">
            <label>Department:</label>
            <input type="text" name="department" value="{{ old('department') }}" required style="width:100%; padding:8px;">
        </div>

        <h4>Enter Marks (Out of 100)</h4>

        @for ($i = 1; $i <= 5; $i++)
            <div style="margin-bottom:10px;">
                <label>Subject {{ $i }} Marks:</label>
                <input type="number" name="subject{{ $i }}" min="0" max="100" required style="width:100%; padding:8px;">
            </div>
        @endfor
        

        <div style="text-align:center;">
            <button type="submit" style="background:#007bff; color:white; padding:10px 20px; border:none; border-radius:8px; cursor:pointer;">
                Save Student Record
            </button>
        </div>
    </form>
</div>
@endsection
