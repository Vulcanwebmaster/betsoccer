<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use softDeletes;

class Aposta extends Model
{
    //
    protected $fillable = ['codigo','valor_aposta', 'nome_apostador', 'pago', 'users_id'];

    //metodo que retorna jogos
    public function jogo()
    {
        return $this->belongsToMany('App\Jogo', 'aposta_jogo', 'apostas_id', 'jogos_id')->withPivot('palpite', 'tpalpite')->withTimestamps();
    }

    //metodo que retorna os usuários
    public function user()
    {
        return $this->belongsTo('App\User', 'users_id');
    }

    /**Método que busca apostas apostas recentes
     * @param $query
     * @param $user_id int id do usuário
     * @return mixed lista de apostas feitas depois do último pagamento
     */
    public function scopeRecentes($query, $user)
    {
        return $query->where('users_id', $user->id)
            ->where('pago', false)->with('jogo')->get();
    }

    /**Méotdo que busca aposta pelo atributo
     * @param $query consulta
     * @param $atributo string com atributo a ser consultado
     * @param $valor valor do atributo a ser consultado
     * @return mixed lista de apostas baseado nos dados passados
     */
    public function scopeBuscarPorAtributo($query, $atributo, $valor)
    {
        return $query->with('jogo')->where($atributo, $valor)->get();
    }
}
