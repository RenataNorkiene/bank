@extends('layouts.app')
@auth()
@section('content')

    @if(session()->has('message'))
        <div class="main-navbar sticky-top bg-white">
            <div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <i class="fa fa-check mx-2"></i>
                <strong>{{ session()->get('message') }}</strong></div></div>
    @endif
    <button class="btn btn-light"><a href="/home">Go Back</a></button>
    <div class="row mt-3">
        <div class="col-lg-12">
            <div class="card card-small mb-4">
                <div class="card-header border-bottom bg-primary text-white">
                    <h3 class="m-0 ">Transfer details</h3>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item p-3">
                        <div class="row">
                            <div class="col">

                                <form action="/transfer-{{$transfer_type}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="">@include('_partials.errors')</div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="account_number_from">Send from account</label>
                                            <select id="account_number_from" name="account_number_from"  class="form-control">
                                                <option selected>Choose an account</option>
                                                @foreach($accounts as $account)
                                                    @if($account->account_number == old('account_number_from'))
                                                        <option selected>{{$account->account_number}}</option>
                                                    @else
                                                        <option>{{$account->account_number}}</option>
                                                    @endif
                                                @endforeach
                                            </select >
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="account_number_to">Send to account</label>
                                            @if($transfer_type == 'own')
                                            <select id="account_number_to" name="account_number_to"  class="form-control">
                                                <option selected>Choose an account</option>
                                                @foreach($accounts as $account)
                                                    @if($account->account_number == old('account_number_to'))
                                                        <option selected>{{$account->account_number}}</option>
                                                    @else
                                                        <option>{{$account->account_number}}</option>
                                                    @endif
                                                @endforeach
                                            </select >
                                            @else
                                                <input type="text" class="form-control" id="account_number_to" name="account_number_to" value="{{old('account_number_to')}}">
                                            @endif

                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="name">Amount</label>
                                            <input type="text" class="form-control" id="amount" name="amount" placeholder="" value="{{old('amount')}}"> </div>
                                    </div>
                                    @if($transfer_type == 'own')
                                        <input type="hidden" id="full_name" name="full_name" value="{{Auth::user()->name}}">
                                    @else
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="name">Beneficiarys full name </label>
                                                <input type="text" class="form-control" id="full_name" name="full_name" placeholder="" value="{{old('full_name')}}">
                                            </div>
                                        </div>
                                    @endif
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="description">Description</label>
                                            <input name="description" class="form-control" id="description" name="description" value="{{old('description')}}">
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary">Confirm Transfer</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
@endauth
