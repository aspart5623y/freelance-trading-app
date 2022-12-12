@extends('layouts.admin')

@section('title', 'All Messages')

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
                    @if ($conversations->count() > 0)
                        @foreach ($conversations as $item)
                            <a href="{{ route('admin.chat.conversation', $item->id) }}">
                                <div class="d-flex py-3 align-items-center">
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0 text-muted"><strong class="text-dark text-capitalize">{{ $item->senderProfile->profileable_type }}</strong>: {{ $item->senderProfile->profileable->firstname . ' ' . $item->senderProfile->profileable->lastname }}</h6>
                                        <h6 class="mb-0 text-muted"><strong class="text-dark text-capitalize">{{ $item->recieverProfile->profileable_type }}</strong>: {{ $item->recieverProfile->profileable->firstname . ' ' . $item->recieverProfile->profileable->lastname }}</h6>
                                    </div>
                                    
                                    <div class="flex-shrink-0">
                                        <div class="d-flex flex-wrap">
                                            <div class="table-img" style="height: 30px; width: 30px; background-image: url('{{ $item->senderProfile->profileable->profile_img ? asset('profile-image/' . $item->senderProfile->profileable_type . '/' . $item->senderProfile->profileable->profile_img) : asset('/images/avatar/avatar.jpeg') }}')"></div>
                                            <div class="table-img" style="height: 30px; width: 30px; background-image: url('{{ $item->recieverProfile->profileable->profile_img ? asset('profile-image/' . $item->recieverProfile->profileable_type . '/' . $item->recieverProfile->profileable->profile_img) : asset('/images/avatar/avatar.jpeg') }}')"></div>
                                        </div>
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