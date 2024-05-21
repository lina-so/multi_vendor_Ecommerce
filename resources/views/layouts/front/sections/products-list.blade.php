  <!-- product_list start-->
  <section class="product_list section_padding">
      <div class="container">
          <div class="row justify-content-center">
              <div class="col-lg-12">
                  <div class="section_tittle text-center">
                      <h3>{{ $title }} <span>shop</span></h3>
                  </div>
              </div>
          </div>
          <div class="row">
              <div class="col-lg-12">
                  <div class="product_list_slider d-flex justify-content-between">
                      <div class="single_product_list_slider">
                          <div class="row align-items-center justify-content-between">

                              @foreach ($products as $product)
                                  @if ($product && $product->count() > 0)
                                      <div class="col-lg-4 col-sm-6">
                                          <div class="single_product_item">
                                              <img src="{{ asset('storage/' . $product->images->first()->path) }}"
                                                  alt="{{ $product->name }}" width="100%" height="200px">

                                              <div class="single_product_text">
                                                  <h4>{{ $product->name }}</h4>
                                                  @if (isset($product->offer) && $product->compare_price !== 0.0)
                                                      <span class="text-danger"
                                                          style="text-decoration: line-through;">${{ $product->price }}</span>
                                                      @php
                                                          $discountedPrice =
                                                              $product->price -
                                                              ($product->price * $product->compare_price) / 100;
                                                      @endphp
                                                      <span>${{ $discountedPrice }}</span>
                                                  @else
                                                      <span>${{ $product->price }}</span>
                                                  @endif
                                                  </span>

                                                  <span><a href="{{ route('product-details', $product->id) }}"
                                                          class="add_cart">+ add to cart</a></span>

                                              </div>
                                          </div>
                                      </div>
                                  @endif
                              @endforeach

                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>


  <!-- product_list part start-->
