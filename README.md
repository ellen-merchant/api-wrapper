# ellllllen/api-wrapper
An API wrapper for the @guzzle/guzzle package

## Installation
`composer require ellllllen/api-wrapper`

### Laravel 5 Implementation
1. In `app/config` add the package Service Provider to the providers array: 
`\Ellllllen\ApiWrapper\ApiWrapperServiceProvider::class`

2. Perform `php artisan vendor:publish` command.

3. Add the configuration for the API you are querying in `config/api-wrapper`

## Usage
### GET request, with no parameters

```php
use Ellllllen\ApiWrapper\Connect;

class HomeController extends Controller
 {
     public function index(Connect $connect)
     {
         $response = $connect->doRequest();
         
         dump($response);
     }
 }
```

### POST request, with parameters

```php
use Ellllllen\ApiWrapper\Connect;

class HomeController extends Controller
 {
     public function index(Connect $connect)
     {
         $response = $connect->doRequest('post', ['id' => 123, 'filter' => 'example']);
         
         dump($response);
     }
 }
```

## Future Developments
1. Facility to connect to multiple APIs
2. API debugging facilities


