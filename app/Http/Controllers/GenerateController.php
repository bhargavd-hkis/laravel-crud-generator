<?php

namespace App\Http\Controllers;

use App\Models\generate;
use App\Models\Student;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Exists;

class GenerateController extends Controller
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      try{
        $model = Str::ucfirst(Str::camel($request->module_name));
        $model_name = $model;
        $fields = array_combine(str_replace([' ','-'], '_', $request->field_name), $request->field_type);
        $db_name = Str::plural($model);
        $migration_name = 'create_'.Str::lower($db_name).'_table';
        $controller_name = Str::ucfirst($model).'Controller';
        if(!Schema::hasTable(Str::lower($db_name))){
          Artisan::call("make:migration:schema",['name' => $migration_name, '--schema' => str_replace(['{','}','"'],'',json_encode($fields))]);
        } else {
          return response()->json(['status' => false, 'data' => '', 'Message' => "Table already exists"], 200);
        }
        Artisan::call("migrate");
        Artisan::call("make:model", ['name' => $model_name]);
        Artisan::call("make:controller",['name' => $controller_name, '--model' => $model_name ]);
        return response()->json(['status' => true, 'data' => ['model_name'=>$model_name, 'migration_name'=>$migration_name, 'controller_name'=>$controller_name, 'table_fields'=>$fields], 'Message' => "New module saved successfully"], 200);
      } catch (Exception $e) {
        return response()->json(['status' => false, 'data' => $e, 'Message' => "Something went wrong"], 200);
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\generate  $generate
     * @return \Illuminate\Http\Response
     */
    public function show(generate $generate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\generate  $generate
     * @return \Illuminate\Http\Response
     */
    public function edit(generate $generate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\generate  $generate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, generate $generate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\generate  $generate
     * @return \Illuminate\Http\Response
     */
    public function destroy(generate $generate)
    {
        //
    }
}
