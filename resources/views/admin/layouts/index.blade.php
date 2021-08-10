@include('admin.layouts.header')

<div id="app">
	<div class="main-wrapper">
		<div class="navbar-bg"></div>

		@include('admin.layouts.sidebar')		

		@include('admin.layouts.navbar')	

		@yield('content')

	</div>
</div>

@yield('modal')

@include('admin.layouts.footer')
