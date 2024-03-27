<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ExternalService;

class AuthController extends Controller
{
    public function getToken(ExternalService $externalService)
    {
        try {
            return response()->json(['token' =>  $externalService->getAccess()]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }
}
