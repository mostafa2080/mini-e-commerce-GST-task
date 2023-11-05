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
                        <h4 class="page-title">Add Product</h4>
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
                                action="{{ route('store.product') }} ">
                                @csrf

                                <div class="row">
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="inputEmail4" class="form-label">Product Name </label>
                                        <input type="text" name="name" class="form-control" id="name"
                                            placeholder="Add Product">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-6 mb-3">
                                            <label for="inputEmail4" class="form-label">Category Name </label>
                                            <select name="category_id" class="form-select required" id="example-select">
                                                <option value="">Select Category </option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <br>
                                        <div class="row">
                                            <div class="form-group col-md-6 mb-3">
                                                <label for="inputEmail4" class="form-label">Description </label>
                                                <input type="text" name="description" class="form-control"
                                                    id="inputEmail4" placeholder="Add Category">
                                                @error('description')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <br>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-md-6 mb-3">
                                                <label for="inputEmail4" class="form-label">Price </label>
                                                <input type="number" name="price" class="form-control" id="inputEmail4"
                                                    placeholder="Add Category">
                                                @error('price')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <br>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="example-fileinput" class="form-label">Product Image</label>
                                                <input type="file" name="main_image" id="image" class="form-control">
                                                @error('main_image')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div> <!-- end col -->

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="example-fileinput" class="form-label"> </label>
                                                <img id="showImage"
                                                    src="{{ !empty($product->image) ? url('upload/product_images/' . $product->image) : url('upload/no_image.jpg') }} "
                                                    class="rounded-circle avatar-lg img-thumbnail" alt="product_image">
                                            </div>
                                        </div>
                                        <!-- end col -->

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="example-fileinput" class="form-label">Product Gallery</label>
                                                <input type="file" name="images[]" id="images" class="form-control"
                                                    multiple>
                                                @error('images')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div> <!-- end col -->

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="example-fileinput" class="form-label"> </label>
                                                <div id="galleryContainer">
                                                    <!-- Display selected images here -->
                                                </div>
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
                    category_id: {
                        required: true,
                    },
                    description: {
                        required: true,
                    },
                    price: {
                        required: true,
                    },
                    main_image: {
                        required: true,
                    },
                    'images[]': {
                        required: true
                    }
                },
                messages: {
                    name: {
                        required: 'Please Enter Product Name',
                    },
                    category_id: {
                        required: 'Please Select Product Category',
                    },
                    description: {
                        required: 'Please Enter Product Description',
                    },
                    price: {
                        required: 'Please Enter Product Price',
                    },
                    main_image: {
                        required: 'Please Enter Product Description',
                    },
                    'images[]': {
                        required: 'Please Enter Product Gallery Images',
                    },
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

    <script type="text/javascript">
        $(document).ready(function() {
            $('#images').change(function(e) {
                var galleryContainer = $('#galleryContainer');
                galleryContainer.empty(); // Clear existing images

                for (var i = 0; i < e.target.files.length; i++) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        galleryContainer.append('<img src="' + e.target.result +
                            '" class="rounded-circle avatar-lg img-thumbnail" alt="product_image">');
                    }
                    reader.readAsDataURL(e.target.files[i]);
                }
            });
        });
    </script>
@endsection
