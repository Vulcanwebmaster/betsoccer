@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="table-responsive col-md-offset-2 col-md-8">
                <h1 style="text-align: center;">Lista de Usuarios Cadastradas</h1>
                <table>
                    <thead>
                    <tr>
                        <th>name</th>
                        <th>E-mail</th>
                        <th>Situacao</th>
                        <th>Acao</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td scope="row">{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->ativo?'Ativo':'Inativo' }}</td>
                            <td>
                                <a class="btn btn-default" href="{{ route('user.editar',$user->id) }}">Editar</a>
                                <a class="btn btn-danger"
                                   href="javascript:(confirm('Tem certeza que deseja excluir esse usu�rio?')? window.location.href='{{ route('user.deletar',$user->id) }}' : false)">Excluir</a>
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
