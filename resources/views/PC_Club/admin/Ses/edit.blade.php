@extends('layouts.app')

@section('content')
    @php
        /** @var \App\Models\PC_ClubSes $ses_item */
    @endphp
    @if($ses_item->exists)
    <form method="post" action="{{ route('PC_Club.admin.Ses.update', $ses_item -> id) }}">
            @method('PATCH')

    @else
    <form method="post" action="{{ route('PC_Club.admin.Ses.store') }}">
    @endif
    @csrf

        <div class="container">

            @php
                    /** @var \Illuminate\Support\ViewErrorBag $errors */
            @endphp

            @include('PC_Club.admin.Ses.includes.result_messages')

            <div class="row justify-content-center">
                <div class="col-md-8">
                        @include('PC_Club.admin.Ses.includes.item_edit_main_col')
                </div>

                <div class="col-md-3">
                        @include('PC_Club.admin.Ses.includes.item_edit_add_col')
                </div>
            </div>
        </div>
    </form>
</form>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('PC_Club.admin.Ses.includes.item_edit_delete-col')
            </div>
            <div class="col-md-3">

            </div>
        </div>
    </div>
@endsection