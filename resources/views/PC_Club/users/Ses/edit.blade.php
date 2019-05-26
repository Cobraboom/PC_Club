@extends('layouts.app')

@section('content')
    @php
        /** @var \App\Models\PC_ClubSes $ses_item */
    @endphp
    @if($ses_item->exists)
        <form method="post" action="{{ route('PC_Club.users.Ses.update', $ses_item -> id) }}">
            @method('PATCH')

            @else
                <form method="post" action="{{ route('PC_Club.users.Ses.store') }}">
                    @endif
                    @csrf

                    <div class="container">

                        @php
                            /** @var \Illuminate\Support\ViewErrorBag $errors */
                        @endphp
                        @if($errors->any())
                            <div class="row justify-content-center">
                                <div class="col-md-11">
                                    <div class="alert alert-danger" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">x</span>
                                        </button>
                                        {{$errors->first()}}
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if(session('success'))
                            <div class="row justify-content-center">
                                <div class="col-md-11">
                                    <div class="alert alert-success" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">x</span>
                                        </button>
                                        {{session()->get('success')}}
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                @include('PC_Club.users.Ses.includes.item_edit_main_col')
                            </div>

                            <div class="col-md-3">
                                @include('PC_Club.users.Ses.includes.item_edit_add_col')
                            </div>
                        </div>
                    </div>
                </form>
        </form>
@endsection