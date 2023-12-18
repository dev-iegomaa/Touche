@section('title')
    Menu | Create
@endsection

@push('css')

    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link href="{{asset('AdminAssets/assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{asset('AdminAssets/assets/css/forms/theme-checkbox-radio.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('AdminAssets/assets/css/forms/switches.css')}}">
    <!--  END CUSTOM STYLE FILE  -->

    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="{{asset('AdminAssets/plugins/file-upload/file-upload-with-preview.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL STYLES -->

    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link rel="stylesheet" type="text/css" href="{{asset('AdminAssets/plugins/bootstrap-select/bootstrap-select.min.css')}}">
    <!--  END CUSTOM STYLE FILE  -->

@endpush

@extends('Admin.Assets.master')

@section('content')

    <!--  BEGIN CONTENT AREA  -->
    <div id="content" class="main-content">
        <div class="container">
            <div class="container">

                <div class="row">

                    <div id="flLoginForm" class="col-lg-12 layout-spacing layout-top-spacing">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-header">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <h4>Create Menu</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content widget-content-area">

                                <form action="{{route('admin.menu.store')}}" method="post">
                                    @csrf
                                    <div class="form-group mb-4">
                                        <input type="text" name="title" value="{{old('title')}}" class="form-control @error('name') is-invalid @enderror" placeholder="Title">
                                    </div>

                                    @error('title')
                                    <div class="alert alert-danger mt-1" role="alert">
                                        <div class="alert-body">
                                            {{ $message }}
                                        </div>
                                    </div>
                                    @enderror

                                    <div class="btn-group bootstrap-select show-tick">

                                        <select name="category_id" class="selectpicker" tabindex="-98">
                                            @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>

                                    </div>

                                    <div class="form-group mb-4">
                                        <input type="text" name="price" value="{{old('price')}}" class="form-control @error('price') is-invalid @enderror" placeholder="Price">
                                    </div>

                                    @error('price')
                                    <div class="alert alert-danger mt-1" role="alert">
                                        <div class="alert-body">
                                            {{ $message }}
                                        </div>
                                    </div>
                                    @enderror

                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Body</span>
                                        </div>
                                        <textarea class="form-control @error('body') is-invalid @enderror" name="body" aria-label="With textarea">{{old('description')}}</textarea>
                                    </div>

                                    @error('body')
                                    <div class="alert alert-danger mt-1" role="alert">
                                        <div class="alert-body">
                                            {{ $message }}
                                        </div>
                                    </div>
                                    @enderror

                                    <button type="submit" class="btn btn-primary mt-4">Send</button>

                                </form>

                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <!--  END CONTENT AREA  -->

@endsection

@push('js')
    <!-- BEGIN PAGE LEVEL CUSTOM SCRIPTS -->
    <script src="{{asset('AdminAssets/plugins/highlight/highlight.pack.js')}}"></script>
    <script src="{{asset('AdminAssets/assets/js/scrollspyNav.js')}}"></script>
    <script>
        checkall('todoAll', 'todochkbox');
        $('[data-toggle="tooltip"]').tooltip()
    </script>
    <!-- END PAGE LEVEL CUSTOM SCRIPTS -->


    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="{{asset('AdminAssets/plugins/file-upload/file-upload-with-preview.min.js')}}"></script>

    <script>
        //First upload
        var firstUpload = new FileUploadWithPreview('myFirstImage')
        //Second upload
        var secondUpload = new FileUploadWithPreview('mySecondImage')
    </script>
    <!-- END PAGE LEVEL PLUGINS -->

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{asset('AdminAssets/plugins/bootstrap-select/bootstrap-select.min.js')}}"></script>
    <!-- END PAGE LEVEL SCRIPTS -->

@endpush
