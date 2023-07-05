<?php

namespace App\Http\Controllers\Api;

use App\Models\Medicine;
use App\Imports\MedicinesImport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\StoreMedicineRequest;
use App\Http\Requests\UpdateMedicineRequest;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $result = Medicine::get();
            return response()->json($result, 200);
        } catch (\Throwable $e) {
            return response()->json(['Error' => $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMedicineRequest $request)
    {
        try {
            $data['name'] = $request['name'];
            $data['section'] = $request['section'];
            $data['indication'] = $request['indication'];

            $result = Medicine::create($data);
            return response()->json($result, 200);
        } catch (\Throwable $e) {
            return response()->json(['Error' => $e->getMessage()], 500);
        }
    }

    /**
     * Store resources by CSV.
     */
    public function import()
    {
        try {
            if (!request()->hasFile('file')) {
                return response()->json(['Error' => 'No file'], 403);
            }

            $path = request()->file('file')->store('file');
            $path = storage_path('app/file') . '/' . $path;

            Excel::import(new MedicinesImport, $path);

            $result = Medicine::paginate();

            return response()->json($result, 200);
        } catch (\Throwable $e) {
            return response()->json(['Error' => $e->getMessage()], 403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Medicine $medicine)
    {
        try { 
            $result = Medicine::find($medicine);
            return response()->json($result, 200);
        } catch (\Throwable $th) {
            return response()->json(['Error' => $th->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMedicineRequest $request, Medicine $medicine)
    {
        try { 
            $result = Medicine::find($medicine->id)->update($request);
            return response()->json($result , 200);
        } catch (\Throwable $e) {
            return response()->json(['Error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Medicine $medicine)
    {
        try {
            $result = Medicine::find($medicine->id)->delete(); 
            return response()->json(["deleted" => $result ], 200);
        } catch (\Throwable $e) {
            return response()->json(['Error' => $e->getMessage()], 500);
        }
    }
}
