# Laravel 6+ Php Artisan Make:Repository, Php Artisan Make:Service
A package for addding `php artisan make:repository`, `php artisan make:service` command to Laravel 6+

## Installation
Require the package with composer using the following command:

`composer require lamdd/design-pattern-repository-service:"dev-master"`

Or add the following to your composer.json's require-dev  section and `composer update`

```json
"require-dev": {
          "lamdd/design-pattern-repository-service": "dev-master"
}
```

In your config/app.php add DesignPattern\LaravelMakeRepositoryService\RepositoryServiceProvider::class to the end of the providers array:
```php
'providers' => [
    ...
    DesignPattern\LaravelMakeRepositoryService\RepositoryServiceProvider::class,
],
```

Publish Configuration
```bash
php artisan vendor:publish --provider "DesignPattern\LaravelMakeRepositoryService\RepositoryServiceProvider"
```

## Usage
`php artisan make:repository your-repository-name`

`php artisan make:service your-service-name`

Example:
```
php artisan make:repository User

php artisan make:service User
```
or
```
php artisan make:repository Backend\User

php artisan make:service Backend\User
```
```
<?php

namespace App\Repositories;

use App\Models\User;
use DesignPattern\LaravelMakeRepositoryService\Repository\BaseRepository;
use App\Repositories\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }
    public function getFindUserCompany($id) {
        return $this->model->join('companies as c', 'cp.id','=','users.company_id')->where('c.id',$id)->first()
    }
}
```
````
<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Services\UserServiceInterface;

class UserService implements UserServiceInterface
{
    protected $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function getFindUser($id) {
        return $this->userRepository->where('id',$id)->first();
    }
}

````
````
<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function index (Request $request){
        $user = $this->userService->getFindUser($request->id);
        return $user;
    }
}
````
