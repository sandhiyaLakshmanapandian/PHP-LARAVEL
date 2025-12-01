<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\CodeCoverage\Report\Xml\Totals;

class StudentController extends Controller
{
    //
    public function index()
    {
        $students = Student::all();//SELECT * FROM Students;
        return view ('student.index',compact('students'));
    }
    public function create()
    {
        return view('student.create');
    }
    public function store(Request $request)
    {
        $validated=$request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:students',
            'department' => 'required|string|max:100',
            'subject1' => 'required|numeric|min:0|max:100',
            'subject2' => 'required|numeric|min:0|max:100',
            'subject3' => 'required|numeric|min:0|max:100',
            'subject4' => 'required|numeric|min:0|max:100',
            'subject5' => 'required|numeric|min:0|max:100',
        ]);
        $total=$validated['subject1']+$validated['subject2']+$validated['subject3']+$validated['subject4']+$validated['subject5'];
        $percentage=round(($total/500)*100,2);

        Student::create([
         'name' => $validated['name'],
         'email' => $validated['email'],
         'department' => $request->department,
         'subject1' => $validated['subject1'],
         'subject2' => $validated['subject2'],
         'subject3' => $validated['subject3'],
         'subject4' => $validated['subject4'],
         'subject5' => $validated['subject5'],
         'total' => $total,
         'percentage' => $percentage,
        ]);
        return redirect()->route('student.index')->with('Success','Student record  added Successfully');
    }
    public function queryExample(){
        $students=DB::table('students')
        ->select('name','email','percentage')
        ->where('percentage','>',80)
        ->whereNull('deleted_at')
        ->get();//SELECT name,email,percentage FROM Students WHERE percentage>80 and deleted_at is null
        return view ('student.topper',compact('students'));
    }
    
     public function edit($id)
    {
        $student = Student::findOrFail($id);// SQL: SELECT * FROM students WHERE id = ?
        return view('student.edit', compact('student'));
    }
    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $id,
            'department' => 'required|string|max:100',
            'subject1' => 'required|numeric|min:0|max:100',
            'subject2' => 'required|numeric|min:0|max:100',
            'subject3' => 'required|numeric|min:0|max:100',
            'subject4' => 'required|numeric|min:0|max:100',
            'subject5' => 'required|numeric|min:0|max:100',
        ]);

        $total = $request->subject1 + $request->subject2 + $request->subject3 + $request->subject4 + $request->subject5;
        $percentage = round(($total / 500) * 100, 2);

        $student->update([
            'name' => $request->name,
            'email' => $request->email,
            'department' => $request->department,
            'subject1' => $request->subject1,
            'subject2' => $request->subject2,
            'subject3' => $request->subject3,
            'subject4' => $request->subject4,
            'subject5' => $request->subject5,
            'total' => $total,
            'percentage' => $percentage,
        ]);

        return redirect()->route('student.index')->with('success', 'Student updated successfully!');
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete(); // Soft delete
        // SQL: UPDATE students SET deleted_at = CURRENT_TIMESTAMP WHERE id = ?
        return redirect()->route('student.index')->with('success', 'Student deleted successfully!');
    }
}


