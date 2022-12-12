@extends('layouts.admin')

@section('title', 'Messages')

@section('content')


    <div class="row justify-content-center">
        <div class="col-xl-8">
            <div class="card card-body message-card border-0 h-100">
                <form id="messageForm">
                    
                    <div class="d-flex justify-content-between border-bottom flex-wrap">
                        <a href="{{ route('admin.user.show', $conversation->senderProfile->id) }}">
                            <div class="d-flex pb-2 align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="table-img" style="background-image: url('{{ $conversation->senderProfile->profileable->profile_img ? asset('profile-image/' . $conversation->senderProfile->profileable_type . '/' . $conversation->senderProfile->profileable->profile_img) : asset('/images/avatar/avatar.jpeg') }}')"></div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="fw-bold mb-0 text-dark">{{ $conversation->senderProfile->profileable->firstname . ' ' . $conversation->senderProfile->profileable->lastname }}</h6>
                                    <small class="text-muted">{{ $conversation->senderProfile->profileable_type }}</small>
                                </div>
                            </div>
                        </a>

                        <a href="{{ route('admin.user.show', $conversation->recieverProfile->id) }}">
                            <div class="d-flex pb-2 align-items-center">
                                <div class="flex-grow-1 me-3 text-end">
                                    <h6 class="fw-bold mb-0 text-dark">{{ $conversation->recieverProfile->profileable->firstname . ' ' . $conversation->recieverProfile->profileable->lastname }}</h6>
                                    <small class="text-muted">
                                        @php
                                            $rate1 = $conversation->recieverProfile->profileable->ratings->count() > 0 ? $conversation->recieverProfile->profileable->ratings()->sum('rating')/$conversation->recieverProfile->profileable->ratings()->count() : 0
                                        @endphp
                                        <small>{{ $conversation->recieverProfile->profileable_type }}</small> | <i class="fas fa-star text-warning"></i> {{ $conversation->recieverProfile->profileable->show_admin_rating ? $conversation->recieverProfile->profileable->admin_rating : $rate1 }} Star rating
                                    </small>
                                </div>
                                <div class="flex-shrink-0">
                                    <div class="table-img" style="background-image: url('{{ $conversation->recieverProfile->profileable->profile_img ? asset('profile-image/' . $conversation->recieverProfile->profileable_type . '/' . $conversation->recieverProfile->profileable->profile_img) : asset('/images/avatar/avatar.jpeg') }}')"></div>
                                </div>
                            </div>
                        </a>
                    </div>

                    
                    <div class="message-area">
                        <ul class="list-unstyled" id="chatDiv">
                            @foreach ($chats as $item)
                                @if ($item->profile->profileable_type == 'investor')
                                    <li class="message-div sent me-auto bg-success text-white">
                                        <strong>{{ $item->profile->profileable->firstname }}:</strong>
                                        {{ $item->message_text }}
                                        <small class="fst-italic d-block text-end text-muted">{{ formatChatDate($item->created_at) }}</small>
                                    </li>
                                @elseif ($item->profile->profileable_type == 'trader')
                                    <li class="message-div recieved me-auto bg-white"> 
                                        <strong>{{ $item->profile->profileable->firstname }}:</strong> 
                                        {{ $item->message_text }} 
                                        <small class="fst-italic d-block text-end text-muted">{{ formatChatDate($item->created_at) }}</small>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
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