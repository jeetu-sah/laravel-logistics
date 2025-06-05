@extends('admin.admin_layout.master')
@section('main_content')
    <div class="content-wrapper" style="min-height: 1419.51px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <!-- <a href="{{ url('branch-user/employees') }}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class=" fa-sm text-white-50"></i> Employees List</a> -->
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Settings</li>
                        </ol>
                    </div>
                </div>
                <div class="row mb-2">
                    @include('common.notification')
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Branch Settings</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('branch-user.settings') }}" method="post" id="form"
                        enctype="multipart/form-data" class="needs-validation" novalidate>
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="prefix_employee_id" class="form-label">Prefix Employee Id</label>
                                    <input type="text" name="prefix_employee_id" class="form-control"
                                        id="prefix_employee_id" value="{{ $settings?->prefix_employee_id }}"
                                        placeholder="Prefix Employee Id" required />

                                </div>
                            </div>


                        </div>
                        <div class="card-header" style="margin: 0 0 0 -20px;">
                            <h3 class="card-title">Branch Settings</h3>
                        </div>
                        <div class="row">

                            <div class="col-md-4 mt-2">
                                <div class="form-group">
                                    <label for="freight_amount" class="form-label">Freight</label>
                                    <input type="text" name="freight_amount" class="form-control"
                                        id="freight_amount" value="{{ $settings?->freight_amount }}"
                                        placeholder="Freight" required />
                                    <small class="text-danger">Distances/Km</small>

                                </div>
                            </div>
                            <div class="col-md-4 mt-2">
                                <div class="form-group">
                                    <label for="wbc_charges" class="form-label">WBC</label>
                                    <input type="text" name="wbc_charges" class="form-control"
                                        id="wbc_charges" value="{{ $settings?->wbc_charges }}"
                                        placeholder="WBC" required />
                                    <small class="text-danger">Per Parcel</small>


                                </div>
                            </div>
                            <div class="col-md-4 mt-2">
                                <div class="form-group">
                                    <label for="handling_charges" class="form-label">Handling Charges:</label>
                                    <input type="text" name="handling_charges" class="form-control"
                                        id="handling_charges" value="{{ $settings?->handling_charges }}"
                                        placeholder="Handling Charges:" required />
                                    <small class="text-danger">Per Parcel</small>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fov_amount" class="form-label">FOV</label>
                                    <input type="text" name="fov_amount" class="form-control"
                                        id="fov_amount" value="{{ $settings?->fov_amount }}"
                                        placeholder="FOV" required />
                                    <small class="text-danger">Applicable for goods of value</small>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fuel_amount" class="form-label">Fuel Charges</label>
                                    <input type="text" name="fuel_amount" class="form-control"
                                        id="fuel_amount" value="{{ $settings?->fuel_amount }}"
                                        placeholder="Fuel Charges" required />
                                    <small class="text-danger">Per Parcel</small>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="transhipmen_amount" class="form-label">Transhipment</label>
                                    <input type="text" name="transhipmen_amount" class="form-control"
                                        id="transhipmen_amount" value="{{ $settings?->transhipmen_amount }}"
                                        placeholder="Transhipment" required />
                                    <small class="text-danger">Per Parcel</small>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="hamali_Charges" class="form-label">Hamali Charges</label>
                                    <input type="text" name="hamali_Charges" class="form-control"
                                        id="hamali_Charges" value="{{ $settings?->hamali_Charges }}"
                                        placeholder="Hamali Charges" required />
                                    <small class="text-danger">Per Parcel</small>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="bilti_Charges" class="form-label">Bilti Charges</label>
                                    <input type="text" name="bilti_Charges" class="form-control"
                                        id="bilti_Charges" value="{{ $settings?->bilti_Charges }}"
                                        placeholder="Bilti Charges" required />
                                    <small class="text-danger">Per Parcel</small>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="compney_charges" class="form-label">Company Charges</label>
                                    <input type="text" name="compney_charges" class="form-control"
                                        id="compney_charges" value="{{ $settings?->compney_charges }}"
                                        placeholder="Company Charges" required />
                                    <small class="text-danger">Per Parcel</small>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="cgst" class="form-label">CGST</label>
                                    <input type="text" name="cgst" class="form-control"
                                        id="cgst" value="{{ $settings?->cgst }}"
                                        placeholder="CGST" required />
                                    <small class="text-danger">9% of Subtotal</small>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="sgst" class="form-label">SGST</label>
                                    <input type="text" name="sgst" class="form-control"
                                        id="sgst" value="{{ $settings?->sgst }}"
                                        placeholder="SGST" required />
                                    <small class="text-danger">9% of Subtotal</small>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="igst" class="form-label">IGST</label>
                                    <input type="text" name="igst" class="form-control"
                                        id="igst" value="{{ $settings?->igst }}"
                                        placeholder="IGST" required />
                                    <small class="text-danger">18% of Subtotal</small>

                                </div>
                            </div>

                        </div>

                        <button class="btn btn-primary mt-3" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection