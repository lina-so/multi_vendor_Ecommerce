@extends('vendor.layouts.main')
@section('title', 'Orders')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">@yield('title')</li>
@endsection


@section('content')

    <form action="{{ URL::current() }}" method="get" class="mb-4 d-flex justify-content-between">
        <x-form.input name="code" placeholder="Order's Code" class="mx-2" :value="request('code')" />
        <select name="status" class="form-control mx-2" id="status">
            <option value="" disabled>Status</option>
            <option value="pending" @selected(request('status') == 'pending')>Pending</option>
            <option value="processing" @selected(request('status') == 'processing')>Processing</option>
            <option value="delivering" @selected(request('status') == 'delivering')>Delivering</option>
            <option value="completed" @selected(request('status') == 'completed')>Completed</option>
            <option value="cancelled" @selected(request('status') == 'cancelled')>Cancelled</option>
            <option value="refunded" @selected(request('status') == 'refunded')>Refunded</option>
        </select>
        <select name="store_id" class="form-control mx-2">
            <option value="" disabled>store</option>
            @foreach ($vendorStores as $store)
                <option value="{{ $store->id }}" @selected(request('store_id') == '{{ $store->id }}')>{{ $store->name }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-dark btn-sm mx-2">Find</button>
    </form>

    <x-alert.alert type="success" />
    <x-alert.alert type="info" />


    <table class="table" id="datatable">
        <thead>
            <tr>
                <th>ID</th>
                <th>User Name</th>
                <th>Store</th>
                <th>Code</th>
                <th>payment_method</th>
                <th>status</th>
                <th>tracking number</th>
                <th>total</th>
                <th>Created at</th>
                <th>Process</th>
                <th colspan="11"></th>
            </tr>
        </thead>
        <tbody>
            @php $i=0;  @endphp
            @forelse ($vendorOrders as $userOrders)
                @foreach ($userOrders as $order)
                    <tr id="order-row-{{ $order->id }}">
                        @php $i++ @endphp
                        <td>{{ $i }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>{{ $order->store->name }} </td>
                        <td>{{ $order->code }}</td>
                        <td>{{ $order->payment_method }}</td>
                        <td class="status-cell">
                            @if ($order->status == 'pending')
                                <span class="label color1 d-flex">
                                    <span class="dot bg-color1"></span>{{ $order->status }}
                                </span>
                            @elseif($order->status == 'processing')
                                <span class="label color2 d-flex">
                                    <span class="dot bg-color2"></span>{{ $order->status }}
                                </span>
                            @elseif($order->status == 'cancelled')
                                <span class="label color3 d-flex">
                                    <span class="dot bg-color3"></span>{{ $order->status }}
                                </span>
                            @elseif($order->status == 'completed')
                                <span class="label color4 d-flex">
                                    <span class="dot bg-color4"></span>{{ $order->status }}
                                </span>
                            @elseif($order->status == 'delivering')
                                <span class="label color4 d-flex">
                                    <span class="dot bg-color4"></span>{{ $order->status }}
                                </span>
                            @elseif($order->status == 'refunded')
                                <span class="label color3 d-flex">
                                    <span class="dot bg-color3"></span>{{ $order->status }}
                                </span>
                            @endif

                        </td>
                        <td class="number_cell">
                            @if ($order->tracking_number)
                                +{{ $order->tracking_number }}
                            @endif
                        </td>
                        <td>{{ $order->tax + $order->total }}</td>
                        <td>{{ $order->created_at->longAbsoluteDiffForHumans() }}</td>
                        <td class='d-flex justify-content-between'>
                            {{-- show orderItems --}}
                            <a href="{{ route('dashboard.vendor.orders.show', $order->id) }}">
                                <button class="btn btn-outline-warning btn-sm"> <i class="fas fa-eye"></i></button></a>
                            {{-- choose the order's status --}}

                            <form action="{{ route('dashboard.vendor.orders.update', $order->id) }}" method="post"
                                id="order-form-{{ $order->id }}">
                                @csrf
                                <div class="form-group sm mx-0">
                                    <select name="status" class="form-control status-select"
                                        data-order-id="{{ $order->id }}">
                                        <option value="">Select Status</option>
                                        <option value="pending">pending</option>
                                        <option value="processing">processing</option>
                                        <option value="delivering" id="delivering" data-id="delivering">delivering</option>
                                        <option value="cancelled">cancelled</option>
                                        <option value="refunded">refunded</option>
                                        <option value="completed">completed</option>
                                    </select>
                                </div>
                            </form>

                        </td>
                        <td>

                        </td>
                        {{-- Other table cells --}}


                        <!-- Modal status delivering-->
                        <div class="modal fade" id="deliveringModal" tabindex="-1" role="dialog"
                            aria-labelledby="deleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel">Confirm delivering</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action ="{{ route('dashboard.updateStatus', $order->id) }}" method="post"
                                        id="delivering-form">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <p id="delev-span"></p>
                                            please,Enter the tracking number ..
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>

                                            <input type="hidden" name="status_delivering" id="status_delivering"
                                                value='delivering'>
                                            <input type="text" name="tracking_number" id="tracking_number"
                                                placeholder="ex: 963 0957758075">

                                            <button type="submit" class="btn btn-danger">save</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </tr>
                @endforeach
            @empty
                <tr>
                    <td colspan="8" style="background-color:#007bff; color:white" class="text-center">No orders
                        defined
                    </td>
                </tr>
            @endforelse


        </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete all selected orders?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <form action="{{ route('dashboard.orders.vendor.deleteAll') }}" method="post">
                    @csrf
                    @method('delete')
                    <input type="hidden" name="delete_all_id" id="delete_all_id" value=''>

                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
                </div>
            </div>
        </div>
    </div>




    </div>


    {{-- {{ $vendorOrders->withQueryString()->links()}} --}}
@endsection


@push('scripts')
    <script>
        $(document).ready(function() {
            $('.status-select').on('change', function() {
                var selectedOption = $(this).val();
                var orderId = $(this).data('order-id');
                var formData = $('#delivering-form').serialize(); // Serialize form data
                var tracking_number;
                if (selectedOption === 'delivering') {
                    // Show your modal here
                    $('#deliveringModal .modal-body #delev-span').html(selectedOption);

                    $('#deliveringModal').modal('show');

                } else {

                    var formData = {
                        _token: '{{ csrf_token() }}',
                        _method: 'POST',
                        status: selectedOption
                    };
                    $.ajax({
                        url: "{{ route('dashboard.updateStatus', ['id' => ':id']) }}".replace(
                            ':id', orderId),

                        type: 'POST',
                        data: formData,
                        success: function(response) {
                            $('#order-row-' + orderId + ' .status-cell').text(selectedOption);
                            $('#order-row-' + orderId + ' .number_cell').text('');
                            // console.log(typeof(selectedOption));

                        },
                        error: function(error) {
                            console.error('Error:', error);
                        }
                    });
                }
            });
        });
    </script>
@endpush

@push('styles')
    <style>
        span.bg-color1 {
            background: #f0f013 !important;
        }

        span.bg-color2 {
            background: #e45737 !important;
        }

        span.bg-color3 {
            background: #fc053f !important;
        }

        span.bg-color4 {
            background: #28a745 !important;
        }

        span.color1 {
            color: #f0f013 !important;
        }

        span.color2 {
            color: #e45737 !important;
        }

        span.color3 {
            color: #fc053f !important;
        }

        span.color4 {
            color: #28a745 !important;
        }

        .dot {
            width: 0.6em;
            height: 0.6em;
            border-radius: 50%;
            margin-top: 0.6em;
            margin-right: .4em;

            animation: blink 1s infinite alternate;
        }

        @keyframes blink {
            0% {
                opacity: 1;
            }

            100% {
                opacity: 0;
            }
        }
    </style>
@endpush
