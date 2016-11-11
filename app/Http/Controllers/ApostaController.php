<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\jogo;
use Carbon\Carbon;
use DB;

class ApostaController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function index()
    {
        /*buscando todas as informacoes dos times
        foreach ($aposta->jogo as $key) {
               echo "JOGO" . $key->time;
               echo $key->pivot->palpite;
             }
        $aposta = \App\Aposta::paginate(10); 
      */
        $results = DB::select('select DISTINCT  CAST(data AS date) AS dataS , campeonatos_id from jogos order by data');
        $apostas = \App\Aposta::with('jogo')->get();
        //dd($apostas);
        foreach ($apostas as $aposta) {
            echo $aposta->jogo->get('id');
        }
        $campeonatos = \App\Campeonato::all();
        $jogos = \App\Jogo::all();
        $res = array_merge($results, $jogos->toArray(), $campeonatos->toArray());
        //return response()->json($jogos);
        return view('aposta.index', compact('jogos', 'campeonatos', 'results'));
    }

    public function cadastrar()
    {

        $time = \App\Jogo::all();
        return view('aposta.cadastrar', compact('time'));
    }

    public function salvar(\App\Http\Requests\ApostaRequest $request)
    {
        $jogo = [];
        $palpite = [];
        $jogo = $request->get('jogo');
        dd($jogo);
        $aposta = \App\Aposta::create($request->all());
        foreach ($jogo as $jogos => $value) {
            $jo = \App\Jogo::find($value);
            $text = "palpite";
            $text .= $value;
            $consu = $request->get($text);
            $palpite ['palpite'] = $jo->$consu;
            $palpite ['tpalpite'] = $consu;
            $aposta->jogo()->attach($value, $palpite);
        }
        $aposta->save();
        \Session::flash('flash_message', [
            'msg' => "Aposta realizada com Sucesso",
            'class' => "alert-success"
        ]);
        return redirect()->route('aposta.index');
    }

    public function apostar(Request $request)
    {
        //Busca o usu�rio pelo c�digo de seguran�a
        $user = \App\User::buscarPorCodigoSeguranca($request->codigo_seguranca)->first();
        //Verificar se usu�rio existe
        if ($user == null):
            //Retorna json com informa��o que usu�rio n�o existe
            return response()->json(['status' => 'Inexistente']);
        endif;
        //Verificar se usu�rio n�o est� ativo
        if (!$user->ativo):
            return response()->json(['status' => 'Inativo']);
        endif;
        //transforma json em array
        $jogos = json_decode($request->jogos, true);
        //Valida jogos
        $jogos_invalidos = $this->validarJogos($jogos);
        if (count($jogos_invalidos) > 0):
            return response()->json($jogos_invalidos);
        endif;


        //nome_apostador; valor_aposta; jogo(id); palpite
        $aposta = \App\Aposta::create($request->all());
         foreach ($jogos as $jogo => $value) {
             $jo = \App\Jogo::find($value);
             $text = "palpite";
             $text .= $value;
             $consu = $request->get($text);
             $palpite ['palpite'] = $jo->$consu;
             $palpite ['tpalpite'] = $consu;
             $aposta->jogo()->attach($value, $palpite);
         }
        return response()->json(['status' => 'Aposta feita']);

    }

    private function validarJogos($jogos)
    {
        //Cria array para armazenar jogos que n�o podem receber aposta
        $jogos_invalidos = Array();
        //Realiza intera��o em todos os jogos
        foreach ($jogos as $valor):
            //Busca jogo pelo id (valor)
            $jogo = \App\Jogo::find($valor)->first();
            //Verificar hor�rio
            if ($jogo==null || $jogo->data < Carbon::now()->subMinute(5)):
                //Se passou do hor�rio para apostar coloca o joga no array
                $jogos_invalidos[] = $jogo;
            endif;
        endforeach;
        //retorna o array com jogos que n�o podem ser feita aposta
        return $jogos_invalidos;
    }

    public function show($id)
    {

    }

    public function showAll()
    {
        $jogos = \App\Aposta::find(4)->jogo()->get();
        foreach ($jogos as $jogo) {
            dd($jogo->pivot->palpite);
        }
        dd($jogos);
    }
}