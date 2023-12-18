@section('title')
    Meal | Index
@endsection

@push('css')
    <!-- BEGIN PAGE LEVEL CUSTOM STYLES -->
    <link href="{{asset('AdminAssets/assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{asset('AdminAssets/assets/css/forms/theme-checkbox-radio.css')}}">
    <link href="{{asset('AdminAssets/assets/css/tables/table-basic.css')}}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL CUSTOM STYLES -->
@endpush

@extends('Admin.Assets.master')

@section('content')

    <!--  BEGIN CONTENT AREA  -->
    <div id="content" class="main-content">
        <div class="container">
            <div class="container">
            <div class="row layout-top-spacing">

                    <div id="tableHover" class="col-lg-12 col-12 layout-spacing">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-header">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <h4>Meal Table</h4>
                                        <a href="{{route('admin.meal.create')}}">
                                            <button class="btn btn-primary">Create Meal</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content widget-content-area">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover mb-4">
                                        <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Type</th>
                                            <th>Image</th>
                                            <th>Update</th>
                                            <th>Delete</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($meals as $meal)
                                                <tr>
                                                    <td>{{$meal->id}}</td>
                                                    <td>{{$meal->name}}</td>
                                                    <td>{{$meal->type}}</td>
                                                    <td>
                                                        <img width="150" src="{{asset($meal->image)}}" alt="meal">
                                                    </td>
                                                    <td>
                                                        <a href="{{route('admin.meal.update',[$meal->id])}}">
                                                            <button class="btn btn-warning">Update</button>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <form action="{{route('admin.meal.delete')}}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="hidden" name="id" value="{{$meal->id}}">
                                                            <input type="submit" class="btn btn-danger" value="Delete">
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr style="text-align: center">
                                                    <td colspan="6">
                                                        <h4>No Data In Meal Table !</h4>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

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
@endpush
