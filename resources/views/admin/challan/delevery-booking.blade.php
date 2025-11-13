@extends('admin.admin_layout.master')
@section('main_content')
<div class="content-wrapper" style="min-height: 1419.51px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 align-items-center">
                <div class="col-sm-6">
                    <h4 class="m-0 text-primary">
                        <i class="fas fa-clipboard-list me-2" style="color: #007bff;"></i> {{ __('Manifest') }}
                    </h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right mb-0" style="background: transparent; padding: 0;">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}" style="color: #6c757d; text-decoration: none;">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item"><a href="#" style="color: #6c757d; text-decoration: none;">{{ __('Manifest') }}</a></li>
                        <li class="breadcrumb-item active" style="color: #007bff;">{{ __('Loading Challan Details') }}</li>
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
        <div class="container-fluid">
            <!-- Action Buttons -->
            <div class="row mb-4">
                <div class="col-12">
                    <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                        <button onclick="window.print()" class="btn btn-success" style="background: #28a745; border: none; padding: 8px 15px; border-radius: 4px; color: white; display: flex; align-items: center;">
                            <i class="fas fa-print mr-1"></i>{{__('Print') }}
                        </button>
                        @if($challanDetail->user->branch_user_id === $branchId)
                        <a href="{{ url('admin/challans') }}" class="btn btn-primary" style="background: #007bff; border: none; padding: 8px 15px; border-radius: 4px; color: white; display: flex; align-items: center; text-decoration: none;">
                            <i class="fas fa-edit mr-1"></i>{{__('Edit') }}
                        </a>
                        @endif
                        <a href="{{ url('admin/challans') }}" class="btn btn-warning" style="background: #ffc107; border: none; padding: 8px 15px; border-radius: 4px; color: #212529; display: flex; align-items: center; text-decoration: none;">
                            <i class="fas fa-angle-double-left mr-1"></i>{{__('Back') }}
                        </a>
                    </div>
                </div>
            </div>

            <!-- Challan Information Card -->
            <div class="row mb-4">
                <div class="col-12">
                    <div style="background: white; border: 1px solid #dee2e6; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                        <div style="background: linear-gradient(135deg, #007bff 0%, #0056b3 100%); padding: 15px 20px; border-radius: 8px 8px 0 0; display: flex; justify-content: between; align-items: center;">
                            <h3 style="margin: 0; color: white; font-size: 1.25rem; font-weight: 600;">
                                <i class="fas fa-truck-loading mr-2"></i>
                                {{ __('Loading Challan Information') }}
                            </h3>
                            <button type="button" style="background: none; border: none; color: white; font-size: 1rem;">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                        <div style="padding: 20px;">
                            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 15px;">
                                <!-- Created By -->
                                <div style="background: #f8f9fa; border: 1px solid #e9ecef; border-radius: 6px; padding: 15px;">
                                    <div style="color: #6c757d; font-size: 0.875rem; margin-bottom: 5px;">{{ __('Created By') }}</div>
                                    <div style="font-weight: 600; font-size: 1rem;">
                                        <span style="background: #dc3545; color: white; padding: 4px 8px; border-radius: 4px; font-size: 0.875rem;">
                                            {{ ($challanDetail->user->branch_user_id === $branchId) ? __('Self') :  (strtoupper($challanDetail->user->branch->branch_name) ?? __('N/A')) }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Vehicle Number -->
                                <div style="background: #f8f9fa; border: 1px solid #e9ecef; border-radius: 6px; padding: 15px;">
                                    <div style="color: #6c757d; font-size: 0.875rem; margin-bottom: 5px;">{{ __('Vehicle Number') }}</div>
                                    <div style="font-weight: 600; font-size: 1rem; color: #495057;">
                                        {{ strtoupper($challanDetail->busNumber ?? __('N/A')) }}
                                    </div>
                                </div>

                                <!-- Driver Name -->
                                <div style="background: #f8f9fa; border: 1px solid #e9ecef; border-radius: 6px; padding: 15px;">
                                    <div style="color: #6c757d; font-size: 0.875rem; margin-bottom: 5px;">{{ __('Driver Name') }}</div>
                                    <div style="font-weight: 600; font-size: 1rem; color: #495057;">
                                        {{ strtoupper($challanDetail->driverName ?? __('N/A')) }}
                                    </div>
                                </div>

                                <!-- Driver Mobile -->
                                <div style="background: #f8f9fa; border: 1px solid #e9ecef; border-radius: 6px; padding: 15px;">
                                    <div style="color: #6c757d; font-size: 0.875rem; margin-bottom: 5px;">{{ __('Driver Mobile') }}</div>
                                    <div style="font-weight: 600; font-size: 1rem;">
                                        <span style="background: #28a745; color: white; padding: 4px 8px; border-radius: 4px; font-size: 0.875rem;">
                                            {{ strtoupper($challanDetail->driverMobile ?? __('N/A')) }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Lock Number -->
                                <div style="background: #f8f9fa; border: 1px solid #e9ecef; border-radius: 6px; padding: 15px;">
                                    <div style="color: #6c757d; font-size: 0.875rem; margin-bottom: 5px;">{{ __('Lock Number') }}</div>
                                    <div style="font-weight: 600; font-size: 1rem;">
                                        <span style="background: #17a2b8; color: white; padding: 4px 8px; border-radius: 4px; font-size: 0.875rem;">
                                            {{ (strtoupper($challanDetail->locknumber) ?? __('N/A')) }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Co-Loder -->
                                <div style="background: #f8f9fa; border: 1px solid #e9ecef; border-radius: 6px; padding: 15px;">
                                    <div style="color: #6c757d; font-size: 0.875rem; margin-bottom: 5px;">{{ __('Co-Loder') }}</div>
                                    <div style="font-weight: 600; font-size: 1rem; color: #495057;">
                                        {{ strtoupper($challanDetail->coLoder ?? __('N/A')) }}
                                    </div>
                                </div>

                                <!-- Dispatch Date -->
                                <div style="background: #f8f9fa; border: 1px solid #e9ecef; border-radius: 6px; padding: 15px;">
                                    <div style="color: #6c757d; font-size: 0.875rem; margin-bottom: 5px;">{{ __('Dispatch Date') }}</div>
                                    <div style="font-weight: 600; font-size: 1rem; color: #495057;">
                                        {{ formatDate($challanDetail->created_at) }}
                                    </div>
                                </div>

                                <!-- Challan Number -->
                                <div style="background: #f8f9fa; border: 1px solid #e9ecef; border-radius: 6px; padding: 15px;">
                                    <div style="color: #6c757d; font-size: 0.875rem; margin-bottom: 5px;">{{ __('Challan Number') }}</div>
                                    <div style="font-weight: 600; font-size: 1rem; color: #495057;">
                                        {{ $challanDetail->challan_number ?? '--' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Booking List Card -->
            <div class="row">
                <div class="col-12">
                    <div style="background: white; border: 1px solid #dee2e6; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                        <form id="bookingForm" action="{{ url('admin/bookings/booking-received') }}" method="post">
                            @csrf
                            <input type="hidden" value="{{ $challanDetail->id }}" name="chalan_id">
                            <div style="background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%); padding: 15px 20px; border-radius: 8px 8px 0 0; display: flex; justify-content: between; align-items: center;">
                                <h3 style="margin: 0; color: white; font-size: 1.25rem; font-weight: 600;">
                                    <i class="fas fa-list-alt mr-2"></i>
                                    {{ __('Loading Challan Booking List') }}
                                </h3>
                                <button type="button" style="background: none; border: none; color: white; font-size: 1rem;">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <div style="padding: 20px;">
                                <div style="overflow-x: auto;">
                                    <table style="width: 100%; border-collapse: collapse; background: white;">
                                        <thead>
                                            <tr style="background: #343a40; color: white;">
                                                <th style="padding: 4px 8px; text-align: left; font-weight: 600; border: 1px solid #454d55; width: 5%;">
                                                    <!-- <input type="checkbox" style="margin: 0;"> -->
                                                </th>
                                                <th style="padding: 4px 8px; text-align: left; font-weight: 600; border: 1px solid #454d55; width: 10%;">{{ __('Created By') }}</th>
                                                <th style="padding: 4px 8px; text-align: left; font-weight: 600; border: 1px solid #454d55; width: 8%;">{{ __('Bilti Number') }}</th>
                                                <th style="padding: 4px 8px; text-align: left; font-weight: 600; border: 1px solid #454d55; width: 5%;">{{ __('Chalan Number') }}</th>
                                                <th style="padding: 4px 8px; text-align: left; font-weight: 600; border: 1px solid #454d55; width: 10%;">{{ __('Origin') }}</th>
                                                <th style="padding: 4px 8px; text-align: left; font-weight: 600; border: 1px solid #454d55; width: 10%;">{{ __('Consignor') }}</th>
                                                <th style="padding: 4px 8px; text-align: left; font-weight: 600; border: 1px solid #454d55; width: 10%;">{{ __('Consignee') }}</th>
                                                <th style="padding: 4px 8px; text-align: left; font-weight: 600; border: 1px solid #454d55; width: 10%;">{{ __('Destination') }}</th>
                                                <th style="padding: 4px 8px; text-align: left; font-weight: 600; border: 1px solid #454d55; width: 5%;">{{ __('QTY') }}</th>
                                                <th style="padding: 4px 8px; text-align: left; font-weight: 600; border: 1px solid #454d55; width: 10%;">{{ __('Cantain') }}</th>
                                                <th style="padding: 4px 8px; text-align: left; font-weight: 600; border: 1px solid #454d55; width: 8%;">{{ __('Booking Type') }}</th>
                                                <th style="padding: 4px 8px; text-align: left; font-weight: 600; border: 1px solid #454d55; width: 20%;">{{ __('Booked at') }}</th>
                                                <th style="padding: 4px 8px; text-align: left; font-weight: 600; border: 1px solid #454d55; width: 10%;">{{ __('Actions') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $i = 1; @endphp
                                            @foreach ($bookings as $booking)
                                            <tr style="border-bottom: 1px solid #dee2e6; transition: background-color 0.2s;">
                                                <td style="padding: 4px 8px; border: 1px solid #dee2e6;">
                                                    @if($booking->visible_for === auth()->user()->branch_user_id)
                                                    <input type="checkbox" name="selectedBookings[]" value="{{ $booking->id }}" style="margin: 0;">
                                                    @endif
                                                </td>
                                                <td style="padding: 4px 8px; border: 1px solid #dee2e6;">
                                                    <span style="background: #dc3545; color: white; padding: 4px 8px; border-radius: 4px; font-size: 0.875rem;">
                                                        {{ $booking->booking_created_by }}
                                                    </span>
                                                </td>
                                                <td style="padding: 4px 8px; border: 1px solid #dee2e6;">{{ $booking->bilti_number }}</td>
                                                <td style="padding: 4px 8px; border: 1px solid #dee2e6;">{{ $challanDetail->challan_number ?? '--' }}</td>
                                                <td style="padding: 4px 8px; border: 1px solid #dee2e6;">{{ $booking->consignorBranch->branch_name ?? '--' }}</td>
                                                <td style="padding: 4px 8px; border: 1px solid #dee2e6;">{{ $booking->consignor_name }}</td>
                                                <td style="padding: 4px 8px; border: 1px solid #dee2e6;">{{ $booking->consignee_name }}</td>
                                                <td style="padding: 4px 8px; border: 1px solid #dee2e6;">{{ $booking->consigneeBranch->branch_name ?? '--' }}</td>
                                                <td style="padding: 4px 8px; border: 1px solid #dee2e6; text-align: center;">{{ $booking->no_of_artical }}</td>
                                                <td style="padding: 4px 8px; border: 1px solid #dee2e6;">{{ $booking->cantain ?? '--' }}</td>
                                                <td style="padding: 4px 8px; border: 1px solid #dee2e6;">
                                                    <span style="background: #dc3545; color: white; padding: 4px 8px; border-radius: 4px; font-size: 0.875rem;">
                                                        {{$booking->booking_type_name ?? '--'}}
                                                    </span>
                                                </td>
                                                <td style="padding: 4px 8px; border: 1px solid #dee2e6;">{{ formatDate($booking->created_at) }}</td>
                                                <td style="padding: 4px 8px; border: 1px solid #dee2e6;">
                                                    @if(($challanDetail->user->branch_user_id === $branchId) && ($booking->is_revert_button_visible))
                                                    <a class="revertbooking" href="#" data-reverturl='{{ url("admin/challans/$challanDetail->id/revert-booking/$booking->id") }}'" style=" background: #dc3545; color: white; padding: 6px 12px; border-radius: 4px; text-decoration: none; font-size: 0.875rem; display: inline-flex; align-items: center; border: none; cursor: pointer;">
                                                        <i class="fas fa-undo mr-1"></i>{{ __('Revert') }}
                                                    </a>
                                                    @else
                                                    {{'--'}}
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr style="background: #f8f9fa; font-weight: 600;">
                                                <td style="padding: 8px; border: 1px solid #dee2e6; text-align: right;" colspan="8">{{ __('Total Quantity') }}:</td>
                                                <td style="padding: 8px; border: 1px solid #dee2e6; text-align: center; background: #e9ecef;">
                                                    {{ $bookings->sum('no_of_artical') }}
                                                </td>
                                                <td style="padding: 8px; border: 1px solid #dee2e6;" colspan="4"></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <div style="padding: 15px 20px; background: #f8f9fa; border-radius: 0 0 8px 8px; border-top: 1px solid #dee2e6;">
                                @if($challanDetail->is_received_button_visible)
                                <button type="button" id="receivedButton" style="background: #28a745; color: white; border: none; padding: 10px 20px; border-radius: 4px; font-weight: 600; cursor: pointer; float: right; display: flex; align-items: center;">
                                    <i class="fas fa-check-circle mr-1"></i>{{ __('Mark as Received') }}
                                </button>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('script')
@parent
<script>
    document.getElementById('receivedButton').addEventListener('click', function() {
        const checkboxes = document.querySelectorAll('input[name="selectedBookings[]"]:checked');
        if (checkboxes.length === 0) {
            alert('{{ __("Please select at least one booking.") }}');
        } else {
            document.getElementById('bookingForm').submit();
        }
    });

    // Select All functionality
    document.getElementById('selectAll').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('input[name="selectedBookings[]"]');
        checkboxes.forEach(checkbox => checkbox.checked = this.checked);
    });
</script>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script>
    $(document).ready(function(e) {
        // Handle select all checkbox
        $(document).on('click', '#selectAll', function(e) {
            if ($(this).prop('checked') == true) {
                // Select all checkboxes
                $('.form-check-input').prop('checked', true);
            } else {
                // Deselect all checkboxes
                $('.form-check-input').prop('checked', false);
            }
        });

        //revert the booking.
        $(document).on('click', '.revertbooking', function(e) {
            e.preventDefault();
            const url = $(this).data('reverturl');
            if (confirm('{{ __("Are you sure want to revert this booking?") }}')) {
                window.location.href = url;
            }
        });
    });
</script>
@endsection

@section('styles')
@parent
<style>
    @media (max-width: 768px) {
        .content-header h4 {
            font-size: 1.25rem !important;
        }

        .btn-group {
            flex-direction: column;
            gap: 10px;
        }

        table {
            font-size: 0.875rem;
        }

        table th,
        table td {
            padding: 8px 4px !important;
        }
    }
</style>
@endsection