@extends('seller.layout.master')
@section('content')
<div class="wrapper">
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading ">
                    Product List
                    <span class="tools pull-right">
                        <a class="fa fa-repeat box-refresh" href="javascript:;"></a>
                        <a class="t-close fa fa-times" href="javascript:;"></a>
                    </span>
                </header>
                <table class="table responsive-data-table data-table">
                    <thead>
                        <tr>
                            <th width="20">Sn</th>
                            <th width="30px">Id</th>
                            <th width="80">Date</th>
                            <th width="60">Image</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th width="80px">Status</th>
                            <th width="70px">Custom</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($SellOnProducts   as $SellOnProduct)
                            @if($SellOnProduct->product)
                            <tr>
                                <td>{{ @$sn=$sn+1 }}</td>
                                <td>{{ $SellOnProduct->product->ukey }}</td>
                                <td>{{ $SellOnProduct->created_at }}</td>
                                <td><img src="{{ route('front.product.image.get',['50','50','80',$SellOnProduct->product->image->first()->name]) }}"></td>
                                <td>{{ $SellOnProduct->product->name }}</td>
                                <td>@foreach($SellOnProduct->product->productOnCategory as $key=>$productOnCategory) {{ ($key==0)?'':', ' }}{{ App\Model\Catalog\Category::find($productOnCategory->cid)->name }}  @endforeach</td>
                                <td><button data-action="btnStatus" data-url="{{ route('seller.sop.status',$SellOnProduct->id) }}" data-parent="tr" class="label {{ ($SellOnProduct->status == 1) ?'btn-success':'btn-danger'}} btn btn-xs">{{ ($SellOnProduct->status == 1)? 'Active' : 'Inactive' }}</button></td>
                                
                                <td>
                                    <a href="{{ route('seller.product.view',[$SellOnProduct->id]) }}" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i></a>
                                    <a href="{{ route('seller.sop.edit',[$SellOnProduct->id]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i></a>
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
