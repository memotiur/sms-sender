<?php

namespace App\Http\Controllers;

use App\Credit;
use App\Recharge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RechargeController extends Controller
{

    public function index()
    {
        return view('pages.recharge.index');
    }

    public function create(Request $request)
    {

        if ($request->isMethod('post')) {
            $user_id = Session::get('id');
            $success = true;
            $message = "Successfully Recharged";
            $transaction_id = $request['transaction_id'];
            $value = Recharge::where('transaction_id', $transaction_id)
                ->where('user_id', $user_id)
                ->first();
            if (is_null($value)) {
                try {
                    $status = $this->verifyTransactionId($transaction_id);
                    if ($status != 0) {
                        Recharge::create(['transaction_id' => $transaction_id, 'recharge_amount' => $status, 'user_id' => $user_id, 'transaction_status' => true]);
                    } else {
                        $success = false;
                        $message = "Transaction ID is wrong";
                        Recharge::create(['transaction_id' => $transaction_id, 'user_id' => $user_id, 'transaction_status' => false]);
                    }

                } catch (\Exception $exception) {
                    $success = false;
                    $message = $exception->getMessage();
                }
            } else if ($value->transaction_status == false && $value->transaction_counter <= 3) {

                $status = $this->verifyTransactionId($transaction_id);
                if ($status != 0) {
                    Recharge::where('recharge_id', $value->recharge_id)->update(['transaction_id' => $transaction_id, 'recharge_amount' => $status, 'user_id' => $user_id, 'transaction_status' => true]);
                } else {
                    $success = false;
                    $message = "Transaction ID is wrong";
                    $counter = $value->transaction_counter;
                    $counter++;
                    Recharge::where('recharge_id', $value->recharge_id)->update(['transaction_id' => $transaction_id, 'user_id' => $user_id, 'transaction_status' => false, 'transaction_counter' => $counter]);
                }
            } else if ($value->transaction_status == true && $value->transaction_counter <= 3) {

                $success = false;
                $message = "Already Used." . $value->transaction_counter . " Times Tried using same Transaction ID. Your account could be Deleted";
                $counter = $value->transaction_counter;
                $counter++;
                Recharge::where('recharge_id', $value->recharge_id)->update(['transaction_counter' => $counter]);

            } else {
                $success = false;
                $message = "You tried " . $value->transaction_counter . " Times using Wrong Transaction ID. Your account could be Deleted";
                $counter = $value->transaction_counter;
                $counter++;
                Recharge::where('recharge_id', $value->recharge_id)->update(['transaction_id' => $transaction_id, 'user_id' => $user_id, 'transaction_status' => false, 'transaction_counter' => $counter]);
            }

            if ($success == true) {
                return back()->with('success', $message);
            } else {
                return back()->with('failed', $message);
            }

        } else {
            return view('pages.recharge.new_recharge');
        }
    }

    public function store(Request $request)
    {
        //
    }


    public function show(Recharge $recharge)
    {
        $user_id = Session::get('id');
        $result = Recharge::where('user_id', $user_id)->get();
        return view('pages.recharge.recharge_history')->with('result', $result);
    }


    public function edit(Recharge $recharge)
    {
        //
    }


    public function update(Request $request, Recharge $recharge)
    {
        //
    }


    public function destroy(Recharge $recharge)
    {
        //
    }

    private function verifyTransactionId($transaction_id)
    {
        $status = 1;
        $amount = rand(5, 100); //TODO:: Amount getting From Bkash API
        if ($status == 1) {
            $this->recahargeAccount($amount);
            return $amount;
        } else {
            return 0;
        }

    }

    private function recahargeAccount($amount)
    {
        $user_id = Session::get('id');
        $res = Credit::where('user_id', $user_id)->first();
        $remaining_balance = $res->account_balance;
        $total = $amount + $remaining_balance;
        try {
            Credit::where('user_id', $user_id)->update(['account_balance' => $total]);
        } catch (\Exception $exception) {

        }
    }
}
