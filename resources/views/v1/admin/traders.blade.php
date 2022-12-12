@extends('layouts.admin')

@section('title', 'Traders')


@section('content')
    <div class="container-fluid">
        <h4 class="fw-bold">Traders</h4>
        <p class="text-muted mb-5">
            This table contains a list of all the traders on your platform.
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
                            <th class="text-muted text-uppercase">Account Verified</th>
                            <th class="text-muted text-uppercase"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $sn = 1;
                        @endphp
                        @foreach ($traders as $user)
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
                                    @if ($user->verify)
                                        <span class="fw-bold text-success"><i class="fas fa-check-circle"></i> &nbsp; Verified</span>
                                    @else
                                        <span class="fw-bold text-warning"><i class="fas fa-exclamation-triangle"></i> &nbsp; Pending</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.user.show', $user->profile->id) }}" class="btn btn-sm btn-success">View</a> 
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
    