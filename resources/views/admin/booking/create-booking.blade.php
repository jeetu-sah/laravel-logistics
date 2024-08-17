@extends('admin.admin_layout.master')
@section('main_content')
    <div class="content-wrapper" style="min-height: 1419.51px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <a href="{{ url('admin/branch/branch-list') }}"
                            class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
                                class=" fa-sm text-white-50"></i> Booking List</a>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Create New Booking</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-6">

                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Consignor</h3>
                            </div>


                            <form>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="email" class="form-control" id="exampleInputEmail1"
                                                    placeholder="State Name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="email" class="form-control" id="exampleInputEmail1"
                                                    placeholder="City Name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="email" class="form-control" id="exampleInputEmail1"
                                                    placeholder="Branch Name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <input type="email" class="form-control" id="exampleInputEmail1"
                                                    placeholder="Consignor Name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <input type="email" class="form-control" id="exampleInputEmail1"
                                                    placeholder="Consignor Number">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <input type="email" class="form-control" id="exampleInputEmail1"
                                                    placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">

                                                <input type="email" class="form-control" id="exampleInputEmail1"
                                                    placeholder="GST Number">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        {{-- <label for="exampleInputPassword1">Address</label> --}}
                                        <textarea class="form-control" id="exampleInputPassword1" placeholder="Address"></textarea>
                                    </div>
                                    <div class="form-group">
                                        {{-- <label for="exampleInputFile">Pin Code</label> --}}
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="text" class="form-control" id="exampleInputPassword1"
                                                    placeholder="Pin code">
                                                {{-- <label class="custom-file-label" for="">Choose file</label> --}}
                                            </div>

                                        </div>
                                    </div>

                                </div>


                            </form>
                        </div>

                    </div>


                    <div class="col-md-6">

                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Consignee</h3>
                            </div>
                            <form>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="email" class="form-control" id="exampleInputEmail1"
                                                    placeholder="State Name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="email" class="form-control" id="exampleInputEmail1"
                                                    placeholder="City Name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="email" class="form-control" id="exampleInputEmail1"
                                                    placeholder="Branch Name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <input type="email" class="form-control" id="exampleInputEmail1"
                                                    placeholder="Consignee Name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <input type="email" class="form-control" id="exampleInputEmail1"
                                                    placeholder="Consignee Number">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <input type="email" class="form-control" id="exampleInputEmail1"
                                                    placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">

                                                <input type="email" class="form-control" id="exampleInputEmail1"
                                                    placeholder="GST Number">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        {{-- <label for="exampleInputPassword1">Address</label> --}}
                                        <textarea class="form-control" id="exampleInputPassword1" placeholder="Address"></textarea>
                                    </div>
                                    <div class="form-group">
                                        {{-- <label for="exampleInputFile">Pin Code</label> --}}
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="text" class="form-control" id="exampleInputPassword1"
                                                    placeholder="Pin code">
                                                {{-- <label class="custom-file-label" for="">Choose file</label> --}}
                                            </div>

                                        </div>
                                    </div>

                                </div>


                            </form>

                        </div>

                    </div>

                    <div class="col-md-6">
                        <div class="card card-danger">
                            <div class="card-header">
                                <h3 class="card-title">Other Details</h3>
                            </div>
                            <form>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <input type="email" class="form-control" id="exampleInputEmail1"
                                                    placeholder="Dest Pin code">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <select class="custom-select">
                                                    <option value="">Select Mode of Payment </option>
                                                    <option>Paid</option>
                                                    <option>To Pay</option>
                                                    <option>To Client</option>
                                                   
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <input type="test" class="form-control" id="exampleInputEmail1"
                                                    placeholder="Services Line">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <input type="test" class="form-control" id="exampleInputEmail1"
                                                    placeholder="No Of Pkg">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <input type="test" class="form-control" id="exampleInputEmail1"
                                                    placeholder="Actule weight">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <input type="test" class="form-control" id="exampleInputEmail1"
                                                    placeholder="Gate Way">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <input type="test" class="form-control" id="exampleInputEmail1"
                                                    placeholder="Packing Type">
                                            </div>
                                        </div>
                                    </div>

                                 
                                   

                                </div>


                            </form>

                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="card card-dark">
                            <div class="card-header">
                                <h3 class="card-title">E-Way Bills</h3>
                            </div>
                            <form>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Description</label>
                                              
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Amount</label>
                                              
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Freight</label>
                                               
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <input type="text" class="form-control" id="exampleInputEmail1"
                                                    placeholder="₹.00">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">O.S</label>
                                               
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <input type="text" class="form-control" id="exampleInputEmail1"
                                                    placeholder="₹.00">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">FOV</label>
                                               
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <input type="text" class="form-control" id="exampleInputEmail1"
                                                    placeholder="₹.00">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Transhipment</label>
                                               
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <input type="text" class="form-control" id="exampleInputEmail1"
                                                    placeholder="₹.00">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Hendling Charge</label>
                                               
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <input type="text" class="form-control" id="exampleInputEmail1"
                                                    placeholder="₹.00">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Loading Charge</label>
                                               
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <input type="text" class="form-control" id="exampleInputEmail1"
                                                    placeholder="₹.00">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Misc Charge</label>
                                               
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <input type="text" class="form-control" id="exampleInputEmail1"
                                                    placeholder="₹.00">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Other Charges</label>
                                             
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <input type="text" class="form-control" id="exampleInputEmail1"
                                                    placeholder="₹.00">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Grand Total</label>
                                                
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <input type="text" class="form-control" id="exampleInputEmail1"
                                                    placeholder="₹.00">
                                            </div>
                                        </div>
                                       
                                    </div>

                                  
                                   

                                </div>


                            </form>

                        </div>

                    </div>

                </div>

            </div>
        </section>
    </div>
@endsection
