@php
/** @var \App\Models\PC_ClubSes $ses_item */
@endphp
<div class="rom justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title"></div>
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#maindata">Основные данные</a>
                    </li>
                </ul>
                <br>
                <div class="tab-content">
                    <div class="tab-pane active" id="maindata" role="tabpanel">
                        <div class="form-group">
                            <label for="id_pc">PC id</label>
                            <select name="id_pc"
                                    id="id_pc"
                                    class="form-control"
                                    placeholder="Выберите PC">
                            @foreach($PC_list as $PC_listOption)
                                    <option value="{{$PC_listOption -> id}}">
                                        {{$PC_listOption -> id_PCname}}
                                    </option>
                            @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="user_id">User id</label>
                            <select name="user_id"
                                    id="user_id"
                                    class="form-control"
                                    placeholder="Выберите Пользователя">
                                @foreach($User_list as $User_listOption)
                                    <option value="{{$User_listOption -> id}}">
                                    {{$User_listOption -> id_login}}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="time_start">Time Start</label>
                            <input  type="datetime-local"
                                    name="time_start"
                                    id="time_start"
                                    class="form-control"
                                    placeholder="Время начала сеанса">
                        </div>

                        <div class="form-group">
                            <label for="time_end">Time End</label>
                            <input type="datetime-local"
                                   name="time_end"
                                   id="time_end"
                                   class="form-control"
                                   placeholder="Время конца сеанса">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>