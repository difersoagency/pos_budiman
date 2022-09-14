@extends('layouts.app')

@section('content')
<!-- <body class="hold-transition overflow-hidden">
    <div class="container mw-100">
      <div class="tw-grid tw-grid-cols-2 tw-h-screen">
        <div class="col-12 col-md-6 p-0">
          <img src="{{asset('assets/images/login-side.jpg')}}" alt="" width="auto" height="100%">
        </div>
        <div class="col flex items-center justify-center">
          <div class="login-box mx-auto">
            <div class="login-logo">
              <img src="{{asset('assets/images/logombm.png')}}" alt="Logo Maju Bersama Motor" width="20%">
              <span class="text-md tw-font-bold">PT. Maju Bersama Motor</span>
            </div>
            @if(Session::has('error')  )
            <div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h5><i class="icon fas fa-ban"></i> Error</h5>
              Username atau password salah
            </div>
            @endif


            <div class="mt-3">
              <div class="">
                <form method="POST" action="{{ route('login') }}">
                  @csrf
                  <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Username" name="username" class="bg-none">
                    <div class="input-group-append">
                      <div class="input-group-text bg-red">
                        <span class="fas fa-envelope"></span>
                      </div>
                    </div>
                  </div>
                  <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Password" name="password">
                    <div class="input-group-append">
                      <div class="input-group-text bg-red">
                        <span class="fas fa-lock"></span>
                      </div>
                    </div>
                  </div>
                  <div class="row">


                    <div class="col-4">
                      <button type="submit" class="btn tw-bg-slate-500 btn-block">Masuk</button>
                    </div>


                  </div>
                </form>
              </div>


            </div>
          </div>
          </div>
      </div>
    </div> -->
    <!-- /.login-box -->

    <section class="login-sect tw-h-screen tw-w-screen tw-overflow-hidden">
      <div class="tw-grid tw-grid-cols-1 lg:tw-grid-cols-2 tw-h-screen md:tw-h-full ">
        <div class="form-log tw-px-10 tw-py-10 lg:tw-px-20 tw-h-fit tw-mx-auto tw-my-auto">
          <img src="{{asset('assets/images/logombm.png')}}" alt="" class="tw-w-20 tw-mb-3">
          <h1 class="tw-font-bold">PT. Maju Bersama Motor</h1>
          <p class="tw-text-gray-400">Silahkan Masukkan Username dan Password Anda</p>
          <div class="form-box tw-mt-6">
            <form method="POST" action="{{ route('login') }}">
                  @csrf
                  <div class="input-group mb-4">
                    <div class="input-group-append tw-bg-none mr-2">
                      <div class="input-group-text tw-bg-transparent tw-border-r-1 tw-border-y-0 tw-border-l-0 tw-border-red-500">
                        <span class="fas fa-envelope tw-text-red-500 tw-bg-none"></span>
                      </div>
                    </div>
                    <input type="text" placeholder="Username" name="username" class="bg-none form-control tw-border-x-0 tw-border-t-0 tw-border-b-1 focus:tw-border-b-2 focus:tw-border-red-500">
                  </div>

                  <div class="input-group mb-4">
                    <div class="input-group-append tw-bg-none mr-2">
                      <div class="input-group-text tw-bg-transparent tw-border-r-1 tw-border-y-0 tw-border-l-0 tw-border-red-500">
                        <span class="fas fa-lock tw-text-red-500 tw-bg-none"></span>
                      </div>
                    </div>
                    <input type="password" class="bg-none form-control tw-border-x-0 tw-border-t-0 tw-border-b-1 focus:tw-border-b-2 focus:tw-border-red-500" placeholder="Password" name="password">

                  </div>
                  <div class="row">


                    <div class="col-4">
                      <button type="submit" class="btn tw-bg-black btn-block tw-text-red-500 tw-font-bold hover:tw-bg-red">Masuk</button>
                    </div>


                  </div>
                </form>
          </div>
          @if(Session::has('error')  )
            <div class="alert alert-danger alert-dismissible tw-mt-6">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h5><i class="icon fas fa-ban"></i> Error</h5>
              Username atau password salah
            </div>
            @endif
        </div>
        <div class="login-img tw-hidden md:tw-block">
          <img src="{{asset('assets/images/login-side.jpg')}}" alt="Image Login PT Maju Bersama Motor" class="tw-w-full tw-h-screen">
        </div>
      </div>
    </section>
@endsection
