@extends('admin.admin_layout.master')
@section('main_content')
<div class="content-wrapper" style="min-height: 1419.51px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a href="{{ url('admin/branches') }}"
                        class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
                            class="fa-sm text-white-50"></i> Branch List</a>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Set Branch Commisions</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            @include('common.notification')
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Set Branch Commisions for {{ $branch->branch_name ?? '--'}}</h3>
            </div>
            <div class="card-body">
                <form action="{{ url('admin/branches/store-commision/2') }}"
                    method="post"
                    id="form"
                    name="pForm"
                    enctype="multipart/form-data"
                    class="needs-validation"
                    novalidate>
                    @csrf
                    @forelse($branches as $b)
                        @php
                            $commission = $branch->commisionsList->where('consignee_branch_id', $b->id)->first();
                        @endphp
                    <div class="row">
                        <!-- Branch Name -->
                        <div class="col-md-4 mb-3">
                            <label for="branch_name_{{ $b->id }}" class="form-label">Branch Name</label>
                            <select class="form-control"
                                name="branch_name[]"
                                id="branch_name"
                                required>
                                <option value="{{$b->id}}">{{$b->branch_name ?? '--'}}</option>
                            </select>

                            <div class="invalid-feedback">Please select a branch</div>
                            @error('branch_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Commission Amount -->
                        <div class="col-md-4">
                            <label for="commission_amount_{{ $b->id }}" class="form-label">Commission Amount</label>
                            <input type="number"
                                class="form-control"
                                name="commission_amount[{{ $b->id }}]"
                                id="commission_amount_{{ $b->id }}"
                                placeholder="Enter Commission Amount"
                                value="{{ old('commission_amount.' . $b->id, $commission->amount ?? '') }}"
                                required>
                            <div class="invalid-feedback">Please enter the commission amount</div>
                            @error('commission_amount.' . $b->id)
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    @empty
                    <p>No other branches available to set commission.</p>
                    @endforelse

                    <button class="btn btn-primary mt-3" type="submit">Submit</button>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
@endsection