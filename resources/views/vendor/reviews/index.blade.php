@extends('vendor.layouts.main')
@section('title', 'Reviews')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">@yield('title')</li>
@endsection

@section('content')

    <form action="{{ URL::current() }}" method="get" class="mb-4 d-flex justify-content-between">
        <select name="rating" class="form-control mx-2">
            <option value="">All</option>
            <option value="1" @selected(request('rating') == '1')>1 star</option>
            <option value="2" @selected(request('rating') == '2')>2 stars</option>
            <option value="3" @selected(request('rating') == '3')>3 stars</option>
            <option value="4" @selected(request('rating') == '4')>4 stars</option>
            <option value="5" @selected(request('rating') == '5')>5 stars</option>
        </select>
        <select name="status" class="form-control mx-2">
            <option value="">All</option>
            <option value="0" @selected(request('status') == '0')>disable</option>
            <option value="1" @selected(request('status') == '1')>enable</option>
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
                <th>Product Name</th>
                <th>Comment</th>
                <th>Rating</th>
                <th>Status</th>
                <th>Created at</th>
            </tr>
        </thead>
        <tbody>
            @php $i=0;  @endphp
            @forelse ($reviews as $review)
                <tr id="review-row-{{ $review->id }}">
                    @php $i++ @endphp
                    <td>{{ $i }}</td>
                    <td>{{ $review->user->name }}
                        <br>
                        <span class='text-gray'>{{ $review->user->email }}</span>
                    </td>
                    <td>{{ $review->product->name }} </td>
                    <td>{{ $review->comment }}</td>
                    <td class="stars-cell">
                        <span
                            class="label text-{{ $review->rating >= 4 ? 'success' : ($review->rating >= 3 ? 'warning' : 'danger') }} d-flex">
                            <span
                                class="text-{{ $review->rating >= 4 ? 'success' : ($review->rating >= 3 ? 'warning' : 'danger') }}"></span>{{ $review->rating }}
                        </span>
                    </td>
                    <td>
                        <div class="button-toggle {{ $review->status == 1 ? 'active' : '' }}"
                            id="toggle-button-{{ $review->id }}">
                            <div class="inner-circle"></div>
                        </div>
                    </td>
                    <td>{{ $review->created_at->longAbsoluteDiffForHumans() }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center" style="background-color:#007bff; color:white;">No reviews defined
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination Links -->
    {{ $reviews->withQueryString()->links() }}

@endsection

@push('scripts')
    <script>
        // document.querySelectorAll('.button-toggle').forEach(button => {
        //     button.addEventListener('click', function() {
        //         button.classList.toggle('active');
        //     });
        // });
    </script>
@endpush

@push('styles')
    <style>
        .button-toggle {
            background-color: #ccc;
            transform: translate(-4%, -50%);
            border-radius: 30px;
            transition: 0.3s;
            width: 44px;
            height: 24px;
            display: flex;
            margin: .9em 0 0 0;

        }

        .inner-circle {
            width: 20px;
            height: 20px;
            margin: 2px;
            background-color: #ddd;
            border-radius: 20px;
            transition: 0.3s;
        }

        .button-toggle.active {
            background-color: green;
        }

        .button-toggle.active>.inner-circle {
            margin-left: 22px;
        }
    </style>
@endpush
