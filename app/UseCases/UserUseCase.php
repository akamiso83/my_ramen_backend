<?php

namespace App\UseCases;

use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserUseCase
{
    public function __construct(
        private UserRepositoryInterface $users
    ) {}

    public function list(): iterable
    {
        return $this->users->all();
    }

    public function get(int $id): User
    {
        return $this->users->find($id)
            ?? throw new \DomainException('User not found.');
    }

    public function create(array $data): User
    {
        $data['password'] = Hash::make($data['password']);

        return $this->users->create($data);
    }

    public function update(int $id, array $data): User
    {
        $user = $this->get($id);

        // パスワード更新時だけハッシュ化
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        return $this->users->update($user, $data);
    }

    public function delete(int $id): void
    {
        $user = $this->get($id);
        $this->users->delete($user);
    }
}
