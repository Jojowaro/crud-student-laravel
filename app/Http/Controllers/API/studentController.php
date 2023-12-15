<?php

namespace App\Http\Controllers\API;

use App\Helpers\ApiFormatter;
use App\Http\Controllers\Controller;
use App\Models\Student;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // try {
        //     $data = Student::all();

        //     return ApiFormatter::createApi(200, 'Success', $data);
        // } catch (Exception $error) {
        //     return ApiFormatter::createApi(400, 'Failed');
        // }

        $students = Student::all();
        if($students->count() > 0){
            return response()->json([
                'status' => 200,
                'student' => $students
            ], 200);
        }else{
            return response()->json([
                'status' => 404,
                'student' => 'No Record Found'
            ], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // try {
        //     $request->validate([
        //         'name' => 'required',
        //         'address' => 'required',
        //         'email' => 'required|email',
        //     ]);

        //     $student = Student::create([
        //         'name' => $request->name,
        //         'address' => $request->address,
        //         'email' => $request->email
        //     ]);

        //     return ApiFormatter::createApi(200, 'Success', $student);
        // } catch (Exception $error) {
        //     return ApiFormatter::createApi(400, 'Failed');
        // }

        $validator = Validator::make($request-> all(),[
            'name' => 'required',
            'address' => 'required',
            'email' => 'required|email',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->errors()
            ], 422);
        }else{
            $student = Student::create([
                'name' => $request->name,
                'address' => $request->address,
                'email' => $request->email,
            ]);

            if($student){
                return response()->json([
                    'status' => 200,
                    'students' => 'Students create successfully'
                ], 200);
            }else{
                return response()->json([
                    'status' => 500,
                    'message' => 'Something went wrong'
                ], 500);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // try {
        //     $student = Student::findOrFail($id);

        //     return ApiFormatter::createApi(200, 'Success', $student);
        // } catch (Exception $error) {
        //     return ApiFormatter::createApi(400, 'Failed');
        // }

        $student = Student::findOrFail($id);
        if($student){
            return response()->json([
                'status' => 200,
                'students' => $student
            ], 200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'No student found'
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // try {
        //     $student = Student::find($id);
    
        //     if ($student) {
        //         return ApiFormatter::createApi(200, 'Success', $student);
        //     } else {
        //         return ApiFormatter::createApi(404, 'Student not found');
        //     }
    
        // } catch (Exception $error) {
        //     return ApiFormatter::createApi(500, 'Internal Server Error');
        // }

        $student = Student::find($id);
        if($student){
            return response()->json([
                'status' => 200,
                'students' => $student
            ], 200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'No student found'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        // try {
        //     $request->validate([
        //         'name' => 'required',
        //         'address' => 'required',
        //         'email' => 'required',
        //     ]);
    
        //     $student = Student::find($id);
    
        //     if ($student) {
        //         $student->update([
        //             'name' => $request->name,
        //             'address' => $request->address,
        //             'email' => $request->email
        //         ]);
    
        //         return ApiFormatter::createApi(200, 'Success', $student);
        //     } else {
        //         return ApiFormatter::createApi(404, 'Student not found');
        //     }
    
        // } catch (Exception $error) {
        //     return ApiFormatter::createApi(500, 'Internal Server Error');
        // }

        $validator = Validator::make($request-> all(),[
            'name' => 'required',
            'address' => 'required',
            'email' => 'required|email',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->errors()
            ], 422);
        }else{
            $student = Student::find($id);
            if($student){
                $student->update([
                    'name' => $request->name,
                    'address' => $request->address,
                    'email' => $request->email,
                ]);

                return response()->json([
                    'status' => 200,
                    'students' => 'Students updated successfully'
                ], 200);
            }else{
                return response()->json([
                    'status' => 404,
                    'message' => 'Not found :('
                ], 404);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $student = Student::find($id);

            if ($student) {
                $student->delete();
                return ApiFormatter::createApi(200, 'Success', 'Student deleted successfully');
            } else {
                return ApiFormatter::createApi(404, 'Student not found');
            }

        } catch (Exception $error) {
            return ApiFormatter::createApi(500, 'Internal Server Error');
        }
    }
}
