@extends('vendor.layouts.main')
@section('title', 'Coupon')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">@yield('title')</li>
@endsection


@section('content')

    <div class="mb-5 ml-3">
            <a href="{{ route('dashboard.vendor.coupon.create') }}" class="btn btn-sm btn-outline-primary mr-2">create</a>
    </div>

    <x-alert.alert type="success" />
    <x-alert.alert type="info" />


    <table class="table" id="datatable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>code</th>
                <th>max_uses</th>
                <th>max_uses_user</th>
                <th>type</th>
                <th>discount_amount</th>
                <th>min_amount</th>
                <th>status</th>
                <th>starts_at</th>
                <th>expires_at</th>

                {{-- <th>social_media_links</th> --}}


                <th colspan="4"></th>
            </tr>
        </thead>
        <tbody>
            @php $i=0; @endphp
            @forelse ($coupons as $coupon)
                <tr>
                    @php $i++ @endphp
                    <td>{{ $i }}</td>
                    <td>{{ $coupon->name }}</td>
                    <td>{{ $coupon->code }} </td>
                    <td>{{ $coupon->max_uses }}</td>
                    <td>{{ $coupon->max_uses_user }}</td>
                    <td>{{ $coupon->type }}</td>
                    <td>{{ $coupon->discount_amount }}</td>
                    <td>{{ $coupon->min_amount }}</td>
                    <td>{{ $coupon->status }}</td>
                    <td>{{ $coupon->starts_at }}</td>
                    <td>{{ $coupon->expires_at }}</td>


                        <td>
                            <a href="{{ route('dashboard.vendor.coupon.edit', $coupon->id) }}"
                                class="btn btn-sm btn-outline-success"> <i class="fas fa-edit"></i></a>

                        </td>
                        <td>
                            <form action="{{ route('dashboard.vendor.coupon.destroy', $coupon->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-outline-danger btn-sm"> <i
                                        class="fas fa-trash-alt"></i></button>
                            </form>
                        </td>
                </tr>
            @empty
                <tr>
                    <td colspan="12" style="background-color:#007bff; color:white" class="text-center">No coupons Difined
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>



@endsection
