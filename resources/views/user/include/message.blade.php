@if(Session::has('message'))
	<div class="col-md-8 col-md-offset-2">
		<div class="alert alert-{{Session::get('class')}} alert-dismissable">
	    	<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
	    {{Session::get('message')}}
	  </div>
	</div>
@endif