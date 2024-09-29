<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use DB;
use Exception;
use Illuminate\Http\Request;
use \Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    /**
     * Retorna uma lista de usuários.
     * 
     * Este método recupera uma lista de usuários do banco de dados
     *  e a retorna como uma resposta JSON.
     * 
     * @return \Illuminate\Http\JsonResponse
    */
    public function index(): JsonResponse{
        // Recuperar os usuários do banco de dados
        $users = User::orderBy("id", "ASC")->get();

        // Retorna os usuários recuperados como uma resposta JSON
        return response()->json([
            "status" => true,
            "users" => $users,
        ], 200);
    }

    /**
     * Exibe os detalhes de um usuário específico.
     * 
     * Este método retorna os detalhes de um usuário específico em formato JSON.
     * 
     * @param \App\Models\User $user
     * @return JsonResponse|mixed
     */
    public function show(User $user): JsonResponse{
        // Retorna os detalhes do usuário em formato JSON
        return response()->json([
            "status" => true,
            "user" => $user,
        ], 200);
    }

    /**
     * Cria novo usuário com os dados fornecidos na requisição.
     * 
     * @param \App\Http\Requests\UserRequest $request
     * @return JsonResponse|mixed
     */
    public function store(UserRequest $request): JsonResponse{
        // Iniciar a transação
        DB::beginTransaction();

        try{
            $user = 
            User::create([
                "name" => $request->name,
                "email" => $request->email,
                "password" => $request->password
            ]);

            // Operação concluída com êxito
            DB::commit();

            // Retorna os dados do usuário cadastrado e um mensagem de sucesso com status 200
            return response()->json([
                "status" => true,
                "user" => $user,
                "message" => "Usuário cadastrado com sucesso!"
            ], 201);
        }
        catch(Exception $e){
            // Operação não é concluída com êxito
            DB::rollBack();

            // Retorna uma mensagem de erro com status 400
            return response()->json([
                "status" => false,
                "message" => "Usuário não cadastrado!",
            ], 400);
        }
    }

    /**
     * Atualizar os dados de um usuário existente com base nos dados fornecidos na requisição.
     * 
     * @param \App\Http\Requests\UserRequest $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UserRequest $request, User $user) : JsonResponse {
        // Iniciar a transação

        DB::beginTransaction();

        try{
            // Editar o registro no banco de dados
            $user->update([
                "name" => $request->name,
                "email" => $request->email,
                "password" => $request->password,
            ]);

             // Operação concluída com êxito
             DB::commit();

            // Retorna os dados do usuário cadastrado e um mensagem de sucesso com status 200
             return response()->json([
                 "status" => true,
                 "user" => $user,
                 "message" => "Usuário editado com sucesso!"
             ], 200);
        }
        catch(Exception $e){
            // Operação não é concluída com êxito
            DB::rollBack();

            // Retorna uma mensagem de erro com status 400
            return response()->json([
                "status" => false,
                "message" => "Usuário não editado!",
            ], 400);
        }
    }

    public function destroy(User $user) : JsonResponse{

        try{
            // Apagar o registro no banco de dados
            $user->delete();

            // Retorna os dados do usuário apagado e um mensagem de sucesso com status 200
            return response()->json([
                "status" => true,
                "user" => $user,
                "message" => "Usuário apagado com sucesso!"
            ], 200);
        }
        catch(Exception $e){
            // Retorna uma mensagem de erro com status 400
            return response()->json([
                "status" => false,
                "message" => "Usuário não apagado!",
            ], 400);
        }
    }
}
