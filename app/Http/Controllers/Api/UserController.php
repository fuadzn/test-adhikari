<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller {
    protected $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    public function index() {
        return response()->json($this->userService->getAllUsers());
    }

    public function show($id) {
        return response()->json($this->userService->getUserById($id));
    }

    public function store(Request $request) {
        $data = $request->array();
        return response()->json($this->userService->createUser($data), 201);
    }

    public function update(Request $request, $id) {
        $data = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . $id,
            'password' => 'sometimes|min:6'
        ]);
        return response()->json($this->userService->updateUser($id, $data));
    }

    public function destroy($id) {
        return response()->json(['deleted' => $this->userService->deleteUser($id)]);
    }

    public function getByNama($nama){
        return response()->json(['nama' => $nama, 'data' => $this->userService->getByNama($nama)], 200);
    }

    public function getByNIM($NIM){
        return response()->json(['NIM' => $NIM, 'data' => $this->userService->getByNIM($NIM)], 200);
    }

    public function getByYMD($YMD){
        return response()->json(['YMD' => $YMD, 'data' => $this->userService->getByYMD($YMD)], 200);
    }
}
