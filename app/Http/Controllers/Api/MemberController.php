<?php

namespace App\Http\Controllers\Api;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberController
{
    public function index(Request $request)
    {
        $members = Member::with('partners')
            ->orderBy('generation')
            ->orderBy('order')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $members
        ]);
    }
}
