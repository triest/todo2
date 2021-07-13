<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateToDoListRequest;
use App\Models\ToDoItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ToDoItemController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        //


        $todolIstItem=new ToDoItem();

        $todolIstItem->fill($request->post());

        $todolIstItem->save();

        die("ds");


        if($request->file('file')) {
            /*
             * удаляем старый файл
             * */
            $fileName = time().'_'.$todolIstItem->id.'_.'.$request->file->getClientOriginalExtension();
            $filePath = $request->file('file')->storeAs('toDoItems', $fileName, 'public');
            $name = time().'_'.$todolIstItem->id.'_'.rand(0,100).'_.'.$request->file->getClientOriginalExtension();
            $todolIstItem->image='/storage/'.$filePath;
            $todolIstItem->save();
        }

        return response()->json([$todolIstItem]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
