@extends('layouts.trader')

@section('title', 'My Messages')

@section('content')


    <div class="row justify-content-center">
        <div class="col-xl-8">
            <div class="card card-body message-card border-0 h-100">
                <form id="messageForm">
                    <input type="hidden" id="myId" value="{{ auth()->user()->id }}">
                    <input type="hidden" id="recieverId" value="{{ $conversation->reciever_id }}">
                    <input type="hidden" id="senderId" value="{{ $conversation->sender_id }}">    
                    <input type="hidden" id="conversationId" value="{{ $conversation->id }}">
                    
                    <div class="d-flex border-bottom pb-2 align-items-center">
                        <div class="flex-shrink-0">

                        @if ($conversation->sender_id == auth()->user()->id)
                                <div class="table-img" style="background-image: url('{{ $conversation->recieverProfile->profileable->profile_img ? asset('profile-image/' . $conversation->recieverProfile->profileable_type . '/' . $conversation->recieverProfile->profileable->profile_img) : asset('/images/avatar/avatar.jpeg') }}')"></div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="fw-bold mb-0 text-dark">{{ $conversation->recieverProfile->profileable->firstname . ' ' . $conversation->recieverProfile->profileable->lastname }}</h6>
                        @elseif($conversation->reciever_id == auth()->user()->id)
                                <div class="table-img" style="background-image: url('{{ $conversation->senderProfile->profileable->profile_img ? asset('profile-image/' . $conversation->senderProfile->profileable_type . '/' . $conversation->senderProfile->profileable->profile_img) : asset('/images/avatar/avatar.jpeg') }}')"></div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="fw-bold mb-0 text-dark">{{ $conversation->senderProfile->profileable->firstname . ' ' . $conversation->senderProfile->profileable->lastname }}</h6>
                        @endif
                            </small>
                        </div>
                    </div>
                    
                    <div class="message-area">
                        <ul class="list-unstyled" id="chatDiv">
                            @foreach ($chats as $item)
                                @if ($item->profile_id == auth()->user()->id)
                                    <li class="message-div sent ms-auto bg-success text-white">
                                        {{ $item->message_text }}
                                        <small class="fst-italic d-block text-end text-muted">{{ formatChatDate($item->created_at) }}</small>
                                    </li>
                                @else 
                                    <li class="message-div recieved me-auto bg-white">
                                        {{ $item->message_text }}
                                        <small class="fst-italic d-block text-end text-muted">{{ formatChatDate($item->created_at) }}</small>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    
                    <div class="input-group bg-white border-top py-2 align-items-end">
                        <textarea name="" id="messageBox" rows="1" class="form-control border-0 message-text" required placeholder="Start typing..."></textarea>
                        {{-- <div class="message-file border">
                            <i class="fa fa-paperclip"></i>
                            <input type="file" name="" id="sendFile">
                        </div> --}}
                        <button type="submit" id="sendMessage" class="btn btn-success"><i class="far fa-paper-plane"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>






    @push('js')
        <script src="{{ asset('js/chat-area.js') }}"></script>

        <script>
            var elem = document.getElementById('chatDiv');
            elem.scrollTop = elem.scrollHeight;
        </script>

        <script>
            $('.delete-btn').on('click', function() {
                $id = $(this).attr('id');
                $('#deleteModal').on('show.bs.modal', function() {
                    $('#accountId').val($id);
                })
                $('#deleteModal').modal('show')
            })
        </script>
    @endpush
@endsection