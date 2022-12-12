@extends('layouts.trader')

@section('title', 'My Messages')

@section('content')


    <div class="row justify-content-center">
        <div class="col-xl-6">
            <div class="card card-body border-0 d-block h-100">
                <h5 class="fw-bold">Chats</h5>
                {{-- <div class="input-group border mb-4 rounded">
                    <span class="input-group-text border-0 bg-white text-muted">
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="text" class="form-control border-0 bg-white" placeholder="Search for chat">
                </div> --}}

                <div class="conversation-list">
                    @if ($conversations->count())
                        @foreach ($conversations as $item)
                            <a href="{{ route('trader.chat.conversation', $item->id) }}">
                                <div class="d-flex py-3 align-items-center">
                                    <div class="flex-shrink-0">
                                        @if ($item->sender_id == auth()->user()->id)
                                                <div class="table-img" style="background-image: url('{{ $item->recieverProfile->profileable->profile_img ? asset('profile-image/' . $item->recieverProfile->profileable_type . '/' . $item->recieverProfile->profileable->profile_img) : asset('/images/avatar/avatar.jpeg') }}')"></div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="fw-bold mb-0 text-dark">{{ $item->recieverProfile->profileable->firstname . ' ' . $item->recieverProfile->profileable->lastname }}</h6>
                                        @elseif($item->reciever_id == auth()->user()->id)
                                                <div class="table-img" style="background-image: url('{{ $item->senderProfile->profileable->profile_img ? asset('profile-image/' . $item->senderProfile->profileable_type . '/' . $item->senderProfile->profileable->profile_img) : asset('/images/avatar/avatar.jpeg') }}')"></div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="fw-bold mb-0 text-dark">{{ $item->senderProfile->profileable->firstname . ' ' . $item->senderProfile->profileable->lastname }}</h6>
                                        @endif
                                        <small class="text-muted">{{ $item->lastchat ? $item->lastchat->message_text : '' }} </small>
                                    </div>
                                    <div class="flex-shrink-0">
                                        @php
                                            $count = $item->chats()->where('read_status', false)->where('profile_id', '!=', auth()->user()->id)->count()
                                        @endphp
                                        @if ($count > 0)
                                            <span class="badge rounded-pill bg-success">{{ $count }}</span>
                                        @endif
                                    </div>
                                </div>
                            </a>
                            @if ($conversations->count() > 1)
                                <hr class="my-0">
                            @endif
                        @endforeach

                        {{ $conversations->links() }}

                    @else
                        <p class="text-muted text-center">No Conversation found</p>
                    @endif
                    
                </div>
            </div>
        </div>

    </div>



@endsection