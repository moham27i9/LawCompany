<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
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



    public function role()
{
    return $this->belongsTo(Role::class);
}
    public function profile()
{
    return $this->hasOne(Profile::class);
}
    public function complaints()
{
    return $this->hasMany(Complaint::class);
}
public function invoices()
{
    return $this->hasMany(Invoice::class);
}
public function issues()
{
    return $this->hasMany(Issue::class);
}
public function consulations()
{
    return $this->hasMany(Consulation::class);
}
public function savedLegalBook()
{
    return $this->hasMany(SavedLegalBook::class);
}
public function savedLegalNews()
{
    return $this->hasMany(SavedLegalNews::class);
}
public function jobApplication()
{
    return $this->hasMany(JobApplication::class);
}
public function employee()
{
    return $this->hasOne(Employee::class);
}
public function lawyer()
{
    return $this->hasOne(Lawyer::class);
}
public function caseRequests()
{
    return $this->hasMany(IssueRequest::class);
}

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
