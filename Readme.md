# Project Name

Lob builds APIs for Printing and Mailing for developers. It makes sending postcards, checks, and letters a breeze. It even provides basic address verification.

This is a library to connect to and consume the Lob API.

## Installation

First, [install composer](https://getcomposer.org/doc/00-intro.md).

Next, require this package.

```
composer require 'brianseitel/lob:dev-master'
```



## Usage

The library is designed to be as simple as possible to use. All you need is your API Key, which you can find on your Dashboard. Your API key goes into a file in `config/app.php`. It looks like this:

```
<?php

return [
    'lob' => [
        'api_key' => 'YOUR_API_KEY_GOES_HERE'
    ]
];
```
Now, you can use the API library like so:

```
$api_key = Lob\Config::get('lob.api_key');
$lob = new Lob\Api($api_key);

$results = $lob->request('get', 'addresses', []); // List all addresses
```

The full signature is: `$lob->request($action, $endpoint, $data)`

* `$action` must be one of the standard HTTP verbs (case insensitive): GET, POST, PUT, DELETE, PATCH
* `$endpoint` must be on of the endpoints detailed in Lob's [Developer Documentation](https://lob.com/docs#intro).
* `$data` must be an array of parameters. This library does not check the validity of the parameters.



## Contributing

1. Fork it!
2. Create your feature branch: `git checkout -b my-new-feature`
3. Commit your changes: `git commit -am 'Add some feature'`
4. Push to the branch: `git push origin my-new-feature`
5. Submit a pull request :D

## License

The MIT License (MIT)

Copyright (c) 2015 Brian Seitel

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
