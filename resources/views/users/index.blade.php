@extends('layout.main')

@section('title', 'Users')

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
                    <h4 class="modal-title" id="myModalLabel2"><i class="fa fa-edit"></i> Edit User</h4>
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

    <div class="modal fade add-user-modal" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel"
         aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" id="mod">
                <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel"><i class="fa fa-plus"></i> Create New User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">

                    <form role="form" id="addUserForm" novalidate="">
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
                            <label for="email" class="col-sm-4 col-form-label">Username<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-7">
                                <input type="text" required="" class="form-control validate[required]"
                                       data-errormessage-value-missing="Username is required!" name="username"
                                       id="username"
                                       placeholder="Enter Username">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label">Role<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-7">
                                <select class="form-control validate[required]"
                                        data-errormessage-value-missing="Role is required!" name="role" id="role">
                                    <option value="">--SELECT ROLE--</option>
                                    <option value="admin">ADMINISTRATOR</option>
                                    <option value="user">END-USER</option>
                                </select>
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group row">
                            <label for="password" class="col-sm-4 col-form-label">Password<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-7">
                                <input type="password" required="" class="form-control validate[required]"
                                       data-errormessage-value-missing="Password is required!" name="upassword"
                                       id="upassword" placeholder="Enter New Password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cpassword" class="col-sm-4 col-form-label">Confirm Password<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-7">
                                <input type="password" required=""
                                       class="form-control validate[required,equals[upassword]]"
                                       data-errormessage-value-missing="Confirm Password is required!" name="ucpassword"
                                       id="ucpassword" placeholder="Enter Confirm Password">
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group row">
                            <div class="col-sm-8 offset-sm-4">
                                <button type="button" id="saveUser"
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
                            data-target=".add-user-modal"><i class="fa fa-plus"></i> Add User
                    </button>
                </div>
                <h4 class="page-title"><i class="fa fa-users"></i> Users</h4>
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
                            <th>Username</th>
                            <th>Role</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach($users as $user)
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    @if($user->role == "admin")
                                        <label class="badge badge-success">ADMIN</label>
                                    @else
                                        <label class="badge badge-primary">USER</label>
                                    @endif
                                </td>
                                <td>{!! fca($user->created_at) !!}</td>
                                <td>
                                    <p>

     <span style="cursor: pointer" route="{{ route('users.edit', $user->id) }}"
           data-toggle="modal" data-target=".edit-modal" class="editUser">
         <i class="fa fa-edit" data-toggle="tooltip" title="Edit User"></i>
     </span>
                                        <span style="padding-left: 12px; cursor: pointer"
                                              route="{{ route('users.delete', $user->id) }}" class="deleteUser">
         <i class="fa fa-trash" data-toggle="tooltip" title="Delete User"></i>
     </span>
                                    </p></td>
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
            $('body').on('click', '#saveUser', function () {
                let valid = $("#addUserForm").validationEngine('validate');
                if (valid) {
                    let data = Biggo.serializeData(addUserForm);
                    Biggo.talkToServer('{{route('users.store')}}', data).then(res => {
                        if (res.error) {
                            Biggo.showFeedBack(addUserForm, res.message, res.error, null);
                        } else {
                            Biggo.showFeedBack(addUserForm, res.message, res.error, "");
                        }

                    });
                }
            });

            $('body').on('click', '.deleteUser', function () {
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

            $('body').on('click', '.editUser', function () {
                let route = $(this).attr('route');
                $('#loader').css('display', 'block');
                $('#editor').html('');
                $.get(route, function (view) {
                    $('#loader').css('display', 'none');
                    $('#editor').html(view);
                });
            });

            $('body').on('click', '#updateUser', function () {
                let valid = $("#updateUserForm").validationEngine('validate');
                if (valid) {
                    let data = Biggo.serializeData(updateUserForm);
                    Biggo.talkToServer('{{route('users.update')}}', data).then(res => {
                        if (res.error) {
                            Biggo.showFeedBack(updateUserForm, res.message, res.error, null);
                        } else {
                            Biggo.showFeedBack(updateUserForm, res.message, res.error, "");
                        }

                    });
                }
            });
        });
    </script>
@endsection
