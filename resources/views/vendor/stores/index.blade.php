@extends('vendor.layouts.main')
@section('title', 'Stores')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">@yield('title')</li>
@endsection


@section('content')

    <div class="mb-5 ml-3">
        <a href="{{ route('dashboard.vendor.stores.create') }}" class="btn btn-sm btn-outline-primary mr-2">create</a>
    </div>

    <x-alert.alert type="success" />
    <x-alert.alert type="info" />


    <table class="table" id="datatable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>logo</th>
                <th>Description</th>
                <th>address</th>
                <th>city</th>
                <th>email</th>
                <th>phone</th>
                <th>industry</th>
                <th>process</th>
                <th>pdfs</th>

                {{-- <th>social_media_links</th> --}}


                <th colspan="4"></th>
            </tr>
        </thead>
        <tbody>
            @php $i=0; @endphp
            @forelse ($vendorStores as $store)
                <tr>
                    @php $i++ @endphp
                    <td>{{ $i }}</td>
                    <td>{{ $store->name }}</td>
                    @if ($store->hasMedia('images'))
                        <td><img src="{{ asset('storage/' . $store->getFirstMedia('images')->id . '/' . $store->getFirstMedia('images')->file_name) }}"
                                width="50px" height="50px"></td>
                    @else
                        <td>No image available</td>
                    @endif

                    <td>{{ $store->description }} </td>
                    <td>{{ $store->address }}</td>
                    <td>{{ $store->city }}</td>
                    <td>{{ $store->email }}</td>
                    <td>{{ $store->phone }}</td>
                    <td>{{ $store->industry }}</td>
                    {{-- <td>{{ $store->social_media_links }}</td> --}}

                    <td>
                        <a href="{{ route('dashboard.vendor.stores.edit', $store->id) }}"
                            class="btn btn-sm btn-outline-success"> <i class="fas fa-edit"></i></a>

                    </td>
                    <td>
                        <form action="{{ route('dashboard.vendor.stores.destroy', $store->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-outline-danger btn-sm"> <i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                    <td>
                        <a href="{{ route('dashboard.download.file', $store->getFirstMedia('pdf1')->id) }}"
                            class="btn btn-primary btn-sm mx-1"><i class="fas fa-download"></i> return policy</a>
                    </td>
                    <td>
                        <a href="{{ route('dashboard.download.file', $store->getFirstMedia('pdf2')->id) }}"
                            class="btn btn-secondary btn-sm mx-1"><i class="fas fa-download"></i> shipping policy</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="12" style="background-color:#007bff; color:white" class="text-center">No stores Difined
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>



@endsection
