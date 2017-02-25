<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param $data array or object
     * @return \Illuminate\Http\JsonResponse
     */
    protected function _successJsonResponse($data) {
        return response()->json($data, 200);
    }
    /**
     * @param $data array or object
     * @param int $header_response
     * @return \Illuminate\Http\JsonResponse
     */
    protected function _failedJsonResponse($data, $header_response = 422) {
        return response()->json($data, $header_response);
    }
    /**
     * check if request is valid json request
     * @return bool|\Illuminate\Http\RedirectResponse
     */
    protected function _checkAjaxRequest() {
        if(!Request::ajax()) {
            return back()->with('message', 'Unauthorised access');
        }
        return true;
    }
}
