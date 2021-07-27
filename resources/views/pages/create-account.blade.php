@extends('layouts.app')
@auth()
@section('content')
<button type="submit" class="btn btn-light" onclick="window.location.href='/home'">Go back</button>
<div class="mb-3 mt-3">
    @include('_partials.errors')
    <ul class="list-group">
        <li class="list-group-item bg-primary text-white"><h3>Please enter name for new account</h3></li>
        <li class="list-group-item">
            <form action="/account/create" method="post" enctype="multipart/form-data">
                @csrf
                <input type="text" class="form-control mt-2 mb-3" id="account_name" name="account_name" placeholder="account name">
                <button type="submit" name="button" class="btn btn-primary">Create an Account</button>
            </form>
        </li>
    </ul>
</div>
@endsection
@endauth
