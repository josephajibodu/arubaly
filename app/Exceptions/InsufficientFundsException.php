<?php

namespace App\Exceptions;

class InsufficientFundsException extends \Exception
{
    /**
     * Report the exception.
     *
     * @return void
     */
    public function report()
    {
        // You can perform additional logging or reporting here if needed
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function render($request)
    {
        return response()->json(['error' => 'Insufficient funds in your wallet.'], 422);
    }
}
