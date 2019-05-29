@extends('layouts.app')

@section('content')
    @php
        /** @var \App\Models\Booking $ses_item */
    @endphp

                <form method="post" action="{{ route('PC_Club.users.Ses.store') }}">

                    @csrf

                    <div class="container">

                        @php
                            /** @var \Illuminate\Support\ViewErrorBag $errors */
                        @endphp

                        @include('PC_Club.admin.Ses.includes.result_messages')

                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                @php
                                    /** @var \App\Models\PC_ClubSes $ses_item */
                                @endphp
                                <div class="rom justify-content-center">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-title"><h3 align="center">Выберите время и PC</h3></div>
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="maindata" role="tabpanel">
                                                            <div class="form-group">
                                                                <label for="title">Пользователь</label>
                                                                <input type="text"
                                                                       value="{{\Illuminate\Support\Facades\Auth::user() -> id}}.{{\Illuminate\Support\Facades\Auth::user() -> login}}"
                                                                       id="user_id"
                                                                       name="user_id"
                                                                       class="form-control" disabled>
                                                            </div>
                                                        <div class="form-group">
                                                            <label for="time_start">Вемя начала</label>
                                                            <input  type="datetime-local"
                                                                    name="time_start"
                                                                    id="time_start"
                                                                    class="form-control"
                                                                    placeholder="Время начала сеанса"
                                                                    required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="time_end">Время конца</label>
                                                            <input type="datetime-local"
                                                                   name="time_end"
                                                                   id="time_end"
                                                                   class="form-control"
                                                                   placeholder="Время конца сеанса"
                                                                   required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="id_pc">Выберите PC</label>
                                                            <select name="id_pc"
                                                                    id="id_pc"
                                                                    class="form-control"
                                                                    placeholder="Выберите PC"
                                                                    required>
                                                                @foreach($PC_list as $PC_listOption)
                                                                    <option value="{{$PC_listOption -> id}}">
                                                                        {{$PC_listOption -> id_PCname}}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row justify-content-center">
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <div class="card-body ml-auto">
                                                        <button href="{{\Illuminate\Support\Facades\Auth::user() -> id}}" type="submit" class="btn btn-primary">Забронировать</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
        </form>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    @include('PC_Club.users.Ses.includes.item_edit_delete_col')
                </div>

            </div>
        </div>
@endsection