<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserService {
    protected $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function getAllUsers() {
        return $this->userRepository->getAll();
    }

    public function getUserById($id) {
        return $this->userRepository->findById($id);
    }

    public function createUser(array $data) {
        $data['password'] = Hash::make($data['password']);
        return $this->userRepository->create($data);
    }

    public function updateUser($id, array $data) {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        return $this->userRepository->update($id, $data);
    }

    public function deleteUser($id) {
        return $this->userRepository->delete($id);
    }

    public function getByNama($nama){
        return $this->userRepository->getByNama($nama);
    }

    public function getByNIM($NIM){
        return $this->userRepository->getByNIM($NIM);
    }

    public function getByYMD($YMD){
        return $this->userRepository->getByYMD($YMD);
    }
}
