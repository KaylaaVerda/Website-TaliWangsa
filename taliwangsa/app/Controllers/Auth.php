<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Auth extends Controller
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        helper(['form','url']);
    }

    public function login()
    {
        return view('auth/login');
    }

    public function loginProcess()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $this->db->table('users')
            ->where('email', $email)
            ->get()
            ->getRow();

        if(!$user){
            return redirect()->back()->with('error', 'Email tidak ditemukan.');
        }

        if(!password_verify($password, $user->password)){
            return redirect()->back()->with('error', 'Password salah.');
        }

        session()->set([
            'isLoggedIn' => true,
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role,
            'avatar' => $user->avatar,
        ]);

        if($user->role == 'admin'){
            return redirect()->to('/admin/dashboard');
        }

        if($user->role == 'freelancer'){
            return redirect()->to('/freelancer/dashboard');
        }

        return redirect()->to('/dashboard');
    }

    public function register()
    {
        return view('auth/register');
    }

    public function registerProcess()
    {
        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $phone = $this->request->getPost('phone');
        $password = $this->request->getPost('password');
        $confirm = $this->request->getPost('confirm_password');
        $role = $this->request->getPost('role');

        if(!$name || !$email || !$phone || !$password || !$confirm || !$role){
            return redirect()->back()->with('error', 'Semua field wajib diisi.');
        }

        if($password != $confirm){
            return redirect()->back()->with('error', 'Konfirmasi password tidak cocok.');
        }

        $check = $this->db->table('users')
            ->where('email', $email)
            ->get()
            ->getRow();

        if($check){
            return redirect()->back()->with('error', 'Email sudah digunakan.');
        }

        $avatar = 'default.png';

        $this->db->table('users')->insert([
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'avatar' => $avatar,
            'role' => $role,
            'is_verified' => 0,
        ]);

        $userId = $this->db->insertID();

        session()->set([
            'isLoggedIn' => true,
            'user_id' => $userId,
            'name' => $name,
            'email' => $email,
            'role' => $role,
            'avatar' => $avatar,
        ]);

        if($role == 'freelancer'){
            return redirect()->to('/freelancer/dashboard');
        }

        return redirect()->to('/dashboard');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}