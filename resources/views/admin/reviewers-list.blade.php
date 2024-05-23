@extends('admin.layout.layout')

@section('main-content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ $heading }}</h1>
            <a href="{{ url($addReviewersURL) }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fa-sm text-white-50"></i> {{ $btnName }}</a>
        </div>

        <!-- Content Row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        <div class="table-responsive ">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>First name</th>
                                        <th>Last name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>User Type</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $counter = 1; // Initialize counter variable
                                    @endphp
                                    @foreach ($allUsers as $users)
                                        <tr>
                                            <td>{{ $counter++ }}</td>
                                            <td>{{ $users->first_name }}</td>
                                            <td>{{ $users->last_name }}</td>
                                            <td>{{ $users->email }}</td>
                                            <td>{{ $users->mobile }}</td>
                                            <td>{{ $users->user_type }}</td>

                                        </tr>
                                    @endforeach
                                </tbody>


                            </table>
                            <div class="pagination-container">
                                <ul class="pagination">
                                    @if ($allUsers->onFirstPage())
                                        <li class="page-item disabled"><span class="page-link">Previous</span></li>
                                    @else
                                        <li class="page-item"><a class="page-link"
                                                href="{{ $allUsers->previousPageUrl() }}">Previous</a></li>
                                    @endif

                                    @for ($i = 1; $i <= $allUsers->lastPage(); $i++)
                                        <li class="page-item {{ $allUsers->currentPage() == $i ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $allUsers->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endfor

                                    @if ($allUsers->hasMorePages())
                                        <li class="page-item"><a class="page-link"
                                                href="{{ $allUsers->nextPageUrl() }}">Next</a></li>
                                    @else
                                        <li class="page-item disabled"><span class="page-link">Next</span></li>
                                    @endif
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
