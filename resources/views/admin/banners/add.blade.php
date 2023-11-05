@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                            </ol>
                        </div>
                        <h4 class="page-title">Add Banner</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <!-- Form row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <form id="myForm" method="post" enctype="multipart/form-data"
                                action="{{ route('store.banner') }} ">
                                @csrf

                                <div class="row">
                                    <div class="form-group col-md-8 mb-3">
                                        <label for="inputEmail4" class="form-label">Section Name </label>
                                        <input type="text" name="section" class="form-control" id="name"
                                            placeholder="Add Banner">
                                        @error('section')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label for="example-fileinput" class="form-label">Banner Image</label>
                                            <input type="file" name="image" id="image" class="form-control">
                                            @error('image')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div> <!-- end col -->

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="example-fileinput" class="form-label"> </label>
                                            <img id="showImage"
                                                src="{{ !empty($banner->image) ? url('upload/banner_images/' . $banner->image) : url('upload/no_image.jpg') }} "
                                                class="rounded-circle avatar-lg img-thumbnail" alt="banner_image">
                                        </div>
                                    </div> <!-- end col -->




                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Save
                                        Changes</button>

                            </form>

                        </div> <!-- end card-body -->
                    </div> <!-- end card-->
                </div> <!-- end col -->
            </div>
            <!-- end row -->



        </div> <!-- container -->

    </div> <!-- content -->

    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    name: {
                        required: true,
                    },
                    image: {
                        required: true,
                    },
                    description: {
                        required: true,
                    },
                },
                messages: {
                    section: {
                        required: 'Please Enter Banner Section Name ',
                    },
                    image: {
                        required: 'Please Enter Banner Image',
                    }
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endsection
