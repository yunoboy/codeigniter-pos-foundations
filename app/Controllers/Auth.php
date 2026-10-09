<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login(): string
    {
        if (session()->has('user_id')) {
            return redirect()->to(site_url('customers'))->getBody();
        }

        return view('auth/login', [
            'errors' => [],
            'username' => '',
        ]);
    }

    public function attempt()
    {
        $username = trim((string) $this->request->getPost('username'));
        $password = (string) $this->request->getPost('password');

        $rules = [
            'username' => 'required',
            'password' => 'required',
        ];

        if (! $this->validateData(
            [
                'username' => $username,
                'password' => $password,
            ],
            $rules
        )) {
            return view('auth/login', [
                'errors' => $this->validator->getErrors(),
                'username' => $username,
            ]);
        }

        $user = (new UserModel())
            ->where('username', $username)
            ->first();

        if ($user === null || ! password_verify($password, $user['password'])) {
            return view('auth/login', [
                'errors' => [
                    'login' => 'The username or password is incorrect.',
                ],
                'username' => $username,
            ]);
        }

        session()->regenerate();
        session()->set([
            'user_id' => $user['id'],
            'username' => $user['username'],
            'full_name' => $user['full_name'],
            'is_logged_in' => true,
        ]);

        return redirect()->to(site_url('customers'));
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to(site_url('login'));
    }
}