@extends('front.layout.main')
@section('breadcrumb')
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="{{ route('front.home') }}">Home</a></li>
                <li class='active'>Cart</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

@endsection
@section('content')

<div class="row ">
    <div class="shopping-cart">
        <div class="shopping-cart-table ">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="cart-description item">Image</th>
                            <th class="cart-product-name item">Product Name</th>
                            <th class="cart-sub-total item">Price</th>
                            <th class="cart-qty item">Quantity</th>
                            <th class="cart-total last-item">Grandtotal</th>
                            <th class="cart-romove item">Remove</th>
                        </tr>
                    </thead><!-- /thead -->
                 
                    <tbody>
                        @if(Session::has('cart'))
                            @foreach($items as $item)
                                @if(@App\Model\Catalog\Product::find($item['pid']))
                                    @php                                        
                                        @$product = App\Model\Catalog\Product::find($item['pid']);
                                        @$productItem = App\Model\Catalog\ProductItem::find($item['iid']);
                                        @$sop = App\Model\Catalog\SellOnProduct::find($item['sop']);
                                        @$cartimgname = $product->image->first()->name;
                                        if($productItem->saleUnit->weight){
                                            $qty1 = implode('.',$item['qty']);
                                            $item['qty']['sv'] = str_pad($item['qty']['sv'], 3, '0', STR_PAD_LEFT);
                                            $qty2 = implode('.',$item['qty']);
                                        }else{
                                            $qty1 = $item['qty'];
                                            $qty2 = $item['qty'];
                                        }
                                        
                                    @endphp
                                    <tr>
                                        <td class="cart-image">
                                            <a class="entry-thumbnail" href="">
                                                <img  
                                                    src="{{ route('front.product.image.get',['50','50','20',$cartimgname]) }}" 
                                                    data-echo="{{ route('front.product.image.get',['50','50','90',$cartimgname]) }}"  
                                                    alt="{{ $product->name }}" 
                                                >
                                            </a>
                                        </td>
                                        
                                        <td class="cart-product-name-info">
                                            <h4 class='cart-product-description'>
                                                <a href="{{ route('front.product.details',[
                                                  $product->name,
                                                  $product->productOnCategory->first()->category->name,
                                                  $product->productOnCategory->first()->category->ukey,
                                                  $productItem->ukey,
                                                  $product->ukey,
                                                ]) }}">{{ $product->name }}({{$productItem->qty.' '.$productItem->unit->alias }})</a>
                                            </h4>
                                           
                                           
                                        </td>
                                        
                                        <td align="center">{{ $sop->msp }} </td>
                                        <td class="cart-product-quantity">
                                            @if($productItem->saleUnit)
                                                <div class=""> {{ $qty1 }} {{ $productItem->saleUnit->alias }}</div>
                                            @else
                                                <div>{{ $item['qty']}} {{ $product->mesurement->alias }}</div>
                                            
                                            @endif
                                            
                                        </td>
                                        <td class="cart-product-grand-total">
                                            <span class="cart-grand-total-price">
                                                
                                                    @if($productItem->unit->alias == 'gm' && $productItem->saleUnit->alias == 'kg' || $productItem->unit->alias == 'ml' && $productItem->saleUnit->alias == 'ltr') 
                                                        {{ $grandTotal = $sop->msp*(($qty2*1000)/$productItem->qty) }}
                                                    @elseif($productItem->unit->alias == 'pcs' && $productItem->saleUnit->alias == 'pcs')
                                                        {{ $grandTotal =($sop->msp/$productItem->qty)*$qty2 }}
                                                    @else
                                                    {{ $grandTotal = $sop->msp*$qty2 }}
                                                    @endif
                                            </span>
                                        </td>
                                        <td class="romove-item">
                                        {!! Form::open(['route'=>['front.cart.delete',encrypt($productItem->id)],'method'=>'put']) !!}
                                            <button title="remove" type="submit" class="icon btn btn-link"><i class="fa fa-trash-o"></i></button>
                                        {!! Form::close() !!}
                                        </td>
                                    </tr>
                                    @php
                                    @$totalPrice+=$grandTotal;
                                    @endphp
                                @else
                                    @php
                                        $cartRem = new App\Front\Catalog\CartController(); 
                                        $cartRem->destroy($item['pid']);
                                    @endphp
                                @endif
                           @endforeach
                       @else
                       <td colspan="6" class="text-center"><h4 class="text-danger">Cart Empty</h4></td>
                       @endif
                    </tbody><!-- /tbody -->
                </table><!-- /table -->
            </div>
        </div><!-- /.shopping-cart-table -->                

        <div class="col-md-12 col-sm-12 cart-shopping-total">
            <table class="table">
                <thead>
                    <tr>
                        <th colspan="2">
                            
                            <div class="cart-grand-total">
                                @if(Session::has('cart'))Total<span class="inner-left-md"><i class="fa fa-inr"></i> {{ round($totalPrice)}}</span>@endif
                            </div>
                        </th>
                    </tr>
                </thead><!-- /thead -->
               
                        
                            
                
            </table><!-- /table -->
            <div class="col-md-8">
                <br>
                <a href="{{ route('front.home') }}" class="btn btn-upper btn-primary outer-left-xs">Continue Shopping</a>
                
            </div>
            <div class="col-md-4">
                <div class="cart-checkout-btn">
                    @if(Session::has('cart'))
                            <br>
                        <a href="{{ route('front.cart.checkout.form') }}" class="btn btn-primary checkout-btn"><i class="fa fa-credit-card-alt" aria-hidden="true"></i> PROCCED TO CHEKOUT</a>
                    @endif
                </div>
            </div>
        </div><!-- /.cart-shopping-total -->            
    </div><!-- /.shopping-cart -->
</div> <!-- /.row -->
      
@endsection
@push('scripts')
<script type="text/javascript">
    function updateKg(event){
        return false;
    }
    function updateKg(event){
        return false;
    }
</script>
@endpush