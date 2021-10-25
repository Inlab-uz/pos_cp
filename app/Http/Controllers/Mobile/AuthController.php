<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\Cashier;
use App\Models\Meneger;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends MobileResponseController
{
    public function register(Request $request){
        $user = Meneger::where('email', $request->email)->first();
        if ($user instanceof Meneger){
            if(  Hash::check( $request->password, $user->password ) )
            {
                $token = $user->createToken('mobile');
                $data = [
                    'token' => $token->plainTextToken,
                    'manager' => true,
                    'cashier' => false
                ];
                return $this->success($data);
            }
        }
        $user = Cashier::where('email', $request->email)->first();
        if($user instanceof Cashier){
            if(  Hash::check( $request->password, $user->password ) )
            {
                $token = $user->createToken('mobile');
                $data = [
                    'token' => $token->plainTextToken,
                    'manager' => false,
                    'cashier' => true
                ];
                return $this->success($data);
            }
        }
        return $this->error('Login yoki Parol Xato!');
    }
    public function login(Request $request){
        $user = auth()->user();
        if(  Hash::check( $request->password, $user['password'] ) )
        {
            $token = $user->createToken('mobile');
            $data = [
                'manager' => true,
                'cashier' => false
            ];
            return $this->success($data);
        }
        return $this->error('Parol Xato!');
    }
}
