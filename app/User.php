<?php

namespace App;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use EntrustUserTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['name','password','email','role', 'ativo', 'codigo_seguranca', 'ultimo_pagamento', 'users_id'];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /** Consulta de usu�rio por c�digo de seguran�a
     * @param $query
     * @param $codigo string c�digo de seguran�a
     * @return mixed usu�rio com c�digo de seguran�a especificado
     */
    public function scopeBuscarPorCodigoSeguranca($query, $codigo)
    {
        return $query->where('codigo_seguranca', $codigo)->get();       //Busca usu�rio por codigo de seguran�a
    }

    /** Consulta apostas feitas
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function apostas()
    {
        return $this->hasMany('App\Aposta', 'users_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'users_id');
    }
    public function users()
    {
        return $this->hasMany('App\User', 'users_id');
    }
    public function acertos()
    {
        return $this->hasMany('App\Acerto');
    }
}