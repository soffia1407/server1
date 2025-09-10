<?php

namespace app\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Src\Auth\IdentityInterface;

class User extends Model implements IdentityInterface
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'name',
        'login',
        'password',
        'role' // Добавляем новое поле
    ];

    protected static function booted()
    {
        static::created(function ($user) {
            $user->password = md5($user->password);
            // Устанавливаем роль по умолчанию, если не указана
            if (!isset($user->role)) {
                $user->role = 'employee';
            }
            $user->save();
        });
    }

    // Выборка пользователя по первичному ключу
    public function findIdentity(int $id)
    {
        return self::where('id', $id)->first();
    }

    // Возврат первичного ключа
    public function getId(): int
    {
        return $this->id;
    }

    // Возврат аутентифицированного пользователя
    public function attemptIdentity(array $credentials)
    {
        return self::where([
            'login' => $credentials['login'],
            'password' => md5($credentials['password'])
        ])->first();
    }

    // Проверка, является ли пользователь администратором
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    // Проверка, является ли пользователем деканата
    public function isEmployee(): bool
    {
        return $this->role === 'employee';
    }
}