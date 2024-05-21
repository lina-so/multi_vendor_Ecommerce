@extends('vendor.layouts.main')
@section('title', 'Offers')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">@yield('title')</li>
@endsection


@section('content')

    <div class="mb-5 ml-3">
        <a href="{{ route('dashboard.vendor.offers.create') }}" class="btn btn-sm btn-outline-primary mr-2">create</a>
    </div>

    <x-alert.alert type="success" />
    <x-alert.alert type="info" />

    <table class="table" id="datatable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>discount</th>
                <th>period</th>
                <th>expired_at</th>

                <th colspan="2"></th>
            </tr>
        </thead>
        <tbody>
            @php $i=0; @endphp
            @forelse ($offers as $offer)
                <tr>
                    @php $i++ @endphp
                    <td>{{ $i }}</td>
                    <td>{{ $offer->offerable->name }}</td>
                    <td>{{ $offer->compare_price }} </td>
                    <td>{{ $offer->period }} </td>

                    <td class = "{{ ($offer->expired_at < now() ) ? 'text-danger' : 'text-black' }}">{{ $offer->expired_at }} </td>



                    <td class="d-flex justify-between  ">
                        <a data-toggle="modal" data-target="#deleteModal{{ $offer->id }}"
                            class="btn btn-sm btn-outline-success mr-2">
                            <i class="fas fa-edit"></i>
                        </a>

                        <form action="{{ route('dashboard.vendor.offers.destroy', $offer->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-outline-danger btn-sm"> <i
                                    class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>

                </tr>
                <!-- Edit Modal -->

                <div class="modal fade" id="deleteModal{{ $offer->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Edit compare price
                                <form action="{{ route('dashboard.vendor.offers.update', $offer->id) }}" method="post">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group">
                                        {{-- <label for="compare_price">Compare Price</label> --}}
                                        <input type="number" name="compare_price" id="compare_price" class="form-control"
                                            value="{{ $offer->compare_price }}" placeholder="Compare Price">

                                        <label for="">period</label>
                                        <select name="period" class="form-control form-select">
                                            <option value="" class="checked">choose</option>
                                            <option value="week" class="">week</option>
                                            <option value="month" class="">month
                                            </option>


                                        </select>

                                        <input type="hidden" name="id" id="" value="{{ $offer->id }}">
                                    </div>
                            </div>


                            <!-- Submit button -->
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>


                            </form>
                        </div>
                    </div>
                </div>


            @empty
                <tr>
                    <td colspan="12" style="background-color:#007bff; color:white" class="text-center">No offers Difined
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>


@endsection
