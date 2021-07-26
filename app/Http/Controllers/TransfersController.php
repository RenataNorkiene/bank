<?php

namespace App\Http\Controllers;

use App\Models\Transfer;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransfersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create_transfer($type)
    {
        if ($type != 'own') {
            $type = 'other';
        }
        if (auth::check()) {
            $accounts = Account::where('user_id', auth::id())->get();
            $data = array('accounts' => $accounts, 'transfer_type' => $type);
            return view('pages.create-transfers')->with($data);
        } else {
            return redirect()->route('login');
        }
    }

    public function store_transfer($type, Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required',
            'account_number_from' => ['required', 'min:20', 'max:20'],
            'account_number_to' => ['required', 'min:20', 'max:20'],
            'amount' => 'required',
            'description' => 'required'
        ]);

        $account_from = Account::where([['account_number', $request->input('account_number_from')],
                                        ['user_id', auth::id()]]
                                        )->first();
        if (!$account_from) {
            return back()->withErrors(['account' => 'Wrong senders account number']);
        }
        if (($account_from->balance) < ($request->input('amount'))) {
            return back()->withErrors(['account' => 'Insufficient balance']);
        }

        $account_to = Account::where('account_number', $request->input('account_number_to'))->first();
        if (!$account_to) {
            return back()->withErrors(['account' => 'Wrong beneficiary\'s account number']);
        }

        $transferAmount = $request->input('amount');

        \DB::transaction(function () use ($account_to, $account_from, $transferAmount, $request) {
            //create transfer
            Transfer::create([
                'full_name' => $request->input('full_name'),
                'account_number_to' => $request->input('account_number_to'),
                'account_number_from' => $request->input('account_number_from'),
                'amount' => $transferAmount,
                'description' => $request->input('description'),
            ]);
            //update account balance
            $account_from->balance = $account_from->balance - $transferAmount;
            $account_from->save();
            $account_to->balance = $account_to->balance + $transferAmount;
            $account_to->save();

        });
        return redirect()->route('home')->with(['message', 'Transfer created successfully']);
    }

    public function transfers_by_account($account_number)
    {
        if (auth::check()) {
            if (app('App\Http\Controllers\AccountsController')->account_belongs_to_user($account_number)) {
                $transfers = Transfer::where('account_number_from', $account_number)
                                        ->orWhere('account_number_to', $account_number)
                                        ->paginate(10);
                $data = array('transfers' => $transfers, 'account_number' => $account_number);
                return view('pages.show-account')->with($data);
            } else {
                return redirect()->route('home');
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function delete_transfer($account_number, $transfer_id)
    {
        if (auth::check()) {
            if (app('App\Http\Controllers\AccountsController')->account_belongs_to_user($account_number)) {
                $transfer = Transfer::where([['id', $transfer_id], ['account_number_from', $account_number]])->first();
                if (!$transfer) {
                    return redirect('account/'. $account_number .'/details');
                } else {
                    if (time() - strtotime($transfer->created_at) < 125) {
                        $account_from = Account::where('account_number', $transfer->account_number_from)->first();
                        $account_to = Account::where('account_number', $transfer->account_number_to)->first();;
                        $account_from->balance = $account_from->balance + $transfer->amount;
                        $account_to->balance = $account_to->balance - $transfer->amount;
                        $account_from->save();
                        $account_to->save();
                        $transfer->delete();
                    }
                    return redirect('account/'. $account_number .'/details');
                }
            } else {
                return redirect()->route('home');
            }
        } else {
            return redirect()->route('login');
        }
    }
}
