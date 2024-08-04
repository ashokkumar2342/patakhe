@extends('admin.layout.master')
@section('content')
  

    <!--body wrapper start-->
    <div class="wrapper">
        <!-- Trigger the modal with a button -->
        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#unitCreate">Create Unit</button>

        <!-- Modal -->
        <div id="unitCreate" class="modal fade " role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    {!! Form::open(['route'=>'admin.unit.post']) !!}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Modal Header</h4>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12">
                            
                                <div class="form-group">
                                    {!! Form::label('name', 'Name', ['class'=>'control-label']) !!}
                                    {!! Form::text('name', '', ['class'=>'form-control']) !!}
                                    <div class="text-danger">{{ $errors->first('name') }}</div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('unit', 'Unit', ['class'=>'control-label']) !!}
                                    {!! Form::text('unit', '', ['class'=>'form-control']) !!}
                                    <div class="text-danger">{{ $errors->first('unit') }}</div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('weight', 'In Weight', ['class'=>'control-label']) !!}
                                    {!! Form::select('weight', ['0'=>'No','1'=>'Yes'],null, ['class'=>'form-control']) !!}
                                    <div class="text-danger">{{ $errors->first('unit') }}</div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('calculation', 'calculation', ['class'=>'control-label']) !!}
                                    {!! Form::text('calculation', '', ['class'=>'form-control']) !!}
                                    <div class="text-danger">{{ $errors->first('calculation') }}</div>
                                </div>
                            
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" >Create</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div><!-- /Model -->  
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
                            <th>Unit</th>
                            <th>In Weight</th>
                            <th>Calculation</th>
                            <th width="130px">Custom</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($units as $unit)
                        <tr>
                            <td>{{ $unit->id }}</td>
                            <td>{{ $unit->created_at->format('d-m-y') }}</td>
                            <td>{{ $unit->name }}</td>
                            <td>{{ $unit->alias }}</td>
                            <td>{!! ($unit->weight == 1)?'<b class="text-success">Yes</b>':'<b class="text-danger">No</b>' !!}</td>
                            <td>{{ $unit->calculation }}</td>
                            <td>
                                <a href="{{ route('admin.unit.edit',['id'=>$unit->id]) }}"  class="btn btn-primary btn-xs" ><i class="fa fa-pencil"></i></a>
                                @if(Auth::guard('admin')->user()->permission == 1)
                                    <a data-action="delete" data-parent="tr" data-url="{{ route('admin.unit.delete',$unit->id) }}"  class="btn btn-danger btn-xs" ><i class="fa fa-trash-o"></i></a>
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
@if($errors->first())
<script type="text/javascript">
    $('#unitCreate').modal("show");
</script>
@endif
@if($editData)
 <!-- Modal -->
        <div id="unitEdit" class="modal fade " role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    {!! Form::open(['route'=>['admin.unit.update',$editData->id]]) !!}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Modal Header</h4>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12">
                            
                                <div class="form-group">
                                    {!! Form::label('name', 'Name', ['class'=>'control-label']) !!}
                                    {!! Form::text('name', $editData->name, ['class'=>'form-control']) !!}
                                    <div class="text-danger">{{ $errors->first('name') }}</div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('unit', 'Unit', ['class'=>'control-label']) !!}
                                    {!! Form::text('unit', $editData->alias, ['class'=>'form-control']) !!}
                                    <div class="text-danger">{{ $errors->first('unit') }}</div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('weight', 'In Weight', ['class'=>'control-label']) !!}
                                    {!! Form::select('weight', ['0'=>'No','1'=>'yes'],$editData->weight, ['class'=>'form-control']) !!}
                                    <div class="text-danger">{{ $errors->first('unit') }}</div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('calculation', 'calculation', ['class'=>'control-label']) !!}
                                    {!! Form::text('calculation', $editData->calculation, ['class'=>'form-control']) !!}
                                    <div class="text-danger">{{ $errors->first('calculation') }}</div>
                                </div>
                            
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" >Update</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div><!-- /Model -->
<script type="text/javascript">
    $('#unitEdit').modal("show");
</script>
@endif
@endpush