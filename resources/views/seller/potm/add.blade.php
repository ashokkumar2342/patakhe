@extends('seller.layout.master')
@push('links')
<link rel="stylesheet" type="text/css" href="{{ asset('js/vakata-jstree/tree.css') }}">
<link href="{{ asset('css/select2.css') }}" rel="stylesheet">
<link href="{{ asset('css/select2-bootstrap.css') }}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ asset('js/bootstrap-datetimepicker/css/datetimepicker.css') }}"/>

<style type="text/css">
#output{
    width: 100%;
}
.imageThumb {
  max-height: 75px;
  border: 2px solid;
  padding: 1px;
  cursor: pointer;
}
.pip {
  display: inline-block;
  margin: 10px 10px 0 0;
}
.remove {
  display: block;
  background: #444;
  border: 1px solid black;
  color: white;
  text-align: center;
  cursor: pointer;
}
.remove:hover {
  background: white;
  color: black;
}
.categoryTree{
    position: absolute;
    background: #fff;
    border: 1px solid #aaa;
    max-height: 100px;
    overflow-y: auto;
    margin-top: -10px;
    width: 86%;
    display: none;
    z-index: 100;

}
.catText{
    background: #00f;
    padding: 3px;
    margin-right: 5px;
}
</style>
@endpush
@section('content')  
    <!--body wrapper start-->
    <div class="wrapper" style="min-height: 1000px">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Add Product of the month</h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            {!! Form::open(['route'=>'seller.potm.create.post','method'=>'put','class'=>'validate cmxform','files'=>true]) !!}
                            
                            <div class="form-group clearfix">
                                <label class="col-lg-3 col-md-4 control-label">Category Select</label>
                                <div class="col-lg-9 col-md-8">
                                    <input type="hidden" id="categoryId" name="catId">
                                    <div class="input-group m-b-10">                                        
                                        <input type="text" disabled id="categoryInput" class="form-control">
                                        <div class="input-group-btn">
                                            <button id="loadTree" tabindex="-1" class="btn btn-white" type="button"><i class="fa fa-list"></i></button>
                                        </div>
                                    </div>
                                    <ul id="catResult"></ul>
                                    <div class="categoryTree" id="category">
                                       
                                    </div>
                                </div>
                            </div> 
                            <div class="form-group clearfix">
                                <div class="col-md-3">{!! Form::label('name', 'Name', ['class'=>'control-label']) !!}</div>
                                <div class="col-md-9">
                                    {!! Form::text('name', '', ['class'=>'form-control','required']) !!}
                                    @if($errors->has('name'))<p class="text-danger">{{ $errors->first('name') }}</p> @endif
                                </div>
                                
                            </div>  
                            <div class="form-group clearfix">
                                <div class="col-md-3">{!! Form::label('sku', 'SKU', ['class'=>'control-label']) !!}</div>
                                <div class="col-md-9">
                                    {!! Form::text('sku', '', ['class'=>'form-control','required']) !!}
                                    @if($errors->has('sku'))<p class="text-danger">{{ $errors->first('sku') }}</p> @endif
                                </div>
                            </div>  
                            <div class="form-group clearfix">
                                <div class="col-md-3">{!! Form::label('product_price', 'Product Price', ['class'=>'control-label']) !!}</div>
                                <div class="col-md-9">
                                    {!! Form::number('product_price', '', ['class'=>'form-control','required']) !!}
                                    @if($errors->has('product_price'))<p class="text-danger">{{ $errors->first('product_price') }}</p> @endif
                                </div>
                                
                            </div>
                            <div class="form-group clearfix">
                                <div class="col-md-3">{!! Form::label('seller_price', 'Seller Price', ['class'=>'control-label']) !!}</div>
                                <div class="col-md-9">
                                    {!! Form::number('seller_price', '', ['class'=>'form-control','required']) !!}
                                     @if($errors->has('seller_price'))<p class="text-danger">{{ $errors->first('seller_price') }}</p> @endif
                                </div>
                               
                            </div>
                            <div class="form-group clearfix">
                                <div class="col-md-3">{!! Form::label('stock', 'Stock', ['class'=>'control-label']) !!}</div>
                                <div class="col-md-9">
                                    {!! Form::number('stock', '', ['class'=>'form-control','required']) !!}
                                     @if($errors->has('stock'))<p class="text-danger">{{ $errors->first('stock') }}</p> @endif
                                </div>
                               
                            </div>
                            <div class="form-group clearfix">
                                    <div class="col-md-3">Mesure</div>
                                    <div class="col-md-9">
                                        {!! Form::select('weight', $mesure, null, ['class' => 'form-control']) !!}
                                        @if($errors->has('weight'))<p class="text-danger">{{ $errors->first('weight') }}</p> @endif
                                    </div>
                            </div>
                            <div class="form-group clearfix">
                                <label class="control-label col-md-3"> Expire </label>
                                <div class="col-md-9">
                                    <div class="input-group date form_datetime-component">
                                        <input type="text" name="expire" value="{{ old('expire') }}" class="form-control" readonly="" size="16">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-primary date-set"><i class="fa fa-calendar"></i></button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                             <div class="form-group clearfix">
                                <div class="col-md-3">{!! Form::label('keywords', 'Keywords', ['class'=>'control-label']) !!}</div>
                                <div class="col-md-9">{!! Form::textarea('keywords', '', ['class'=>'form-control','required','rows'=>4,'style'=>'resize:none']) !!}
                                    @if($errors->has('keywords'))<p class="text-danger">{{ $errors->first('keywords') }}</p> @endif
                                </div>
                                
                            </div>
                             <div class="form-group clearfix">                                
                                <div class="col-md-3">{!! Form::label('description', 'Description', ['class'=>'control-label']) !!}</div>
                                <div class="col-md-9">
                                    {!! Form::textarea('description', '', ['class'=>'form-control','required','rows'=>4,'style'=>'resize:none']) !!}
                                    @if($errors->has('description'))<p class="text-danger">{{ $errors->first('description') }}</p> @endif
                                </div>
                                
                            </div> 
                            <div class="form-group clearfix">
                                <div class="row">
                                    <div class="col-md-3">Image</div>
                                    <div class="col-md-9">
                                        <input type="file" accept="image/gif, image/jpeg, image/png" onchange="loadFile(event)" name="image" class="form-control">
                                        @if($errors->has('image'))<p class="text-danger">{{ $errors->first('image') }}</p> @endif
                                    </div>
                                </div>
                                
                            </div>
                            <div class="form-group clearfix">
                                <div class="row">
                                    <div class="col-md-3">Is Active</div>
                                    <div class="col-md-9">
                                        {!! Form::select('status', ['0' => 'no', '1' => 'yes'], null, ['class' => 'form-control']) !!}
                                        @if($errors->has('status'))<p class="text-danger">{{ $errors->first('status') }}</p> @endif
                                    </div>

                                </div>
                            </div>
                            <div class="form-group clearfix">
                                <button class="btn btn-primary pull-right">Add Product</button>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-md-offset-2 text-center">
                <img id="output"/>
            </div>
        </div>

    </div>
    <!--body wrapper end-->

@endsection
@push('scripts')

<!--select2-->
{{-- <script src="{{ asset('js/select2.js') }}"></script> --}}
<!--select2 init-->
{{-- <script src="{{ asset('js/select2-init.js') }}"></script> --}}
<script type="text/javascript" src="{{ asset('js/vakata-jstree/tree.js') }}"></script>
<script src="{{ asset('js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/form-validation-init.js')}}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js') }}"></script>t>

<!--picker initialization-->
<script src="{{ asset('js/picker-init.js') }}"></script>
<!--dropzone-->
{{-- <script src="{{ asset('js/dropzone.js') }}"></script> --}}
<script type="text/javascript">
        function jsTree(){
            $('#category').jstree({
                "plugins":["checkbox"]
            });
        }
        function searchCat(data){
            $('#catResult').html();
            if(data != ''){
                axios.put('{{ route('seller.category.search') }}',{value:data}).then(response => {
                if (response.data.status === 'OK' ) {
                    for (var i = 0; i < response.data.categories.length; i++) {
                        $('#catResult').html('<li>'+response.data.categories[i].name+'</li>');
                        $('#categoryInput').removeClass('spinner');
                    }
                } 
                }).catch(error=> {            
                    toastr.error('Error in for finding category ..'); 
                    $('#categoryInput').removeClass('spinner');
                });
            }
        }
        $('#category').on('changed.jstree',function(e,data){
            if (data.selected.length) {
                $('#categoryInput').val('');
                $('#categoryId').val('');
                var textToAppend= "",idToAppend= "";
                $(data.selected).each(function(idx){
                    var node = data.instance.get_node(data.selected[idx]);
                    textToAppend += (textToAppend == "") ? "" : ", ";
                    textToAppend += node.text;
                    idToAppend += (idToAppend == "") ? "" : ",";
                    idToAppend += node.id;
                });
                $('#categoryInput').val(textToAppend);
                $('#categoryId').val(idToAppend);
            }
        });
        // $('#categoryInput').on('keyup',function(e){
        //     var thisVal = '';
        //     $(this).addClass('spinner');
        //     thisVal= thisVal+$(this).val();
        //     searchCat(thisVal);
        // });
        $('#categoryInput').blur(function(){

        });
        $('#loadTree').on('click',function(){
            jsTree();
            $('#category').slideToggle('fast');
        });
        // $('body').on('click',function(e){
        //     if($(e.target).attr('id') != 'loadTree' || $(e.target).parent().attr('id') != 'loadTree' && $(e.target).parent().attr('class') == 'fa-list'){
        //         $('#category').slideUp('fast');
        //     }
        // });
</script>
<script type="text/javascript">

  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
  };
</script>
@endpush