@php
/** @var \App\Models\PC_ClubPC $PC_item*/
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
                            <label for="PC_Name">PC_Name</label>
                            <input name="PC_Name"
                                   id="PC_Name"
                                   type="text"
                                   class="form-control"
                                   {{--minlength="3"
                                   required--}}
                                   value="{{ $PC_item -> PC_Name }}">
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="PC_Info">PC_Info</label>
                            <textarea name="PC_Info"
                                      id="PC_Info"
                                      class="form-control"
                                      rows="4">
                                {{ $PC_item -> PC_Info }}
                            </textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>