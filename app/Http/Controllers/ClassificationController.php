<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClassificationRequest;
use App\Http\Requests\UpdateClassificationRequest;
use App\Models\Classification;
use Gate;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class ClassificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(Gate::denies('branch_read'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $classifications = Classification::all();
        return view('classifications.index',compact('classifications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('classifications.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClassificationRequest $request)
    {
        try {
            Classification::create($request->all());
            return to_route('classifications.create')->with('message', 'Classification added successfully!');
        }catch (\Exception $e){
            dd($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Classification $classification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classification $classification)
    {
        return view('classifications.edit',compact('classification'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClassificationRequest $request, Classification $classification)
    {
        try {
            $classification->update($request->all());
            return to_route('classifications.index')->with('message', 'Classification Updated successfully!');
        }catch (\Exception $e){
            dd($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classification $classification)
    {
        DB::beginTransaction();
        try {
            DB::commit();
            $classification->delete();
            return to_route('classifications.index')->with('message', 'Classification Deleted successfully!');
        }catch (\Exception $e){
            DB::rollback();
            dd($e);
        }
    }
}
