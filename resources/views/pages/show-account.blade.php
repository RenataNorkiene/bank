@extends('layouts.app')
@auth()
@section('content')
    <div class="p-3 mb-2 bg-primary text-white"> <h3>Transactions table</h3></div>
    <table class="table table-bordered bg-white">
        <thead>
        <tr>
            <th scope="col">Data</th>
            <th scope="col">Account from</th>
            <th scope="col">Account to</th>
            <th scope="col">Full Name</th>
            <th scope="col">Description</th>
            <th scope="col">Amount</th>
            <th scope="col">Status</th>
        </tr>
        </thead>
        <tbody>
        @if(count($transfers) > 0)
            @foreach($transfers as $transfer)

                <tr>
                    <td>{{$transfer->created_at}}</td>
                    <td>{{$transfer->account_number_from}}</td>
                    <td>{{$transfer->account_number_to}}</td>
                    <td>{{$transfer->full_name}}</td>
                    <td>{{$transfer->description}}</td>
                    @if($account_number == $transfer->account_number_from)
                        <td>-{{$transfer->amount}}</td>
                    @else
                        <td>+{{$transfer->amount}}</td>
                    @endif
                    <td>
                    @if(time() - strtotime($transfer->created_at) < 120)
                        <button type="button" class="btn btn-danger">Cancel Transfer</button>
                    @else
                        Completed
                    @endif
                    </td>
                </tr>
        </tbody>
        @endforeach
        @else
            Transactions not found
        @endif
    </table>
@endsection
@endauth

