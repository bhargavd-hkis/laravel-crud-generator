<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \{{ namespacedStsoreRequest }}  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      try{
        $data = Student::create($request->all());
        return response()->json(['status' => true, 'data' => json_decode($data), 'Message' => "Record saved successfully"], 200);
      } catch (Exception $e) {
        return response()->json(['status' => false, 'data' => json_decode($e), 'Message' => "Something went wrong"], 200);
      } 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        try{
          return response()->json(['status' => true, 'data' => json_decode($student), 'Message' => "Record found successfully"], 200);
        } catch (Exception $e) {
          return response()->json(['status' => false, 'data' => json_decode($e), 'Message' => "Something went wrong"], 200);
        } 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        try{
          return response()->json(['status' => true, 'data' => json_decode($student), 'Message' => "Record found successfully"], 200);
        } catch (Exception $e) {
          return response()->json(['status' => false, 'data' => json_decode($e), 'Message' => "Something went wrong"], 200);
        } 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
      try{
        $data = Student::where('id',$student)->update($request->all());
        return response()->json(['status' => true, 'data' => json_decode($data), 'Message' => "Record updated successfully"], 200);
      } catch (Exception $e) {
        return response()->json(['status' => false, 'data' => json_decode($e), 'Message' => "Something went wrong"], 200);
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
      try{
        $student->delete();
        return response()->json(['status' => true, 'data' => '', 'Message' => "Record deleted successfully"], 200);
      } catch (Exception $e) {
        return response()->json(['status' => false, 'data' => json_decode($e), 'Message' => "Something went wrong"], 200);
      }
    }
}
