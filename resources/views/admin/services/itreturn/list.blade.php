@extends('admin.layout.master')
@section('content')
    <!--body wrapper start-->
<div class="wrapper">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <section class="panel">
                <header class="panel-heading ">
                    It Return Request List
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
                            <th>Email</th>
                            <th width="80px">Status</th>
                            <th width="80px">Custom</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($itreturns as $data)
                        @if($data->user)
                            <tr>
                                <td>{{ @$sn=$sn+1 }}</td>
                                <td>{{ $data->created_at }}</td>
                                <td class="p-name">{{ $data->user->first_name or ' ' }} {{ $data->user->last_name or ' '  }}</td>
                                <td class="p-name"> {{ $data->user->mobile or ' ' }}</td>
                                <td class="p-name"> {{ $data->user->email or ' ' }}</td>
                                <td>
                                    <button data-action="btnStatus" data-url="{{ route('admin.services.itreturn.status',$data->id) }}" data-parent="tr" class="label {{ ($data->status == 1) ?'btn-success':'btn-danger'}} btn btn-xs">{{ ($data->status == 1)? 'Done' : 'Pending' }}</button>
                                </td>
                                <td>
                                    <a href="{{ route('admin.services.itreturn.view',[$data->id]) }}" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i></a>
                                    @if(Auth::guard('admin')->user()->permission == 1)
                                        <a data-action="delete" data-parent="tr" data-url="{{ route('admin.services.itreturn.delete',$data->id) }}"  class="btn btn-danger btn-xs" ><i class="fa fa-trash-o"></i></a>
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

@endsection
