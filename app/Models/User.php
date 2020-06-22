<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{

    use SoftDeletes;
    use Notifiable;

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $fillable = [
        'IGR_CODIGO',
        'CID_CODIGO',
        'user_id',
        'matricula',
        'name',
        'foto',
        'dtnascimento',
        'cpf',
        'rg',
        'pai',
        'mae',
        'estadocivil',
        'conjuge',
        'confirmacao_casal',
        'dtcasamento',
        'dtviuvez',
        'nacionalidade',
        'escolaridade',
        'tp',
        'phone',
        'cellphone',
        'cellphone2',
        'email',
        'password',
        'tx_mensal',
        'tx_obreiro',
        'tx_dizimo',
        'sexo',
        'titulo_eleitoral',
        'profissao',
    ];
    public $rules = [
        'IGR_CODIGO' => 'required|numeric',
        'CID_CODIGO' => 'required|numeric',
        'user_id' => 'numeric',
        'matricula' => 'required|max:20',
        'name' => 'required|max:120',
        'foto' => 'max:255',
        'dtnascimento' => 'date|required',
        'cpf' => 'max:16|unique:users,cpf,((ID{?})),id',
        'rg' => 'max:30',
        'pai' => 'max:200',
        'mae' => 'required|max:200',
        'estadocivil' => 'required|max:20',
        'conjuge' => 'max:200',
        'confirmacao_casal' => 'max:12',
        'dtcasamento' => '',
        'dtviuvez' => '',
        'nacionalidade' => 'required|min:10|max:20',
        'escolaridade' => 'max:30',
        'tp' => 'max:3',
        'phone' => 'max:16',
        'cellphone' => 'required|max:16',
        'cellphone2' => 'max:16',
        'tx_mensal' => 'max:3',
        'tx_obreiro' => 'max:3',
        'tx_dizimo' => 'max:3',
        'email' => 'required|max:250|unique:users,email,((ID{?})),id',
        'sexo' => 'required',
        'titulo_eleitoral' => 'max:16|unique:users,titulo_eleitoral,((ID{?})),id',
        'profissao' => 'max:200',
    ];

    /**
     * Atributos da tabela "users" que devem ser escondidos.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function hasPermission(Permission $permission)
    {
        /* recupero os perfis e permissões */
        return $this->hasAnyRoles($permission->roles);
    }

    public function hasAnyRoles($roles)
    {
        /* recupero os perfis e permissões */
        if (is_array($roles) || is_object($roles)) {
            return $roles->intersect($this->roles)->count();
        }

        return $this->roles->contains('name', $roles);
    }
}
