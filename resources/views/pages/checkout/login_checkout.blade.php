@extends('collection')
@section('header')
    <title>sign in</title>
@endsection
@section('product_content')
    <section id="form">
        <div class="container card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4 offset-sm-1">
                        <div class="login-form bg-white p-4 rounded">
                            <h2 class="mb-4">Login </h2>
                            <form action="{{ URL::to('/login-customer') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="email_account" id="email_account"
                                        placeholder="Email Address" />
                                    @error('email_account')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <input type="password" class="form-control" name="password_account"
                                        id="password_account" placeholder="password" />
                                    @error('password_account')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="form-control btn btn-outline-dark">Login</button>
                            </form>
                            <hr>
                            <h3 class="mb-4">Or with phone</h3>
                            <form action="{{ URL::to('/login-customer-phone') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="customer_phone_2" id="customer_phone_2"
                                        placeholder="phone number" />
                                    @error('customer_phone_2')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <input type="password" class="form-control" name="password_account_2"
                                        id="password_account_2" placeholder="password" />
                                    @error('password_account_2')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="form-control btn btn-outline-dark">Login</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-sm-1">
                        <p class="or mt-5"
                            style="border-radius: 50%; background-color: black; color: white; text-align: center; line-height: 55px;width: 60px; height: 60px; font-size: 30px">
                            OR</p>
                    </div>

                    <div class="col-sm-4">
                        <div class="signup-form bg-white p-4 rounded">
                            <h2 class="mb-4">Register</h2>
                            <form id="registerForm" action="{{ URL::to('/add-customer') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="customer_name" placeholder="Name" />
                                    @error('customer_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <input type="email" class="form-control" name="customer_email"
                                        placeholder="Email Address" />
                                    @error('customer_email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <input type="password" class="form-control" name="customer_password"
                                        placeholder="Password" />
                                    @error('customer_password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <input type="password" class="form-control" name="re_customer_password"
                                        id="re_customer_password" placeholder="enter password again" />
                                    @error('re_customer_password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="customer_address" id="customer_address"
                                        placeholder="enter address" />
                                    @error('customer_address')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="customer_phone" placeholder="Phone" />
                                    @error('customer_phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <select class="form-control" name="district_id" required>
                                        <option value="" selected disabled>Select District</option>
                                        @foreach ($districts as $district)
                                            <option value="{{ $district->district_id }}">{{ $district->district_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="form-control btn btn-outline-dark">Register</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
