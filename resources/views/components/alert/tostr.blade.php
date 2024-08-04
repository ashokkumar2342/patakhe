@if(Session::has('message'))
<script type="text/javascript">
$(document).ready(function(){
    Command: toastr["{{Session::get('class')}}"]("{!!Session::get('message')!!}")


});
</script>
@endif