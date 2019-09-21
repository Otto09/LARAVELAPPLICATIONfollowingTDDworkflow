<?php

namespace App;

use App\Owner;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function owners()
    {
        return $this->hasMany(Owner::class)->latest('updated_at');

        // ->orderByDesc('updated_at'); orderBy('updated_at', 'desc');
    }

    public function accessibleOwners()
    {
        return Owner::where('user_id', $this->id)

            ->orWhereHas('members', function ($query) {

                $query->where('user_id', $this->id);
                
            })

            ->get();
        
        /*$ownersCreated = $this->owners;

        $ids = \DB::table('owner_members')->where('user_id', $this->id)

            ->pluck('owner_id');

        $ownersSharedWith = Owner::find($ids);

        return $ownersCreated->merge($ownersSharedWith);*/
    }
}
