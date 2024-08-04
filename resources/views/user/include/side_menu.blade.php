@push('links')
<style type="text/css">
	.user-sidebar li{
		padding: 4px 2px
	}
	.user-sidebar li a{
		padding: 5px 2px;
	}
</style>
@endpush
<div class="panel panel-primary">
<div class="panel-heading">My Account</div>
<div class="panel-body">
	<ul class="user-sidebar ">
		<h4>Setting</h4>

		<li><a href="{{ route('user.profile.get') }}" class="text-muted">Personal Information</a></li>
		<li><a href="{{ route('user.orderlist.post') }}" class="text-muted">Order Details</a></li>

		<li><a href="{{ route('user.password.change') }}" class="text-muted">Change Password</a></li>
		{{-- <li><a href="{{ route('user.order.get') }}" class="text-muted">Order Details</a></li> --}}
		<li><a href="#" class="text-muted">Profile Settings</a></li>
		<li><a href="#" class="text-muted">Update Email/Mobile</a></li>
		 
		<li><a href="{{ route('user.review.post') }}" class="text-muted">Review</a></li>

	</ul>

</div>
</div>
