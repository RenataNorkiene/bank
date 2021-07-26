@include('_partials.head')
<style>
    body {
        background: url('https://images.unsplash.com/photo-1491895200222-0fc4a4c35e18?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1267&q=80') no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        background-size: cover;
        -o-background-size: cover;
    }
</style>
<div class="p-3 mb-5 bg-primary text-white text-center">
    <h2>Welcome to e-bank</h2></div>
<body class="flex-row align-items-center">
@yield('content')
</body>
