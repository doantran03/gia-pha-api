<?php

namespace App\Http\Controllers\Admin;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Services\MemberService;
use App\Http\Controllers\Controller;
use App\Http\Requests\MemberRequest;

class MemberController extends Controller
{
    protected MemberService $memberService;

    public function __construct(MemberService $memberService)
    {
        $this->memberService = $memberService;
    }

    public function index()
    {
        $members = Member::orderBy('generation', 'asc')
            ->orderBy('order', 'asc')
            ->orderBy('gender', 'asc')
            ->orderBy('full_name', 'asc')
            ->get();

        return view('admin.members.index', compact('members'));
    }

    public function getMotherByFather($fatherId)
    {
        $members = Member::join('member_partner', 'members.id', '=', 'member_partner.member_id')
            ->where('member_partner.partner_id', $fatherId)
            ->select('members.id', 'members.full_name')
            ->get();

        return response()->json($members);
    }

    public function create()
    {
        $fathers = Member::where('gender', 'male')
            ->orderBy('generation', 'asc')
            ->orderBy('full_name', 'asc')
            ->get();

        $members = Member::orderBy('generation', 'asc')
            ->orderBy('full_name', 'asc')
            ->get();

        return view('admin.members.create', compact('fathers', 'members'));
    }

    public function store(MemberRequest $request)
    {
        $this->memberService->create($request->validated());

        return redirect()
            ->route('members.index')
            ->with('success', 'Thêm thành viên thành công');
    }

    public function edit($memberId)
    {
        $member = Member::findOrFail($memberId);

        $fathers = Member::where('gender', 'male')
            ->orderBy('generation', 'asc')
            ->orderBy('full_name', 'asc')
            ->get();

        $members = Member::orderBy('generation', 'asc')
            ->orderBy('full_name', 'asc')
            ->get();

        return view('admin.members.edit', compact('member', 'fathers', 'members'));
    }

    public function update(MemberRequest $request, $memberId)
    {
        $member = Member::findOrFail($memberId);

        $this->memberService->update($member, $request->validated());

        return redirect()
            ->route('members.index')
            ->with('success', 'Cập nhật thành viên thành công');
    }

    public function delete($memberId)
    {
        $member = Member::findOrFail($memberId);

        $this->memberService->delete($member);

        return redirect()
            ->route('members.index')
            ->with('success', 'Xoá thành viên thành công');
    }
}
