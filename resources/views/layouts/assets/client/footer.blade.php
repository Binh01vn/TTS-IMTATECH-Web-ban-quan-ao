<footer>
    <section class="py-5 border-top bg-light">
        <div class="container">
            <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-4">
                <div class="col">
                    <div class="footer-section1">
                        <h5 class="mb-4 text-uppercase fw-bold">Thông tin liên hệ</h5>
                        <div class="address mb-3">
                            <h6 class="mb-0 text-uppercase fw-bold">Address</h6>
                            <p class="mb-0">123 Street Name, City, Australia</p>
                        </div>
                        <div class="phone mb-3">
                            <h6 class="mb-0 text-uppercase fw-bold">Phone</h6>
                            <p class="mb-0">Toll Free (123) 472-796</p>
                            <p class="mb-0">Mobile : +91-9910XXXX</p>
                        </div>
                        <div class="email mb-3">
                            <h6 class="mb-0 text-uppercase fw-bold">Email</h6>
                            <p class="mb-0">mail@example.com</p>
                        </div>
                        <div class="working-days mb-3">
                            <h6 class="mb-0 text-uppercase fw-bold">WORKING DAYS</h6>
                            <p class="mb-0">Mon - FRI / 9:30 AM - 6:30 PM</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="footer-section2">
                        <h5 class="mb-4 text-uppercase fw-bold">Danh mục</h5>
                        <ul class="list-unstyled">
                            <li class="mb-1"><a href="javascript:;"><i class='bx bx-chevron-right'></i>
                                    Jeans</a>
                            </li>
                            <li class="mb-1"><a href="javascript:;"><i class='bx bx-chevron-right'></i>
                                    T-Shirts</a>
                            </li>
                            <li class="mb-1"><a href="javascript:;"><i class='bx bx-chevron-right'></i>
                                    Sports</a>
                            </li>
                            <li class="mb-1"><a href="javascript:;"><i class='bx bx-chevron-right'></i>
                                    Shirts &
                                    Tops</a>
                            </li>
                            <li class="mb-1"><a href="javascript:;"><i class='bx bx-chevron-right'></i>
                                    Clogs &
                                    Mules</a>
                            </li>
                            <li class="mb-1"><a href="javascript:;"><i class='bx bx-chevron-right'></i>
                                    Sunglasses</a>
                            </li>
                            <li class="mb-1"><a href="javascript:;"><i class='bx bx-chevron-right'></i>
                                    Bags &
                                    Wallets</a>
                            </li>
                            <li class="mb-1"><a href="javascript:;"><i class='bx bx-chevron-right'></i>
                                    Sneakers
                                    & Athletic</a>
                            </li>
                            <li class="mb-1"><a href="javascript:;"><i class='bx bx-chevron-right'></i>
                                    Electronis</a>
                            </li>
                            <li class="mb-1"><a href="javascript:;"><i class='bx bx-chevron-right'></i>
                                    Furniture</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col">
                    <div class="footer-section3">
                        <h5 class="mb-4 text-uppercase fw-bold">Thẻ</h5>
                        <div class="tags-box d-flex flex-wrap gap-2">
                            @php
                                $tags = \App\Models\Tags::query()->get();
                            @endphp
                            @foreach ($tags as $item)
                                <a href="javascript:;" class="btn btn-ecomm btn-outline-dark">{{ $item->name }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="footer-section4">
                        <h5 class="mb-4 text-uppercase fw-bold">Theo dõi chúng tôi</h5>
                        <div class="subscribe">
                            <input type="text" class="form-control" placeholder="Nhập Email của bạn" />
                            <div class="mt-3 d-grid">
                                <a href="javascript:;" class="btn btn-dark btn-ecomm">Đăng ký</a>
                            </div>
                            <p class="mt-3 mb-0">Đăng ký nhận bản tin của chúng tôi để nhận được các ưu đãi giảm giá
                                sớm, thông tin cập nhật và thông tin về sản phẩm mới.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>
    </section>

    <section class="footer-strip text-center py-3 border-top positon-absolute bottom-0">
        <div class="container">
            <div class="d-flex flex-column flex-lg-row align-items-center gap-3 justify-content-between">
                <p class="mb-0">Copyright © 2022. All right reserved.</p>
            </div>
        </div>
    </section>
</footer>
