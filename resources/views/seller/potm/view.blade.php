@extends('seller.layout.master')

@section('content')  
    <!--body wrapper start-->
    <div class="wrapper" style="min-height: 1000px">
        <div class="row">
            <div class="col-md-12 ">
                <div class="panel panel-info">
                   
                    <div class="panel-body">
                        <div class="col-md-12">
                            <div class="col-md-3">
                                <img  src="{{ route('front.product.image.get',['200','300','100',$productOfTheMonth->sellOnProduct->product->image->first()->name]) }}">
                            </div>
                            <div class="col-md-9">
                                <h2> {{ $productOfTheMonth->sellOnProduct->product->name }}</h2>
                                <table class="table">
                                    <tr><th>Category  </th><td>  : </td><td> @foreach($productOfTheMonth->sellOnProduct->product->productOnCategory as $category) {{  App\model\Catalog\Category::find($category->cid)->name }} @endforeach</td></tr>
                                    <tr><th>Price </th><td>  :  </td><td> {{ $productOfTheMonth->sellOnProduct->product->mrp }}</td></tr>
                                    
                                    <tr><th>Description </th><td>  :</td><td>  {{ $productOfTheMonth->sellOnProduct->product->description }}</td></tr>
                                </table>
                             
                                @if($sellOnProduct = $productOfTheMonth->sellOnProduct->product->sellerSellOnProduct)
                                    <table>
                                    <tr><th>Your Price  </th><td> &nbsp;&nbsp; : &nbsp;&nbsp;  {{ $sellOnProduct->msp }}</td></tr>
                                    <tr><th>Stock </th><td> &nbsp;&nbsp; : &nbsp;&nbsp; {{ $sellOnProduct->stock }}</td></tr>
                                    @if($sellOnProduct->sku)<tr><th>sku </th><td> &nbsp;&nbsp; : &nbsp;&nbsp; {{ $sellOnProduct->sku }}</td></tr>
                                    @endif
                                    <tr><th>Status </th><td> &nbsp;&nbsp; : &nbsp;&nbsp; <button data-action="btnStatus" data-url="{{ route('seller.potm.status',$productOfTheMonth->id) }}" data-parent="tr" class="label {{ ($productOfTheMonth->status == 1) ?'btn-success':'btn-danger'}} btn btn-xs">{{ ($productOfTheMonth->status == 1)? 'Active' : 'Inactive' }}</button></td></tr>
                                </table>
                                @else
                                <br><br>
                                    <div class="col-md-12">
                                        {!! Form::open(['route'=>['seller.sop.create.post',$product->ukey],'method'=>'put','rol'=>'form']) !!}
                                            <div class="form-group clearfix">
                                                <div class="row">
                                                    <div class="col-md-2"><label>Price</label></div>
                                                    <div class="col-md-6">
                                                        {!! Form::number('price', '', ['class'=>'form-control','required']) !!}
                                                        @if($errors->has('price'))<p class="text-danger">{{ $errors->first('price') }}</p> @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group clearfix">
                                                <div class="row">
                                                    <div class="col-md-2"><label>Stock</label></div>
                                                    <div class="col-md-6">
                                                        {!! Form::number('stock', '', ['class'=>'form-control','required']) !!}
                                                        @if($errors->has('stock'))<p class="text-danger">{{ $errors->first('stock') }}</p> @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group clearfix">
                                                <div class="row">
                                                    <div class="col-md-2"><label>SKU</label></div>
                                                    <div class="col-md-6">
                                                        {!! Form::text('sku', '', ['class'=>'form-control','required']) !!}
                                                        @if($errors->has('sku'))<p class="text-danger">{{ $errors->first('sku') }}</p> @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group clearfix">
                                                <div class="row">
                                                    <div class="col-md-2"><label>Status</label></div>
                                                    <div class="col-md-6">
                                                        {!! Form::select('status', ['0' => 'no', '1' => 'yes'], null, ['class' => 'form-control']) !!}
                                                        @if($errors->has('status'))<p class="text-danger">{{ $errors->first('status') }}</p> @endif
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="form-group clearfix">
                                                <div class="row">
                                                    <div class="col-md-2"><label>Status</label></div>
                                                    <div class="col-md-6">
                                                        <button class="btn btn-success">Sell On This Product</button>
                                                    </div>
                                                </div>
                                            </div>  
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                @endif
                            </div>                         
                        </div>
                       
                       </div>

                    </div>
                </div>
            </div>
            
        </div>

    </div>
    <!--body wrapper end-->

@endsection
