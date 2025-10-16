<?php

namespace App\Http\Controllers;

use App\Models\ShortLink;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ShortLinkController extends Controller
{

    public function create(Request $request) {
        $validated=  $request->validate([
            'original_url'    => 'url|required',
            'custom_code' => 'nullable|string|max:10|alpha_dash',
        ]);

        if ($request->filled('custom_code')) {

            $user = ShortLink::create([

                'user_id' => auth()->user()->id,

                'original_url' => $validated['original_url'],

                'code' => $validated['custom_code'],

                'clicks' => 0,

            ]);

            return response()->json( [

                    'id' => $user->id,
                    'user_id' => $user->user_id,
                    'original_url' => $user->original_url,
                    'code' => $user->code,
                    'clicks' => $user->clicks,
                    'created_at' => $user->created_at,
                ]
                , 201);
        } else {

            $user = ShortLink::create([

                'user_id' => auth()->user()->id,

                'original_url' => $validated['original_url'],

                'code' =>  Str::random(10),

                'clicks' => 0,


            ]);

            return response()->json(

                [
                    'id' => $user->id,
                    'user_id' => $user->user_id,
                    'original_url' => $user->original_url,
                    'code' => $user->code,
                    'clicks' => $user->clicks,
                    'created_at' => $user->created_at,
                ]
                , 201);
        }

    }

    public function redirectWithShort($code ) {

        $Short = ShortLink::where('code', $code)->first();

        if (! $Short) {
            return response()->json([
                'message' => 'The code is invalide',
            ], 401);
        }
            $clicks = $Short->clicks+1 ;

            $Short->update(['clicks' => $clicks]);

        return redirect($Short->original_url, 302);
    }

    public function getlink() {

        $me=auth()->user()->id;

        $general=ShortLink::where('user_id', $me)->select('id', 'original_url', 'code', 'clicks', 'created_at') ->get() ;
        return response()->json($general, 200);
    }

    public function destroy($id) {

        $me=auth()->user()->id;

        $destoy=ShortLink::where('user_id', $me)->where('id', $id)->first();

        if (! $destoy) {
            return response()->json(['message'=> 'The link doest not exist'], 404);
        }

        $destoy->delete();

        return response()->json(['message'=> 'Link deleted successfully'], 404);

    }
}
