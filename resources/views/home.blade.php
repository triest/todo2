@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <button class="btn btn-primary"> </button>

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createToDoListModal">
                Создать список
            </button>

            <span id="toDoListList"></span>
            <!-- Modal -->

        </div>
    </div>
</div>

<div class="modal fade" id="createToDoListModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="nemToListModelClouseButton">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               <form id="createListForm" method="post" action="{{route('to-do-list.store')}}">
                    @csrf
                   <input type="text" name="name" id="name"  required>

                   <button type="submit" class="btn btn-primary">Создать</button>
               </form>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="createToDoListItemModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" >Создать елемент списка</h5>
                <button type="button" class="close" data-dismiss="modal" id="nemToDoItemModelClouseButton" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="createListItemForm" method="post" action="{{route('to-do-list-item.store')}}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="list_id" id="list_id"  required>
                    <input type="text" name="name" id="toDoItemName"  required>
                    <input type="file" name="file" id="file">
                    <button type="submit" class="btn btn-primary">Создать</button>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection



@section('scripts')
    <script src="{{ asset('js/jquery-3.6.0.js') }}"></script>
    <script src="{{ asset('js/todo.js') }}"></script>
@endsection
