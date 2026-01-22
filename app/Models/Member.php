<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Member extends Model
{
    protected $fillable = [
        'avatar',
        'full_name',
        'other_name',
        'birth_date',
        'death_date',
        'gender',
        'order',
        'generation',
        'address',
        'biography',
        'fid',
        'mid',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'death_date' => 'date',
    ];

    protected $appends = ['pids'];
    
    protected $hidden = [ 'partners'];

    /* ========= CHA MẸ ========= */

    public function father(): BelongsTo
    {
        return $this->belongsTo(Member::class, 'fid');
    }

    public function mother(): BelongsTo
    {
        return $this->belongsTo(Member::class, 'mid');
    }

    /* ========= CON CÁI ========= */

    public function childrenByFather(): HasMany
    {
        return $this->hasMany(Member::class, 'fid');
    }

    public function childrenByMother(): HasMany
    {
        return $this->hasMany(Member::class, 'mid');
    }

    public function allChildren()
    {
        return self::where('fid', $this->id)
            ->orWhere('mid', $this->id)
            ->get();
    }

    /* ========= VỢ / CHỒNG ========= */

    public function partners(): BelongsToMany
    {
        return $this->belongsToMany(
            Member::class,
            'member_partner',
            'member_id',
            'partner_id'
        );
    }

    public function getPidsAttribute()
    {
        return $this->partners()->pluck('members.id')->toArray();
    }
}