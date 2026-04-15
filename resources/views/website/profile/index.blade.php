@extends('website.layout.app')
@section('content')

  <div class="container">
    <div class="brudcrum brudcrum-defrent">
      <ul>
        <li>{{ __('lang.website.home') }}</li>
        <li><img src="{{asset('website_assets/images/r-errow.png')}}"></li>
        <li><a href="#" class="active">{{ __('lang.website.edit_profile') }}</a></li>
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
                      <h4>{{ __('lang.website.personal_info') }}</h4>
                      <p>{{ __('lang.website.edit_your_personal_information') }}</p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="personal-info-box-right">
                      <div class="row-input">
                        <label>{{ __('lang.website.name') }} <span>*</span></label>
                        <input type="text" name="name" placeholder="{{ __('lang.website.name_placeholder') }}" value="{{ $user->name }}" required />
                      </div>
                      <div class="row-input">
                        <label>{{ __('lang.website.email') }}<span>*</span></label>
                        <input type="email" name="email" placeholder="{{ __('lang.website.email_placeholder') }}" value="{{ $user->email }}" required />
                      </div>
                      <div class="row-input">
                        <label>{{ __('lang.website.phone') }}<span>*</span></label>
                        <input type="phone" name="phone" placeholder="{{ __('lang.website.phone_placeholder') }}" value="{{ $user->phone }}" required />
                      </div>

                      <div class="row-input">
                        <div class="card-body">
                          <span>{{ __('lang.website.notification') }}</span>
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
                      <h4>{{ __('lang.website.address') }}</h4>
                      <p>{{ __('lang.website.edit_your_address') }}</p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="personal-info-box-right">
                      <form>
                        <div class="row-input">
                          <label>{{ __('lang.website.address') }} <span>*</span></label>
                          <textarea name="address" placeholder="{{ __('lang.website.address_placeholder') }}">{{ $user->address }}</textarea>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>

              <div class="from-save-button">
                <button type="submit" class="profile-save-btn">{{ __('lang.website.save_changes') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection