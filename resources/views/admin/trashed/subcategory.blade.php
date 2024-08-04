@extends('admin.layout.master')
@section('content')
    <!-- page head start-->
    <div class="page-head">
        <h3>
           Sub Category List
        </h3>
        <div class="state-information">
            <div class="state-graph">
                <a href="{{ route('admin.trash.category.list') }}" class="btn btn-danger btn-sm"><i class="fa fa-trash-o " style="font-size: 1.2em"> Trash <span class="badge">{{ App\Category::onlyTrashed()->count() }}</span> </i></a> 
            </div>
        </div>
    </div>

    <!-- page head end-->

    <!--body wrapper start-->
    <div class="wrapper">
@include('admin.include.message')
        <header class="panel-heading">
          All Sub Category List
          <span class="pull-right">
              <button type="button" id="loading-btn" class="btn btn-warning btn-xs"><i class="fa fa-refresh"></i> Refresh</button>
              <a href="{{ route('admin.subcategory.form') }}" class=" btn btn-success btn-xs"> Create Categories</a>
          </span>
        </header>
        <div class="panel-body">
            <div class="row">
              <div class="col-md-12">
                  <div class="input-group"><input type="text" placeholder="Search Here" class="input-sm form-control"> <span class="input-group-btn">
                  <button type="button" class="btn btn-sm btn-success"> Go!</button> </span></div>
              </div>
          </div>
        </div>
        <table class="table table-hover p-table table-responsive">
            <thead>
                <tr>
                    <th width="50px">Id</th>
                    <th width="150px">Date</th>
                    <th>Name</th>
                    <th>Title</th>
                    <th width="100px">Action</th>
                    <th width="100px">Custom</th>
                </tr>
            </thead>
            <tbody>
            @foreach($SubCategories as $SubCategory)
                <tr>
                    <td>{{ $SubCategory->id }}</td>
                    <td>{{ $SubCategory->created_at }}</td>
                    <td>{{ $SubCategory->productmenu }}</td>
                    <td >{{ $SubCategory->name }}</td>
                    <td >{{ $SubCategory->title }}</td>
                    <td>
                        <a href="javascript:;"  onclick="event.preventDefault(); document.getElementById('r{{ $SubCategory->id }}').submit();" class="btn btn-danger btn-xs", ></i> Restore </a>
                        {!! Form::open(['route'=>['admin.trash.category.restore',$SubCategory->id],'method'=>'put','class'=>'hidden',  'id'=>'r'.$SubCategory->id]) !!}

                        {!! Form::close() !!}
                    </td>
                    <td>
                        <a href="javascript:;"  onclick="event.preventDefault(); document.getElementById('d{{ $SubCategory->id }}').submit();" class="btn btn-danger btn-xs", ><i class="fa fa-trash-o"></i>  </a>
                        {!! Form::open(['route'=>['admin.trash.category.delete',$SubCategory->id],'method'=>'delete','class'=>'hidden',  'id'=>'d'.$SubCategory->id]) !!}

                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table> 
        <div class="row">
            <div class="col-md-12">
                {{ $SubCategories->links() }}
            </div>
        </div>
    </div>
    <!--body wrapper end-->

@endsection