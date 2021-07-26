@extends('layouts.app')
@auth()
@section('content')
<ul class="list-group">
    <li class="list-group-item bg-primary text-white"><h3 class="text-center">Transfers table</h3></li>
        <div class="table-responsive">
            <table class="table table-bordered bg-white text-center">
                <thead>
                <tr>
                    <th scope="col">Data</th>
                    <th scope="col">Amount from</th>
                    <th scope="col">Amount to</th>
                    <th scope="col">Full name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Status</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    @if(count($transfers) > 0)
                        @foreach($transfers as $transfer)
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
                @endforeach
                </tbody>
                @else
                    Transactions not found
                @endif
            </table>
        </div>
</ul>
@endsection
@endauth


