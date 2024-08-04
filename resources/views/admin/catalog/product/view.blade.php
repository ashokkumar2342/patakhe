@extends('admin.layout.master')
@push('links')
 <!--bootstrap picker-->
    <link rel="stylesheet" type="text/css" href="{{ asset('js/bootstrap-datetimepicker/css/datetimepicker.css') }}"/>
@endpush
@section('content')  
    <!--body wrapper start-->
    <div class="wrapper" style="min-height: 1000px">
        <div class="row">
            <div class="col-md-12 ">
                <div class="panel panel-info">                   
                    <div class="panel-body">
                        <div class="col-md-12">
                            <div class="col-md-3">
                                <img  src="{{ route('front.product.image.get',['230','300','100',$product->image->first()->name]) }}">
                            </div>
                            <div class="col-md-9">
                                <h2> {{ $product->name }}</h2>
                                <table class="table">
                                    <tr><th>Category  </th><td>  : </td><td> @foreach($product->productOnCategory as $category) {{  App\Model\Catalog\Category::find($category->cid)->name }} @endforeach</td></tr>
                                    <tr><th>Price </th><td>  :  </td><td> {{ $product->mrp }}</td></tr>
                                    
                                    <tr><th>Description </th><td>  :</td><td>  {{ $product->description }}</td></tr>
                                </table>
                                <table class="table responsive-data-table data-table">
                                    <thead>
                                        <tr>
                                            <th width="30px">Sn</th>
                                            <th width="80">Date</th>
                                            <th width="60">Image</th>
                                            <th>Qty</th>
                                            <th>Product price</th>
                                            <th>Selling Unit</th>
                                            <th width="150px">Custom</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($product->productItem as $productItem)
                                            <tr>
                                                <td>{{ @$sn=$sn+1 }}</td>
                                                <td>{{ $productItem->created_at->format('d-m-Y') }}</td>
                                                <td><img src="{{ route('front.product.image.get',['50','50','80',($productItem->image->first())?$productItem->image->first()->name : $product->image->first()->name]) }}"></td>
                                                <td>{{ $productItem->qty }} {{ $productItem->unit->name }} ({{ $productItem->unit->alias }})</td>
                                                <td>{{ $productItem->mrp }}</td>
                                                <td>{{ $productItem->saleUnit->name }}</td>
                                                <td>
                                                    <a href="{{ route('admin.product.item.view',[$product->ukey,$productItem->ukey]) }}" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i></a>
                                                    <a href="{{ route('admin.product.item.delete',[$product->ukey,$productItem->ukey]) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
                                                   
                                                        
                                                </td>
                                               
                                                
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>                                  
                            </div>                         
                        </div>                       
                    </div><!--/panel body -->
                </div><!--/panel -->
            </div>
        </div>        
    </div>
    <!--body wrapper end-->
@endsection
@push('scripts')
<script src="{{ asset('js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/form-validation-init.js')}}" type="text/javascript"></script>
<!--bootstrap picker-->
<script type="text/javascript" src="{{ asset('js/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js') }}"></script>
<!--picker initialization-->
<script src="{{ asset('js/picker-init.js')}}"></script>
@endpush