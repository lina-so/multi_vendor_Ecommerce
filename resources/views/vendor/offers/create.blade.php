@extends('vendor.layouts.main')
@section('title', 'Create Offer')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">@yield('title')</li>
@endsection

@section('content')

    <div class="p-3">
        <!-- row -->
        <div class="row">

            <div class="col-xl-12">
                <div class="card mg-b-20">
                    <div class="card-header pb-5 pt-5">
                        <form action="{{ route('dashboard.vendor.offers.store') }}" method="POST" autocomplete="off">
                            {{ csrf_field() }}
                            <h5>Add offer to</h5>
                            <div class="col-lg-3 d-flex justify-content-between">
                                <label class="rdiobox">
                                    <input checked name="radio" type="radio" value="1" id="brand_div">
                                    <span>Brand</span></label>
                                <label class="rdiobox">
                                    <input name="radio" value="2" id="category_div" type="radio"><span> Category
                                    </span></label>
                                <label class="rdiobox">
                                    <input name="radio" value="3" type="radio"><span>Product
                                    </span></label>
                                <br><br>
                            </div>
                            {{-- period --}}
                            <div class="form-group">
                                <label for="">period</label>
                                <select name="period" class="form-control form-select">
                                    <option value="" class="checked">choose</option>
                                    <option value="week" class="">week</option>
                                    <option value="month" class="">month</option>


                                </select>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 mg-t-20 mg-lg-t-0 " id="brand">

                                    {{-- brand --}}
                                    <div class="form-group">
                                        <label for="">select brand</label>
                                        <select name="brand_id" class="form-control form-select">
                                            <option value="" class="checked">choose</option>
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand->id }}">
                                                    {{ $brand->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- compare_price --}}

                                    <x-form.input name="brand_compare_price" type="number" label="compare_price" />
                                </div>

                            </div><!-- col-4 -->
                            <div class="col-lg-3 mg-t-20 mg-lg-t-0 " id="category">
                                {{-- categorie --}}
                                <div class="form-group">
                                    <label for="">select category</label>
                                    <select name="category_id" id="category_id"class="form-control form-select">
                                        <option value="" class="checked">choose</option>
                                        @foreach ($categories as $categorie)
                                            <option value="{{ $categorie->id }}">
                                                {{ $categorie->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- compare_price --}}
                                <div class="form-group">
                                    <x-form.input name="category_compare_price" type="number" label="compare_price" />
                                </div>


                            </div><!-- col-4 -->
                            <div class="col-lg-3 mg-t-20 mg-lg-t-0 " id="product">
                                {{-- brand --}}
                                <div class="form-group">
                                    <label for="">select Brand</label>
                                    <select name="product_brand_id" id="brand_id_select"class="form-control form-select">
                                        <option value="" class="checked">choose</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}">
                                                {{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- categorie --}}
                                <div class="form-group">
                                    <label for="">select Product</label>
                                    <select name="product_id" id="product_id_select"class="form-control form-select">

                                        <!-- category will be dynamically populated using JavaScript -->
                                    </select>
                                </div>
                                {{-- compare_price --}}
                                <div class="form-group">
                                    <x-form.input name="product_compare_price" type="number" label="compare_price" />
                                </div>

                            </div><!-- col-4 -->
                    </div><br>
                    <div class="row">
                        <div class="col-sm-2 col-md-2">
                            <button class="btn btn-primary btn-block">Add Offer</button>
                        </div>
                    </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    </div>
    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#category').hide();
                $('#product').hide();

                $('input[type="radio"]').click(function() {
                    if ($(this).attr('id') == 'brand_div') {
                        $('#category').hide();
                        $('#product').hide();
                        $('#brand').show();

                    } else if ($(this).attr('id') == 'category_div') {
                        $('#category').show();
                        $('#brand').hide();
                        $('#product').hide();

                    } else {
                        $('#category').hide();
                        $('#brand').hide();
                        $('#product').show();

                    }
                });
            });
        </script>

        <!-- get Brand's category -->
    <script>
        $(document).ready(function() {
            // When the main category dropdown changes
            $('#brand_id_select').on('change', function() {
                var brandId = $(this).val();
                if (brandId) {
                    // Fetch subcategories based on the selected main category
                    $.ajax({
                        url: '/vendor/dashboard/get_brand_categories/' + brandId,
                        type: 'GET',
                        success: function(data) {
                            // Clear existing options
                            $('#product_id_select').empty();
                            // Add new options based on the response
                            $.each(data, function(id, name) {
                                $('#product_id_select').append($('<option>', {
                                    value: id,
                                    text: name
                                }));
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                } else {
                    // If no main category selected, clear subcategory options
                    $('#product_id_select').empty();
                }
            });
        });
    </script>
    @endpush
@endsection
