<?php

namespace App\Http\Controllers;

use App\Checkingaccount;
use App\Http\Controllers\Utils\Utils;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CheckingAccountController extends Controller
{
    public function index()
    {
        $accounts = Checkingaccount::whereUserId(Auth::id())->get();
        return response()->json($accounts)->setStatusCode(Response::HTTP_OK);
    }

    public function show($id)
    {
        $accounts = Checkingaccount::find($id);
        if (Utils::isUserNotAuthorized($checkAccountFrom->user_id)) {
            return Utils::responseNotAuthorized();
        }
        return response()->json($accounts);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|Response|object
     */
    public function store(Request $request)
    {
        $checkAccount = new Checkingaccount();

        try {
            $checkAccount->name = Auth::user()->name . " " . Auth::user()->surename;
            $checkAccount->amount = 0;
            $checkAccount->user_id = Auth::id();
            $checkAccount->pin = $request->pin;
            //set sign to (-)
            $checkAccount->limit = Utils::setLimit($request->limit);

            $checkAccount->save();
            return response()->json($checkAccount);
        } catch (\Exception $e) {
            return response("create checking account failed, $e")->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|Response|object
     */
    public function update(Request $request, $id)
    {
        try {
            $account = $this->getCheckingAccount($id);

            if ($this->checkPin($request->pin, $account->pin)) {
                if ($account->amount + $request->amount >= $account->limit) {
                    $account->amount += $request->amount;
                    $account->save();
                    return response()->json($account);
                } else {
                    return Utils::responseLimitExceed();
                }
            } else {
                return Utils::responseIncorrectPin();
            }
        } catch (\Exception $e) {
            return response("something goes wrong, $e");
        }
    }

    /**
     * @param Request $request
     * @param $id_sender
     * @param $id_recipient
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|Response|object
     */
    public function transfer(Request $request, $id_sender, $id_recipient)
    {
        $checkAccountFrom = Checkingaccount::find($id_sender);

        $checkAccountTo = Checkingaccount::find($id_recipient);

        $dispolimitReached = $this->checkDispoLimit($checkAccountFrom, $request->amount);

        if ($checkAccountFrom != null && $checkAccountTo != null) {
            if ($this->checkPin($request->pin, $checkAccountFrom->pin)) {
                if (!$dispolimitReached) {
                    $checkAccountFrom->amount = $checkAccountFrom->amount - $request->amount;
                    $checkAccountTo->amount = $checkAccountTo->amount + $request->amount;

                    $checkAccountFrom->save();
                    $checkAccountTo->save();
                } else {
                    return Utils::responseLimitExceed();
                }
            } else {
                return Utils::responseIncorrectPin();
            }
        } else {
            return response("error with transfer")->setStatusCode(Response::HTTP_BAD_REQUEST);
        }
        return response()->json($checkAccountFrom);
    }

    private function checkPin(int $pin, int $account_pin)
    {
        return $account_pin == $pin;
    }

    private function checkDispoLimit(Checkingaccount $account, float $amount)
    {
        return $account->amount - $amount < $account->limit;
    }

    private function getCheckingAccount(int $id)
    {
        return Checkingaccount::find($id);
    }
}
