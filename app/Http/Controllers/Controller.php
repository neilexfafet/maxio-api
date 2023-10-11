<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function maxioRequest($method = 'GET', $resource = '', $body = []) {
        $baseUrl = config('maxio.base_url');
        $username = config('maxio.key');
        $password = config('maxio.password');

        $client = new \GuzzleHttp\Client();

        $method = strtoupper($method);

        $token = base64_encode($username.':'.$password);

        $params = $method == 'POST' ? 'form_params' : 'query';

        try {
            $data = $client->request($method, $baseUrl.$resource, [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Basic '.$token
                ],
                $params => $body
            ]);

            return $this->formatRequest(true, $data);
        } catch(\Exception $e) {
            return $this->formatRequest(false, $e);
        } catch (\Guzzle\Http\Exception $e) {
            return $this->formatRequest(false, $e);
        } catch(\Guzzle\Http\Exception\BadResponseException $e) {
            return $this->formatRequest(false, $e);
        } catch(\Guzzle\Http\Exception\ClientException $e) {
            return $this->formatRequest(false, $e);
        }
    }

    protected function formatRequest($success, $result) {
        if($success) {
            return [
                'success' => true,
                'data' => $result->getBody(),
            ];
        } else {
            return [
                'success' => false,
                'message' => $result->getResponse()->getBody()->getContents() ?? $result->getMessage(),
                'code' => $result->getCode()
            ];
        }
    }

    public function response($result = [], $message = '') {
        if($result['success']) {
            $data = json_decode($result['data']);
            
            return $this->sendResponse($data, $message);
        } else {
            return $this->sendError($result['message'], $result['code']);
        }
    }

    public function sendResponse($result = [], $message = '', $code = 200) {
        return response()->json([
            'success' => true,
            'data' => $result,
            'message' => $message,
        ], $code);
    }

    public function sendError($error = '', $code = 404) {
        return response()->json([
            'success' => false,
            'message' => $error
        ], $code);
    }

    public function sendSuccess($message = '') {
        return response()->json([
            'success' => true,
            'message' => $message
        ], 200);
    }
}
