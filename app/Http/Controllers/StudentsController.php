<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentsRequest;
use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('students/index', [
            'title' => 'Data Murid',
            'data' => Students::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('students/create', [
            'title' => 'Tambah Data Murid'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentsRequest $studentsRequest)
    {
        $created = Students::create([
            'code' => $studentsRequest->code,
            'fullname' => $studentsRequest->fullname,
            'notelp' => $studentsRequest->notelp,
            'kota' => $studentsRequest->kota,
        ]);

        if ($created) {
            return response()->json(['success' => 'Data berhasil disimpan']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Students  $students
     * @return \Illuminate\Http\Response
     */
    public function show(Students $students)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Students  $students
     * @return \Illuminate\Http\Response
     */
    public function edit(Students $students, $id)
    {
        return view('students/edit', [
            'title' => 'Edit Data Murid',
            'data' => Students::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Students  $students
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Students $students, $id)
    {
        //
        $validate = Validator::make($request->all(), [
            'fullname' => ($students->fullname == $request->fullname) ? 'required' : 'required|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/|min:3',
            'notelp' => 'required|numeric'
        ], [
            'fullname.regex' => 'The :attribute name must be string',
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors()->toArray())->setStatusCode(422);
        } else {
            $update = $students->find($id)->update([
                'fullname' => $request->fullname,
                'notelp' => $request->notelp,
                'kota' => $request->kota,
            ]);

            if ($update) {
                return response()->json(['success' => 'Data berhasil disimpan']);
            } else {
                return response()->json(['error' => 'Data gagal disimpan...'])->setStatusCode(400);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Students  $students
     * @return \Illuminate\Http\Response
     */
    public function destroy(Students $students, $id)
    {
        if ($students->find($id)->delete()) {
            return response()->json(['success' => 'Data berhasil dihapus']);
        } else {
            return response()->json($id)->setStatusCode(400);
        }
    }
}
