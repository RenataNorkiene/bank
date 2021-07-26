@extends('layouts.app')
@auth()
@section('content')
    <div class="card-header border-bottom text-center bg-white">
        <h4 class="mb-0">{{ auth()->user()->name }}</h4>
    </div>
    @if(count($accounts) > 0)

        @foreach($accounts as $account)
            <ul class="list-group mb-3">
                <a href="/account/{{$account->account_number}}/details" class="list-group-item list-group-item-action active" aria-current="true">
                    {{$account->account_number}}
                </a>
                <li class="list-group-item">
                    @if($account->isMain === 1)
                        <h5 class="text-primary">Main account</h5>
                    @else
                        Other account: <h5 class="d-inline text-primary">{{$account->account_name}}</h5>
                    @endif
                </li>
                <li class="list-group-item">Balance: {{$account->balance}}</li>
            </ul>
        @endforeach
        <p>Total balance: {{$balance}}</p>
        <div class="clearfix mt-5">
            {{$accounts->links('pagination::bootstrap-4')}}
        </div>
    @else
        <p>No accounts found</p>
    @endif
    <button type="button" class="btn btn-primary mt-3 " onclick="window.location.href='/account/create'">Create new Account</button>


@endsection
@endauth
