<?php
require __DIR__.'/../../vendor/autoload.php';

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

        $this->assertEquals('foobar', Lob\Config::getKey($settings, 'lob.api_key'));
        $this->assertEquals(5, Lob\Config::getKey($settings, 'keys.lock1'));
        $this->assertEquals('brian', Lob\Config::getKey($settings, 'names.boys.0'));
    }
}