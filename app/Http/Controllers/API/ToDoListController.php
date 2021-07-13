<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateToDoListRequest;
use App\Http\Resources\ToDoListResource;
use App\Models\Tag;
use App\Models\ToDoList;
use http\Env\Response;
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

        if (!empty($tags)) {
            foreach ($tags as $tag) {
                $toDolists->whereHas(
                        'item.tag',
                        function ($query) use ($tag) {
                            $query->where('tags.name', $tag);
                        }
                );
            }
        }
        $toDolists->where('user_id',$user->id);



        $toDolists2= $toDolists->with('item')->get();


        if (!empty($tags)) {
            foreach ($tags as $tag) {
                $tag = Tag::where('name', $tag)->first();

                if (!$tag) {
                    continue;
                }

                $array = array();

                foreach ($toDolists2 as $toDolist) {

                    $Items=$toDolist->item()->get();

                    foreach ($Items as $item){

                        $tagsItem=$item->tag()->get();
                        $collection=collect();

                        foreach ($tagsItem as $tagItem){

                            if($tagItem->id==$tag->id){

                                $collection->push($item);
                            }
                        }
                    }

                    $array[] = [
                            'id' => $toDolist->id,
                            'name' => $toDolist->name,
                            'items'=>$collection
                    ];

                }
            }

            return  response()->json($array);
        }





        return response()->json(ToDoListResource::collection($toDolists2));
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
