@extends('website.layout.app')
@section('content')

  <div class="container">
    <div class="brudcrum brudcrum-defrent">
      <ul>
        <li>Home appliances</li>
        <li><img src="{{asset('website_assets/images/r-errow.png')}}"></li>
        <li><a href="#" class="active">Edit profile</a></li>
      </ul>
    </div>
  </div>


  <div class="edit-profile-saction">
    <div class="container">
      <div class="row">
        @include('website.profile_partial.menu')
        <div class="col-md-9">
          <form id="profileForm" method="POST" enctype="multipart/form-data" action="{{ route('profile.update') }}">
            @csrf
            <div class="edit-profile-saction-right">
              <div class="profile-box-image">
                <div class="avatar-upload">
                  <div class="avatar-edit">
                    <input name="image" type='file' id="imageUpload"  accept=".png,.jpg,.jpeg" />
                    <label for="imageUpload"></label>
                  </div>
                  <div class="avatar-preview">
                    @php
                        $image = !empty($user->image) 
                            ? asset('uploads/user/' . $user->image) 
                            : asset('website_assets/images/parofile-image.png');
                    @endphp

                    <div id="imagePreview"
                         style="background-image: url('{{ $image }}');">
                    </div>
                </div>
                </div>
                <div class="profile-name-box">
                  <h4>{{$user->name}}</h4>
                  <p>{{ $user->email }}</p>
                </div>
              </div>

              <div class="personal-info-box">
                <div class="row">
                  <div class="col-md-6">
                    <div class="personal-info-box-left">
                      <h4>Personal Info</h4>
                      <p>Edit your Personal Information</p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="personal-info-box-right">
                      <div class="row-input">
                        <label>Name <span>*</span></label>
                        <input type="text" name="name" placeholder="Esther Howard" value="{{ $user->name }}" required />
                      </div>
                      <div class="row-input">
                        <label>Email<span>*</span></label>
                        <input type="email" name="email" placeholder="estherhaward@gmail.com" value="{{ $user->email }}" required />
                      </div>
                      <div class="row-input">
                        <label>Phone<span>*</span></label>
                        <input type="phone" name="phone" placeholder="98765 43210" value="{{ $user->phone }}" required />
                      </div>

                      <div class="row-input">
                        <div class="card-body">
                          <span>Notification</span>
                          <label class="switch" for="checkbox">
                            <input type="checkbox" id="checkbox" name="enable_notificaton" {{ $user->enable_notificaton ? 'checked' : '' }}/>
                            <div class="slider round"></div>
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="personal-info-box">
                <div class="row">
                  <div class="col-md-6">
                    <div class="personal-info-box-left">
                      <h4>Address</h4>
                      <p>Edit your address</p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="personal-info-box-right">
                      <form>
                        <div class="row-input">
                          <label>Address <span>*</span></label>
                          <textarea name="address" placeholder="Gurunanak Society, Than">{{ $user->address }}</textarea>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>

              <div class="from-save-button">
                <button type="submit" class="profile-save-btn">Save changes</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection