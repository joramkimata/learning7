<!-- ============================================================== -->
<!-- End Page content -->
<!-- ============================================================== -->

<!-- Footer Start -->
<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                {{date('Y')}} &copy; Powered By Izweb Technologies
            </div>

        </div>
    </div>
</footer>
<!-- end Footer -->

<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>

<!-- Vendor js -->
<script src="{{url('assets/js/vendor.min.js')}}"></script>

<script src="{{url('assets/libs/apexcharts/apexcharts.min.js')}}"></script>
<script src="{{url('assets/libs/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
<script src="{{url('assets/libs/jquery-vectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{url('assets/libs/jquery-vectormap/jquery-jvectormap-world-mill-en.js')}}"></script>

<!-- Peity chart-->
<script src="{{url('assets/libs/peity/jquery.peity.min.js')}}"></script>

<!-- init js -->
<script src="{{url('assets/js/pages/dashboard-2.init.js')}}"></script>

<script src="{{url('assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
<script src="{{url('assets/libs/moment/moment.min.js')}}"></script>
<script src="{{url('assets/libs/bootstrap-daterangepicker/daterangepicker.js')}}"></script>

<!-- App js -->
<script src="{{url('assets/js/app.min.js')}}"></script>

<script src="{{url('sa/sa.js')}}"></script>

<script src="{{url('ve/ve.js')}}"></script>
<script src="{{url('ve/ve.en.js')}}"></script>

<script src="{{url('bjs/b.js')}}"></script>

<script>

    $('body').on('click', '#changePassword', function() {
        var valid = $("#changePassForm").validationEngine('validate');
        if (valid) {
            // change the password now!!
            $('#changePassForm').css('opacity', 0.2);

            var data = {
                _token: '{{csrf_token()}}',
                password: $('#password').val()
            };

            Biggo.talkToServer('{{route("users.password")}}', data, false).then(function(res) {
                $('#changePassForm').css('opacity', 1);
                $('#password').val('');
                $('#cpassword').val('');
                if (res.error) {
                    Biggo.showFeedBack(changePassForm, res.message, res.error);
                } else {
                    Biggo.showFeedBack(changePassForm, res.message, res.error);
                }

            });
        }
    });


    $('body').on('click', '#saveTodo', function () {
        var valid = $("#addTodoForm").validationEngine('validate');
        if (valid) {
            $('#addTodoForm').css('opacity', 0.2);

            let data = $('#addTodoForm').serializeArray();

            Biggo.talkToServer('{{route("todos.store")}}', data, false).then(function (res) {
                $('#addTodoForm').css('opacity', 1);
                if (res.error) {
                    Biggo.showFeedBack(addTodoForm, res.message, res.error, null);
                } else {
                    Biggo.showFeedBack(addTodoForm, res.message, res.error, "");
                }

            });
        }
    });

    $('body').on('click', '#updateTodo', function () {
        var valid = $("#updateTodoForm").validationEngine('validate');
        if (valid) {
            $('#updateTodoForm').css('opacity', 0.2);

            var data = $('#updateTodoForm').serializeArray();

            Biggo.talkToServer('{{route("todos.update")}}', data, false).then(function (res) {
                $('#updateTodoForm').css('opacity', 1);
                if (res.error) {
                    Biggo.showFeedBack(updateTodoForm, res.message, res.error);
                } else {
                    if (res.error) {
                        Biggo.showFeedBack(updateTodoForm, res.message, res.error, null);
                    } else {
                        Biggo.showFeedBack(updateTodoForm, res.message, res.error, "");
                    }
                }

            });
        }
    });

    $('body').on('click', '.editTodo', function () {
        var route = $(this).attr('route');
        $('#editor-todo-edit').html('');
        $('#loader-todo-edit').css('display', 'block');
        $.get(route, function (view) {
            $('#loader-todo-edit').css('display', 'none');
            $('#editor-todo-edit').html(view);
        });
    });

    $('body').on('click', '.viewTodo', function () {
        var route = $(this).attr('route');
        $('#editor-todo-view').html('');
        $('#loader-todo-view').css('display', 'block');
        $.get(route, function (view) {
            $('#loader-todo-view').css('display', 'none');
            $('#editor-todo-view').html(view);
        });
    });

    $('body').on('click', '.completeTodo', function () {
        var route = $(this).attr('route');
        var title = $(this).attr('tip');

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
                $.post(route, {
                    _token: '{{csrf_token()}}',
                    title: title
                }, function (res) {
                    if (res.error) {
                        Biggo.showFeedBack(dataTb, res.message, res.error, null);
                    } else {
                        Biggo.showFeedBack(dataTb, res.message, res.error, "");
                    }

                });
            }

        });
    });

    $('body').on('click', '.deleteTodo', function() {
        var route = $(this).attr('route');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then(function(result) {

            if (result.value) {
                $.post(route, {
                    _token: '{{csrf_token()}}'
                }, function(res) {
                    if (result.value) {
                        if (res.error) {
                            Biggo.showFeedBack(dataTb, res.message, res.error, null);
                        } else {
                            Biggo.showFeedBack(dataTb, res.message, res.error, "");
                        }
                    }
                });
            }

        });
    });

</script>

@yield('scripts')

</body>

<!-- Mirrored from coderthemes.com/minton/layouts/horizontal/blue/dashboard-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 14 Nov 2019 03:20:11 GMT -->
</html>
