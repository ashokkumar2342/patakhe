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
                            <th width="30">Sn</th>
                            <th width="30px">Id</th>
                            <th width="80">Date</th>
                            <th width="60">Image</th>
                            <th>Name</th>
                            <th>Category</th>
                            
                            <th width="100px">Custom</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products   as $product)
                            <tr>
                                <td>{{ @$sn = $sn+1 }}</td>
                                <td>{{ $product->ukey }}</td>
                                <td>{{ $product->created_at }}</td>
                                <td><img src="{{ route('front.product.image.get',['50','50','80',@$product->image->first()->name]) }}"></td>
                                <td>{{ $product->name }}</td>
                                <td>@foreach($product->productOnCategory as $key=>$productOnCategory) {{ ($key==0)?'':', ' }}{{ App\Model\Catalog\Category::find($productOnCategory->cid)->name }}  @endforeach</td>
                                
                                <td>
                                    <a href="{{ route('seller.product.view',[$product->ukey]) }}" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i></a>
                                   
                                    <a href="{{ route('seller.product.edit',[$product->ukey]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i></a>

                                </td>
                               
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </section>
        </div>

    </div>
</div>
   
                   

@endsection
