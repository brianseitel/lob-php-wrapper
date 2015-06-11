<?php

namespace Lob;

use GuzzleHttp\Client;

class Api {

    private $base_url = 'https://api.lob.com/v1/';
    private $api_key;

    public function __construct($api_key) {
        $this->api_key = $api_key;
    }

    public function request($action, $endpoint, $params = []) {
        $client = new Client(['base_uri' => $this->base_url]);

        $results = $client->{$action}($endpoint, [
            'auth' => [$this->api_key, null],
            'form_params' => $params,
            'http_errors' => false,
        ]);

        if ($results->getStatusCode() == 200) {
            return json_decode($results->getBody(true), 1);
        } else {
            return [
                'status' => $results->getStatusCode(),
                'reason' => $results->getReasonPhrase()
            ];
        }

        throw new \Exception("Oops, something went wrong!");
    }
}
