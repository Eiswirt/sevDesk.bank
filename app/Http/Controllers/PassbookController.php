<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Utils\Utils;
use App\Passbook;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use mysql_xdevapi\Exception;

class PassbookController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse|object
     */
    public function index()
    {
        $accounts = Passbook::whereUserId(Auth::id())->get();
        return response()->json($accounts)->setStatusCode(Response::HTTP_OK);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|object
     */
    public function store(Request $request)
    {
        try {
            $passbook = new Passbook();
            $passbook->user_id = Auth::id;
            $passbook->name = Auth::user()->name . " " . Auth::user()->surename;
            $passbook->amount = $request->amount;
            $passbook->interest = $request->interest;

            $passbook->save();

            return response()->json("$passbook")->setStatusCode(Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json("create passbook failed, $e");
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse|object
     */
    public function show($id)
    {
        $accounts = Passbook::find($id);
        if (!$this->isUserAuthorized($checkAccountFrom->user_id)) {
            return response()->json("You are not authorized")->setStatusCode(Response::HTTP_UNAUTHORIZED);
        }

        return response()->json($accounts);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response|object
     */
    public function update(Request $request, $id)
    {
        try {
        $passbook = Passbook::find($id);
        if(Utils::isUserNotAuthorized($passbook->user_id)){
            return Utils::responseNotAuthorized();
        }

        if($passbook->amount + $request->amount >= 0){
            $passbook->amount += $request->amount;
            $passbook->save();
            return \response()->json($passbook);
        } else {
            return \response("Not enough money ")->setStatusCode(Response::HTTP_NOT_ACCEPTABLE);
        }}catch(Exception $e){
            return \response("something goes wrong, $e");
        }
    }
}
