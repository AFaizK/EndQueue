@extends('layouts/master-login')

@section('title', 'Login')

@section('content')
    <!-- Content -->
    <div class="browse-job login-style3">
        <!-- Coming Soon -->
        <div class="bg-img-fix overflow-hidden"
            style="background:#fff url({{ asset('assets') }}/images/background/bg6.jpg); height: 100vh;">
            <div class="row gx-0">
                <div class="col-xl-4 col-lg-5 col-md-6 col-sm-12 vh-100 bg-white ">
                    <div id="mCSB_1" class="mCustomScrollBox mCS-light mCSB_vertical mCSB_inside" style="max-height: 653px;"
                        tabindex="0">
                        <div id="mCSB_1_container" class="mCSB_container" style="position:relative; top:0; left:0;"
                            dir="ltr">
                            <div class="login-form style-2">




                                <div class="card-body">
                                    <div class="logo-header row g-2 align-items-center">
                                        <img src="../assets/images/endqueue.png" class="col-sm-6"
                                            style="height: 70px; width: 80px" alt="Logo">
                                        <div class="brand-title col-sm-6" style="font-size: 24px;">
                                            <span style="color: #13BBED">END</span><span style="color: #035989">QUEUE</span>
                                        </div>
                                    </div>

                                    <nav>
                                        <div class="nav nav-tabs border-bottom-0" id="nav-tab" role="tablist">

                                            <div class="tab-content w-100" id="nav-tabContent">
                                                <div class="tab-pane fade show active" id="nav-personal" role="tabpanel"
                                                    aria-labelledby="nav-personal-tab">
                                                    {{-- <form class="dz-form pb-3 login-admin">
                                                        <h3 class="form-title m-t0">Personal Information</h3>
                                                        <div class="dz-separator-outer m-b5">
                                                            <div class="dz-separator bg-primary style-liner"></div>
                                                        </div>
                                                        <p>Enter your e-mail address and your password. </p>
                                                        <div class="form-group mb-3" id="email">
                                                            <input type="email" class="form-control">
                                                        </div>
                                                        <div class="form-group mb-3" id="password">
                                                            <input type="password" class="form-control">
                                                        </div>
                                                        <div class="form-group text-left mb-5 forget-main">
                                                            <button type="submit" class="btn btn-primary">Sign Me
                                                                In</button>
                                                            <span class="form-check d-inline-block">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="check1" name="example1">
                                                                <label class="form-check-label" for="check1">Remember
                                                                    me</label>
                                                            </span>
                                                            <button
                                                                class="nav-link m-auto btn tp-btn-light btn-primary forget-tab "
                                                                id="nav-forget-tab" data-bs-toggle="tab"
                                                                data-bs-target="#nav-forget" type="button" role="tab"
                                                                aria-controls="nav-forget" aria-selected="false">Forget
                                                                Password ?</button>
                                                        </div>
                                                    </form> --}}

                                                    <form id="loginForm" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <h3 class="form-title m-t0">Personal Information</h3>
                                                        <div class="dz-separator-outer m-b5">
                                                            <div class="dz-separator bg-primary style-liner"></div>
                                                        </div>
                                                        <p>Enter your e-mail address and your password.</p>
                                                        <div class="form-group mb-3">
                                                            <input name="email" type="email" id="email"
                                                                class="form-control">
                                                        </div>
                                                        <div class="form-group mb-3">
                                                            <input name="password" type="password" id="password"
                                                                class="form-control">
                                                        </div>
                                                        <div class="form-group text-left mb-5 forget-main">
                                                            <button type="submit" class="btn btn-primary"
                                                                id="submitBtn">Sign Me In</button>
                                                            <span class="form-check d-inline-block">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="check1" name="example1">
                                                                <label class="form-check-label" for="check1">Remember
                                                                    me</label>
                                                            </span>
                                                            <button
                                                                class="nav-link m-auto btn tp-btn-light btn-primary forget-tab"
                                                                id="nav-forget-tab" data-bs-toggle="tab"
                                                                data-bs-target="#nav-forget" type="button" role="tab"
                                                                aria-controls="nav-forget" aria-selected="false">Forget
                                                                Password ?</button>
                                                        </div>
                                                    </form>

                                                </div>
                                                <div class="tab-pane fade" id="nav-forget" role="tabpanel"
                                                    aria-labelledby="nav-forget-tab">
                                                    <form class="dz-form">
                                                        <h3 class="form-title m-t0">Forget Password ?</h3>
                                                        <div class="dz-separator-outer m-b5">
                                                            <div class="dz-separator bg-primary style-liner"></div>
                                                        </div>
                                                        <p>Enter your e-mail address below to reset your password. </p>
                                                        <div class="form-group mb-4">
                                                            <input name="dzName" required="" class="form-control"
                                                                placeholder="Email Address" type="text">
                                                        </div>
                                                        <div class="form-group clearfix text-left">
                                                            <button class=" active btn btn-primary" id="nav-personal-tab"
                                                                data-bs-toggle="tab" data-bs-target="#nav-personal"
                                                                type="button" role="tab" aria-controls="nav-personal"
                                                                aria-selected="true">Back</button>
                                                            <button class="btn btn-primary float-end">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>

                                        </div>
                                    </nav>
                                </div>
                                <div class="card-footer">
                                    <div class=" bottom-footer clearfix m-t10 m-b20 row text-center">
                                        <div class="col-lg-12 text-center">
                                            <span> © Copyright by <span class="heart"></span>
                                                <a href="javascript:void(0);">DexignZone </a> All rights reserved.</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Full Blog Page Contant -->
    </div>
    <!-- Content END-->
    <script>
        function submitLoginForm() {
            const formData = new FormData(document.getElementById('loginForm'));
            console.log(formData)
            fetch('/login', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': formData.get('_token'),
                    },
                    body: formData,
                })
                .then(response => response.json())
                .then(data => {
                    // Handle the response
                    console.log(data.token);

                    // Redirect to the specified URL (e.g., /dashboard)
                    window.location.href = data.redirect;
                })
                .catch(error => {
                    // Handle errors
                    console.error('Error:', error);
                });
        }
    </script>
@endsection
