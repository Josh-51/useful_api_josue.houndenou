<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\UserModule;
use Illuminate\Http\Request;

class ModuleControlller extends Controller
{
    public function activate($id) {

        $module = Module::where('id', $id)->first();

        if ($module) {

            $Module_User = UserModule::updateOrCreate(

               [ 'module_id' => $id,

                'user_id' => auth()->id() ] ,

               [ 'active' => true ,

            ]);

            return response()->json([
                'message' => 'Module activated',
            ], 200);
        } else {

            return response()->json([
                'message' => 'The module does not exist',
            ], 404);

        }
    }

    public function deactivate($id) {

        $module = Module::where('id', $id)->first();

        if ($module) {

            $Module_User = UserModule::updateOrCreate(

                [ 'module_id' => $id,

                    'user_id' => auth()->id() ] ,

                [ 'active' => false ,

                ]);

            return response()->json([
                'message' => 'Module deactivated',
            ], 200);
        } else {

            return response()->json([
                'message' => 'The module does not exist',
            ], 404);

        }
    }

    public function index () {

        $id = auth()->id();

        $general=UserModule::with('modules')->where('user_id', $id)->where('active', 1)->get() ;
        $general= $general->select('modules')->pluck('modules')->toArray();
        return response()->json($general);
    }
}
