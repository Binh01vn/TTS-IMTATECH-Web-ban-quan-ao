<div class="row g-0">
    <div class="col-md-6 col-xxl-3 pe-md-2 mb-3 mb-xxl-0">
        <div class="card">
            <div class="card-header d-flex flex-between-center bg-body-tertiary py-2">
                <h6 class="mb-0">Active Users</h6>
                <div class="dropdown font-sans-serif btn-reveal-trigger"><button
                        class="btn btn-link text-600 btn-sm dropdown-toggle dropdown-caret-none btn-reveal" type="button"
                        id="dropdown-active-user" data-bs-toggle="dropdown" data-boundary="viewport" aria-haspopup="true"
                        aria-expanded="false"><span class="fas fa-ellipsis-h fs-11"></span></button>
                    <div class="dropdown-menu dropdown-menu-end border py-2" aria-labelledby="dropdown-active-user"><a
                            class="dropdown-item" href="#!">View</a><a class="dropdown-item"
                            href="#!">Export</a>
                        <div class="dropdown-divider"></div><a class="dropdown-item text-danger"
                            href="#!">Remove</a>
                    </div>
                </div>
            </div>
            <div class="card-body py-2">
                <div class="d-flex align-items-center position-relative mb-3">
                    <div class="avatar avatar-2xl status-online">
                        <img class="rounded-circle" src="{{ asset('theme/admin/assets/img/team/1.jpg') }}"
                            alt="" />
                    </div>
                    <div class="flex-1 ms-3">
                        <h6 class="mb-0 fw-semi-bold"><a class="stretched-link text-900"
                                href="pages/user/profile.html">Emma Watson</a></h6>
                        <p class="text-500 fs-11 mb-0">Admin</p>
                    </div>
                </div>
                <div class="d-flex align-items-center position-relative mb-3">
                    <div class="avatar avatar-2xl status-online">
                        <img class="rounded-circle" src="{{ asset('theme/admin/assets/img/team/2.jpg') }}"
                            alt="" />
                    </div>
                    <div class="flex-1 ms-3">
                        <h6 class="mb-0 fw-semi-bold"><a class="stretched-link text-900"
                                href="pages/user/profile.html">Antony Hopkins</a></h6>
                        <p class="text-500 fs-11 mb-0">Moderator</p>
                    </div>
                </div>
                <div class="d-flex align-items-center position-relative mb-3">
                    <div class="avatar avatar-2xl status-away">
                        <img class="rounded-circle" src="{{ asset('theme/admin/assets/img/team/3.jpg') }}"
                            alt="" />
                    </div>
                    <div class="flex-1 ms-3">
                        <h6 class="mb-0 fw-semi-bold"><a class="stretched-link text-900"
                                href="pages/user/profile.html">Anna Karinina</a></h6>
                        <p class="text-500 fs-11 mb-0">Editor</p>
                    </div>
                </div>
                <div class="d-flex align-items-center position-relative mb-3">
                    <div class="avatar avatar-2xl status-offline">
                        <img class="rounded-circle" src="{{ asset('theme/admin/assets/img/team/4.jpg') }}"
                            alt="" />
                    </div>
                    <div class="flex-1 ms-3">
                        <h6 class="mb-0 fw-semi-bold"><a class="stretched-link text-900"
                                href="pages/user/profile.html">John Lee</a></h6>
                        <p class="text-500 fs-11 mb-0">Admin</p>
                    </div>
                </div>
                <div class="d-flex align-items-center position-relative false">
                    <div class="avatar avatar-2xl status-offline">
                        <img class="rounded-circle" src="{{ asset('theme/admin/assets/img/team/5.jpg') }}"
                            alt="" />
                    </div>
                    <div class="flex-1 ms-3">
                        <h6 class="mb-0 fw-semi-bold"><a class="stretched-link text-900"
                                href="pages/user/profile.html">Rowen Atkinson</a></h6>
                        <p class="text-500 fs-11 mb-0">Editor</p>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-body-tertiary p-0"><a class="btn btn-sm btn-link d-block w-100 py-2"
                    href="app/social/followers.html">All active users<span
                        class="fas fa-chevron-right ms-1 fs-11"></span></a></div>
        </div>
    </div>
    <div class="col-md-6 col-xxl-3 ps-md-2 order-xxl-1 mb-3 mb-xxl-0">
        <div class="card h-100">
            <div class="card-header bg-body-tertiary d-flex flex-between-center py-2">
                <h6 class="mb-0">Bandwidth Saved</h6>
                <div class="dropdown font-sans-serif btn-reveal-trigger"><button
                        class="btn btn-link text-600 btn-sm dropdown-toggle dropdown-caret-none btn-reveal"
                        type="button" id="dropdown-bandwidth-saved" data-bs-toggle="dropdown" data-boundary="viewport"
                        aria-haspopup="true" aria-expanded="false"><span
                            class="fas fa-ellipsis-h fs-11"></span></button>
                    <div class="dropdown-menu dropdown-menu-end border py-2" aria-labelledby="dropdown-bandwidth-saved">
                        <a class="dropdown-item" href="#!">View</a><a class="dropdown-item"
                            href="#!">Export</a>
                        <div class="dropdown-divider"></div><a class="dropdown-item text-danger"
                            href="#!">Remove</a>
                    </div>
                </div>
            </div>
            <div class="card-body d-flex flex-center flex-column">
                <!-- Find the JS file for the following chart at: src/js/charts/echarts/bandwidth-saved.js--><!-- If you are not using gulp based workflow, you can find the transpiled code at: public/assets/js/theme.js-->
                <div class="echart-bandwidth-saved" data-echart-responsive="true"></div>
                <div class="text-center mt-3">
                    <h6 class="fs-9 mb-1"><span class="fas fa-check text-success me-1"
                            data-fa-transform="shrink-2"></span>35.75 GB saved</h6>
                    <p class="fs-10 mb-0">38.44 GB total bandwidth</p>
                </div>
            </div>
            <div class="card-footer bg-body-tertiary py-2">
                <div class="row flex-between-center">
                    <div class="col-auto"><select class="form-select form-select-sm">
                            <option>Last 6 Months</option>
                            <option>Last Year</option>
                            <option>Last 2 Year</option>
                        </select></div>
                    <div class="col-auto"><a class="fs-10 font-sans-serif" href="#!">Help</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-6 px-xxl-2">
        <div class="card h-100">
            <div class="card-header bg-body-tertiary py-2">
                <div class="row flex-between-center">
                    <div class="col-auto">
                        <h6 class="mb-0">Top Products</h6>
                    </div>
                    <div class="col-auto d-flex"><a class="btn btn-link btn-sm me-2" href="#!">View Details</a>
                        <div class="dropdown font-sans-serif btn-reveal-trigger"><button
                                class="btn btn-link text-600 btn-sm dropdown-toggle dropdown-caret-none btn-reveal"
                                type="button" id="dropdown-top-products" data-bs-toggle="dropdown"
                                data-boundary="viewport" aria-haspopup="true" aria-expanded="false"><span
                                    class="fas fa-ellipsis-h fs-11"></span></button>
                            <div class="dropdown-menu dropdown-menu-end border py-2"
                                aria-labelledby="dropdown-top-products"><a class="dropdown-item"
                                    href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                                <div class="dropdown-divider"></div><a class="dropdown-item text-danger"
                                    href="#!">Remove</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body h-100">
                <!-- Find the JS file for the following chart at: src/js/charts/echarts/top-products.js--><!-- If you are not using gulp based workflow, you can find the transpiled code at: public/assets/js/theme.js-->
                <div class="echart-bar-top-products h-100" data-echart-responsive="true"></div>
            </div>
        </div>
    </div>
</div>
