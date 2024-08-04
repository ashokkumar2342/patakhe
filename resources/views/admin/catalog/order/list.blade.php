@extends('admin.layout.master')
@section('content')

    <!--body wrapper start-->
    <div class="wrapper">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <section class="panel">
                    <header class="panel-heading ">
                        Order List
                        <span class="tools pull-right">
                            <a class="fa fa-repeat box-refresh" href="javascript:;"></a>
                            <a class="t-close fa fa-times" href="javascript:;"></a>
                        </span>
                    </header>
                    <table class="table responsive-data-table data-table">
                        <thead>
                            <tr>
                                <th>Sn &nbsp;&nbsp;</th>
                                <th>Date</th>
                                <th>Name</th>
                                <th>Mobile</th>                                
                                <th>Item</th>
                                <th>slot</th>
                                <th width="70px">Status</th>
                                <th width="70px">Custom</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $data)
                                @if($data->user)
                                    <tr>
                                        <td>{{ @$sn=$sn+1 }}</td>
                                        <td>{{ $data->created_at->format('d-M-Y / h:i') }}</td>
                                        <td class="p-name">{{ $data->user->first_name or ' ' }} {{ $data->user->last_name or ' '  }}</td>
                                        <td class="p-name"> {{ $data->user->mobile or ' ' }}</td>
                                        <td>{{ count($data->orderItems) }}</td>
                                        <td class="p-name"> {{ $data->slot }}</td>

                                        
                                        <td>
                                            @if($data->status == 4 || $data->status == 1)
                                            <button data-action="btnStatus" data-url="{{ route('admin.product.order.status',$data->id) }}" data-parent="tr" class="label {{ ($data->status == 4) ?'btn-success':'btn-danger'}} btn btn-xs">{{ ($data->status == 4)? 'Delivered' : 'Pending' }}</button>
                                            @else
                                                <span class="label label-warning">canceled</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.product.order.view',[$data->id]) }}"  title="view" class="btn btn-primary btn-xs tooltips"><i class="fa fa-eye"></i></a>
                                            <a {{ ($data->status == 2 || $data->status == 1)?'disabled':'' }} href="{{ route('admin.product.order.cancel',$data->id) }}" title="Cancel" class="btn btn-warning btn-xs tooltips" ><i class="fa fa-times"></i></a>
                                            @if(Auth::guard('admin')->user()->permission == 1)
                                                <a data-action="delete" title="Delete" data-parent="tr" data-url="{{ route('admin.product.order.delete',$data->id) }}"  class="btn btn-danger btn-xs tooltips" ><i class="fa fa-trash-o"></i></a>
                                            @endif  
                                        </td>                                  
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </section>
            </div>
        </div>
    </div>
    <!--body wrapper end-->

@endsection