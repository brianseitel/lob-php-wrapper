<?php
require __DIR__.'/../../bootstrap.php';

class ConfigTest extends PHPUnit_Framework_TestCase {

    public function testGetKey() {
        $settings = [
            'lob' => [
                'api_key' => 'foobar',
            ],
            'keys' => [
                'lock1' => 5,
                'lock2' => 3,
            ],
            'names' => [
                'boys' => [
                    'brian',
                    'george',
                    'alan'
                ],
                'girls' => [
                    'sarah',
                    'kimberly',
                    'laura'
                ]
            ]
        ];

        $this->assertEquals('foobar', Config::getKey($settings, 'lob.api_key'));
        $this->assertEquals(5, Config::getKey($settings, 'keys.lock1'));
        $this->assertEquals('brian', Config::getKey($settings, 'names.boys.0'));
    }
}