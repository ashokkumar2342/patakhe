@extends('admin.layout.master')
@section('content')


    <!--body wrapper start-->
    <div class="wrapper">
        <div id="createColor" class="collapse in row">
            <div class="panel col-md-6 col-md-offset-3 ">
                <div class="panel-heading">Update Color</div>
                <div class="panel-body">
                {!! Form::open(['route'=>['admin.color.update',$color->id]]) !!}
                     <div class="form-group">
                        {!! Form::label('name', 'Name', ['class'=>'control-label']) !!}
                        {!! Form::text('name', $color->name, ['class'=>'form-control']) !!}
                        <div class="text-danger">{{ $errors->first('name') }}</div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('code', 'Code', ['class'=>'control-label']) !!}
                        <div class="input-group colorpicker-default colorpicker-component">
                            <input type="text"  value="{{ (old('code'))?old('code'):$color->code }}" name="color" class="form-control">
                            <span class="input-group-addon"><i></i></span>
                        </div>
                        <div class="text-danger">{{ $errors->first('code') }}</div>
                    </div>
                    <button type="submit" class="btn btn-primary" >Update</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <!-- Modal -->
      
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"></h3>
            </div>
            <div class="panel-body">
                 <table class="table responsive-data-table data-table">
                    <thead>
                        <tr>
                            <th>Id &nbsp;&nbsp;</th>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Color</th>
                            <th width="130px">Custom</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($colors as $color)
                        <tr>
                            <td>{{ $color->id }}</td>
                            <td>{{ $color->created_at->format('d-m-y') }}</td>
                            <td>{{ $color->name }}</td>
                            <td>{{ $color->code }}</td>
                            <td><button style="background: {{ $color->code }};padding: 10px; border: none"></button></td>
                            <td>
                                <a href="{{ route('admin.color.edit',['id'=>$color->id]) }}"  class="btn btn-primary btn-xs" ><i class="fa fa-pencil"></i></a>
                                @if(Auth::guard('admin')->user()->permission == 1)
                                    <a data-action="delete" data-parent="tr" data-url="{{ route('admin.color.delete',$color->id) }}"  class="btn btn-danger btn-xs" ><i class="fa fa-trash-o"></i></a>
                                @endif 
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>      
    </div>
    <!--body wrapper end-->
    
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('js/bootstrap-colorpicker/js/bootstrap-colorpicker.js') }}"></script>
    <script type="text/javascript">
        $('.colorpicker-default').colorpicker({
            format: 'hex'
        });
    </script>
@endpush

@push('links')
    <link rel="stylesheet" type="text/css" href="{{ asset('js/bootstrap-colorpicker/css/colorpicker.css') }}"/>
@endpush
