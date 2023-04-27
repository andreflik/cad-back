<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Http\Controllers\Controller;

class AutenticarController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6',
            'type' => 'required|string|in:comum,admin', // adicione a validação para o tipo de usuário
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Os dados informados são inválidos.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = User::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'type' => $request->type, // defina o tipo de usuário com base no valor enviado na requisição
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Usuário criado com sucesso.',
            'token' => $token,
        ], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $credentials['type'] = 'comum'; // defina o tipo de usuário como comum por padrão

        if ($request->has('admin')) {
            $credentials['type'] = 'admin'; // altere o tipo de usuário para admin se a flag admin estiver presente na requisição
        }

        if (Auth::attempt($credentials)) {
            $token = Auth::user()->createToken('auth_token')->plainTextToken;

            return response()->json([
                'message' => 'Autenticação realizada com sucesso.',
                'token' => $token,
            ]);
        }

        return response()->json([
            'message' => 'Credenciais inválidas.',
        ], 401);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message
            ' => 'Logout realizado com sucesso.',
        ]);
        }
}
