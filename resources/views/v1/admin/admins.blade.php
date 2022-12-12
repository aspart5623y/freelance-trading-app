@extends('layouts.admin')

@section('title', 'Admins')


@section('content')
    <div class="container-fluid">
       

        <h4 class="fw-bold">Admins</h4>
        <p class="text-muted mb-5">
            This table contains a list of all the admins on your platform.
        </p>



        <div class="row justify-content-center">

            <div class="col-xl-4 col-lg-12 col-md-5">
                <div class="card card-body border-0 mb-4 d-block">
                    <h4 class="fw-bold mb-3">Create Admin</h4>

                    <form action="{{ route('admin.user.createAdmin') }}" method="post">
                        @csrf
                        
                        <div class="form-group mb-3">
                            <label class="mb-1">Firstname</label>
                            <input type="text" placeholder="Enter firstname" class="form-control min-height @error('firstname') is-invalid @enderror" value="{{ old('firstname') }}" name="firstname">                            
                            @error('firstname')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div class="form-group mb-3">
                            <label class="mb-1">Lastname</label>
                            <input type="text" placeholder="Enter lastname" class="form-control min-height @error('lastname') is-invalid @enderror" value="{{ old('lastname') }}" name="lastname">                            
                            @error('lastname')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div class="form-group mb-3">
                            <label class="mb-1">Email</label>
                            <input type="text" placeholder="Enter email" class="form-control min-height @error('email') is-invalid @enderror" value="{{ old('email') }}" name="email">                            
                            @error('email')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div class="form-group mb-3">
                            <label class="mb-1">Level</label>
                            <select name="level" id="" class="form-select min-height @error('level') is-invalid @enderror">
                                <option value="">Select admin level</option>
                                <option value="manager">Manager</option>
                                <option value="support">Support</option>
                            </select>
                            @error('level')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <button type="submit" class="btn btn-success px-4">Create</button>
                    </form>
                </div>
            </div>

            <div class="col-xl-8 col-lg-12 col-md-7">
                <div class="card card-body border-0 mb-4">
                    <h4 class="fw-bold mb-3">Admin List</h4>

                    <div class="table-responsive">
                        <table class="table table-borderless data-table">
                            <thead>
                                <tr>
                                    <th class="text-muted text-uppercase">s/n</th>
                                    <th class="text-muted text-uppercase">fullname</th>
                                    <th class="text-muted text-uppercase">email</th>
                                    <th class="text-muted text-uppercase">level</th>
                                    <th class="text-muted text-uppercase"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $sn = 1;   
                                @endphp
                                @foreach ($admins as $user)
                                    @if (auth()->user()->email == $user->profile->email) 
                                        @php
                                            continue;    
                                        @endphp
                                    @else
                                        <tr class="border-bottom">
                                            <td>{{ $sn++ }}</td>
                                            <td>{{ $user->firstname . ' ' . $user->lastname }}</td>
                                            <td>{{ $user->profile->email }}</td>
                                            <td class="text-capitalize">{{ $user->level }}</td>
                                            <td>
                                                <a href="{{ route('admin.user.show', $user->profile->id) }}" class="btn btn-link">View</a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>



    </div>













    @push('js')
        <script>
            $(document).ready(function () {
                $('.data-table').DataTable();
            });
        </script>
    @endpush
@endsection
    