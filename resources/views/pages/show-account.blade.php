@extends('layouts.app')
@auth()
@section('content')
<button class="btn btn-light mb-3"><a href="/home">Go Back</a></button>
<br>
@if(count($transfers) > 0)
<ul class="list-group mt-3">
    <li class="list-group-item bg-primary text-white"><h3>Transfers table</h3></li>
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
                               @if(time() - strtotime($transfer->created_at) < 120 and $account_number == $transfer->account_number_from)
                                   <form action="/account/{{$account_number}}/delete/{{$transfer->id}}" method="post" enctype="multipart/form-data">
                                       @csrf
                                       <button type="submit" class="btn btn-danger">Cancel Transfer</button>
                                   </form>
                               @else
                                   Completed
                               @endif
                           </td>
                    </tr>
                @endforeach
                </tbody>
                @else
                    <ul class="list-group">
                        <li class="list-group-item bg-primary text-white"><h3>Account don't have transfers yet. Make it!</h3></li>
                        <li class="list-group-item">
                    <button type="button" class="btn btn-primary mr-2" onclick="window.location.href='/transfer-own'">Transfer between own accounts</button>
                    <button type="button" class="btn btn-primary" onclick="window.location.href='/transfer-other'">Transfer to other user accounts</button>
                        </li>
                    </ul>
                @endif
            </table>
            <div class="clearfix mt-5">
                {{$transfers->links('pagination::bootstrap-4')}}
            </div>
        </div>
</ul>
@endsection
@endauth


