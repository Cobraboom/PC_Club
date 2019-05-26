@php
    /** @var \App\Models\PC_ClubSes $ses_item */
@endphp
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
        </div>
    </div>
</div><br>
@if($ses_item->exists)
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li>ID: {{$ses_item -> id}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Создано</label>
                        <input type="text" value="{{$ses_item -> created_at}}" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label for="title">Изменено</label>
                        <input type="text" value="{{$ses_item -> updated_at}}" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label for="title">Удалено</label>
                        <input type="text" value="{{$ses_item -> deleted_at}}" class="form-control" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
