@if(Session::has('message'))
<script type="text/javascript">
$(document).ready(function(){
    toastr.options = {
	  "closeButton": true,
	  "debug": false,
	  "progressBar": false,
	  "positionClass": "toast-top-right",
	  "onclick": null,
	  "showDuration": "300",
	  "hideDuration": "1000",
	  "timeOut": "5000",
	  "extendedTimeOut": "1000",
	  "showEasing": "swing",
	  "hideEasing": "linear",
	  "showMethod": "fadeIn",
	  "hideMethod": "fadeOut"
	}
    Command: toastr["{{Session::get('class')}}"]("{!!Session::get('message')!!}")
});
</script>
@endif