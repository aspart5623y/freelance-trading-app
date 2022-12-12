@extends('layouts.admin')

@section('title', 'Investors')


@section('content')
    <div class="container-fluid">
        <h4 class="fw-bold">Investors</h4>
        <p class="text-muted mb-5">
            This table contains a list of all the investors on your platform.
        </p>
        
        
        <div class="card card-body border-0">
            <div class="table-responsive">
                <table class="table table-borderless data-table">
                    <thead>
                        <tr>
                            <th class="text-muted text-uppercase">s/n</th>
                            <th class="text-muted text-uppercase">image</th>
                            <th class="text-muted text-uppercase">fullname</th>
                            <th class="text-muted text-uppercase">email</th>
                            <th class="text-muted text-uppercase">gender</th>
                            <th class="text-muted text-uppercase">phone number</th>
                            <th class="text-muted text-uppercase"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $sn = 1;   
                        @endphp
                        @foreach ($investors as $user)
                            <tr class="border-bottom">
                                <td>{{ $sn++ }}</td>
                                <td>
                                    <div class="table-img" style="background-image: url('{{ $user->profile_img ? asset('profile-image/' . $user->profile->profileable_type . '/' . $user->profile_img) : asset('/images/avatar/avatar.jpeg') }}')">
                                    </div>
                                </td>
                                <td>{{ $user->firstname . ' ' . $user->lastname }}</td>
                                <td>{{ $user->profile->email }}</td>
                                <td>{{ $user->gender }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>
                                    <a href="{{ route('admin.user.show', $user->profile->id) }}" class="btn btn-success btn-sm">View</a> 
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
    