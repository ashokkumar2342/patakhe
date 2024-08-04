@extends('admin.layout.master')
@section('content')
    <!--body wrapper start-->
<div class="wrapper">
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading ">
                    Member Request List
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
                            <th>User Name</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th width="100px">Status</th>
                            <th width="100px">Custom</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($members as $member)
                        @if($member->UserDetails)
                            <tr>
                                <td>{{ @$sn=$sn+1 }}</td>
                                <td>{{ $member->created_at }}</td>
                                <td>{{ $member->UserDetails->first_name or ' ' }} {{ $member->UserDetails->last_name or ' '  }}</td>
                                <td class="p-name"> {{ $member->UserDetails->mobile or ' ' }}</td>
                                <td class="p-name"> {{ $member->UserDetails->email or ' ' }}</td>
                                <td>
                                    <span class="label label-{{ ($member->userDetails->status == 1)?'success':'danger' }}">{{ ($member->userDetails->status == 1)? 'Active' : 'Inactive' }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.user.view',$member->user_id) }}" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i>  </a>
                                    <a href="{{ route('admin.member.request.edit',[$member->user_id]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> </a>
                                    <button data-action="delete" data-parent="tr" data-url="{{ route('admin.member.request.delete',$member->id) }}"  class="btn btn-danger btn-xs" ><i class="fa fa-trash-o"></i></button>
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