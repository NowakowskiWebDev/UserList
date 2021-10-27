<?php

namespace App\Repository;

use App\Models\User;

interface UserRepositoryInterface
{
    public function allPaginated(int $limit);

    public function destroy(int $id);

    public function get(int $id);

    public function sortPaginated(string $by, string $direction, int $limit);

    public function store(array $data): User;

    public function updateModel(User $user, array $data);
}
