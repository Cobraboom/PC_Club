@extends('layouts.app')

@section('content')

    <div class="container">
        @php
            /** @var \Illuminate\Support\ViewErrorBag $errors */
        @endphp

        @include('PC_Club.admin.Ses.includes.result_messages')
        <div class="row justify-content-center">
            <div class="col-md-12">
                <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
                    <a class="btn btn-primary" href="{{ route('PC_Club.admin.Ses.create') }}">Добавить</a>
                </nav>
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>id</th>
                                <th>id PC</th>
                                <th>User</th>
                                <th>Time Start</th>
                                <th>Time End</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($paginator as $Ses)
                                @php /** @var \App\Models\PC_ClubSes $Ses */ @endphp
                                <tr>
                                    <td>{{ $Ses -> id }}</td>
                                    <td>{{ $Ses -> id_pc }}</td>
                                    <td>{{ $Ses -> user -> login}}</td>
                                    <td>{{ $Ses -> time_start}}</td>
                                    <td>{{ $Ses -> time_end }}</td>
                                    <td>
                                        <a class="btn btn-primary" href="{{ route('PC_Club.admin.Ses.edit', $Ses -> id) }}">
                                            Изменить
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @if($paginator->total() > $paginator->count())
            <br>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            {{ $paginator -> links() }}
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
