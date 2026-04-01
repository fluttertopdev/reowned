@extends('website.layout.app')
@section('content')

  <div class="container">
    <div class="brudcrum brudcrum-defrent">
      <ul>
        <li>Home appliances</li>
        <li><img src="{{asset('website_assets/images/r-errow.png')}}"></li>
        <li>Setting</li>
        <li><img src="{{asset('website_assets/images/r-errow.png')}}"></li>
        <li><a href="#" class="active">User Verification</a></li>
      </ul>
    </div>
  </div>


  <div class="edit-profile-saction">
    <div class="container">
      <div class="row">
        @include('website.profile_partial.menu')
        <div class="col-md-9">
          <div class="edit-profile-saction-right">
            <div class="user-verification">
              <h3>User verification</h3>

              <form id="verificationForm" enctype="multipart/form-data" action="{{ route('verification.upload') }}"
                method="POST">
                @csrf

                <div class="verification-upload">
                  <div class="row">
                    <div class="col-md-6">
                      <div id="myform">
                        <div class="">
                          <label for="imag" class="form-label">
                            <input type="file" class="form-control" name="id_proof_front" id="frontInput"
                              accept=".jpg,.jpeg,.png,.svg,.pdf">
                            <img src="{{asset('website_assets/images/upload-button.png')}}">
                            <span>ID Proof (Front)</span>
                            <p>Allowed file types: PNG,JPG,JPEG,SVG,PDF</p>
                          </label>
                        </div>
                        @if($user->id_proof_front)
                          <img id="frontPreview" src="{{ asset('uploads/user/' . $user->id_proof_front) }}" width="150" height="100" style="object-fit: contain;">
                        @else
                        <img id="frontPreview" width="150" height="100" style="object-fit: contain;">
                        @endif
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div id="myform">
                        <div class="">
                          <label for="imag" class="form-label">
                            <input type="file" class="form-control" name="id_proof_back" id="backInput"
                              accept=".jpg,.jpeg,.png,.svg,.pdf">
                            <img src="{{asset('website_assets/images/upload-button.png')}}">
                            <span>ID Proof (Back)</span>
                            <p>Allowed file types: PNG,JPG,JPEG,SVG,PDF</p>
                          </label>
                        </div>
                        @if($user->id_proof_back)
                          <img id="backPreview" src="{{ asset('uploads/user/' . $user->id_proof_back) }}" width="150" height="100" style="object-fit: contain;">
                        @else
                        <img id="backPreview" width="150" height="100" style="object-fit: contain;">
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="verify-buuton"><button type="submit" class="upload-btn">Verify</button></div>
                </div>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection