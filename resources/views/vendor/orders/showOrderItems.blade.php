@extends('vendor.layouts.main')
@section('title', 'Order Items')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">@yield('title')</li>
@endsection


@section('content')

    <div class="mb-5 ml-3">
        <a href="{{ route('dashboard.vendor.orders.index') }}" class="btn btn-sm btn-outline-dark mr-2">back</a>
    </div>

    <table class="table" id="datatable">
        <thead>
            <tr>
                <th>ID</th>
                <th>order code</th>
                <th>product name</th>
                <th>price</th>
                <th>quantity</th>
                <th>options</th>
                <th>Created at</th>
                <th colspan="7"></th>
            </tr>
        </thead>
        <tbody>
            @php $i=0;  @endphp
            @forelse ($orderItems as $item)
                <tr>
                    @php $i++ @endphp
                    <td>{{ $i }}</td>
                    <td>{{ $item->order->code }}</td>
                    <td>{{ $item->product_name }} </td>
                    <td>{{ $item->price }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>
                        @php
                            $options = json_decode($item->options, true);
                            // dd($options);
                        @endphp

                        @foreach ($options as $optionId => $valueId)
                        @php
                        $optionName = isset($optionNames[$optionId]) ? $optionNames[$optionId] : "Unknown Option";
                        $valueName = isset($optionValues[$valueId]) ? $optionValues[$valueId] : "Unknown Value";
                    @endphp
                    <h6>
                        {{ $optionName }}: {{ $valueName }}
                    </h6>
                        @endforeach
                    </td>
                    <td>{{ $item->created_at->longAbsoluteDiffForHumans() }}</td>

                </tr>
            @empty
                <tr>
                    <td colspan="8" style="background-color:#007bff; color:white" class="text-center">No orders defined
                    </td>
                </tr>
            @endforelse


        </tbody>
    </table>


    {{-- {{ $vendorOrders->links()}} --}}
@endsection
