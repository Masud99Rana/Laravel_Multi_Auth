@if(Auth::guard('web')->check())
	<p class="text-success">
		You are login as User
	</p>
@else

	<p class="text-danger">
		You are logout as User
	</p>
@endif


@if(Auth::guard('admin')->check())
	<p class="text-success">
		You are login as Admin
	</p>
@else

	<p class="text-danger">
		You are logout as Admin
	</p>
@endif