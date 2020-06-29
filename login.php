<?php

session_start();
require_once 'user.php';

$_SESSION['log_user'] = $_POST['login'];
$_SESSION['pass_user']= $_POST['password'];

class Users
{
    public function __construct($user)
    {
        $this->name = $user['name'];
        $this->surname = $user['surname'];
    }

}

class Admin extends Users
{
    public function welcome()
    {
        echo 'Здравствуйте, вы админ ' . $this->name . ' ' . $this->surname . '. Вы можете делать всё.';
        include 'admin.php';
    }
}

class Manager extends Users
{
    public function welcome()
    {
        echo 'Здравствуйте, вы менеджер ' . $this->name . ' ' . $this->surname . '. Вы можете изменять, удалять и создавать клиентов.';
        include 'manager.php';
    }
}

class Client extends Users
{
    public function welcome()
    {
        echo 'Здравствуйте, вы клиент ' . $this->name . ' ' . $this->surname . '. Вы можете просматривать информацию доступную пользователям.';
        include 'client.php';
    }
}

$role = [
    'admin'=>Admin::class,
    'manager'=>Manager::class,
    'client'=>Client::class,
];

foreach ($arr as $user) 
{
    if ($_SESSION['log_user'] == $user['login'] && $_SESSION['pass_user'] == $user['password']) 
    {
        $role_user = new $role[$user['role']]($user);
        $_SESSION['role'] = $user['role'];
        break;
    }
}

$_SESSION['name'] = $user['name'];
$_SESSION['surname'] = $user['surname'];

if ($role_user > 0) 
{
    $role_user->welcome();
} else 
{
    echo 'Login failed';
} 

	?>