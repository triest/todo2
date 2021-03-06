@extends('layouts.app')

@section('content')
<div class="container">


    <div class="row justify-content-center">
        <div class="col-md-8">

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createToDoListModal">
                Создать список
            </button>

            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createTagModal" onclick="getTags()">
                Создать тег
            </button>
            <br>
            Теги:
            @foreach($tags as $tag)
                <span onclick="getToLoLists('{{$tag->name}}')">{{$tag->name}}</span>
            @endforeach
            <br>
            <span id="tag-search"></span>
            <span id="toDoListList"></span>
            <!-- Modal -->
            <br>




        </div>
    </div>
</div>

<div class="modal fade" id="createToDoListModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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

<div class="modal fade" id="createToDoListItemModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" >Создать элемент списка</h5>
                <button type="button" class="close" data-dismiss="modal" id="close-create-list-item-button" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="createListItemForm" method="post" accept-charset="multipart/form-data"   action="{{route('to-do-list-item.store')}}">
                    @csrf
                    <input type="hidden" name="list_id" id="list_id"  required>
                    <input type="text" name="name" id="toDoItemName"  required>
                    <br>
                    <textarea name="description" id="description"></textarea>
                    <input type="file" name="file" id="file"  required>
                    <span id="tags-span"></span> <p></p>
                    <button type="submit" class="btn btn-primary">Создать</button>
                </form>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="createTagModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" >Редактирование тегов</h5>
                <button type="button" class="close" data-dismiss="modal" id="close-create-list-item-button" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="createTegForm" method="post" accept-charset="multipart/form-data"   action="{{route('tag.store')}}">
                    @csrf
                    <label for="name">Имя тега</label>
                    <input type="text" name="name">
                    <input type="submit" value="Создать тег">
                </form>

                <span id="tag-list"></span>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="shareListItemModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" >Поделиться списком</h5>
                <button type="button" class="close" data-dismiss="modal" id="close-create-list-item-button" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="shareList" method="post" accept-charset="multipart/form-data"   action="{{route('to-do-list-item.store')}}">
                    @csrf
                    <span id="share-span"></span>
                    <input type="submit">
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
