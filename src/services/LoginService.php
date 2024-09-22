<?php

namespace src\services;

use src\models\Users;
use Illuminate\Database\Capsule\Manager;

class LoginService
{
    private $Users;

    public function __construct()
    {
        $this->Users = new Users();
    }

    public function login(string $email, string $passwd): array
    {
        $return = ['auth' => false, 'error' => 'Login inválido'];

        if (empty($email) || empty($passwd)) {
            return $return;
        }

        $query = Manager::table('users')
            ->where('email', '=', $email)
            ->where('passwd', '=', $passwd);

        $res = $query->get();
        $user = $res[0] ?? [];

        if (empty($user) == true) {
            $return['error'] = 'Usuário ou senha inválido!';
            return $return;
        }

        $this->startUserSession($user->id);
        $return['auth'] = true;
        $return['error'] = '';
        return $return;
    }

    public function startUserSession($userId): bool
    {
        session_destroy();
        session_start();

        $user = $this->Users::find($userId);
        $now = date('Y-m-d H:i:s');

        $_SESSION['userId'] = $user->id;
        $_SESSION['firstName'] = $user->first_name;
        $_SESSION['lastName'] = $user->last_name;
        $_SESSION['email'] = $user->email;
        $_SESSION['loginTime'] = $now;
        $_SESSION['login'] = true;

        $user->last_login = $now;
        $user->save();
        return true;
    }
}
