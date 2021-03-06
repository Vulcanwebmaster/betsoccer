<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use softDeletes;
class Jogo extends Model
{
	  protected $table = 'jogos';
    protected $fillable = ['data','ativo','valor_casa','valor_empate','valor_fora','valor_1_2','valor_dupla','max_gol_2','min_gol_3','ambas_gol','r_casa','r_fora','campeonatos_id'];


    public function campeonato(){
   		return $this->belongsTo('App\Campeonato','campeonatos_id');

   	}
   	/*public function horario(){
      $teste = Carbon::now()->addMinutes(5);
   		return $this->belongsTo('App\Horario','horarios_id')->where('data', '>', $teste);
   	}*/
   	public function time(){
   		return $this->belongsToMany('App\Time','jogo_time','jogos_id','times_id');
   	}

	public function apostas(){
		return $this->belongsToMany('App\Aposta', 'aposta_jogo', 'jogos_id','apostas_id')
			->withPivot('palpite', 'tpalpite')->withTimestamps();
	}

	/** Busca jogos n�o realizados com mais apostas
	 * @param $query
	 * @return mixed jogos com mais apostas
	 */
	public function scopeMaisApostados(){
		$resultado = \DB::table('aposta_jogo')							//Realiza consulta na tabela aposta_jogo
			->select(\DB::raw('count(*) as qtd, jogos_id as jogo'))		//Seleciona a quantidade e jogos_id
			->join('jogos', 'aposta_jogo.jogos_id','=', 'jogos.id')		//Realiza jun��o com tabela jogos
			->where('jogos.data','>',Carbon::now())						//Estabelece como cla�sula que data do jogo deve ser maior que atual
			->groupBy('jogos_id')										//Agrupa por jogos_id
			->orderBy('qtd', 'desc')									//Ordena de forma decrescente pela quantidade
			->take(config('constantes.jogos_mais_apostados'))			//Pega os primeiros de acordo com quantidade definida
			->lists('jogo');											//Pega ids dos jogos
		$jogos = collect();												//Criar cole��o para armazenar jogos
		foreach ($resultado as $jogo):										//Percorre rela��o de resultado
			$jogos->push($this->find($jogo));							//Busca jogo e acrescenta a cole��o
		endforeach;
		return $jogos;													//Retorna jogos
	}

	public function scopeDisponiveis($query)
	{
		$resultado = $query->join('campeonatos', 'jogos.campeonatos_id', '=', 'campeonatos.id')
			->where('jogos.ativo', true)
			->whereBetween('jogos.data', [Carbon::now()->addMinute(5), Carbon::now()->addDay(1)->setTime(23, 59, 59)])
			->orderBy('campeonatos.descricao_campeonato')
			->orderBy('jogos.data')
			->lists('jogos.id');
		$jogos = collect();
		foreach ($resultado as $jogo):
			$jogos->push($this->with(['time', 'campeonato'])->find($jogo));
		endforeach;
		return $jogos;
	}
}