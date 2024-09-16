@extends(Auth::check() ? 'layouts.homelayout' : 'layouts.app')

@section('content')


<div class="container d-flex">
    <p class="startlabel"> Testing Page</p>
</div> 

<div class="main-content">
    <main class="">
        @yield('content')
    </main>
    @include('partials.footer')
</div>

@endsection