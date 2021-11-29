## Usage

- Option 1: Use Facade
```php
use LaravelIntuition\Facades\Intuition;

public function index()
{
    return Intuition::success();
}
```

- Option 2: Use Helper
```php
public function index()
{
    return intuition()->success();
}
```

- Option 3: Use Inject
```php
use LaravelIntuition\Http\ResponseService;

public function index(ResponseService $response)
{
    return $response->success();
}
```

### Success Response
``Sample 1: Empty data``

```php
use LaravelIntuition\Facades\Intuition;
use App\Http\HttpStatusCode;

public function index()
{
    return Intuition::success(null, [
        'status' => HttpStatusCode::SUCCESS,
        'message' => 'success'
    ]);
}
```
```json
{
    "status": 200,
    "status_ref": "Ok",
    "success": true,
    "message": "success",
    "data": null
}
```

``Sample 2: Use Spatie Laravel Fractal``
```php
use LaravelIntuition\Facades\Intuition;
use App\Transformers\UserTransformer;

public function index()
{   
    $users = User::paginate();
    $users = fractal($users, UserTransformer::class);
    
    return Intuition::success($users);
}
```
```json
{
    "status": 200,
    "status_ref":"Ok",
    "success": true,
    "message": "success",
    "data": [...],
    "meta": {...}
}
```

``Sample 3: Use API Resources``
```php
use LaravelIntuition\Facades\Intuition;
use App\Http\Resources\UserCollection;

public function index()
{   
    $users = User::paginate();
    $users = new UserCollection($users);
    
    return Intuition::success($users);
}
```
```json
{
    "data": [...],
    "links": {...},
    "meta": {...},
    "status": 200,
    "status_ref": "Ok",
    "success": true,
    "message": "success"
}
```

### Error Response
``Sample 1: Empty info``
```php
use LaravelIntuition\Facades\Intuition;

public function index()
{
    return Intuition::error();
}
```
```json
{
    "status": 400,
    "status_ref": "Bad Request",
    "success": false,
    "message": "error",
    "data": null
}
```

``Sample 2: With info``
```php
use LaravelIntuition\Facades\Intuition;
use App\Http\HttpStatusCode;

public function index()
{ 
    return Intuition::error(
        HttpStatusCode::FORBIDDEN,
        "You don't have permit.",
        [
            'ip'     => '192.168.x.x',
            'time'   => '2021-09-17 16:45:07 UTC ',
            'detail' => 'The REST API Key you are using does not have sufficient permissions.'
        ]
    );
}
```
```json
{
    "status": 403,
    "status_ref": "Forbidden",
    "success": false,
    "message": "You don't have permit.",
    "data": {
        "ip": "192.168.x.x",
        "time": "2021-09-17 16:45:07 UTC ",
        "detail": "The REST API Key you are using does not have sufficient permissions."
    }
}
```
