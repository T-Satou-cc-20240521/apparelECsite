<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    /**
     * テーブル名
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * 主キーのカラム名
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * 自動インクリメントするIDの型
     *
     * @var string
     */
    protected $keyType = 'int';

    /**
     * タイムスタンプを使うか
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * マスアサインメント可能な属性
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'password_hash',
        'address',
        'email_verified_at',
        'is_active',
        'is_admin'
    ];

    /**
     * キャストする属性
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_active' => 'boolean',
        'is_admin' => 'boolean',
    ];

    /**
     * パスワードをハッシュ化して設定するアクセサ
     *
     * @param  string  $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password_hash'] = bcrypt($value);
    }

    /**
     * リメンバートークンの設定
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        return 'remember_token';
    }
}
