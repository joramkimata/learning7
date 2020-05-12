@extends('layout.main')

@section('title', 'Todos')

@section('styles')
    <link rel="stylesheet" href="{{url('dt/dt.css')}}"/>
    <link rel="stylesheet" href="{{url('ve/ve.css')}}"/>
@endsection

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <button class="btn btn-primary waves-effect waves-light" data-toggle="modal"
                            data-target=".add-todo-modal"><i class="fa fa-plus"></i> Add Todo
                    </button>
                </div>
                <h4 class="page-title"><i class="fa fa-list"></i> Todos</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="card">
                        <div class="card-body">
                            <table id="dataTb" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Category</th>
                                    <th>Start Date</th>
                                    <th>Due Date</th>
                                    <th>Complete Date</th>
                                    <th>Created At</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach($todos as $t)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$t->title}}</td>
                                        <td>{{$t->description == "" ? '-' : $t->description }}</td>
                                        <td>{!! getCat($t->category_id) !!}</td>
                                        <td>{{$t->start_date}}</td>
                                        <td>{{$t->end_date}}</td>
                                        <td>{{ $t->complete_date == "" ? '-' : $t->complete_date }}</td>
                                        <td>{!! fca($t->created_at) !!}</td>
                                        <td>{!! ts($t->status) !!}</td>
                                        <td>
                                            @if($t->status == 'in_progress')
                                                <span style="cursor: pointer"
                                                      route="{{route('todos.edit', $t->id)}}" data-toggle="modal"
                                                      data-target=".edit-todo-modal" class="editTodo">
                                    <i class="fa fa-edit" data-toggle="tooltip" title="Edit Todo"></i>
                                </span>
                                                <span style="padding-left: 12px; cursor: pointer"
                                                      route="{{route('todos.view', $t->id)}}" data-toggle="modal"
                                                      data-target=".view-todo-modal" class="viewTodo">
                                    <i class="fa fa-search" data-toggle="tooltip" title="View Todo"></i>
                                </span>
                                            @endif
                                            @if($t->status != 'in_progress')
                                                <span style="padding-left: 12px; cursor: pointer"
                                                      route="{{route('todos.delete', $t->id)}}" class="deleteTodo">
                                    <i class="fa fa-trash" data-toggle="tooltip" title="Delete Todo"></i>
                                </span>
                                            @endif
                                            @if($t->status == 'in_progress')
                                                <span style="padding-left: 12px; cursor: pointer"
                                                      tip="Mark as Complete!"
                                                      route="{{route('todos.complete', $t->id)}}"
                                                      class="completeTodo">
                                    <i class="fa fa-check-double" data-toggle="tooltip" title="Mark as Complete!"></i>
                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                @endforeach
                                </tbody>
                            </table>
                        </div> <!-- end card body-->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{url('ve/ve.js')}}"></script>
    <script src="{{url('ve/ve.en.js')}}"></script>
    <script src="{{url('dt/dt.js')}}"></script>

    <script>
        $(document).ready(function () {
            $('#dataTb').DataTable();
        });
    </script>
    <script src="{{url('bjs/b.js')}}"></script>
    <script>
        $(function () {

        });
    </script>
@endsection


