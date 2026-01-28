<?php
 
namespace App\Services;

use App\Models\Member;
use App\Services\FileUploadService;
use App\Repositories\Interfaces\MemberRepositoryInterface;

class MemberService
{
    protected FileUploadService $fileUploadService;
    protected MemberRepositoryInterface $memberRepository;

    public function __construct(FileUploadService $fileUploadService, MemberRepositoryInterface $memberRepository)
    {
        $this->fileUploadService = $fileUploadService;
        $this->memberRepository = $memberRepository;
    }

    public function create(array $data): Member
    {
        $partnerIds = $this->extractPartnerIds($data);

        $data['generation'] = $this->resolveGeneration($data);
        $this->handleAvatarUpload($data);

        $member = $this->memberRepository->create($data);

        $this->syncPartnersBidirectional($member, $partnerIds);

        return $member;
    }

    public function update(Member $member, array $data): Member
    {
        $partnerIds = $this->extractPartnerIds($data);

        $data['generation'] = $this->resolveGeneration($data);
        $this->handleAvatarUpload($data);

        $updatedMember = $this->memberRepository->update($member, $data);

        $this->syncPartnersBidirectional($updatedMember, $partnerIds, true);

        return $updatedMember;
    }

    public function delete(Member $member): bool
    {
        return $this->memberRepository->delete($member);
    }

    /* ================== PRIVATE HELPERS ================== */

    private function extractPartnerIds(array &$data): array
    {
        $partnerIds = $data['pids'] ?? [];
        unset($data['pids']);

        return $partnerIds;
    }

    private function resolveGeneration(array $data): int
    {
        if (isset($data['generation'])) {
            return (int) $data['generation'];
        }

        if (!empty($data['fid'])) {
            $father = $this->memberRepository->find($data['fid']);

            return $father
                ? ((int) $father->generation + 1)
                : 0;
        }

        return 0;
    }

    private function handleAvatarUpload(array &$data, bool $isUpdate = false): void
    {
        if (!array_key_exists('avatar', $data)) {
            return;
        }

        if ($isUpdate && empty($data['avatar'])) {
            unset($data['avatar']);
            return;
        }

        if (!empty($data['avatar'])) {
            $data['avatar'] = $this->fileUploadService->upload($data['avatar'], 'members');
            return;
        }

        unset($data['avatar']);
    }

    private function syncPartnersBidirectional(Member $member, array $partnerIds, bool $isUpdate = false): void {
        $currentPartnerIds = $member->partners()->pluck('members.id')->toArray();

        if ($isUpdate) {
            $removedPartnerIds = array_diff($currentPartnerIds, $partnerIds);

            foreach ($removedPartnerIds as $removedId) {
                $partner = Member::find($removedId);
                if ($partner) {
                    $partner->partners()->detach($member->id);
                }
            }

            $member->partners()->detach();
        }

        foreach ($partnerIds as $partnerId) {
            $partner = Member::find($partnerId);

            if (!$partner) {
                continue;
            }

            $member->partners()->syncWithoutDetaching([$partnerId]);
            $partner->partners()->syncWithoutDetaching([$member->id]);
        }
    }
}
