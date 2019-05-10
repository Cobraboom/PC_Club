@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
                    <a class="btn btn-primary" href="{{ route('PC_Club.admin.PC.create') }}">Добавить</a>
                </nav>
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>id_PC</th>
                                <th>Имя_PC</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($paginator as $PC)
                                @php /** @var \App\Models\PC_ClubPC $item */ @endphp
                                <tr>
                                    <td>{{ $PC -> id }}</td>
                                    <td>{{ $PC -> PC_Name }}</td>
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
