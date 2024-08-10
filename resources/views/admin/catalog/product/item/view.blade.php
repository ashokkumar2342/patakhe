@extends('admin.layout.master')
@section('content')
<div class="wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-4"><img src="{{ route('front.product.image.get',['250','250','70',($product->image->first())?$product->image->first()->name : 'blank.jpg']) }}"></div>
            <div class="col-md-8">
                <div class="col-md-8">
                    <table class="">
                        <tr><th>Product Name </th><td> &nbsp;&nbsp; : &nbsp;&nbsp; {{ $product->name }}({{ $productItem->qty.' '.$productItem->unit->alias }})</td></tr>
                        <tr><th>Category  </th><td> &nbsp;&nbsp; : &nbsp;&nbsp;  @foreach($product->productOnCategory as $category) {{  App\Model\Catalog\Category::find($category->cid)->name }} @endforeach</td></tr>
                        <tr><th>In Weight </th><td> &nbsp;&nbsp; : &nbsp;&nbsp; {{ ($product->weight == 1)?'Yes':'No' }}</td></tr>
                        <tr><th>Description </th><td> &nbsp;&nbsp; : &nbsp;&nbsp; {{ $productItem->description }}</td></tr>
                        <tr><th>Keywords </th><td> &nbsp;&nbsp; : &nbsp;&nbsp; {{ $productItem->keywords }}</td></tr>
                    </table>
                </div>
                <div class="col-md-4">
                    <a class="btn btn-warning btn-sm" href="{{ route('admin.product.view',[$product->ukey]) }}" >Sale in this category</a>
                    
                </div>
            </div>
        </div>
    </div>
    <br>
       
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading ">
                    Product Item List
                    <span class="tools pull-right">
                        <a class="fa fa-repeat box-refresh" href="javascript:;"></a>
                        <a class="t-close fa fa-times" href="javascript:;"></a>
                    </span>
                </header>
                <table class="table responsive-data-table data-table">
                    <thead>
                        <tr>
                            <th width="30px">Sn</th>
                            <th width="80">Date</th>
                            <th width="60">msp (rs)</th>
                            <th>stock</th>
                            <th>expire</th>
                            <th width="70px">Custom</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(App\Model\Catalog\SellOnProduct::where(['iid'=>$productItem->id])->get() as $sop)
                            <tr>
                                <td>{{ @$sn=$sn+1 }}</td>
                                <td>{{ $sop->created_at->format('d-m-Y') }}</td>
                                <td>{{ $sop->msp }}</td>
                                <td>{{ $sop->stock }}</td>
                                <td>{{ date('d-m-Y h:m:i',strtotime($sop->expire)) }}</td>
                                <td>
                                    <a href="{{ route('admin.product.item.sop.view',[$product->ukey,$productItem->ukey,$sop->ukey]) }}" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i></a>


                                    
                                   
                                   
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
@push('scripts')
    <!--select2-->
    <script src="{{ asset('js/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js') }}"></script>
    <!--select2 init-->
    <script type="text/javascript">
       
        $(".form_datetime-component").datetimepicker({
            format: "dd MM yyyy - hh:ii",
            autoclose: true,
            todayBtn: true,
            pickerPosition: "bottom-left"
        });
      
    </script>
@endpush
@push('links')
    <link href="{{asset ('js/bootstrap-datetimepicker/css/datetimepicker.css') }}" rel="stylesheet">
@endpush