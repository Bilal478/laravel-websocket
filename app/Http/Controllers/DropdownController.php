<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\OptionSelected;
use Pusher;

class DropdownController extends Controller
{
    public function index()
    {
        return view('dropdown');
    }

    public function selectOption(Request $request)
    {
        $option = $request->input('option');
        broadcast(new OptionSelected($option))->toOthers();

        $app_id = '1793041';
        $app_key = '93473b84de1b69a82c33';
        $app_secret = 'f671def2bf57c70f5b36';
        $app_cluster = 'mt1';

        $pusher = new Pusher\Pusher( $app_key, $app_secret, $app_id, array( 'cluster' => $app_cluster, 'useTLS' => true ) );
        
        $data = ['from' => '1', 'to' => '2', 'options' => $option];
        $pusher->trigger('escrolab_channel1', 'escrolab_messages1', $data);

        return response()->json(['success' => true]);
    }
}


