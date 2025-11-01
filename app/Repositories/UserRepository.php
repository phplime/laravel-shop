<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserRepository
{

    public function getAllPaginated(int $perPage = 15): LengthAwarePaginator
    {
        return User::paginate($perPage);
    }

    public function findById(int $id): ?User
    {
        return User::find($id);
    }

    public function findByEmail(string $email)
    {
        return User::where('email', $email)->first();
    }


    public function findByCredentials(string $identifier)
    {
        return User::where('email', $identifier)
            ->orWhere('username', $identifier)
            ->orWhere('phone', $identifier)
            ->first();
    }



    public function create(array $data): User
    {
        return User::create($data);
    }

    public function update(int $id, array $data): bool
    {
        $user = $this->findById($id);
        if (!$user) {
            return false;
        }
        return $user->update($data);
    }

    public function delete(int $id): bool
    {
        $user = $this->findById($id);
        if (!$user) {
            return false;
        }
        return $user->delete();
    }









    // public function getAllPaginated(int $perPage = 15)
    // {
    //     return User::paginate($perPage);
    // }


    // public function getAll()
    // {
    //     return User::all();
    // }


    // public function getById(int $id): User
    // {
    //     $user = User::find($id);

    //     if (!$user) {
    //         throw new ModelNotFoundException("User with ID {$id} not found.");
    //     }

    //     return $user;
    // }



    // // Optional: Safe version that returns null instead of throwing
    // public function findById(int $id): ?User
    // {
    //     return User::find($id);
    // }



    // public function create(array $data): User
    // {
    //     return User::create([
    //         'name' => $data['name'],
    //         'email' => $data['email'],
    //         'password' => Hash::make($data['password']),
    //     ]);
    // }



    // public function findByEmail(string $email): ?User
    // {
    //     return User::where('email', $email)->first();
    // }
}
