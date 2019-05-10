@extends('layouts.app')

@section('content')
    <table>
        @foreach($Sess as $ses)
            <tr>
                <td>{{ $ses -> id }}</td>
                <td>{{ $ses -> user_id }}</td>
                <td>{{ $ses -> time_start }}</td>
                <td>{{ $ses -> time_end }}</td>
            </tr>
        @endforeach
    </table>
@endsection