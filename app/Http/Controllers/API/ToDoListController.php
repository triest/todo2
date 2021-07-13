<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateToDoListRequest;
use App\Http\Resources\ToDoListResource;
use App\Models\ToDoList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ToDoListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        //
        $user = Auth::user();

        if (!$user) {
            return response()->json()->setStatusCode(403);
        }

        $tags = array_keys($request->all());

        $toDolists = ToDoList::select(['*']);

        if ($tags) {
            foreach ($tags as $tag) {
                $toDolists->whereHas(
                        'item.tag',
                        function ($query) use ($tag) {
                            $query->where('tags.id', $tag);
                        }
                );
            }
        }

        $toDolists->where('user_id',$user->id);


        $toDolists = $toDolists->with('item')->get();
        return response()->json(ToDoListResource::collection($toDolists));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateToDoListRequest $request)
    {
        //
        $todoList=new ToDoList();
        $todoList->fill($request->validated());
        $todoList->user_id=Auth::id();
        $todoList->save();
        return response()->json($todoList);
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
