@extends('layouts.admin')

@section('title', 'Contact Message')

@section('content')

    <div class="container-fluid">
        <div class="d-flex justify-content-between flex-wrap align-items-center mb-5">
            <div>
                <h4 class="fw-bold">Contact Messages</h4>
                <p class="text-muted">
                    This table contains a list of all your Contact Messages on this platform.
                </p>
            </div>
        </div>
        
        <div class="card card-body border-0"> 
            <div class="table-responsive"> 
                <table class="table table-borderless data-table"> 
                    <thead> 
                        <tr> 
                            <th class="text-muted text-uppercase">s/n</th> 
                            <th class="text-muted text-uppercase">Name</th> 
                            <th class="text-muted text-uppercase">email</th> 
                            <th class="text-muted text-uppercase">message</th> 
                            <th class="text-muted text-uppercase">date sent</th> 
                        </tr> 
                    </thead> 
                    <tbody> 
                        @php 
                            $sn = 1; 
                        @endphp 
                        @foreach ($contacts as $item) 
                            <tr class="border-bottom"> 
                                <td>{{ $sn++ }}</td> 
                                <td>{{ $item->name }}</td> 
                                <td>{{ $item->email }}</td> 
                                <td class="text-wrap">{{ $item->message }}</td> 
                                <td>{{ Carbon\Carbon::create($item->created_at)->format('l jS \of F Y') }}</td> 
                            </tr> 
                        @endforeach 
                    </tbody> 
                </table> 
            </div> 
        </div>
        
    </div>






@endsection