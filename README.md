# PureRequest

## ⚠️ UNDER DEVELOPMENT ⚠️

## Introduction
`PureRequest` is a streamlined PHP library designed to simplify web communication by providing a hassle-free interface for HTTP requests, eliminating the complexity of using cURL directly. This library supports a wide range of HTTP operations, including GET and POST requests, and is highly configurable to meet the needs of various web applications.

## Features
- Easy-to-use interface for HTTP GET and POST requests
- Support for custom headers and body content
- Configurable request options, including timeouts and redirection handling
- Built-in support for handling response data and status codes
- Secure and efficient implementation

## Installation

To install PureRequest, you need to have Composer installed on your machine. Run the following command in your project directory:

```bash
composer require swnck/pure-request
```

## Usage

### Configuration of Request
```php
$request = new PureRequest((new RequestConfiguration())
    ->setReturnTransfer(true) // Return the transfer as a string of the return value of curl_exec() instead of outputting it out directly
    ->setFollowLocation(true) // Follow any "Location: " header that the server sends as part of the HTTP header (note this is recursive, PHP will follow as many "Location: " headers that it is sent, unless CURLOPT_MAXREDIRS is set)
    ->setConnectTimeout(10) // The maximum number of seconds to allow cURL functions to execute
);
```

or if you want to stay with DEFAULT configuration:
```php
$request = new PureRequest();
```

### Sending a GET Request
```php
$request->get(HeaderContent::empty(), function (ResponseFrame $response) {
    echo $response->getContent();
    echo $response->getStatusCode();
}, "https://example.com/api/data");
```

### Sending a POST Request
```php
$request->post(HeaderContent::paste(["Content-Type" => ContentType::APPLICATION_JSON, "Connection" => "keep-alive"]), BodyContent::paste([
    "email" => "user@example.com",
    "password" => "your_password"
]), function (ResponseFrame $response) {
    echo $response->getContent();
}, "https://example.com/api/login");
```

## Features
- [x] Easy-to-use interface for HTTP GET and POST requests
- [x] Support for custom headers and body content
- [ ] Support for PUT, DELETE, PATCH, OPTIONS, HEAD, and other HTTP methods
- [ ] Support for file uploads and multipart form data
- [x] Configurable request options, including timeouts and redirection handling
- [x] Built-in support for handling response data and status codes
- [x] Secure and efficient implementation
- [ ] Support for cookies and session management
- [ ] Support for asynchronous requests and parallel processing

## Contributing
We welcome contributions from the community! If you'd like to contribute to PureRequest, please fork the repository and submit a pull request with your proposed changes or improvements.

## License 
The contents of this repository are licensed under the [Apache License, version 2.0](http://www.apache.org/licenses/LICENSE-2.0).

