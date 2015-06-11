<?php
require __DIR__.'/../../vendor/autoload.php';

class ApiTest extends PHPUnit_Framework_TestCase {

    private $lob;
    private $address;
    private $address_ids = [];

    public function setup() {
        $this->lob = new Lob\Api(Lob\Config::get('lob.api_key'));
        $this->address = [
            'name'            => 'Brian Seitel',
            'address_line1'   => '225 Bush St',
            'address_line2'   => 'Suite 1100',
            'address_city'    => 'San Francisco',
            'address_state'   => 'CA',
            'address_zip'     => '94104',
            'address_country' => 'US',
        ];
    }

    public function testRequests() {
        // Create an address
        $results = $this->lob->request('post', 'addresses', $this->address);

        $id = $results['id'];

        $this->assertTrue(isset($results['id']));
        $this->assertEquals($this->address['name'],            $results['name']);
        $this->assertEquals($this->address['address_line1'],   $results['address_line1']);
        $this->assertEquals($this->address['address_line2'],   $results['address_line2']);
        $this->assertEquals($this->address['address_city'],    $results['address_city']);
        $this->assertEquals('California',                      $results['address_state']);
        $this->assertEquals($this->address['address_zip'],     $results['address_zip']);
        $this->assertEquals('United States',                   $results['address_country']);
        $this->assertFalse(isset($results['deleted']));

        // Fetch from /v1/address
        $results = $this->lob->request('get', 'addresses/'.$id);

        $this->assertTrue(isset($results['id']));
        $this->assertEquals($this->address['name'],          $results['name']);
        $this->assertEquals($this->address['address_line1'], $results['address_line1']);
        $this->assertEquals($this->address['address_line2'], $results['address_line2']);
        $this->assertEquals($this->address['address_city'],  $results['address_city']);
        $this->assertEquals('California',                    $results['address_state']);
        $this->assertEquals($this->address['address_zip'],   $results['address_zip']);
        $this->assertEquals('United States',                 $results['address_country']);
        $this->assertFalse(isset($results['deleted']));

        // Delete the address
        $results = $this->lob->request('delete', 'addresses/'.$id);

        $this->assertEquals($id, $results['id']);
        $this->assertEquals(1,   $results['deleted']);

        // Fetch it again -- deleted should be 1
         // Fetch from /v1/address
        $results = $this->lob->request('get', 'addresses/'.$id);

        $this->assertTrue(isset($results['id']));
        $this->assertEquals($this->address['name'],            $results['name']);
        $this->assertEquals($this->address['address_line1'],   $results['address_line1']);
        $this->assertEquals($this->address['address_line2'],   $results['address_line2']);
        $this->assertEquals($this->address['address_city'],    $results['address_city']);
        $this->assertEquals('California',                      $results['address_state']);
        $this->assertEquals($this->address['address_zip'],     $results['address_zip']);
        $this->assertEquals('United States',                   $results['address_country']);
        $this->assertEquals(1,                                 $results['deleted']);
    }

    public function testVerify() {
        $results = $this->lob->request('post', 'verify', $this->address);

        $this->assertEquals('225 BUSH ST',   $results['address']['address_line1']);
        $this->assertEquals('STE 1100',      $results['address']['address_line2']);
        $this->assertEquals('SAN FRANCISCO', $results['address']['address_city']);
        $this->assertEquals('CA',            $results['address']['address_state']);
        $this->assertEquals('94104-4250',    $results['address']['address_zip']);
        $this->assertEquals('US',            $results['address']['address_country']);
    }
}