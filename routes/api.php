<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

// Route::get('/users', function (Request $request) {
//     return response()->json([
//         'status' => true,
//         'message' => "Listar usuários"
//     ], 200);
// })->middleware("auth:sanctum"); // Usuário está logado?

Route::get("/users", [UserController::class, "index"]); // GET - http://127.0.0.1:8000/api/users
Route::get("/users/{user}", [UserController::class, "show"]); // GET -  http://127.0.0.1:8000/api/users/1
Route::post("/users", [UserController::class, "store"]); // POST - http://127.0.0.1:8000/api/users
Route::put("/users/{user}", [UserController::class, "update"]); // PUT - http://127.0.0.1:8000/api/users/1
Route::delete("/users/{user}", [UserController::class, "destroy"]); // DELETE - http://127.0.0.1:8000/api/users/1