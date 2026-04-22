<div class="col-md-3">
  <div class="edit-profile-saction-left">
    <h4>{{ __('lang.website.setting') }}</h4>
    <ul>
      <li class="{{ request()->is('profile') ? 'active' : '' }}">
          <a href="{{ url('profile') }}">
            <img src="{{ asset('website_assets/images/brown-icon-1.png') }}" class="brown-icon">
            <img src="{{ asset('website_assets/images/black-icon-1.png') }}" class="black-icon">
            {{ __('lang.website.edit_profile') }}
          </a>
      </li>

        <li class="{{ request()->is('get-verification-badge') ? 'active' : '' }}">
          <a href="{{ url('get-verification-badge') }}">
            <img src="{{ asset('website_assets/images/brown-icon-2.png') }}" class="brown-icon">
            <img src="{{ asset('website_assets/images/black-icon-2.png') }}" class="black-icon">
            {{ __('lang.website.get_verification_badge') }}
          </a>
        </li>

        <li class="{{ request()->is('chats') ? 'active' : '' }}">
          <a href="{{ url('chats') }}">
            <img src="{{ asset('website_assets/images/brown-icon-4.png') }}" class="brown-icon">
            <img src="{{ asset('website_assets/images/black-icon-4.png') }}" class="black-icon">
            {{ __('lang.website.chat') }}
          </a>
        </li>

        <li class="{{ request()->is('subscriptions') ? 'active' : '' }}">
          <a href="{{ url('subscriptions') }}">
            <img src="{{ asset('website_assets/images/brown-icon-5.png') }}" class="brown-icon">
            <img src="{{ asset('website_assets/images/black-icon-5.png') }}" class="black-icon">
            {{ __('lang.website.subscription') }}
          </a>
        </li>

        <li class="{{ request()->is('sell/listing') ? 'active' : '' }}">
          <a href="{{ url('sell/listing') }}">
            <img src="{{ asset('website_assets/images/brown-icon-6.png') }}" class="brown-icon">
            <img src="{{ asset('website_assets/images/black-icon-6.png') }}" class="black-icon">
            {{ __('lang.website.ads') }}
          </a>
        </li>

        <li class="{{ request()->is('favorites') ? 'active' : '' }}">
          <a href="{{ url('favorites') }}">
            <img src="{{ asset('website_assets/images/brown-icon-7.png') }}" class="brown-icon">
            <img src="{{ asset('website_assets/images/black-icon-7.png') }}" class="black-icon">
            {{ __('lang.website.favorites') }}
          </a>
        </li>

        <li class="{{ request()->is('transactions') ? 'active' : '' }}">
          <a href="{{ url('transactions') }}">
            <img src="{{ asset('website_assets/images/brown-icon-8.png') }}" class="brown-icon">
            <img src="{{ asset('website_assets/images/black-icon-8.png') }}" class="black-icon">
            {{ __('lang.website.transaction') }}
          </a>
        </li>
      <li>
        <a href="#" id="openSignOutModal">
          <img src="{{asset('website_assets/images/brown-icon-9.png')}}" class="brown-icon"> <img
            src="{{asset('website_assets/images/black-icon-9.png')}}" class="black-icon">
          {{ __('lang.website.sign_out') }}
        </a>
      </li>
      <li>
        <a href="#" id="openDeleteModal">
          <img src="{{asset('website_assets/images/brown-icon-10.png')}}" class="">
          {{ __('lang.website.delete_account') }}
        </a>
      </li>
    </ul>
  </div>
</div>