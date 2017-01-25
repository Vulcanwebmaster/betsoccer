@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="table-responsive col-md-offset-2 col-md-8">
                <h1 style="text-align: center;">Lista de Dispositivos Cadastrados</h1>
                <a href="{{ route('dispositivo.cadastrar')}}" class="btn btn-primary light-blue darken-3">Cadastrar</a>
                <table>
                    <thead>
                    <tr>
                        <th>MAC</th>
                        <th>Usuario</th>
                        <th>Acao</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($dispositivos as $dispositivo)
                        <tr>
                            <td scope="row">{{ $dispositivo->mac }}</td>
                            <td>{{ $dispositivo->user->name }}</td>
                            <td>
                                <a class="btn btn-default" href="{{ route('dispositivo.editar',$dispositivo->id) }}">Editar</a>
                                <a class="btn btn-danger" href="javascript:(confirm('Tem certeza que deseja excluir esse dispositivo?')? window.location.href='{{ route('dispositivo.deletar',$dispositivo->id) }}' : false)">Excluir</a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>

                </table>
                <div align="center">

                </div>
            </div>

        </div>
    </div>
@endsection