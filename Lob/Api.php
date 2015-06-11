<?php

use Guzzle\Http\Client;
use Guzzle\Http\EntityBody;
use Guzzle\Http\Message\Request;
use Guzzle\Http\Message\Response;

class Lob {

    private $base_url = 'https://api.lob.com/v1/';

    public function request($action, $endpoint, $params = []) {
        $client = new Client($this->base_url);
        if (!method_exists($client, $action)) {
            throw new Exception("Action must be a valid Guzzle action, such as `get`, `post`, `delete`, etc.");
        }
        $request = $client->{$action}($endpoint, [], $params);
        $request->setAuth(Config::get('lob.api_key'), null);

        try {
            $results = $request->send()->getBody(true);
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
        
        return json_decode($results, 1) ?: $results;
    }
}
