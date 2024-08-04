@if(Session::has('message'))
<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<div class="alert alert-{{Session::get('class')}} alert-dismissable">
	    	<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
	    {{Session::get('message')}}
	  </div>
	</div>
</div>
@endif