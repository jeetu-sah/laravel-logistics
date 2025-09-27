@extends('admin.admin_layout.master')

@section('main_content')
<div class="content-wrapper">

    <!-- Page Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-7">
                    <h3 class="mb-1 text-dark">Branch Commission Management</h3>
                    <p class="text-muted mb-0">
                        Configure <strong>Outgoing</strong> and <strong>Incoming</strong> commissions
                        for branch: <span class="text-primary">{{ $branch->branch_name ?? '--' }}</span>
                    </p>
                </div>
                <div class="col-sm-5 text-right">
                    <a href="{{ url('admin/branches') }}" class="btn btn-success btn-sm shadow-sm">
                        <i class="fas fa-list mr-1"></i> Back to Branch List
                    </a>
                </div>
            </div>
            <div class="row mt-3">
                @include('common.notification')
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="content">
        <div class="container-fluid">

            <div class="card shadow-sm">
                <!-- Custom Tab Header -->
                <div class="card-header bg-light border-bottom-0 p-0">
                    <ul class="nav nav-pills nav-justified" id="commissionTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link py-3 font-weight-bold 
                {{ session('activeTab', 'outgoing') === 'outgoing' ? 'active' : '' }}"
                                id="outgoing-tab" data-toggle="tab" href="#outgoing" role="tab">
                                <i class="fas fa-arrow-up text-primary mr-2"></i> Outgoing Commissions
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link py-3 font-weight-bold 
                {{ session('activeTab') === 'incoming' ? 'active' : '' }}"
                                id="incoming-tab" data-toggle="tab" href="#incoming" role="tab">
                                <i class="fas fa-arrow-down text-success mr-2"></i> Incoming Commissions
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Tab Content -->
                <div class="card-body">
                    <div class="tab-content" id="commissionTabsContent">

                        <!-- Outgoing Commissions -->
                        <div class="tab-pane fade show active" id="outgoing" role="tabpanel">
                            <h5 class="mb-3 text-primary"><i class="fas fa-cogs mr-1"></i> Outgoing Commission Settings</h5>
                            <form action='{{ url("admin/branches/store-commision/$branch->id") }}' method="post" novalidate>
                                @csrf
                                <input type="hidden" name="type" value="outgoing" />

                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Branch</th>
                                                <th>Commission Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($branches as $b)
                                            @php
                                            $commission = $branch->outgoingCommisions->where('consignee_branch_id', $b->id)->first();
                                            @endphp
                                            <tr>
                                                <td>
                                                    <input type="hidden" name="branch_name[]" value="{{ $b->id }}">
                                                    <span class="font-weight-bold">{{ $b->branch_name ?? '--' }}</span>
                                                </td>
                                                <td>
                                                    <input type="number"
                                                        class="form-control"
                                                        name="commission_amount[{{ $b->id }}]"
                                                        placeholder="Enter Amount"
                                                        value="{{ old('commission_amount.' . $b->id, $commission->amount ?? '') }}"
                                                        required>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="2" class="text-center text-muted">No branches available.</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                <div class="text-right">
                                    <button class="btn btn-primary mt-2" type="submit">
                                        <i class="fas fa-save mr-1"></i> Save Outgoing Commissions
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Incoming Commissions -->
                        <div class="tab-pane fade" id="incoming" role="tabpanel">
                            <h5 class="mb-3 text-success"><i class="fas fa-cogs mr-1"></i> Incoming Commission Settings</h5>
                            <form action='{{ url("admin/branches/store-commision/$branch->id") }}' method="post" novalidate>
                                @csrf
                                <input type="hidden" name="type" value="incoming" />

                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Branch</th>
                                                <th>Commission Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($branches as $b)
                                            @php
                                            $commission = $branch->incomingCommisions->where('consignee_branch_id', $b->id)->first();
                                            @endphp
                                            <tr>
                                                <td>
                                                    <input type="hidden" name="branch_name[]" value="{{ $b->id }}">
                                                    <span class="font-weight-bold">{{ $b->branch_name ?? '--' }}</span>
                                                </td>
                                                <td>
                                                    <input type="number"
                                                        class="form-control"
                                                        name="commission_amount[{{ $b->id }}]"
                                                        placeholder="Enter Amount"
                                                        value="{{ old('commission_amount.' . $b->id, $commission->amount ?? '') }}"
                                                        required>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="2" class="text-center text-muted">No branches available.</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                <div class="text-right">
                                    <button class="btn btn-success mt-2" type="submit">
                                        <i class="fas fa-save mr-1"></i> Save Incoming Commissions
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>
</div>

<!-- Extra Styling -->
<style>
    .nav-pills .nav-link {
        border-radius: 0;
        transition: 0.3s ease;
        font-size: 15px;
    }

    .nav-pills .nav-link.active {
        background: #f8f9fa;
        border-bottom: 3px solid #007bff;
        color: #007bff !important;
    }

    .nav-pills .nav-link:hover {
        background: #f1f1f1;
    }

    #incoming-tab.active {
        border-bottom: 3px solid #28a745 !important;
        color: #28a745 !important;
    }
</style>
@endsection