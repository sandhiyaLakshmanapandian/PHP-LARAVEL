@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3 text-center">Student Marks List</h2>

    <div class="text-end mb-3">
        <a href="{{ route('student.create') }}" class="btn btn-success">Add New Student</a>
        <a href="{{ route('student.queryExample') }}" class="btn">View Topper List</a>

    </div>

    <table class="table table-bordered table-striped text-center">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Department</th>
                <th>Total</th>
                <th>Percentage</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
                <tr>
                    <td>{{ $student->id }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->department }}</td>
                    <td>{{ $student->total }}</td>
                    <td>{{ $student->percentage }}%</td>
                    <td>
                        <a href="{{ route('student.edit', $student->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('student.destroy', $student->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure to delete this student?')" class="btn btn-danger btn-sm">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
