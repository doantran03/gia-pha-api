<?php

namespace App\Repositories\Eloquent;

use App\Models\Member;
use Illuminate\Support\Collection;
use App\Repositories\Interfaces\MemberRepositoryInterface;

class MemberRepository implements MemberRepositoryInterface
{   
    public function all(): Collection
    {
        return Member::with(['father', 'mother'])->get();
    }
    
    public function find(int $id): ?Member
    {
        return Member::with(['father', 'mother'])->find($id);
    }

    public function create(array $data): Member
    {
        return Member::create($data);
    }

    public function update(Member $member, array $data): Member
    {
        $member->update($data);
        return $member;
    }

    public function delete(Member $member): bool
    {
        return $member->delete();
    }

    public function getByGeneration(int $generation)
    {
        return Member::where('generation', $generation)
            ->orderBy('order')
            ->get();
    }
}
