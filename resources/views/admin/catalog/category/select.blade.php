@extends('admin.layout.master')
@push('links')
<link rel="stylesheet" type="text/css" href="{{ asset('js/vakata-jstree/tree.css') }}">
@endpush
@section('content')
    <!--body wrapper start-->
    <div class="wrapper">
       <div class="row">
            <div class="col-md-3">
                <a class="btn btn-warning">+ New Category</a>
                <br><br>
                
                <div class="tree" id="category">
                       
                </div>
            </div>
            <div class="col-md-9" style="border-left:1px solid #aaa" id="catInfo">
                <div class="col clearfix"><div class="pull-right"><button class="btn btn-danger" data-action="resetForm" > Reset </button>&nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-success pull-right" data-action="saveCategory" data-url="{{ route('admin.category.create') }}"> Save category </button></div></div>
                <h4>{{ $category->name }}</h4>
                <h2 class="bg-primary" style="padding:9px">General Information</h2>
                <hr>
                <form action="javascript:;" data-action="addCategory" id="CreateCategoryForm">
                    <input type="hidden" name="parent" value="{{ $category->id }}">
                    <div class="form-group clearfix">
                        <div class="row">
                            <div class="col-md-3 col-md-offset-1">Name</div>
                            <div class="col-md-7"><input type="text" name="name" class="form-control"></div>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="row">
                            <div class="col-md-3 col-md-offset-1">Title</div>
                            <div class="col-md-7"><input type="text" name="title" class="form-control"></div>
                        </div>
                    </div>
                  
                    <div class="form-group clearfix">
                        <div class="row">
                            <div class="col-md-3 col-md-offset-1">Keywords</div>
                            <div class="col-md-7"><textarea name="keywords" style="resize: none" rows="4" class="form-control"></textarea></div>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="row">
                            <div class="col-md-3 col-md-offset-1">description</div>
                            <div class="col-md-7"><textarea name="description" style="resize: none" rows="4" class="form-control"></textarea></div>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="row">
                            <div class="col-md-3 col-md-offset-1">Is Active</div>
                            <div class="col-md-7"><select name="status" class="form-control"><option value="0">no</option><option value="1">yes</option></select></div>
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
    if ($(this).attr('data-action') === 'saveCategory') {
        var html = $(this).html();
        $(this).html('<i class="fa fa-spin fa-spinner"></i> '+html).addClass('disabled');
        var data = $('form#CreateCategoryForm').serialize();
       
        axios.put($(this).attr('data-url'),data).then(response => {
            if (response.data.status === 'OK' ) {
                toastr.success(response.data.message);
               $('form#CreateCategoryForm').trigger('reset');
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
        $('form#CreateCategoryForm').trigger('reset');
    }
    
});
$('#category').on('click','li a',function(){
        window.location.href=$(this).attr('href');
});

    $("#category").jstree({
        "core" : {
          "check_callback" : true,
          'data' : {
              'url' : '{{ route('admin.category.get')}}',
              'data' : function (node) {
              }
            }
        },
        "plugins" : ['core', "dnd",'json_data','sort','json' ],
        "types" : {
            "#" : {
              "max_depth" : 3,
            }
        },
        "sort" : function (a, b) { 
        },
        })
        .bind("move_node.jstree", function(e, data) {
            axios.put('{{ route('admin.category.arrange')}}',{'id':data.node.id,'parent':data.parent,'position':data.position}).then(response => {
                toastr.success('category updated'); 
            }).catch(error=> {            
                toastr.error('Error in updating category ..'); 
            });
        })
        .bind("select_node.jstree", function (e, data) { 
            console.log(data.node.a_attr.href);
        });
    // $("#res").html(JSON.stringify(obj));
</script>
@endpush