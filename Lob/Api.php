<?php

namespace Lob;

use GuzzleHttp\Client;

class Api {

    private $base_url = 'https://api.lob.com/v1/';
    private $api_key;

    public function __construct($api_key) {
        $this->api_key = $api_key;
    }

    /**
     * Sends a request to Lob's API. If successful, returns the response as an array.
     * If it fails, it returns the status code and the reason for failure.
     *
     * @param $action String The method through which to send the request: GET, PUT, PATCH, DELETE, POST
     * @param $endpoint String Which endpoint we want to hit on Lob's API
     * @param $params Array The data we want to send to Lob as a key-value array
     */
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
