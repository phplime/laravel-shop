<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    /**
     * Get the subscription associated with the user.
     */
    public function subscription()
    {
        return $this->belongsTo(Subscription::class, 'subscription_id');
    }

    /**
     * Get the package associated with the user.
     */
    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['package_type'] ?? null, function ($q, $type) {
            $q->whereHas('package', fn($p) => $p->where('package_type', $type));
        });

        $query->when($filters['is_expired'] ?? null, function ($q, $expired) {
            $q->whereHas('subscription', fn($s) => $s->where('is_expired', $expired));
        });

        $query->when($filters['q'] ?? null, function ($q, $search) {
            $q->where(
                fn($sub) =>
                $sub->where('name', 'like', "%$search%")
                    ->orWhere('username', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%")
            );
        });
    }
}
