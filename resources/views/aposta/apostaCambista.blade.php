@extends('layouts.app')

@section('content')
<style>    
    .ganhos {
        font-size: 18px;
    }
</style>
<div class="container">
    <div class="row">        

        <ol class="breadcrumb panel-heading">
            <li class="active">Relatorios das apostas efetuadas pelo {{$cambista->name}} </li>            
        </ol>
        <!-- Nav tabs -->
        <div class="container col-md-6">
            <div class="row">
                <form class="form-inline" action="{{ route('aposta.cambista')}}" method="post">
                    {{ csrf_field() }}

                    <select class="form-control special-flexselect" name="cambista">
                        <option value="" disabled selected>Nome do Cambista</option>
                        @foreach ($users as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </select>
                    <button class="btn btn-info">Buscar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"><a href="#ativas" aria-controls="home" role="tab" data-toggle="tab">Apostas Ativas</a></li>
          <li role="presentation"><a href="#recebidas" aria-controls="profile" role="tab" data-toggle="tab">Apostas Recebidas</a></li>
          <li role="presentation"><a href="#ganhos" aria-controls="messages" role="tab" data-toggle="tab">Ganhos</a></li>
          <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Outros</a></li>
      </ul>
  </div>
</div>



<!-- Tab panes -->
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="ativas">     
        <div class="table-responsive col-md-offset-1 col-md-10">
         <h3>Valor total receber do Cambista : R$ {{$receber_cambista["com_abertas"]["liquido"]}}</h3>
         <h3>Premio total possível a ser Pago : R$ {{number_format($premiacao_possivel, 2, ',', '.')}}</h3> 
         <table >
            <thead>
                <tr>
                    <th>Cod Aposta</th>
                    <th>Data</th>
                    <th>Valor Apostado</th>
                    <th>Apostador</th>
                    <th>Agente</th>
                    <th>Total a Pagar</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                {{ csrf_field() }}
                @foreach ($apostas as $key => $aposta)
                <tr>
                   <td class="ganhos">{{ $aposta->codigo }}</td>
                   <td class="ganhos">{{date('d/m/Y - H:i', strtotime($aposta->created_at)) }}</td>
                   <td class="ganhos">{{ number_format($aposta->valor_aposta, 2, ',', '.')}}</td>
                   <td class="ganhos">{{ $aposta->nome_apostador}}</td>
                   <td class="ganhos">{{ $aposta->user->name}}</td>
                   <td class="ganhos">{{ number_format($premios[$key], 2, ',', '.')}}</td>
                   <td>
                     <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-{{$aposta->id}}">
                      Detalhe
                  </button>
              </td>
          </tr>
          <!-- Modal -->
          <div class="modal fade" id="modal-{{$aposta->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Jogos</h4>
                </div>
                <div class="modal-body">
                   @foreach ($aposta->jogo as $key => $jogo)

                   <h5>{{date('d/m/Y - H:i', strtotime($jogo->data))}} -- {{$jogo->time[0]->descricao_time}} x {{$jogo->time[1]->descricao_time}}</h4>
                    <h5>    Palpite..: {{$jogo->pivot->tpalpite}}......Valor..: {{$jogo->pivot->palpite}}
                    </h5>

                    @endforeach 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</tbody>
</table>
</div>
</div>
<div role="tabpanel" class="tab-pane" id="recebidas">  
    <div class="table-responsive col-md-offset-1 col-md-10">
        <h3>Total recebido do cambista : R$ {{$ganhosRecebidos["com_abertas"]["liquido"]}}</h3>
        <table>
            <thead>
              <tr> 
                <th data-field="price">Qtd. Apostas</th>
                <th data-field="price">Qtd. Jogos</th>
                <th data-field="price">Comissão (2 jogos)</th>
                <th data-field="price">Comissão (3 +)</th>
                <th data-field="price">Comissão (5 +)</th>
                <th data-field="price">Comissão Total</th>
                <th data-field="price">Valor Total Apostado</th>
                <th data-field="price">Total Premiação</th>
                <th data-field="price">Líquido</th>
            </tr>
        </thead>
        <tbody>
          <tr >
            <td class="ganhos">{{$ganhosRecebidos["com_abertas"]["qtd_apostas"]}}</td>
            <td class="ganhos">{{$ganhosRecebidos["com_abertas"]["qtd_jogos"]}}</td>
            <td class="ganhos">{{$ganhosRecebidos["com_abertas"]["comissao_simples"]}}</td>
            <td class="ganhos">{{$ganhosRecebidos["com_abertas"]["comissao_mediana"]}}</td>
            <td class="ganhos">{{$ganhosRecebidos["com_abertas"]["comissao_maxima"]}}</td>
            <td class="ganhos">{{$ganhosRecebidos["com_abertas"]["comissao_total"]}}</td>
            <td class="ganhos">{{$ganhosRecebidos["com_abertas"]["total_apostado"]}}</td>
            <td class="ganhos">{{$ganhosRecebidos["com_abertas"]["total_premiacao"]}}</td>
            <td class="ganhos">{{$ganhosRecebidos["com_abertas"]["liquido"]}}</td>

        </tr>
    </tbody>
</table>
</div>  
<div class="table-responsive col-md-offset-1 col-md-10 ">         
    <table>
        <thead>
            <tr>
                <th>Cod Aposta</th>
                <th>Data</th>
                <th>Valor Apostado</th>
                <th>Apostador</th>
                <th>Agente</th>
                <th>Premissão Possível</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            {{ csrf_field() }}
            @foreach ($apostasPagas as $key => $aposta)
            <tr>
                <td>{{ $aposta->codigo }}</td>
                <td>{{date('d/m/Y - H:i', strtotime($aposta->created_at)) }}</td>
                <td class="ganhos">R$ {{ number_format($aposta->valor_aposta, 2, ',', '.')}}</td>
                <td>{{ $aposta->nome_apostador}}</td>
                <td>{{ $cambista->name}}</td>
                <td class="ganhos">R$ {{ number_format($premiosPago[$key], 2, ',', '.')}}</td>
                <td>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-{{$aposta->id}}">
                      Detalhe
                  </button>

              </td>
          </tr>

          <!-- Modal -->
          <div class="modal fade" id="modal-{{$aposta->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Jogos</h4>
                </div>
                <div class="modal-body">
                    @foreach ($aposta->jogo as $key => $jogo)

                    <h5>{{date('d/m/Y - H:i', strtotime($jogo->data))}} -- {{$jogo->time[0]->descricao_time}} x {{$jogo->time[1]->descricao_time}}</h4>
                        <h5>    Palpite..: {{$jogo->pivot->tpalpite}}......Valor..: {{$jogo->pivot->palpite}}
                        </h5>

                        @endforeach 
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>

        @endforeach
    </tbody>
</table>
</div> 
</div>
<div role="tabpanel" class="tab-pane" id="ganhos">
    <div class="col-md-offset-1 col-md-3">
        <table class="table">
            <tbody>
                <tr> 
                    <th >Qtd. Apostas</th>
                    <td class="ganhos">{{$receber_cambista["com_abertas"]["qtd_apostas"]}}</td>
                </tr>
                <tr>
                    <th data-field="price">Qtd. Jogos</th>
                    <td class="ganhos">{{$receber_cambista["com_abertas"]["qtd_jogos"]}}</td>

                </tr>
                <tr>
                    <th data-field="price">Comissão (2 jogos)</th>
                    <td class="ganhos">R$ {{$receber_cambista["com_abertas"]["comissao_simples"]}}</td>
                </tr>
                <tr>
                    <th data-field="price">Comissão (3 +)</th>
                    <td class="ganhos">R$ {{$receber_cambista["com_abertas"]["comissao_mediana"]}}</td>
                </tr>
                <tr>
                    <th data-field="price">Comissão (5 +)</th>
                    <td class="ganhos">R$ {{$receber_cambista["com_abertas"]["comissao_maxima"]}}</td>
                </tr>
                <tr>
                    <th data-field="price">Comissão Total</th>
                    <td class="ganhos">R$ {{$receber_cambista["com_abertas"]["comissao_total"]}}</td>
                </tr>
                <tr>
                    <th data-field="price">Valor Total Apostado</th>
                    <td class="ganhos">R$ {{$receber_cambista["com_abertas"]["total_apostado"]}}</td>
                </tr>
                <tr>
                    <th data-field="price">Total Premiação</th>
                    <td class="ganhos">R$ {{$receber_cambista["com_abertas"]["total_premiacao"]}}</td>
                </tr>
                <tr>
                    <th data-field="price">Líquido</th>
                    <td class="ganhos">R$ {{$receber_cambista["com_abertas"]["liquido"]}}</td>
                </tr>                    
            </tbody>
        </table>    
    </div>
</div>
</div>
@endsection