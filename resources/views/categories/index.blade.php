@extends('layout.main')

@section('title', 'Categories')

@section('styles')
    <link rel="stylesheet" href="{{url('dt/dt.css')}}"/>
    <link rel="stylesheet" href="{{url('ve/ve.css')}}"/>
    <link rel="stylesheet" href="{{url('sa/sa.css')}}"/>
@endsection

@section('content')
    <div class="modal fade edit-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel2"><i class="fa fa-edit"></i> Edit Category</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div id="loader" style="display: none">
                            <center>
                                <img src="{{url('assets/images/loader.gif')}}"/>
                            </center>
                        </div>

                        <div id="editor"></div>
                    </div>
                </div>


                </form>

            </div>
        </div>
    </div>

    <div class="modal fade add-category-modal" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel"
         aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" id="mod">
                <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel"><i class="fa fa-plus"></i> Create Category</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">

                    <form role="form" id="addCategoryForm" novalidate="">
                        {{csrf_field()}}
                        <div class="form-group row">
                            <label for="name" class="col-sm-4 col-form-label">Name<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-7">
                                <input type="text" required="" class="form-control validate[required]"
                                       data-errormessage-value-missing="Name is required!" name="name" id="name"
                                       placeholder="Enter Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-8 offset-sm-4">
                                <button type="button" id="saveCategory"
                                        class="btn btn-primary waves-effect waves-light mr-1">
                                    Save
                                </button>
                                <button type="reset" class="btn btn-secondary waves-effect waves-light">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <div class="row">
        <div class="col-8">
            <div class="page-title-box">
                <div class="page-title-right">
                    <button class="btn btn-primary waves-effect waves-light" data-toggle="modal"
                            data-target=".add-category-modal"><i class="fa fa-plus"></i> Add Category
                    </button>
                </div>
                <h4 class="page-title"><i class="fa fa-list"></i> Categories</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <table id="dataTb" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach($categories as $category)
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$category->name}}</td>
                                <td>{!! status($category->status) !!}</td>
                                <td>{!! fca($category->created_at) !!}</td>
                                <td>
                                    <p>
                                    <span style="cursor: pointer" route="{{route('categories.edit', $category->id)}}"
                                          data-toggle="modal" data-target=".edit-modal" class="editCategory">
                                        <i class="fa fa-edit" data-toggle="tooltip" title="Edit Category"></i>
                                    </span>
                                        <span style="padding-left: 12px; cursor: pointer"
                                              route="{{route('categories.delete', $category->id)}}"
                                              class="deleteCategory">
                                        <i class="fa fa-trash" data-toggle="tooltip" title="Delete Category"></i>
                                    </span>
                                        <span data-toggle="tooltip"
                                              tip="{{$category->status == 1 ? 'Block Category' : 'Activate Category'}}"
                                              title="{{$category->status == 1 ? 'Block Category' : 'Activate Category'}}"
                                              style="padding-left: 12px; cursor: pointer"
                                              route="{{route('categories.change.status', $category->id)}}"
                                              class="activateCategory">
                                        <i class="{!! $category->status == 1 ? 'fa fa-unlock' : 'fa fa-lock' !!}"></i>
                                    </span>
                                    </p>
                                </td>
                            </tr>
                            @php
                                $i++;
                            @endphp
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{url('ve/ve.js')}}"></script>
    <script src="{{url('ve/ve.en.js')}}"></script>
    <script src="{{url('dt/dt.js')}}"></script>
    <script src="{{url('sa/sa.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('#dataTb').DataTable();
        });
    </script>
    <script src="{{url('bjs/b.js')}}"></script>
    <script>
        $(function () {
            $('body').on('click', '#saveCategory', function () {
                let valid = $('#addCategoryForm').validationEngine('validate');
                if (valid) {
                    // we can save our category
                    let data = Biggo.serializeData(addCategoryForm);
                    Biggo.talkToServer('{{route('categories.store')}}', data).then(res => {
                        if (res.error) {
                            Biggo.showFeedBack(addCategoryForm, res.message, res.error, null);
                        } else {
                            Biggo.showFeedBack(addCategoryForm, res.message, res.error, "");
                        }

                    });
                }
            });

            $('body').on('click', '.deleteCategory', function () {
                let route = $(this).attr('route');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then(function (result) {

                    if (result.value) {
                        let data = {
                            _token: '{{csrf_token()}}'
                        };
                        Biggo.talkToServer(route, data).then(res => {
                            Biggo.showFeedBack(dataTb, res.message, res.error, "");
                        });
                    }

                });
            });

            $('body').on('click', '.activateCategory', function () {
                let route = $(this).attr('route');
                let title = $(this).attr('tip');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You will " + title,
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: title
                }).then(function (result) {

                    if (result.value) {
                        let data = {
                            _token: '{{csrf_token()}}'
                        };
                        Biggo.talkToServer(route, data).then(res => {
                            Biggo.showFeedBack(dataTb, res.message, res.error, "");
                        });
                    }

                });
            });

            $('body').on('click', '.editCategory', function () {
                let route = $(this).attr('route');
                $('#editor').html('');
                $('#loader').css('display', 'block');
                $.get(route, function(view) {
                    $('#loader').css('display', 'none');
                    $('#editor').html(view);
                });
            });

            $('body').on('click', '#updateCategory', function () {
                let valid = $('#updateCategoryForm').validationEngine('validate');
                if (valid) {
                    // we can save our category
                    let data = Biggo.serializeData(updateCategoryForm);
                    Biggo.talkToServer('{{route('categories.update')}}', data).then(res => {
                        if (res.error) {
                            Biggo.showFeedBack(updateCategoryForm, res.message, res.error, null);
                        } else {
                            Biggo.showFeedBack(updateCategoryForm, res.message, res.error, "");
                        }

                    });
                }
            });
        });
    </script>
@endsection

