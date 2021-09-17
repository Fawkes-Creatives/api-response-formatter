## Usage

- Option 1: Use Facade
```php
use ApiResponse\Formatter\Facades\ApiResponse;

public function index()
{
    return ApiResponse::success();
}
```

- Option 2: Use Helper
```php
public function index()
{
    return api_response()->success();
}
```

- Option 3: Use Inject
```php
use ApiResponse\Formatter\Http\ResponseService;

public function index(ResponseService $response)
{
    return $response->success();
}
```

### Success Response
``Sample 1: Empty data``
```php
use ApiResponse\Formatter\Facades\ApiResponse;

public function index()
{
    return ApiResponse::success();
}
```
```json
{
    "status": 200,
    "success": true,
    "message": "success",
    "data": null
}
```

``Sample 2: Use Spatie Laravel Fractal``
```php
use ApiResponse\Formatter\Facades\ApiResponse;
use App\Transformers\UserTransformer;

public function index()
{   
    $users = User::paginate();
    $users = fractal($users, UserTransformer::class);
    
    return ApiResponse::success($users);
}
```
```json
{
    "status": 200,
    "success": true,
    "message": "success",
    "data": [...],
    "meta": {...}
}
```

``Sample 3: Use API Resources``
```php
use ApiResponse\Formatter\Facades\ApiResponse;
use App\Http\Resources\UserCollection;

public function index()
{   
    $users = User::paginate();
    $users = new UserCollection($users);
    
    return ApiResponse::success($users);
}
```
```json
{
    "data": [...],
    "links": {...},
    "meta": {...},
    "status": 200,
    "success": true,
    "message": "success"
}
```

### Error Response
``Sample 1: Empty info``
```php
use ApiResponse\Formatter\Facades\ApiResponse;

public function index()
{
    return ApiResponse::error();
}
```
```json
{
      "status": 400,
      "success": false,
      "message": "error",
      "data": null
}
```

``Sample 2: With info``
```php
use ApiResponse\Formatter\Facades\ApiResponse;
use App\Http\HtmlStatusCode;

public function index()
{ 
    return ApiResponse::error(
        HtmlStatusCode::UNAUTHORIZED,
        "You don't have permit.",
        [
            'ip'     => '192.168.x.x',
            'time'   => '2021-09-17 16:45:07 UTC ',
            'detail' => 'To further protect your account, consider configuring a two-factor authentication method.'
        ]
    );
}
```
```json
{
      "status": 401,
      "success": false,
      "message": "You don't have permit.",
      "data": {
        "ip": "192.168.x.x",
        "time": "2021-09-17 16:45:07 UTC ",
        "detail": "To further protect your account, consider configuring a two-factor authentication method."
      }
}
```