<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    private $baseUrl;
    private $username;
    private $password;

    public function __construct() {
        $this->baseUrl = config('maxio.base_url');
        $this->username = config('maxio.key');
        $this->password = config('maxio.password');
    }

    protected function maxioRequest($method = 'GET', $resource = '', $body = []) {
        $client = new \GuzzleHttp\Client();

        $method = strtoupper($method);

        $token = base64_encode($this->username.':'.$this->password);

        $params = $method == 'POST' ? 'form_params' : 'query';

        try {
            $data = $client->request($method, $this->baseUrl.$resource, [
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
            'message' => $this->str_or_json($message),
        ], $code);
    }

    public function sendError($error = '', $code = 404) {
        return response()->json([
            'success' => false,
            'message' => $this->str_or_json($error)
        ], $code);
    }

    public function sendSuccess($message = '') {
        return response()->json([
            'success' => true,
            'message' => $message
        ], 200);
    }

    public function str_or_json($str) {
        if(json_decode($str)) {
            return json_decode($str);
        }
        return $str;
    }
}
