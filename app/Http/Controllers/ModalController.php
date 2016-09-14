<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;

class ModalController extends Controller
{
	public function postLeaveCallbackComment(Request $request, $callback_id, $user_id)
	{
    $this->validate($request,[
      'message' => 'required|min:1'
      ]);
    $comment = $request['message'];
    DB::table('callbacks')
      ->where('id', $callback_id)
      ->update(['comment' => $comment]);
      return redirect()->back();
  }
}
