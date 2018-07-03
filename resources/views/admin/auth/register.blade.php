@extends('layout.login')

@section('content')
<div class="row">
                <div class="col-lg-6 bg-white pattern">
                  <div class="auth-form-light text-left p-5">
                    <h2>Register</h2>
                    <h4 class="font-weight-light">Hello! lets get started</h4>
                    <form class="pt-4">
                      <form>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Username</label>
                          <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Username">
                          <i class="mdi mdi-account"></i>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Password</label>
                          <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                          <i class="mdi mdi-eye"></i>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword2">Password</label>
                          <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Confirm password">
                          <i class="mdi mdi-eye"></i>
                        </div>
                        <div class="mt-5">
                          <a class="btn btn-block btn-primary btn-lg font-weight-medium" href="../../index.html">Register</a>
                        </div>
                        <div class="mt-2 w-75 mx-auto">
                          <div class="form-check form-check-flat">
                            <label class="form-check-label">
                              <input type="checkbox" class="form-check-input">
                              I accept terms and conditions
                            </label>
                          </div>
                        </div>
                        <div class="mt-2 text-center">
                          <a href="login.html" class="auth-link text-black">Already have an account? <span class="font-weight-medium">Sign in</span></a>
                        </div>
                      </form>                  
                    </form>
                  </div>
                </div>
                <div class="col-lg-6 register-half-bg d-flex flex-row">
                  <p class="  font-weight-medium text-center flex-grow align-self-end">Copyright &copy; 2018  All rights reserved.</p>
                </div>
              </div>
@endsection
