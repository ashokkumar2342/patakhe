@extends('admin.layout.master')
@push('links')
<link rel="stylesheet" type="text/css" href="{{ asset('js/vakata-jstree/tree.css') }}">
@endpush
@section('content')
    <!--body wrapper start-->
    <div class="wrapper">
       <div class="row">
            <div class="col-md-3">

                <a class="btn btn-warning" href="{{ route('admin.category.form') }}">+ New Category</a>
                <br><br>
                
                <div class="tree" id="category">
                    @foreach($categories as $category)
                           <ul>
                               <li ><a  href="{{ route('admin.category.edit',$category->ukey) }}">{{ $category->name }}</a></li>
                           </ul>
                    @endforeach                  
                </div>
            </div>
            <div class="col-md-9" style="border-left:1px solid #aaa" id="catInfo">
                <div class="col clearfix"><div class="pull-right"><button class="btn btn-danger" data-action="resetForm" > Reset </button>&nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-success " data-action="updateCategory" > Update category </button></div></div>
                <h4>{{ $cat->name }}</h4>
                <h2 class="bg-primary" style="padding:9px">General Information</h2>
                <hr>
                <form action="javascript:;" data-action="addCategory" id="UpdateCategoryForm">
                    {!! Form::hidden('id', $cat->id) !!}
                    <div class="form-group clearfix">
                        <div class="row">
                            <div class="col-md-3 col-md-offset-1">Name</div>
                            <div class="col-md-7">{!! Form::text('name', $cat->name, ['class'=>'form-control']) !!}</div>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="row">
                            <div class="col-md-3 col-md-offset-1">Title</div>
                            <div class="col-md-7">{!! Form::text('title', $cat->title, ['class'=>'form-control']) !!}</div>
                        </div>
                    </div>
                  
                    <div class="form-group clearfix">
                        <div class="row">
                            <div class="col-md-3 col-md-offset-1">Keywords</div>
                            <div class="col-md-7">{!! Form::textarea('keywords', $cat->keywords, ['class'=>'form-control','style'=>'resize: none','rows'=>'4']) !!}</div>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="row">
                            <div class="col-md-3 col-md-offset-1">description</div>
                            <div class="col-md-7">{!! Form::textarea('description', $cat->description, ['class'=>'form-control','style'=>'resize: none','rows'=>'4']) !!}</div>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="row">
                            <div class="col-md-3 col-md-offset-1">Is Active</div>

                            <div class="col-md-7">{{ Form::select('status', ['0' => 'no', '1' => 'yes'], $cat->status, ['class'=>'form-control','placeholder' => 'choose visiblity...']) }}</div>
                        </div>
                    </div>
                   
                </form>
            </div>
       </div>
    </div>
    <!--body wrapper end-->
@endsection
@push('scripts')
<script type="text/javascript" src="{{ asset('js/vakata-jstree/tree.js') }}"></script>
<script type="text/javascript">
    
$('body').find('button').on('click',function(e){
    if ($(this).attr('data-action') === 'updateCategory') {
        var html = $(this).html();
        $(this).html('<i class="fa fa-spin fa-spinner"></i> '+html).addClass('disabled');
        var data = $('form#UpdateCategoryForm').serialize();       
        axios.put('{{ route('admin.category.update',$cat->id) }}',data).then(response => {
            if (response.data.status === 'OK' ) {
                toastr.success(response.data.message);
                $(this).html(html).removeClass('disabled');
            }
            else{
                toastr.error(response.data.message);
                $(this).html(html).removeClass('disabled');
            }                
        }).catch(error=> {            
            toastr.error('Error in for submission..'); 
            $(this).html(html).removeClass('disabled');
        });
    }
    if ($(this).attr('data-action') === 'resetForm') {
        $('form#UpdateCategoryForm').trigger('reset');
    }
    
});
$('#category').on('click','li a',function(){
        window.location.href=$(this).attr('href');
          // $('#catInfo h4').text($(this).text());
});
    // $('#tree').on("move_node.jstree", function (e, data) {

   //      // //item being moved                      
   //      // var moveitemID = $('#' + data.node.id).find('a')[0].id;            

   //      // //new parent
   //      // var newParentID = $('#' + data.parent).find('a')[0].id;

   //      // //old parent
   //      // var oldParentID = $('#' + data.old_parent).find('a')[0].id;

   //      //position index point in group
   //      //old position
   //      console.log(data.parent.id);
    // });
    $("#category").jstree({
        "core" : {
          "check_callback" : true
        },
        "json_data": { data: "nodes" },
        "plugins" : [ "dnd","types",'json_data' ],
        "types" : {
            "#" : {
              "max_depth" : 3,
            }
        },
      })
    // $("#res").html(JSON.stringify(obj));
</script>
@endpush