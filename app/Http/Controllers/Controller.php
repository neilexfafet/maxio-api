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

        $params = $method == 'POST' ? 'body' : 'query';

        try {
            $data = $client->request($method, $this->baseUrl.$resource, [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Basic '.$token
                ],
                $params => $body
            ]);

            return $data;
        } catch(\Exception $e) {
            return $e;
        } catch (\Guzzle\Http\Exception $e) {
            return $e;
        } catch(\Guzzle\Http\Exception\BadResponseException $e) {
            info('error');
            info($e);
            return $e;
        }
    }
}
