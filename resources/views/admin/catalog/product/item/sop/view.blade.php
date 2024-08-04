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
                        <tr><th>Category  </th><td> &nbsp;&nbsp; : &nbsp;&nbsp;  @foreach($product->productOnCategory as $category) {{  App\model\Catalog\Category::find($category->cid)->name }} @endforeach</td></tr>
                        <tr><th>In Weight </th><td> &nbsp;&nbsp; : &nbsp;&nbsp; {{ ($product->weight == 1)?'Yes':'No' }}</td></tr>
                        <tr><th>MSP </th><td> &nbsp;&nbsp; : &nbsp;&nbsp; {{ $sop->msp  }}</td></tr>
                        <tr><th>Stock </th><td> &nbsp;&nbsp; : &nbsp;&nbsp; {{ $sop->stock }}</td></tr>
                        <tr><th>Expire </th><td> &nbsp;&nbsp; : &nbsp;&nbsp; {{ $sop->expire }}</td></tr>
                        <tr><th>Description </th><td> &nbsp;&nbsp; : &nbsp;&nbsp; {{ $productItem->description }}</td></tr>
                        <tr><th>Keywords </th><td> &nbsp;&nbsp; : &nbsp;&nbsp; {{ $productItem->keywords }}</td></tr>
                    </table>
                </div>
                <div class="col-md-4">
                    {!! Form::open(['route'=>['admin.product.special.add',$sop->ukey]]) !!}
                        {!! Form::select('add', [], '', ['class'=>'form-control']) !!}
                        <button class="btn btn-sm"></button>
                    {!! Form::close() !!}
                    
                </div>
            </div>
        </div>
    </div>
    <br>
       
 
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