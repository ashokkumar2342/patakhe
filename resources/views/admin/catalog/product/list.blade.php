@extends('admin.layout.master')
@section('content')
    <!--body wrapper start-->
<div class="wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-body">
                    <button onclick="addData()" class="btn btn-info">Special Product</button>
                    <a onclick="addData()" class="btn btn-success">Special Product</a>
                    <button class="btn btn-danger pull-right">Do Action</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <section class="panel">
                <header class="panel-heading ">
                    Product List <span style="margin-left:100px">{!! Form::select('action', ['a'=>'Special product','2'=>'Feature product','3'=>'Delete'], '', ['placeholder'=>'Action']) !!}</span>
                    <span class="tools pull-right">
                        <a class="fa fa-repeat box-refresh" href="javascript:;"></a>
                        <a class="t-close fa fa-times" href="javascript:;"></a>
                    </span>
                </header>

                
                    
                <form id="itemForm">  
                <table class="table responsive-data-table data-table">
                    <thead>
                        <tr>
                            <th>Sn &nbsp;&nbsp;</th>
                            <th></th>
                            <th>Date</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>MRP</th>
                            <th>Category</th>
                            <th>Custom</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                        @foreach($products as $product)
                            <tr>
                                <td>{{ @$sn=$sn+1 }}</td>
                                <td><input type="checkbox" name="items[]" value="{{ $product->id }}"></td>
                                <td>{{ $product->created_at }}</td>
                                <td><img src="{{ route('front.product.image.get',['50','50','80',$product->image->first()->name]) }}"></td>
                                <td class="p-name">{{ $product->name }} </td>
                                <td>{{ $product->mrp }}</td>
                                <td>@foreach(App\Model\Catalog\ProductOnCategory::where('pid',$product->id)->get() as $key=>$ProductOnCategory){{ ($key==0)?'':', ' }}{{ App\Model\Catalog\Category::find($ProductOnCategory->cid)->name }}  @endforeach</td>
                                <td><a href="{{ route('admin.product.view',$product->id) }}" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i></a></td>
                            </tr>
                        @endforeach
                    
                    </tbody>
                </table>
                </form>
            </section>
        </div>
    </div>
</div>

    <!--body wrapper end-->

@endsection
@push('scripts')
    <script type="text/javascript">
        function addData(url){
            axios.put(url,$('#itemForm input[name="items[]"]').serialize()).then(response => {
                if (response.data.status === 'OK' ) {
                    if(response.data.message){
                        toastr.success(response.data.message); 
                    }
                }
                else{
                    if(response.data.message){
                        toastr.error(response.data.message); 
                    }
                }                
            }).catch(error=> {
                toastr.error('Whoops, looks like something went wrong ! Try again ...'); 
            });
        }   
    </script>
@endpush
