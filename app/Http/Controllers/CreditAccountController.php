<?php

namespace App\Http\Controllers;

use App\Checkingaccount;
use App\Creditaccount;
use App\Http\Controllers\Utils\Utils;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CreditAccountController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|Response|object
     */
    public function store(Request $request)
    {
        $checkingaccount = Checkingaccount::find($request->checkingaccount_id);

        try {
            $newCreditaccount = new Creditaccount();
            $newCreditaccount->limit = Utils::setLimit($request->limit);

            if ($checkingaccount == null) {
                return response("no checking account exist")->setStatusCode(Response::HTTP_BAD_REQUEST);
            }

            $newCreditaccount->checkingaccount_id = $checkingaccount->id;
            $newCreditaccount->save();
            return response()->json($newCreditaccount);
        } catch (\Exception $e) {
            return response("something goes wrong: $e")->setStatusCode(Response::HTTP_BAD_REQUEST);
        }
    }

    public function index()
    {
        $creditaccount = Checkingaccount::whereUserId(Auth::id())->get()
            ->flatMap(function ($it) {
                return $it->creditaccounts;
            });
        return response()->json($creditaccount);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|Response|object
     */
    public function update(Request $request, $id)
    {
        $creditAccount = Creditaccount::find($id);

        if ($creditAccount != null) {

            if (Utils::isUserNotAuthorized($creditAccount->checkingaccount->user_id)) {
                return Utils::responseNotAuthorized();
            }

            $creditAccount->amount -= $request->amount;
            $checkingAccount = $creditAccount->checkingaccount;

            if ($this->checkCreditLimit($creditAccount)) {
                if ($this->checkCheckingAccountLimit($creditAccount, $checkingAccount)) {
                    $creditAccount->save();
                    return response()->json($creditAccount);
                } else {
                    return response("not enough money on checking account")->setStatusCode(Response::HTTP_NOT_ACCEPTABLE);
                }
            } else {
                return response("credit limit exceed")->setStatusCode(Response::HTTP_NOT_ACCEPTABLE);
            }
        } else {
            return response("no credit account")->setStatusCode(Response::HTTP_NOT_ACCEPTABLE);
        }
    }

    private function checkCreditLimit(Creditaccount $creditAccount)
    {
        return $creditAccount->limit <= $creditAccount->amount;
    }

    private function checkCheckingAccountLimit(Creditaccount $creditAccount, Checkingaccount $checkingaccount)
    {
        return $checkingaccount->limit < ($checkingaccount->amount + $creditAccount->amount);
    }
}
