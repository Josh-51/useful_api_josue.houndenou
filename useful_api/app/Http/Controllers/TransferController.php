<?php

namespace App\Http\Controllers;

use App\Models\Transfer;
use Illuminate\Http\Request;
use App\Models\User;

class TransferController extends Controller
{
    public function registerWallet(Request $request) {
        $validated=  $request->validate([
            'receiver_id'    => 'required|numeric|exists:users,id',
            'amount' => 'required|decimal:1|gt:0',
        ]);

        $me=auth()->user();

        if($me->id==$request->receiver_id) {

            return response()->json(['message'=>'You cannot transfer to yourself.'], 401);
        }

        if($me->balance < $request->amount ) {
            return response()->json(['message'=>'Insufficient funds.'], 401);
        }

        $me->update(['balance' => $me->balance-$request->amount ]);

        $receiver= User::where('id',$request->receiver_id)->first();

        $receiver->update(['balance' => $receiver->balance + $request->amount]);

       $transfert= Transfer::Create( [
            'receiver_id' => $request->receiver_id,
            'amount' => $request->amount,
                'sender_id' => $me->id,
                'status' => 'success',

        ]
        );

       return response()->json($transfert, 201);

    }
}
