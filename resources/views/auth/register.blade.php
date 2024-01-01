<x-master>
    <div
        class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
        <div class="d-flex align-items-center justify-content-center w-100">
            <div class="row justify-content-center w-100">
                <div class="col-md-8 col-lg-6 col-xxl-3">
                    <div class="card mb-0">
                        <div class="card-body">
                            <a href="javascript:void(0)" class="text-nowrap logo-img text-center d-block py-3 w-100">
                                <img src="{{ asset('images/logos/svg/logo-no-background.svg') }}" width="180"
                                    alt="">
                            </a>
                            <p class="text-center">Your Budget Manager</p>
                            <form action="{{ route('users.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name <span
                                            class="text-sm text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                                    @error('name')
                                        <span class="text-sm text-danger" id="err-username">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <span class="text-sm text-danger" id="err-email"></span>
                                    <label for="email" class="form-label">Email <span
                                            class="text-sm text-danger">*</span></label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                                    @error('email')
                                        <span class="text-sm text-danger" id="err-username">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="password" class="form-label">Password <span
                                            class="text-sm text-danger">*</span></label>
                                    <input type="password" class="form-control" id="password" name="password">
                                    @error('password')
                                        <span class="text-sm text-danger" id="err-username">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="cpassword" class="form-label">Confirm Password <span
                                            class="text-sm text-danger">*</span></label>
                                    <input type="password" class="form-control" id="cpassword" name="cpassword">
                                    <span class="text-sm text-danger" id="err-cpassword"></span>
                                </div>
                                <button class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" type="submit">Sign
                                    Up</button>
                                <div class="d-flex align-items-center justify-content-center">
                                    <p class="fs-4 mb-0 fw-bold">Already have an Account?</p>
                                    <a class="text-primary fw-bold ms-2" href="{{ route('login') }}">Sign In</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-master>
