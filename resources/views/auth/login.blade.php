<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Đăng nhập - Gia Phả</title>

    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="bg-primary">
<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">

                            <div class="card-header">
                                <h3 class="text-center font-weight-light my-4">Đăng nhập</h3>
                            </div>

                            <div class="card-body">

                                {{-- THÔNG BÁO LỖI LOGIN --}}
                                @if ($errors->has('login'))
                                    <div class="alert alert-danger text-center">
                                        {{ $errors->first('login') }}
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('login') }}" novalidate>
                                    @csrf

                                    {{-- EMAIL --}}
                                    <div class="form-floating mb-3">
                                        <input
                                            class="form-control @error('email') is-invalid @enderror"
                                            id="inputEmail"
                                            type="email"
                                            name="email"
                                            value="{{ old('email') }}"
                                            placeholder="name@example.com"
                                            required
                                        />
                                        <label for="inputEmail">Email</label>

                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    {{-- PASSWORD --}}
                                    <div class="form-floating mb-3">
                                        <input
                                            class="form-control @error('password') is-invalid @enderror"
                                            id="inputPassword"
                                            type="password"
                                            name="password"
                                            placeholder="Password"
                                            required
                                        />
                                        <label for="inputPassword">Mật khẩu</label>

                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    {{-- REMEMBER --}}
                                    <div class="form-check mb-3">
                                        <input
                                            class="form-check-input"
                                            id="inputRememberPassword"
                                            name="remember"
                                            type="checkbox"
                                            {{ old('remember') ? 'checked' : '' }}
                                        />
                                        <label class="form-check-label" for="inputRememberPassword">
                                            Nhớ mật khẩu
                                        </label>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                        <a class="small" href="#">Quên mật khẩu?</a>
                                        <button class="btn btn-primary" type="submit">
                                            Đăng nhập
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <div class="card-footer text-center py-3">
                                <div class="small">
                                    <a href="#!">Bạn cần tài khoản? Đăng ký ngay!</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets/js/scripts.js') }}"></script>
</body>
</html>