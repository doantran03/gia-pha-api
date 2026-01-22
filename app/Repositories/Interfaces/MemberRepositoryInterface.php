<?php

namespace App\Repositories\Interfaces;

use App\Models\Member;
use Illuminate\Support\Collection;

interface MemberRepositoryInterface
{
    public function all(): Collection;

    public function find(int $id): ?Member;

    public function create(array $data): Member;

    public function update(Member $member, array $data): Member;

    public function delete(Member $member): bool;

    public function getByGeneration(int $generation);
}
