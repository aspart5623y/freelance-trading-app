@extends('layouts.trader')

@section('title', 'Investment')

@section('content')

    <div class="d-flex justify-content-between flex-wrap align-items-center mb-5">
        <div>
            <h4 class="fw-bold">Investments</h4>
            <p class="text-muted">
                This table contains a list of all your investments on this platform.
            </p>
        </div>
    </div>

    <div class="card card-body border-0"> 
        <div class="table-responsive"> 
            <table class="table table-borderless data-table"> 
                <thead> 
                    <tr> 
                        <th class="text-muted text-uppercase">s/n</th> 
                        <th class="text-muted text-uppercase">Amount</th> 
                        <th class="text-muted text-uppercase">package</th> 
                        <th class="text-muted text-uppercase">duration</th> 
                        <th class="text-muted text-uppercase">PRofits</th> 
                        <th class="text-muted text-uppercase">status</th> 
                        <th class="text-muted text-uppercase">requested date</th> 
                        <th></th>
                    </tr> 
                </thead> 
                <tbody> 
                    @php 
                        $sn = 1; 
                    @endphp 
                    @foreach ($investments as $item) 
                        <tr class="border-bottom"> 
                            <td>{{ $sn++ }}</td> 
                            <td>${{ number_format($item->amount, 2) }}</td> 
                            <td>{{ $item->package->title }}</td> 
                            <td>{{ $item->package->duration }}days</td> 
                            <td>${{ number_format($item->amount * ($item->package->roi/100), 2) }}/daily</td> 
                            <td> 
                                @if ($item->status == 'accepted' || $item->status == 'completed') 
                                    <span class="badge bg-success">{{ $item->status }}</span> 
                                @elseif ($item->status == 'running') 
                                    <i class="fas fa-spinner text-success fa-pulse"></i>
                                    <span class="badge text-success bg-light">{{ $item->status }}</span> 
                                    <i class="fas fa-spinner text-success fa-pulse"></i>
                                @elseif ($item->status == 'rejected' || $item->status == 'cancelled') 
                                    <span class="badge bg-danger">{{ $item->status }}</span> 
                                @elseif ($item->status == 'pending') 
                                    <span class="badge bg-secondary">{{ $item->status }}</span> 
                                @endif 
                            </td> 
                            <td>{{ Carbon\Carbon::create($item->created_at)->format('l jS \of F Y') }}</td> 
                            <td>
                                <select name="" id="{{ $item->id }}" class="form-select status-select"> 
                                    @if ($item->status == 'pending') 
                                        <option value="pending" {{ $item->status == 'pending' ? 'selected' : '' }}>pending</option> 
                                        <option value="accepted" {{ $item->status == 'accepted' ? 'selected' : '' }}>accepted</option> 
                                        <option value="rejected" {{ $item->status == 'rejected' ? 'selected' : '' }}>rejected</option> 
                                    @elseif($item->status == 'accepted')
                                        <option value="accepted" {{ $item->status == 'accepted' ? 'selected' : '' }}>accepted</option> 
                                        <option value="running" {{ $item->status == 'running' ? 'selected' : '' }}>running</option> 
                                        <option value="completed" {{ $item->status == 'completed' ? 'selected' : '' }}>completed</option> 
                                    @elseif($item->status == 'running')
                                        <option value="running" {{ $item->status == 'running' ? 'selected' : '' }}>running</option> 
                                        <option value="completed" {{ $item->status == 'completed' ? 'selected' : '' }}>completed</option> 
                                    @elseif($item->status == 'completed')
                                        <option value="completed" {{ $item->status == 'completed' ? 'selected' : '' }}>completed</option> 
                                    @endif 
                                </select> 
                            </td>
                        </tr> 
                    @endforeach 
                </tbody> 
            </table> 
        </div> 
    </div>


   
    <form action="{{ route('trader.investment.update') }}" id="status-form" class="d-none" method="post">
        @csrf
        <input type="hidden" name="id" id="statusID">
        <input type="hidden" name="status" id="statusVal">
    </form>



    @push('js')
        <script>
            $('.status-select').on('change', function() {
                $("#statusVal").val($(this).val())
                $("#statusID").val($(this).attr('id'))
                $("#status-form").submit()
            })
        </script>

        <script>
            $(document).ready(function () {
                $('.data-table').DataTable();
            });
        </script>
    @endpush
@endsection