<nav class="navbar navbar-light bg-light sticky-top mb-5>
    <div class="container-fluid">
<img src={{URL::asset("asset/images/shards-dashboards-logo.svg")}} alt="" width="50" height="40")>
<a class=" navbar-brand ml-3 " href="{{ url('/') }}"><h3>{{ config('app.name', 'Laravel') }}</h3></a>
<ul class="navbar-nav ml-auto">
    <!-- Authentication Links -->
    @guest
        @if (Route::has('login'))
            <div class="container-fluid d-flex">
                <a class="nav-link" aria-current="page" href="{{ route('login') }}">{{ __('Login') }}</a>
                @endif

                @if (Route::has('register'))
                    <a class="nav-link ml-3" href="{{ route('register') }}">{{ __('Register') }}</a>
            </div>
        @endif
    @else
        <li class="nav-item ">
            <a>
                {{ Auth::user()->name }}
            </a>
        </li>
    @endguest
</ul>
</div>
</nav>
