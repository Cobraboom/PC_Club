@if($PC_item->exists)
    <form method="post" action="{{ route('PC_Club.admin.PC.destroy', $PC_item -> id )}}">
        @method('DELETE')
        @csrf
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-block">
                    <div class="card-body ml-auto">
                        <button type="submit" class="btn">Удалить</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endif