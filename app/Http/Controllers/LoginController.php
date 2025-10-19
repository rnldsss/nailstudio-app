<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    private function findDummyUser(string $username)
    {
        // Data dummy untuk otentikasi
        $dummyUsers = [
            // Password: 'password' (asumsi hash ini untuk 'password')
            'admin_user' => ['id' => 1, 'username' => 'admin_user', 'password' => '$2y$10$92IXSuN1E3G/tLq1f6oP.uFf/1n0lR/cO1.j4K42L2fE6fC4t8aD', 'role' => 'admin'], 
            'member_user' => ['id' => 2, 'username' => 'member_user', 'password' => '$2y$10$92IXSuN1E3G/tLq1f6oP.uFf/1n0lR/cO1.j4K42L2fE6fC4t8aD', 'role' => 'member'],
        ];

        return $dummyUsers[$username] ?? null;
    }

    /**
     * Menampilkan formulir login.
     */
    public function showLoginForm()
    {
        if (session('loggedin')) {
            if (session('role') == 'admin') {
                return redirect()->route('dashboard.index');
            }
            return redirect()->to('/');
        }
        
        // Mengirim error dari session
        return view('admin/login', ['error' => session('error')]);
    }

    /**
     * Memproses login (POST).
     */
    public function login(Request $request)
    {
        $request->validate(['username' => 'required|string', 'password' => 'required|string']);
        
        $username = $request->username;
        $password = $request->password;
        
        $user = $this->findDummyUser($username);

        if ($user) {
            // Dalam proyek nyata: if (\Hash::check($password, $user['password']))
            // Karena ini dummy, kita asumsikan check hash
            if (\Hash::check($password, $user['password'])) { 
                
                // Set Session Laravel
                session(['loggedin' => true, 'id' => $user['id'], 'username' => $user['username'], 'role' => $user['role']]);

                // Redirect sesuai role
                if ($user['role'] == "admin") {
                    return redirect()->route('dashboard.index');
                }
                return redirect()->to('/');

            } else {
                return redirect()->back()->with('error', 'Invalid password');
            }
        } else {
            return redirect()->back()->with('error', 'Username not found');
        }
    }
}
