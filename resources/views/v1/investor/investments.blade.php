@extends('layouts.investor')

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
                        <th class="text-muted text-uppercase">trader</th> 
                        <th class="text-muted text-uppercase">duration</th> 
                        <th class="text-muted text-uppercase">PRofits</th> 
                        <th class="text-muted text-uppercase">status</th> 
                        <th class="text-muted text-uppercase">requested date</th> 
                        <th></th>
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
                            <td>${{ $item->amount }}</td> 
                            <td>
                                <a href="{{ route('investor.package.show', $item->package->id) }}" class="text-muted">{{ $item->package->title }}</a>
                            </td> 
                            <td>
                                <a href="{{ route('investor.trader.show', $item->trader->profile->id) }}" class="text-muted">{{ $item->trader->firstname . ' ' . $item->trader->lastname }}</a>
                            </td> 
                            <td>{{ $item->package->duration }}days</td> 
                            <td>${{ number_format($item->amount * ($item->package->roi/100), 2) }}</td> 
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
                                <button type="button" id="{{ $item->id }}" class="btn btn-sm btn-success view-btn">View</button>
                            </td>
                            <td>
                                @if ($item->status == 'pending') 
                                    <button type="button" data-id="{{ $item->id }}" class="btn btn-sm btn-danger cancel-btn" id="{{ $item->id }}">
                                        <i class="fas fa-times"></i>
                                    </button>
                                @endif 
                            </td>
                        </tr> 
                    @endforeach 
                </tbody> 
            </table> 
        </div> 
    </div>







    <div class="modal fade" id="viewModal">
        <div class="modal-dialog modal-dialog-scrollable modal-xl">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="d-flex justify-content-end">
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-6">
                            <h5 class="fw-bold">Investment Details</h5>
                            <div class="table-responsive mb-4">
                                <table class="table table-striped mb-4">
                                    <tbody id="investmentDetails">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <h5 class="fw-bold">Earnings</h5>
                            <div class="table-responsive mb-4">
                                <table class="table mb-4">
                                    <thead>
                                        <th class="text-muted text-uppercase">S/N</th> 
                                        <th class="text-muted text-uppercase">Amount</th> 
                                        <th class="text-muted text-uppercase">Date</th> 
                                    </thead>
                                    <tbody id="earningsTable">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="cancelModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="d-flex justify-content-between">
                        <h5 class="fw-bold">Cancel Investment</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    
                    <p class="text-muted">
                        Are you sure you want to cancel this investment?
                    </p>
                    
                    <div class="text-end">
                        <button class="btn btn-light text-danger px-4 me-1" data-bs-dismiss="modal">Cancel</button>
                        <a class="btn btn-danger px-4" href="#"
                            onclick="event.preventDefault();
                                        document.getElementById('cancel-form').submit();">
                            Confirm
                        </a>
                    
                        <form id="cancel-form" action="{{ route('investor.investment.cancel') }}" method="POST" class="d-none">
                            @csrf
                            <input type="hidden" id="serviceId" name="id">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    

    @push('js')
        <script src="{{ asset('js/moment.min.js') }}"></script>
        <script>
            $('.view-btn').on('click', function() {
                $payload = $(this).attr('id');
                $('#viewModal').on('show.bs.modal', function() {
                    fetch(`/investment/details/${$payload}`)
                        .then(response => {
                            if (!response.ok) {
                                return Promise.reject(response);
                                // throw new Error('Account not found. Please make sure the account address is correct.');
                            }
                            return response.json();
                        })
                        .then(data => {

                            $status = '';
                            if (data.investment.status == 'accepted' || data.investment.status == 'completed') {
                                $status = `<span class="badge bg-success">${data.investment.status}</span>`;
                            } else if (data.investment.status == 'running') {
                                $status = `<i class="fas fa-spinner text-success fa-pulse"></i>
                                            <span class="badge text-success bg-light">${data.investment.status}</span> 
                                            <i class="fas fa-spinner text-success fa-pulse"></i>`
                            } else if (data.investment.status == 'rejected' || data.investment.status == 'cancelled') {
                                $status = `<span class="badge bg-danger">${data.investment.status}</span>`
                            } else if (data.investment.status == 'pending') {
                                $status = `<span class="badge bg-secondary">${data.investment.status}</span>`
                            } 

                            $dates = ''
                            if (data.investment.status == 'running') {
                                $dates = `
                                    <tr>
                                        <th>Date investment started running</th>
                                        <td>${data.investment.start_date}</td>
                                    </tr>
                                    <tr>
                                        <th>End Date</th>
                                        <td>${data.investment.end_date}</td>
                                    </tr>
                                `
                            }


                            $('#investmentDetails').html(`
                                <tr>
                                    <th>Requested Date</th>
                                    <td>${data.investment.requested_date}</td>
                                </tr>
                                <tr>
                                    <th>Package Name</th>
                                    <td><a href="/investor/package/view/${data.investment.package_id}" class="text-success">${data.investment.package_title}</a></td>
                                </tr>
                                <tr>
                                    <th>Package Duration</th>
                                    <td>${data.investment.duration} days</td>
                                </tr>
                                <tr>
                                    <th>Trader</th>
                                    <td><a href="/investor/trader/show/${data.investment.trader_profile_id}" class="text-success">${data.investment.trader_name}</a></td>
                                </tr>
                                <tr>
                                    <th>Amount</th>
                                    <td>$${data.investment.amount}</td>
                                </tr>
                                <tr>
                                    <th>Daily Return</th>
                                    <td>$${data.investment.daily_return}/daily</td>
                                </tr>
                                <tr>
                                    <th>Total Profit</th>
                                    <td>$${data.investment.profit}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>${$status}</td>
                                </tr>
                                ${$dates}
                            `);


                            $('#earningsTable').html('')
                            data.earnings.forEach((element, index) => {
                                $('#earningsTable').append(`
                                    <tr>
                                        <td>${index + 1}</td>
                                        <td>$${element.amount}</td>    
                                        <td>${moment(element.created_at).format("dddd Do of MMMM YYYY")}</td>    
                                    </tr>
                                `);
                            });
                        })
                        .catch(function(error) {
                            if (typeof error.json === "function") {
                                error.json().then(jsonError => {
                                    $('#investmentDetails').html(`
                                        <tr>
                                            <td>${jsonError}</td>
                                        </tr>
                                    `);
                                }).catch(genericError => {
                                    $('#investmentDetails').html(`
                                        <tr>
                                            <td>${error.statusText}</td>
                                        </tr>
                                    `);
                                });
                            } else {
                                $('#investmentDetails').html(`
                                    <tr>
                                        <td>${error}</td>
                                    </tr>
                                `);
                            }
                            
                        });
                })
                $('#viewModal').modal('show')
            })
        </script>


        <script>
            $('.cancel-btn').on('click', function() {
                $id = $(this).attr('id');
                $('#cancelModal').on('show.bs.modal', function() {
                    $('#serviceId').val($id);
                })
                $('#cancelModal').modal('show')
            })
        </script>

        <script>
            $(document).ready(function () {
                $('.data-table').DataTable();
            });
        </script>
    @endpush
@endsection