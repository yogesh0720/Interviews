<?php

interface Factory
{
    public function create();
}

class Friend
{
    public function sayHello()
    {
        return "Hello, I am your friend!";
    }
}

class FriendFactory implements Factory
{
    public function create(): Friend
    {
        return new Friend();
    }
}

$factory = new FriendFactory();
$friend = $factory->create();

echo $friend->sayHello(); //Hello, I am your friend!

#######################################################
#######################################################
#######################################################
#######################################################

interface UserServiceInterface
{
    public function getUser(): string;
}

class AdminUserService implements UserServiceInterface
{
    public function getUser(): string
    {
        return 'Admin User';
    }
}

class CustomerUserService implements UserServiceInterface
{
    public function getUser(): string
    {
        return 'Customer User';
    }
}

/*
### Service-Based Factory using if–else ###
class UserServiceFactory
{
    public function create(string $type): UserServiceInterface
    {
        if ($type === 'admin') {
            return new AdminUserService();
        }

        if ($type === 'customer') {
            return new CustomerUserService();
        }

        throw new InvalidArgumentException('Invalid user type');
    }
}

*/
/*
### Production-Ready (DI Container Style – Senior Level)
class UserServiceFactory
{
    public function __construct(
        private AdminUserService $admin,
        private CustomerUserService $customer
    ) {}

    public function create(string $type): UserServiceInterface
    {
        return match ($type) {
            'admin'    => $this->admin,
            'customer' => $this->customer,
            default    => throw new InvalidArgumentException('Invalid user type'),
        };
    }
}
*/

### Registry / Map-Based Factory (Best Practice) ###
class UserServiceFactory
{
    private array $services = [
        'admin'    => AdminUserService::class,
        'customer' => CustomerUserService::class,
    ];

    public function create(string $type): UserServiceInterface
    {
        if (!isset($this->services[$type])) {
            throw new InvalidArgumentException('Invalid user type');
        }

        return new $this->services[$type]();
    }
}

##USE CASE##
$factory = new UserServiceFactory();
try {
    $adminUserService = $factory->create('admin');
    echo $getUser = $adminUserService->getUser();
    $customerUserService = $factory->create('customer');
    echo $getUser = $customerUserService->getUser();
} catch (Exception $e) {
    throw new Exception($e->getMessage());
}
