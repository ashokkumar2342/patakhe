@extends('admin.layout.master')

@section('content')
    <!--body wrapper start-->
    <div class="wrapper">
       <div class="row">
            <div class="col-md-3">
                <a class="btn btn-warning" href="{{ route('admin.category.special.form') }}">+ New Category</a>
                <br><br>
                
                <div class="tree" id="category">
                    @foreach(App\Model\Catalog\Category::where('type',2)->get() as $specialCategory1)
                           <ul>
                               <li ><a href="{{ route('admin.category.special.edit',$specialCategory1->ukey) }}">{{ $specialCategory1->name }}</a></li>
                           </ul>
                    @endforeach                  
                </div>
            </div>
            <div class="col-md-9" style="border-left:1px solid #aaa" >
                
                <h2 class="bg-primary" style="padding:9px">Create Special Category</h2>
                <hr>
                {!! Form::open(['route'=>['admin.category.special.update',$specialCategory->id],'method'=>'put']) !!}
                    <div class="form-group clearfix">
                        <div class="row">
                            <div class="col-md-3 col-md-offset-1">Name</div>
                            <div class="col-md-7">
                                {!! Form::text('name', $specialCategory->name, ['class'=>'form-control','required']) !!}
                                @if($errors->has('name'))<p class="text-danger">{{ $errors->first('name') }}</p> @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="row">
                            <div class="col-md-3 col-md-offset-1">Title</div>
                            <div class="col-md-7">
                                {!! Form::text('title', $specialCategory->title, ['class'=>'form-control','required']) !!}
                                @if($errors->has('title'))<p class="text-danger">{{ $errors->first('title') }}</p> @endif
                            </div>
                        </div>
                    </div>
                  
                    <div class="form-group clearfix">
                        <div class="row">
                            <div class="col-md-3 col-md-offset-1">Keywords</div>
                            <div class="col-md-7">
                                {!! Form::textarea('keywords', $specialCategory->keywords, ['class'=>'form-control','required', 'style'=>'resize: none', 'rows'=>'4']) !!}
                                @if($errors->has('keywords'))<p class="text-danger">{{ $errors->first('keywords') }}</p> @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="row">
                            <div class="col-md-3 col-md-offset-1">Description</div>
                            <div class="col-md-7">
                                {!! Form::textarea('description', $specialCategory->description, ['class'=>'form-control','required', 'style'=>'resize: none', 'rows'=>'4']) !!}
                                @if($errors->has('description'))<p class="text-danger">{{ $errors->first('keywords') }}</p> @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="row">
                            <div class="col-md-3 col-md-offset-1">Is Active</div>
                            <div class="col-md-7">
                                {!! Form::select('status', ['0' => 'no', '1' => 'yes'], $specialCategory->status, ['class' => 'form-control']) !!}
                                @if($errors->has('status'))<p class="text-danger">{{ $errors->first('status') }}</p> @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="row">
                            <div class="col-md-3 col-md-offset-1">Type</div>
                            <div class="col-md-7">
                                {!! Form::select('type', ['1' => 'Special Offer', '2' => 'Home Left', '3' => 'Home Right'], $specialCategory->type, ['class' => 'form-control','placeholder'=>'Pick a category type']) !!}
                                @if($errors->has('type'))<p class="text-danger">{{ $errors->first('type') }}</p> @endif
                           </div>
                        </div>
                    </div>
                    <div class="col clearfix"><div class="pull-right"><button class="btn btn-danger" data-action="resetForm" type="reset"> Reset </button>&nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-success" type="submit"> Update category </button></div></div>
                {!! Form::close() !!}
            </div>
       </div>
    </div>
    <!--body wrapper end-->
@endsection
