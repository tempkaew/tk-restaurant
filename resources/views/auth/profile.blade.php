@extends('layouts.admin')

@section('addcss')
<!-- Toastr -->
<link rel="stylesheet" href="{{url('assets/AdminLTE/plugins/toastr/toastr.min.css')}}">
@endsection

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Profile</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Admin</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Main row -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">แก้ไขข้อมูลส่วนบุคคล</h3>
            </div>
            <!-- /.card-header -->

            <div class="card-body">

                <div class="row">
                    <div class="col-md-6">
                        <p id="userName">
                            ชื่อและนามสกุล : {{ Auth::user()->name }}
                        </p>
                        <p>
                            Email : {{ Auth::user()->email }}
                        </p>
                        <p>
                            เบอร์โทรติดต่อ : {{ Auth::user()->phone_number }}
                        </p>
                        <p>
                            ID Line : {{ Auth::user()->line_id }}
                        </p>
                    </div>
                    <div class="col-md-6">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" id="profilePhoto"
                                src="{{ Auth::user()->photo == "" ? url('assets/adminLTE/dist/img/user4-128x128.jpg') : asset('assets/images/profile/'.Auth::user()->photo) }}"
                                alt="User profile picture">
                                <p>
                                    <a href="" data-toggle="modal" data-userid="{{ Auth::id() }}" data-target="#EditImgProfile">เปลี่ยนรูป Profile</a>
                                </p>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-userid="{{ Auth::id() }}" data-target="#EditProfile">แก้ไขข้อมูล</button>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-userid="{{ Auth::id() }}" data-target="#EditPassword">แก้ไขรหัสผ่าน</button>
            </div>

            <!-- Modal EditProfile -->
            <div class="modal fade" id="EditProfile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">แก้ไขข้อมูลส่วนบุคคล</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <form id="frmEditProfile" action="#">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="inputName">ชื่อและนามสกุล</label>
                                            <input type="text" class="form-control" value="{{ Auth::user()->name }}"
                                                id="inputName" placeholder="Enter Name">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail">Email address</label>
                                            <input type="email" class="form-control" value="{{ Auth::user()->email }}"
                                                id="inputEmail" placeholder="Enter email">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputTel">Tel</label>
                                            <input type="tel" class="form-control"
                                                value="{{ Auth::user()->phone_number }}" id="inputTel"
                                                placeholder="Enter Phone Number">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputIDLine">ID Line</label>
                                            <input type="text" class="form-control" value="{{ Auth::user()->line_id }}"
                                                id="inputIDLine" placeholder="Enter ID Line">
                                        </div>

                                        <div class="dropdown-divider"></div>

                                        <div class="form-group">
                                            <label for="inputOldPassword">ยืนยันรหัสผ่าน</label>
                                            <input type="password" class="form-control"value="" 
                                                id="inputPasswordConfirm" placeholder="Enter Passwprd Confirm">
                                        </div>

                                    </div>
                                </div>
                            </form>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                            <button type="button" id="btnEditUser" class="btn btn-primary">แก้ไขข้อมูล</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- / Modal EditProfile -->

            <!-- Modal EditPassword -->
            <div class="modal fade" id="EditPassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">แก้ไขรหัสผ่าน</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <form id="frmEditPassword" action="#">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="inputPassword">รหัสผ่านใหม่</label>
                                            <input type="password" class="form-control" value=""
                                                id="inputPassword" placeholder="Enter New Password">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputRePassword">ยืนยันรหัสผ่านใหม่</label>
                                            <input type="password" class="form-control" value=""
                                                id="inputRePassword" placeholder="Enter Re-Password">
                                        </div>

                                        <div class="dropdown-divider"></div>

                                        <div class="form-group">
                                            <label for="inputOldPassword">รหัสผ่านเดิม</label>
                                            <input type="password" class="form-control"value="" 
                                                id="inputOldPassword" placeholder="Enter Old Passwprd">
                                        </div>

                                    </div>
                                </div>
                            </form>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                            <button type="button" id="btnEditPassword" class="btn btn-primary">แก้ไขรหัสผ่าน</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- / Modal EditPassword -->

            <!-- Modal EditImgProfile -->
            <div class="modal fade" id="EditImgProfile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">

                        <form method="POST" enctype="multipart/form-data" id="frmEditImgProfile" action="#">

                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">แก้ไขรูปประจำตัว</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="form-group">

                                            <label for="exampleInputFile">File input</label>

                                            <p>
                                                <img src="" id="imagesPreview" class="img-fluid">
                                            </p>

                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="inputPhoto" name="inputPhoto">
                                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                                <button type="button" id="btnEditPhoto"
                                    class="btn btn-primary">แก้ไขรูปประจำตัว</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- / Modal EditImgProfile -->

        </div>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection

@section('script')
<!-- Toastr -->
<script src="{{url('assets/AdminLTE/plugins/toastr/toastr.min.js')}}"></script>
<!-- bs-custom-file-input -->
<script src="{{url('assets/AdminLTE/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<script>
    $(document).ready(function () {
        bsCustomFileInput.init();
    });

    //Edit Profile    
    $('#EditProfile').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget) // Button that triggered the modal
        var userid = button.data('userid') // Extract info from data-* attributes

        $("#btnEditUser").click(function (e) {

            e.preventDefault();

            var formData = {
                name: $('input[id=inputName]').val(),
                email: $('input[id=inputEmail]').val(),
                line_id: $('input[id=inputIDLine]').val(),
                phone_number: $('input[id=inputTel]').val(),
                password: $('input[id=inputPasswordConfirm]').val(),
                user_id: userid
            }

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: '{{ url('/profile/edit_profile') }}',
                data: formData,
                cache: false,

                success: function (data) {

                    console.log(data.status);

                    if (data.status == true) {
                        $('#EditProfile').modal('hide');
                        //location.reload();
                        toastr.success(data.message)
                        window.location.reload();
                    } else {
                        toastr.error(data.message)
                    }

                }

            });

        })

    })

    //Edit Password
    $('#EditPassword').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget) // Button that triggered the modal
        var userid = button.data('userid') // Extract info from data-* attributes

        $("#btnEditPassword").click(function (e) {

            inputpwd = $('input[id=inputPassword]').val();
            inputrepwd = $('input[id=inputRePassword]').val();

            if (inputpwd != inputrepwd) {
                toastr.error('ยืนยันรหัสผ่านไม่ตรงกัน');
            } else {

                e.preventDefault();

                var formData = {
                    new_password: $('input[id=inputPassword]').val(),
                    password: $('input[id=inputOldPassword]').val(),
                    user_id: userid
                }

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url: '{{ url('/profile/edit_password') }}',
                    data: formData,
                    cache: false,

                    success: function (data) {

                        if (data.status == true) {
                            $('#EditProfile').modal('hide');
                            //location.reload();
                            toastr.success(data.message)
                            window.location.reload();
                        } else {
                            toastr.error(data.message)
                        }

                    }

                });
            }

        })

    })

    //Edit Photo Profile
    $(document).ready(function () {
        $('#inputPhoto').change(function () {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#imagesPreview').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });
    });
    
    $('#EditImgProfile').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget) // Button that triggered the modal
        var userid = button.data('userid') // Extract info from data-* attributes

        $("#btnEditPhoto").click(function (e) {

            e.preventDefault();

            var formData = new FormData( $("#frmEditImgProfile")[0] );
            formData.append('user_id', userid);
            // formData = {
            //     user_id: userid
            // }

            console.log(formData)

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ url('/profile/edit_photo') }}',
                data: formData,
                type: 'POST',
                enctype: 'multipart/form-data',
                cache: false,
                contentType: false,
                processData: false,

                success: function (data) {

                    if (data.status == true) {
                        $('#EditImgProfile').modal('hide');
                        toastr.success(data.message)
                        window.location.reload();
                    } else {
                        toastr.error(data.message)
                    }

                }

            });

        })

    })

</script>
@endsection