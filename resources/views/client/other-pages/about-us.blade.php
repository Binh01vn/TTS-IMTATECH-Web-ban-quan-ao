@extends('layouts.client')
@section('title')
    Giới thiệu
@endsection
@section('contents')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--start breadcrumb-->
            <section class="py-3 border-bottom border-top d-none d-md-flex bg-light">
                <div class="container">
                    <div class="page-breadcrumb d-flex align-items-center">
                        <h3 class="breadcrumb-title pe-3">Về chúng tôi</h3>
                        <div class="ms-auto">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0 p-0">
                                    <li class="breadcrumb-item"><a href="/"><i class="bx bx-home-alt"></i>
                                            Trang chủ</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="javascript:;">Trang</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Giới thiệu</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </section>
            <!--end breadcrumb-->
            <!--start page content-->
            <section class="py-0 py-lg-4">
                <div class="container">
                    <h4>Câu chuyện của chúng tôi</h4>
                    <p>Lorem Ipsum chỉ đơn giản là văn bản giả của ngành công nghiệp in ấn và sắp chữ. Lorem Ipsum đã trở
                        thành văn bản giả tiêu chuẩn của ngành công nghiệp kể từ những năm 1500, khi một nhà in vô danh lấy
                        một phòng trưng bày loại và xáo trộn nó để tạo ra một cuốn sách mẫu vật. Nó đã tồn tại không chỉ năm
                        thế kỷ, mà còn là bước nhảy vọt vào sắp chữ điện tử, về cơ bản vẫn không thay đổi.</p>
                    <p>Trái ngược với niềm tin phổ biến, Lorem Ipsum không chỉ đơn giản là văn bản ngẫu nhiên. Nó có nguồn
                        gốc từ một tác phẩm văn học Latin cổ điển từ năm 45 trước Công nguyên, khiến nó hơn 2000 năm tuổi.
                        Richard McClintock, một giáo sư tiếng Latinh tại Đại học Hampden-Sydney ở Virginia, đã tìm kiếm một
                        trong những từ tiếng Latinh khó hiểu hơn, consectetur, từ một đoạn văn của Lorem Ipsum, và xem qua
                        các trích dẫn của từ này trong văn học cổ điển, đã phát hiện ra nguồn gốc không thể nghi ngờ.</p>
                    <p>Trái ngược với niềm tin phổ biến, Lorem Ipsum không chỉ đơn giản là văn bản ngẫu nhiên. Nó có nguồn
                        gốc từ một tác phẩm văn học Latin cổ điển từ năm 45 trước Công nguyên, khiến nó hơn 2000 năm tuổi.
                        Richard McClintock, một giáo sư tiếng Latinh tại Đại học Hampden-Sydney ở Virginia, đã tìm kiếm một
                        trong những từ tiếng Latinh khó hiểu hơn, consectetur, từ một đoạn văn của Lorem Ipsum, và xem qua
                        các trích dẫn của từ này trong văn học cổ điển, đã phát hiện ra nguồn gốc không thể nghi ngờ.</p>
                </div>
            </section>
            <section class="py-4">
                <div class="container">
                    <h4>Tại sao chọn chúng tôi</h4>
                    <hr>
                    <div class="row row-cols-1 row-cols-lg-3">
                        <div class="col d-flex">
                            <div class="card rounded-0 shadow-none w-100">
                                <div class="card-body">
                                    <img src="{{ asset('theme/client/images/icons/delivery.png') }}" width="60"
                                        alt="">
                                    <h5 class="my-3">MIỄN PHÍ VẬN CHUYỂN</h5>
                                    <p class="mb-0">Lorem Ipsum chỉ đơn giản là văn bản giả của ngành công nghiệp in ấn và
                                        sắp chữ. Lorem Ipsum đã là người công nghiệp dưới một hình thức nào đó.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col d-flex">
                            <div class="card rounded-0 shadow-none w-100">
                                <div class="card-body">
                                    <img src="{{ asset('theme/client/images/icons/money-bag.png') }}" width="60"
                                        alt="">
                                    <h5 class="my-3">ĐẢM BẢO HOÀN TIỀN 100%</h5>
                                    <p class="mb-0">Lorem Ipsum chỉ đơn giản là văn bản giả của ngành công nghiệp in ấn và
                                        sắp chữ. Lorem Ipsum đã là người công nghiệp dưới một hình thức nào đó.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col d-flex">
                            <div class="card rounded-0 shadow-none w-100">
                                <div class="card-body">
                                    <img src="{{ asset('theme/client/images/icons/support.png') }}" width="60"
                                        alt="">
                                    <h5 class="my-3">HỖ TRỢ TRỰC TUYẾN 24/7</h5>
                                    <p class="mb-0">Lorem Ipsum chỉ đơn giản là văn bản giả của ngành công nghiệp in ấn và
                                        sắp chữ. Lorem Ipsum đã là người công nghiệp dưới một hình thức nào đó.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end row-->
                </div>
            </section>
            <!--end start page content-->
        </div>
    </div>
    <!--end page wrapper -->
@endsection
