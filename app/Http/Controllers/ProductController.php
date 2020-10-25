<?php

namespace App\Http\Controllers;

use Facade\FlareClient\Api;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Services\ApiOzon;

class ProductController extends Controller
{
    public function addProducts(Request $request)
    {
        $items = json_decode($request->getContent(), true);

        if (!$items) {
            return response()->json(['error' => 'Invalid Json'], 400);
        }

        $client = new ApiOzon();
        $response = $client->addProducts($items);
        if (isset($response['error'])) {
            return response()->json($response, 400);
        } else {
            Log::info('task_id = ' . $response['result']['task_id']);
        }

        return response()->json($response);
    }

    public function infoProduct(Request $request)
    {
        $params = json_decode($request->getContent(), true);

        if (!$params) {
            return response()->json(['error' => 'Invalid Json'], 400);
        }

        $client = new ApiOzon();
        $response = $client->getProductInfo($params);
        if (isset($response['error'])) {
            return response()->json($response, 400);
        }

        return response()->json($response);
    }
}
