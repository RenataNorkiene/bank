@extends('layouts.app')
@auth()
@section('content')

    <div class="mb-3">
            @include('_partials.errors')
            <form action="/account/create" method="post" enctype="multipart/form-data">
                @csrf
                <label for="account_name" class="form-label"><h3>Please enter name for new account</h3></label>
                <input type="text" class="form-control" id="account_name" name="account_name" placeholder="account name">
    </div>
                <button type="submit" name="button" class="btn btn-primary">Create an Account</button>
            </form>
        </div>
    </div>
@endsection
@endauth
