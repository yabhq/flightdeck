<?php

namespace Yab\FlightDeck\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Yab\FlightDeck\Http\Requests\ResetPasswordRequest;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Reset the given user's password.
     *
     * @param  Yab\FlightDeck\Http\Requests\ResetPasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function reset(ResetPasswordRequest $request)
    {
        $response = $this->broker()->reset(
            $this->credentials($request), function ($user, $password) {
                $this->resetPassword($user, $password);
            }
        );

        return $response == Password::PASSWORD_RESET
            ? $this->sendResetResponse($request, $response)
            : $this->sendResetFailedResponse($request, $response);
    }

    /**
     * Get the response for a successful password reset.
     *
     * @param  Yab\FlightDeck\Http\Requests\ResetPasswordRequest   $request
     * @param  string  $response
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendResetResponse(ResetPasswordRequest $request, $response)
    {
        return new JsonResponse([
            'success' => true,
            'message' => '',
        ], Response::HTTP_OK);
    }

    /**
     * Get the response for a failed password reset.
     *
     * @param  Yab\FlightDeck\Http\Requests\ResetPasswordRequest   $request
     * @param  string  $response
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendResetFailedResponse(ResetPasswordRequest $request, $response)
    {
        return new JsonResponse([
            'success' => false,
            'message' => 'An error occurred while trying to reset the password',
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
