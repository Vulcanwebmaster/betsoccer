@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div>
            <div class="panel panel-default">
                <ol class="breadcrumb panel-heading">
                    <li class="active">Valores a pagar</li>
                </ol>
                <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
              <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Apostas Abertas</a></li>
              <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Apostas Vencedoras</a></li>
              <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Apostas Canceladas</a></li>
              <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Outros</a></li>
          </ul>
            </div>



          <!-- Tab panes -->
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="home">
                <h1>Premio total possível a ser Pago : R$ {{number_format($total, 2, ',', '.')}}</h1>
                <div class="table-responsive">
                    <table class="table table-bordered table-condensed">
                        <thead>
                            <tr>
                                <th>Cod Aposta</th>
                                <th>Data</th>
                                <th>Valor Apostado</th>
                                <th>Apostador</th>
                                <th>Total a Pagar</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{ csrf_field() }}
                            @foreach ($apostas as $key => $aposta)
                            <tr>
                                <td>{{ $aposta->codigo }}</td>
                                <td>{{date('d/m/Y - H:i', strtotime($aposta->created_at)) }}</td>
                                <td>{{ $aposta->valor_aposta}}</td>
                                <td>{{ $aposta->nome_apostador}}</td>
                                <td>{{ number_format($premios[$key], 2, ',', '.')}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>


            </div>
            <div role="tabpanel" class="tab-pane" id="profile">
                <h1>Premio total possível a ser Pago : R$ {{number_format($totalPago, 2, ',', '.')}}</h1>
                <div class="table-responsive">
                    <table class="table table-bordered table-condensed">
                        <thead>
                            <tr>
                                <th>Cod Aposta</th>
                                <th>Data</th>
                                <th>Valor Apostado</th>
                                <th>Apostador</th>
                                <th>Total pago</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{ csrf_field() }}
                            @foreach ($apostasPagas as $key => $aposta)
                            <tr>
                                <td>{{ $aposta->codigo }}</td>
                                <td>{{date('d/m/Y - H:i', strtotime($aposta->created_at)) }}</td>
                                <td>{{ $aposta->valor_aposta}}</td>
                                <td>{{ $aposta->nome_apostador}}</td>
                                <td>{{ number_format($premiosPago[$key], 2, ',', '.')}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="messages"><h1>EM CONSTRUÇÂO</h1></div>
            <div role="tabpanel" class="tab-pane" id="settings"><h1>EM CONSTRUÇÂO</h1></div>
        </div>

    </div>
</div>
</div>

@endsection