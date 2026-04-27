<style>
    .dropdown-hover:hover>.dropdown-menu {
        display: block;
        margin-top: 0;
    }

    /* Hover open */
    .dropdown-hover:hover>.dropdown-menu {
        display: block;
        margin-top: 0;
    }

    /* Mega dropdown main box */
    .dropdown-niv3 {
        left: 0;
        right: 0;
        padding: 20px 30px !important;
        /* controlled padding */
        border-radius: 16px;
    }

    /* Columns wrapper */
    .mega-wrapper {
        display: flex;
        gap: 50px;
        align-items: flex-start;
        /* VERY IMPORTANT */
    }

    /* Column */
    .mega-col {
        min-width: 190px;
    }

    /* CATEGORY HEADING */
    .mega-heading {
        font-weight: 600;
        font-size: 15px;
        margin-bottom: 8px;
        /* reduced more */
        display: block;
        text-decoration: none;
        color: #222;
    }

    /* Remove ul default spacing */
    .mega-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    /* Subcategory spacing */
    .mega-list li {
        margin-bottom: 6px;
        /* tighter */
    }

    /* Subcategory link */
    .mega-list li a {
        display: block;
        font-size: 14px;
        line-height: 1.2;
        /* tighter */
        text-decoration: none;
        color: #555;
    }

    .mega-list li a:hover {
        color: #00a7b5;
    }

    li.mega-list-child a {
        padding: 1px !important;
    }

    img.sell-icon-black {
        height: 20px;
        width: 20px;
    }

    .all-cetagory-box .selectDropdown .option a {
        color: #737373 !important;
        text-decoration: none;
    }

    .home-cat-image {
        height: 130px;
        width: 130px;
        border-radius: 50%;
    }

    .total-add-box .item-box-image {
        width: 212px;
        height: 135px;
        object-fit: contain;
    }

    .item-list-img {
        height: 250px;
        width: 100%;
        object-fit: contain;
    }
    
    svg.svg-inline--fa.fa-angle-right.fa-w-8.ms-2 {
        color: #b4b3b0 !important;
    }
</style>
<!-- Filter -->
<style>
    .filter-form {
        display: flex;
        gap: 20px;
        align-items: center;
    }

    .custom-select {
        position: relative;
    }

    .custom-select label {
        margin-right: 8px;
        font-weight: 500;
        float: inline-start;
    }

    .custom-select select {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;

        background-color: #f3efe4;
        /* light yellow background */
        border: none;
        padding: 12px 40px 12px 18px;
        border-radius: 30px;
        font-size: 15px;
        cursor: pointer;
        outline: none;
        min-width: 200px;
        border: 1px solid;
    }

    /* Custom dropdown arrow */
    .custom-select::after {
        content: "▾";
        position: absolute;
        right: 18px;
        top: 65%;
        transform: translateY(-50%);
        pointer-events: none;
        font-size: 14px;
    }

    .designer-box-image img {
        height: 74px;
        border-radius: 50%;
    }

    li a {
        text-decoration: none;
        color: #2c2b2b;
    }
</style>
<!-- Location -->
<style>
    .location-modal {
        width: 550px;
        max-width: 95%;
        border-radius: 20px;
        padding: 20px;
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .location-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #f5f5f5;
        padding: 10px 15px;
        border-radius: 30px;
        margin-bottom: 10px;
    }

    .location-display span {
        font-size: 14px;
        color: #333;
    }

    .curont-loc {
        border: none;
        background: white;
        padding: 6px 12px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        gap: 5px;
        cursor: pointer;
    }

    .map-search {
        margin-bottom: 10px;
    }

    #mapLocationSearch {
        width: 100%;
        padding: 10px;
        border-radius: 6px;
        border: 1px solid #ddd;
    }

    .map-wrapper {
        border-radius: 12px;
        overflow: hidden;
        margin-bottom: 15px;
    }

    #mapCanvas {
        height: 300px;
        width: 100%;
    }

    .slider-container {
        margin-top: 10px;
    }

    .save-button {
        text-align: right;
        margin-top: 15px;
    }

    .save-button button {
        background: #d66b2b;
        color: white;
        border: none;
        padding: 10px 25px;
        border-radius: 25px;
    }

    .modal-content .custom_radio {
        margin: 31px 0 0 0;
        padding: 0;
        text-align: left;
    }

    .modal-content .custom_radio li {
        display: inline-block;
        width: 100%;
        margin: 0 0 22px 0;
    }
    #currentLocation{
        display: inline-block;
        max-width: 400px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        vertical-align: middle;
    }
    .subscription-box-inner .tabs #tab1 .box-pricing-plan-box .choose-plan {
        margin: 30px 0 0 0;
    }
    .option.active a{
        color: green !important;
    }
    .pac-container {
        z-index: 999999 !important;
    }
    .area-filter {
        cursor: pointer;
    }
    div#moreBtn{
        cursor: pointer;
    }
    img.image-thumbnail {
        height: 100px;
        width: 100px;
        margin: 5px 5px;
    }

    .make-an-offer-btn {
        width: auto;
        background-color: #CB6932;
        border-radius: 30px;
        padding: 16px 26px;
        color: #fff;
        text-decoration: none;
        font-family: "Manrope", sans-serif;
        font-weight: 600;
        font-size: 14px;
        margin: 30px 0 0 0;
    }
</style>
<!-- filter -->
<style>
    .slider-container {
        position: relative;
        padding: 15px 10px 25px;
    }

    /* Label */
    .range-label {
        font-size: 14px;
        color: #777;
        margin-bottom: 10px;
    }

    /* Values */
    .price-values {
        display: flex;
        justify-content: space-between;
        font-weight: 600;
        margin-bottom: 10px;
    }

    /* Histogram bars */
    .price-bars {
        display: flex;
        align-items: flex-end;
        height: 40px;
        gap: 3px;
        margin-bottom: 10px;
    }

    .price-bars span {
        flex: 1;
        background: #ddd;
        border-radius: 2px;
    }

    /* random heights (you can adjust) */
    .price-bars span:nth-child(1) { height: 20%; }
    .price-bars span:nth-child(2) { height: 30%; }
    .price-bars span:nth-child(3) { height: 40%; }
    .price-bars span:nth-child(4) { height: 60%; }
    .price-bars span:nth-child(5) { height: 50%; }
    .price-bars span:nth-child(6) { height: 45%; }
    .price-bars span:nth-child(7) { height: 55%; }
    .price-bars span:nth-child(8) { height: 70%; }
    .price-bars span:nth-child(9) { height: 50%; }
    .price-bars span:nth-child(10){ height: 40%; }

    /* Slider track */
    .slider-track {
        position: absolute;
        height: 4px;
        background: #ff6a00;
        top: 75%;
        transform: translateY(-50%);
        border-radius: 5px;
    }

    /* Range input */
    .slider-container input[type=range] {
        position: absolute;
        width: 100%;
        top: 75%;
        transform: translateY(-50%);
        pointer-events: none;
        -webkit-appearance: none;
        background: none;
    }

    /* Track */
    .slider-container input[type=range]::-webkit-slider-runnable-track {
        height: 4px;
        background: #ccc;
    }

    /* Thumb */
    .slider-container input[type=range]::-webkit-slider-thumb {
        pointer-events: all;
        -webkit-appearance: none;
        height: 18px;
        width: 18px;
        background: #fff;
        border: 3px solid #ff6a00;
        border-radius: 50%;
        cursor: pointer;
    }

    /* Apply button */
    #applyPrice {
        width: 100%;
        margin-top: 15px;
        padding: 10px;
        background: #0d47a1;
        color: #fff;
        border: none;
        border-radius: 8px;
    }

    span#maxPrice {
        width: 10%;
    }
</style>
<!-- chat -->
<style>
  /* CHAT CONTAINER */
  .chat-meassge-box {
      height: 400px;
      max-height: 400px;
      overflow-y: auto;
      padding: 15px;
      background: #f5f7fb;
      display: flex;
      flex-direction: column;

      /* Hide scrollbar */
      scrollbar-width: none; /* Firefox */
      -ms-overflow-style: none; /* IE & Edge */
  }

  .chat-meassge-box::-webkit-scrollbar {
      display: none; /* Chrome, Safari */
  }

  /* MESSAGE COMMON */
  .chat-meassge-box div {
      max-width: 80%;
      padding: 2px 5px;
      border-radius: 12px;
      margin-bottom: 10px;
      font-size: 14px;
      position: relative;
      word-wrap: break-word;
      display: inline-flex;
  }

  /*Seen Status*/
  span.seen-status {
      display: inline-block;
      color: #000;
      font-size: 10px;
      font-family: "Manrope", sans-serif;
      font-weight: 500;
      margin-top: 10px;
      width: 20px;
  }

  /* MY MESSAGE */
  .my-msg {
      background: #d9fdd3;
      align-self: flex-end;
      border-bottom-right-radius: 2px;
  }

  /* OTHER MESSAGE */
  .other-msg {
      background: #ffffff;
      align-self: flex-start;
      border-bottom-left-radius: 2px;
  }

  /* SEEN */
  .seen-status {
      font-size: 10px;
      margin-left: 5px;
      color: #999;
  }

  /* INPUT AREA */
  .type-meassge-box {
      display: flex;
      gap: 10px;
      padding: 10px;
      border-top: 1px solid #eee;
  }

  .type-your {
      flex: 1;
      border-radius: 25px;
      padding: 10px 15px;
      border: 1px solid #ddd;
      resize: none;
      height: 40px;
  }

  /* SEND BUTTON */
  .send-meassge {
      background: #ff6b00;
      border: none;
      color: #fff;
      border-radius: 50%;
      width: 40px;
      height: 40px;
  }

  /* TYPING */
  .typing-indicator span{
    color: green !important;
  }
   
  /*Active Chat*/
  a.open-chat.active {
    background-color: #fff;
  }

    /*chat icon*/
    .chat-icon {
        margin-top: -20px;
    }
    
    /*Unread count*/
    span.unread-count.badge {
        float: inline-end;
        background: green;
        color: white;
        border-radius: 50%;
        font-size: 10px;
        margin-top: 40px;
    }
    /*Today yeaster tag*/
    .chat-date{
        text-align: center;
        margin: 10px 0;
        font-size: 12px;
        color: #888;
    }

    /*Time*/
    span.msg-time {
        font-size: 10px;
        margin-top: 10px;
    }

    /*item name*/
    .item-name-a{
        text-decoration: none;
        color: #cb694f;
        font-weight: 900;
    }
</style>
<!-- Lang drop -->
<style>
   .lang-dropdown {
        position: relative;
        display: inline-block;
        float: inline-end;
    }

    .lang-btn {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 6px 12px;
        border-radius: 25px;
        border: 1px solid #333;
        background: #000;
        color: #fff;
        cursor: pointer;
    }

    .lang-btn img {
        width: 20px;
        height: 20px;
        border-radius: 50%;
    }

    .arrow-down {
        border: solid #fff;
        border-width: 0 1.5px 1.5px 0;
        display: inline-block;
        padding: 3px;
        transform: rotate(45deg);
        margin-left: 5px;
    }

    .lang-menu {
        position: absolute;
        top: 110%;
        right: 0;
        background: #fff;
        border-radius: 10px;
        list-style: none;
        padding: 5px 10px;
        margin: 0;
        display: none;
        min-width: 100px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .lang-menu li a {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 8px 12px;
        color: #000;
        text-decoration: none;
    }

    .lang-menu li a:hover {
        background: #f5f5f5;
    }

    .lang-menu li a.active {
        font-weight: bold;
    }

    .lang-menu img {
        width: 18px;
        height: 18px;
        border-radius: 50%;
    }
    .lang-menu.show {
        display: block;
    }
</style>
<!-- Packages style -->
<style>
    .box-pricing-plan-box {
      position: relative;
      overflow: hidden;
    }

    .plan-ribbon {
      position: absolute;
      top: 20px;
      left: -55px;
      width: 160px;
      background: #28a745;
      color: #fff;
      text-align: center;
      transform: rotate(-45deg);
      padding: 6px 0;
      z-index: 10;
      line-height: 1.2;
    }

    .plan-ribbon span {
      display: block;
      font-size: 12px;
      font-weight: 600;
    }

    .plan-ribbon small {
      display: block;
      font-size: 10px;
      opacity: 0.9;
    }
</style>

<!-- Register Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-0 border-0 bg-transparent">

            <div class="not-fill-bg-image-login">
                <div class="login-all-screen">
                    <div class="login-all-screen-inner">

                        <!-- Close Button -->
                        <button type="button" class="close-btn" data-bs-dismiss="modal">
                            <img src="{{asset('website_assets/images/tage-close.png')}}">
                        </button>

                        <!-- Logo -->
                        <img src="{{asset('website_assets/images/search-button.png')}}">

                        <h2>{{ __('lang.website.welcome_to_reowned') }}</h2>
                        <p>{{ __('lang.website.lets_create_your_account') }}</p>

                        <form id="registerForm" method="POST" action="{{ route('user.do-signup') }}">
                            @csrf

                            <div class="form-group">
                                <label>{{ __('lang.website.name') }}</label>
                                <input type="text" placeholder="{{ __('lang.website.type_name') }}" name="name" required>
                                <small class="error-text text-danger"></small>
                            </div>

                            <div class="form-group">
                                <label>{{ __('lang.website.email') }}</label>
                                <input type="email" placeholder="{{ __('lang.website.enter_your_email') }}" name="email" required
                                    autocomplete="off" class="register-email">
                                <small class="error-text text-danger already-email-msg"></small>
                            </div>

                            <div class="form-group">
                                <label>{{ __('lang.website.phone_number') }}</label>
                                <input type="text" id="mobile_code" class="js-states form-control"
                                    placeholder="{{ __('lang.website.enter_phone_number') }}" name="mobile" required>
                                <small class="error-text text-danger"></small>
                            </div>

                            <div class="form-group position-relative">
                                <label>{{ __('lang.website.password') }}</label>
                                <input type="password" placeholder="{{ __('lang.website.enter_your_password') }}" name="password" required
                                    minlength="8">
                                <small class="error-text text-danger"></small>
                            </div>

                            <button type="submit" class="singup-btn">{{ __('lang.website.signup') }}</button>
                        </form>
                         
                        @if(setting('enable_google_login') == 1)
                        <div class="Sign-in-google">
                            <a href="{{ route('google.login') }}">
                                <img src="{{asset('website_assets/images/flat-color-icons_google.png')}}">
                                {{ __('lang.website.sign_in_with_google') }}
                            </a>
                        </div>
                        @endif

                        @php 
                            $cmsList = \Helpers::getCmsForSite();
                            $terms = null;
                            $privacy = null;

                            if(isset($cmsList) && count($cmsList)){
                                foreach($cmsList as $cms){
                                    if(strtolower($cms->slug) == 'term-and-conditions' || strtolower($cms->slug) == 'terms-and-conditions'){
                                        $terms = $cms;
                                    }

                                    if(strtolower($cms->slug) == 'privacy-policy'){
                                        $privacy = $cms;
                                    }
                                }
                            }
                        @endphp

                        <p class="by-signing">
                            {{ __('lang.website.signin_footer_msg') }} <br>
                            @if($terms)
                                <a target="_blank" href="{{ url('/'.$terms->slug) }}">
                                    {{ $terms->page_name }}
                                </a>
                            @endif

                            @if($terms && $privacy)
                                &
                            @endif

                            @if($privacy)
                                <a target="_blank" href="{{ url('/'.$privacy->slug) }}">
                                    {{ $privacy->page_name }}
                                </a>
                            @endif
                        </p>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-0 border-0 bg-transparent">

            <div class="not-fill-bg-image-login">
                <div class="login-all-screen">
                    <div class="login-all-screen-inner">

                        <!-- Close Button -->
                        <button type="button" class="close-btn" data-bs-dismiss="modal">
                            <img src="{{asset('website_assets/images/tage-close.png')}}">
                        </button>

                        <!-- Logo -->
                        <img src="{{asset('website_assets/images/search-button.png')}}">

                        <h2>{{ __('lang.website.login_to_reowned') }}</h2>
                        <p>{{ __('lang.website.welcome_back_enter_details') }}</p>

                        <form id="loginForm" method="POST" action="{{ route('user.do-login') }}">
                            @csrf

                            <div class="form-group">
                                <label>{{ __('lang.website.email') }}</label>
                                <input type="email" placeholder="{{ __('lang.website.enter_your_email') }}" name="email" required>
                            </div>

                            <div class="form-group position-relative">
                                <label>{{ __('lang.website.password') }}</label>
                                <input type="password" placeholder="{{ __('lang.website.enter_your_password') }}" name="password" required>
                                <small class="error-text text-danger"></small>
                            </div>

                            <button type="submit" class="login-submit-btn">{{ __('lang.website.login') }}</button>
                        </form>
                        
                        @if(setting('enable_google_login') == 1)
                        <div class="Sign-in-google">
                            <a href="{{ route('google.login') }}">
                                <img src="{{asset('website_assets/images/flat-color-icons_google.png')}}">
                                {{ __('lang.website.sign_in_with_google') }}
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<!-- Mail Modal -->
<div class="modal fade" id="mailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-0 border-0 bg-transparent">

            <div class="not-fill-bg-image-login">
                <div class="login-all-screen">
                    <div class="login-all-screen-inner">

                        <!-- Close Button -->
                        <button type="button" class="close-btn" data-bs-dismiss="modal">
                            <img src="{{asset('website_assets/images/tage-close.png')}}">
                        </button>

                        <!-- Img -->
                        <img src="{{asset('website_assets/images/verify-otp.png')}}">
                        <h2>{{ __('lang.website.youve_got_mail') }}</h2>
                        <p>{{ __('lang.website.click_the_link_in_your_email') }}</p>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<!-- Sign Out Modal -->
<div class="sign-delete-popup">
    <div class="modal" id="signOutModal">
        <div class="modal-content">
            <div class="sign-delete-box">
                <img src="{{asset('website_assets/images/sign-out-icon.png')}}">
                <h4>{{ __('lang.website.are_you_sure') }}</h4>
                <p>{{ __('lang.website.are_you_sure_to_sign_out') }}</p>
                <form method="post" action="{{route('user.logout')}}">
                    @csrf
                    <div class="button-popup-sign-detlet">
                        <button type="button" class="cancel-btn" data-close="signOutModal">{{ __('lang.website.cancel') }}</button>
                        <button type="submit" class="yes-btn">{{ __('lang.website.yes') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Account Modal -->
<div class="sign-delete-popup">
    <div class="modal" id="deleteModal">
        <div class="modal-content">
            <div class="sign-delete-box">
                <img src="{{asset('website_assets/images/deleate-icon.png')}}">
                <h4>{{ __('lang.website.are_you_sure') }}</h4>
                <ul>
                    <li>{{ __('lang.website.your_ads_transactions_history_deleted') }}</li>
                    <li>{{ __('lang.website.accounts_details_cant_be_recovered') }}</li>
                    <li>{{ __('lang.website.subscriptions_will_be_cancelled') }}</li>
                    <li>{{ __('lang.website.saved_preferences_and_messages_lost') }}</li>
                </ul>
                <form method="post" action="{{route('user.delete')}}">
                    @csrf
                    <div class="button-popup-sign-detlet">
                        <button type="button" class="cancel-btn" data-close="deleteModal">{{ __('lang.website.cancel') }}</button>
                        <button type="submit" class="yes-btn">{{ __('lang.website.yes') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "4000"
    };
</script>

<script>
    const range = document.getElementById('kmRange');
    const rangeValue = document.getElementById('rangeValue');

    function updateSliderBackground() {
        const value = range.value;
        const max = range.max;
        const percent = (value / max) * 100;

        range.style.setProperty('--value', `${percent}%`);
        rangeValue.textContent = `${value} KM`;
    }

    range.addEventListener('input', updateSliderBackground);
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const dropdownToggle = document.getElementById('navbarDropdown');
        const dropdownMenu = document.querySelector('.dropdown-menu');

        // Make sure dropdownMenu exists
        if (dropdownMenu) {
            dropdownMenu.addEventListener('click', function (e) {
                // Check if clicked item is a link
                if (e.target.tagName === 'A' && window.innerWidth < 768) {
                    const dropdownInstance = mdb.Dropdown.getInstance(dropdownToggle);

                    if (dropdownInstance) {
                        dropdownInstance.hide(); // Close the dropdown
                    }
                }
            });
        }
    });
</script>

<!-- Register -->
<script>
    $(document).on('click', '.register-btn', function () {
        $('.register-email').val('');
        $('.already-email-msg').text('');
        $('#registerModal').modal('show');
    });


    $(document).on('submit', '#registerForm', function (e) {
        e.preventDefault();

        let form = $(this);
        let formData = form.serialize();
        let valid = true;

        $('.error-text').text('');

        let name = $('input[name="name"]').val().trim();
        let email = $('input[name="email"]').val().trim();
        let mobile = $('input[name="mobile"]').val().trim();
        let password = $('input[name="password"]').val().trim();

        // Name validation
        if (name.length < 3) {
            $('input[name="name"]').next('.error-text')
                .text('{{ __('lang.website.name_minimum_characters') }}');
            valid = false;
        }

        // Email validation
        let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            $('input[name="email"]').next('.error-text')
                .text('{{ __('lang.website.enter_valid_email_address') }}');
            valid = false;
        }

        // Phone validation (exact 10 digit)
        if (!/^[0-9]{10}$/.test(mobile)) {
            $('input[name="mobile"]').next('.error-text')
                .text('{{ __('lang.website.phone_number_exact_digits') }}');
            valid = false;
        }

        // Password validation
        if (password.length < 8) {
            $('input[name="password"]').next('.error-text')
                .text('{{ __('lang.website.password_minimum_length') }}');
        }

        if (!valid) return;

        // Button loading state
        let btn = form.find('.singup-btn');
        btn.prop('disabled', true).text('{{ __('lang.website.submitting') }}');

        $.ajax({
            url: form.attr('action'),
            type: "POST",
            data: formData,
            success: function (response) {

                btn.prop('disabled', false).text('{{ __('lang.website.signup') }}');

                if (response.status) {

                    toastr.success(response.message);

                    $('#registerModal').modal('hide');
                    $('#mailModal').modal('show');

                    form[0].reset();
                }
            },
            error: function (xhr) {

                btn.prop('disabled', false).text('{{ __('lang.website.signup') }}');

                if (xhr.status === 422) {

                    let errors = xhr.responseJSON.errors;

                    $.each(errors, function (key, value) {

                        toastr.error(value[0]);
                    });
                } else {
                    toastr.error('{{ __('lang.website.something_went_wrong_try_again') }}');
                }
            }
        });
    });


    $('.register-email').on('blur', function () {

        let email = $(this).val();

        if (email.length > 0) {
            $.ajax({
                url: "{{ route('user.check-email') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    email: email
                },
                success: function (response) {

                    if (response.exists) {
                        $('input[name="email"]').next('.error-text')
                            .text('{{ __('lang.website.email_already_registered') }}');
                    } else {
                        $('input[name="email"]').next('.error-text')
                            .text('');
                    }
                }
            });
        }
    });
</script>

<!-- Login -->
<script>

    $(document).on('click', '.login-btn', function () {
        $('#loginModal').modal('show');
        $('.already-email-msg').text('');
    });

    $(document).on('submit', '#loginForm', function (e) {

        e.preventDefault();

        let form = $(this);
        let formData = form.serialize();
        let btn = form.find('.login-submit-btn');

        btn.prop('disabled', true).text('{{ __('lang.website.logging_in') }}');

        $.ajax({
            url: form.attr('action'),
            type: "POST",
            data: formData,
            success: function (response) {

                btn.prop('disabled', false).text('{{ __('lang.website.login') }}');

                if (response.status) {

                    toastr.success(response.message);

                    $('#loginModal').modal('hide');

                    setTimeout(function () {
                        location.reload(); // reload to update UI
                    }, 1000);
                }
            },
            error: function (xhr) {

                btn.prop('disabled', false).text('{{ __('lang.website.login') }}');

                if (xhr.responseJSON && xhr.responseJSON.message) {
                    toastr.error(xhr.responseJSON.message);
                } else {
                    toastr.error('{{ __('lang.website.something_went_wrong') }}');
                }
            }
        });
    });
</script>

<!-- Profile -->
<script>
    $(document).on('submit', '#profileForm', function (e) {

        e.preventDefault();

        let form = $(this);
        let formData = new FormData(this);
        let btn = form.find('.profile-save-btn');

        btn.prop('disabled', true).text('{{ __('lang.website.saving_changes') }}');

        $.ajax({
            url: form.attr('action'),
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,

            success: function (response) {

                btn.prop('disabled', false).text('{{ __('lang.website.save_changes') }}');

                if (response.status) {
                    toastr.success(response.message);
                }
            },

            error: function (xhr) {

                btn.prop('disabled', false).text('{{ __('lang.website.save_changes') }}');

                if (xhr.status === 422) {
                    $.each(xhr.responseJSON.errors, function (key, value) {
                        toastr.error(value[0]);
                    });
                } else {
                    toastr.error('{{ __('lang.website.something_went_wrong') }}');
                }
            }
        });
    });
</script>

<!-- Profile Image -->
<script>
    $("#imageUpload").change(function () {

        const file = this.files[0];

        if (file) {
            let reader = new FileReader();

            reader.onload = function (event) {
                $('#imagePreview').css('background-image', 'url(' + event.target.result + ')');
            }

            reader.readAsDataURL(file);
        }
    });
</script>

<script>
    $(document).ready(function () {
        $('.grid-view').on('click', function () {
            // Remove list layout and update button states
            $('.recommendations-saction-shop').removeClass('list-boxlayout');

            // Toggle button classes
            $('.grid-view').addClass('on active');
            $('.list-view').removeClass('on active');
        });

        $('.list-view').on('click', function () {
            // Add list layout and update button states
            $('.recommendations-saction-shop').addClass('list-boxlayout');

            // Toggle button classes
            $('.list-view').addClass('on active');
            $('.grid-view').removeClass('on active');
        });
    });
</script>

<script>
    // Open Sign Out Modal
    document.getElementById('openSignOutModal').addEventListener('click', function (e) {
        e.preventDefault();
        document.getElementById('signOutModal').style.display = 'flex';
    });

    // Open Delete Modal
    document.getElementById('openDeleteModal').addEventListener('click', function (e) {
        e.preventDefault();
        document.getElementById('deleteModal').style.display = 'flex';
    });

    // Close Modals on .close or .cancel-btn click
    document.querySelectorAll('[data-close]').forEach(button => {
        button.addEventListener('click', function () {
            const modalId = this.getAttribute('data-close');
            document.getElementById(modalId).style.display = 'none';
        });
    });

    // Close modal when clicking outside the modal content
    window.addEventListener('click', function (e) {
        document.querySelectorAll('.modal').forEach(modal => {
            if (e.target === modal) {
                modal.style.display = 'none';
            }
        });
    });
</script>

<!-- Verify Document Badge -->
<script>
    function readURL(input, previewID) {

        if (input.files && input.files[0]) {

            let reader = new FileReader();

            reader.onload = function (e) {
                $('#' + previewID).attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#frontInput").change(function () {
        readURL(this, "frontPreview");
    });

    $("#backInput").change(function () {
        readURL(this, "backPreview");
    });
</script>

<!-- Verify document -->
<script>
    $(document).on('submit', '#verificationForm', function (e) {

        e.preventDefault();

        let form = $(this);
        let formData = new FormData(this);
        let btn = form.find('.upload-btn');

btn.prop('disabled', true).text('{{ __('lang.website.uploading') }}');

        $.ajax({
            url: form.attr('action'),
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,

            success: function (response) {
                btn.prop('disabled', false).text('{{ __('lang.website.submit') }}');

                if (response.status) {
                    toastr.success(response.message);
                }
            },

            error: function (xhr) {

                btn.prop('disabled', false).text('{{ __('lang.website.submit') }}');

                if (xhr.status === 422) {
                    $.each(xhr.responseJSON.errors, function (key, value) {
                        toastr.error(value[0]);
                    });
                } else {
                    toastr.error('{{ __('lang.website.something_went_wrong') }}');
                }
            }
        });
    });
</script>

<!-- sell add -->
<script>
    document.addEventListener("DOMContentLoaded", function () {

        let firstCategoryId = "{{ $firstCategory->id ?? '' }}";

        // Load first category automatically
        if (firstCategoryId) {
            loadSubcategories(firstCategoryId);
        }

        // Click category
        document.querySelectorAll('.category-item').forEach(item => {
            item.addEventListener('click', function () {

                document.querySelectorAll('.category-item').forEach(li => li.classList.remove('active'));
                this.classList.add('active');

                let categoryId = this.getAttribute('data-id');
                loadSubcategories(categoryId);
            });
        });

        // Load More
        document.getElementById('loadMoreBtn')?.addEventListener('click', function () {
            document.querySelectorAll('.extra-category').forEach(el => {
                el.classList.remove('d-none');
            });
            this.style.display = 'none';
        });

    });


    function loadSubcategories(categoryId) {
        fetch("{{ url('sell/get-subcategories') }}/" + categoryId)
            .then(response => response.json())
            .then(data => {

                if (!data.status) return;

                document.getElementById('categoryTitle').innerHTML =
                    data.category + ' <span>({{ __('lang.website.all_subcategory') }})</span>';

                let container = document.getElementById('subcategoryContainer');
                container.innerHTML = '';

                if (data.subcategories.length === 0) {
                    container.innerHTML = `<p>{{ __('lang.website.no_subcategories_found') }}</p>`;
                    return;
                }

                data.subcategories.forEach(sub => {

                    let url = "{{ url('sell/add-listing') }}/" +
                        data.category_id + "/" + sub.id;

                    container.innerHTML += `
              <div class="col-md-4 mb-4">
                  <ul>
                      <li>
                          <a href="${url}">
                              <div class="category-product">
                                  <img src="{{ asset('uploads/category') }}/${sub.image ?? 'default.png'}">
                              </div>
                              <span>${sub.name}</span>
                          </a>
                      </li>
                  </ul>
              </div>
          `;
                });
            });
    }
</script>
<script>
    const isLoggedIn = {{ Auth::guard('web')->check() ? 'true' : 'false' }};
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).on('click', '.toggle-favorite', function (e) {

        e.preventDefault();
        e.stopPropagation();

        if (!isLoggedIn) {

            Swal.fire({
                icon: 'warning',
                title: '{{ __('lang.website.login_required') }}',
                text: '{{ __('lang.website.login_to_add_items_wishlist') }}',
                confirmButtonText: '{{ __('lang.website.login') }}',
                confirmButtonColor: '#CB6932'
            }).then((result) => {

                if (result.isConfirmed) {
                    $('#loginModal').modal('show');
                }

            });

            return;
        }

        let itemId = $(this).data('item');
        let button = $(this);
        let img = button.find('.favorite-img');

        let addIcon = button.data('add');
        let removeIcon = button.data('remove');

        $.ajax({
            url: "{{ route('item.favorite.toggle') }}",
            type: "POST",
            data: {
                item_id: itemId,
                _token: "{{ csrf_token() }}"
            },
            success: function (res) {

                if (res.status == 'added') {
                    img.attr('src', addIcon);
                }

                if (res.status == 'removed') {
                    img.attr('src', removeIcon);
                }

            }
        });
    });
</script>

<script>

    let map;
    let marker;
    let autocomplete;
    let geocoder;

    $(document).ready(function () {

        geocoder = new google.maps.Geocoder();

        let lat = localStorage.getItem('user_lat');
        let lng = localStorage.getItem('user_lng');
        let address = localStorage.getItem('user_address');

        if (lat && lng) {

            $('#currentLocation').text(localStorage.getItem('user_address'));

            initMap(parseFloat(lat), parseFloat(lng));

        } else {

            $('#myLocationEditModal').show();

            initMap(23.2599, 77.4126); // default Bhopal

        }

    });


    function initMap(lat, lng) {

        let center = { lat: lat, lng: lng };

        map = new google.maps.Map(document.getElementById("mapCanvas"), {
            zoom: 13,
            center: center,
            gestureHandling: "greedy"
        });

        marker = new google.maps.Marker({
            position: center,
            map: map,
            draggable: true
        });


        // Drag marker
        google.maps.event.addListener(marker, 'dragend', function () {

            let lat = marker.getPosition().lat();
            let lng = marker.getPosition().lng();

            getAddress(lat, lng);

        });


        // Click on map
        google.maps.event.addListener(map, 'click', function (event) {

            let lat = event.latLng.lat();
            let lng = event.latLng.lng();

            marker.setPosition(event.latLng);

            getAddress(lat, lng);

        });

    }

    function initAutocomplete() {

        let input = document.getElementById('mapLocationSearch');

        if (autocomplete) {
            return; // prevent duplicate binding
        }

        autocomplete = new google.maps.places.Autocomplete(input, {
            types: ['geocode'],
            componentRestrictions: { country: 'in' }
        });

        autocomplete.bindTo('bounds', map);

        autocomplete.addListener('place_changed', function () {

            let place = autocomplete.getPlace();

            if (!place.geometry) return;

            let lat = place.geometry.location.lat();
            let lng = place.geometry.location.lng();

            let location = { lat, lng };

            map.setCenter(location);
            map.setZoom(13);
            marker.setPosition(location);

            getAddress(lat, lng);
        });
    }

    function geocodeAddress(address) {

        geocoder.geocode({ address: address }, function (results, status) {

            if (status === "OK") {

                let lat = results[0].geometry.location.lat();
                let lng = results[0].geometry.location.lng();

                let location = { lat: lat, lng: lng };

                map.setCenter(location);
                map.setZoom(13);

                marker.setPosition(location);

                getAddress(lat, lng);

            } else {

                alert("Location not found");

            }

        });

    }


    $('#mapLocationSearch').on('keydown', function (e) {

        if (e.key === "Enter") {

            e.preventDefault();

            let address = $(this).val();

            if (address.length > 3) {

                geocodeAddress(address);

            }

        }

    });


    // Current location button
    $(document).on('click', '.curont-loc', function () {

        if (navigator.geolocation) {

            navigator.geolocation.getCurrentPosition(function (position) {

                let lat = position.coords.latitude;
                let lng = position.coords.longitude;

                let pos = { lat: lat, lng: lng };

                map.setCenter(pos);
                map.setZoom(13);

                marker.setPosition(pos);

                getAddress(lat, lng);

            });

        }

    });


    function getAddress(lat, lng) {

        let latlng = { lat: parseFloat(lat), lng: parseFloat(lng) };

        geocoder.geocode({ location: latlng }, function (results, status) {

            if (status === "OK" && results[0]) {

                let components = results[0].address_components;

                let area = '', city = '', state = '', country = '', pincode = '';

                components.forEach(function (component) {

                    let types = component.types;

                    // AREA (COLONY PRIORITY)
                    if (
                        types.includes("sublocality_level_1") ||
                        types.includes("sublocality") ||
                        types.includes("neighborhood")
                    ) {
                        area = component.long_name;
                    }

                    // fallback
                    if (!area && types.includes("locality")) {
                        area = component.long_name;
                    }

                    if (types.includes("locality")) {
                        city = component.long_name;
                    }

                    if (types.includes("administrative_area_level_1")) {
                        state = component.long_name;
                    }

                    if (types.includes("country")) {
                        country = component.long_name;
                    }

                    if (types.includes("postal_code")) {
                        pincode = component.long_name;
                    }
                });

                // FINAL CLEAN TEXT (OLX STYLE)
                let cleanAddress = area + (city ? ', ' + city : '');

                // UI update
                $('#mapLocationSearch').val(cleanAddress);
                $('#currentLocation').text(cleanAddress);

                // store structured
                localStorage.setItem('user_area', area);
                localStorage.setItem('user_city', city);
                localStorage.setItem('user_state', state);
                localStorage.setItem('user_country', country);
                localStorage.setItem('user_pincode', pincode);

                localStorage.setItem('user_address', cleanAddress);
                localStorage.setItem('user_lat', lat);
                localStorage.setItem('user_lng', lng);
            }

        });

    }

    // Save button
    $(document).on('click', '.save-button button', function () {

        let lat = marker.getPosition().lat();
        let lng = marker.getPosition().lng();
        let range = $('#kmRange').val();

        let area = localStorage.getItem('user_area');
        let city = localStorage.getItem('user_city');
        let state = localStorage.getItem('user_state');
        let pincode = localStorage.getItem('user_pincode');

        // store locally (already doing)
        localStorage.setItem('user_lat', lat);
        localStorage.setItem('user_lng', lng);
        localStorage.setItem('radius', range);

        // SEND TO BACKEND
        $.ajax({
            url: "{{ route('save.location') }}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                lat: lat,
                lng: lng,
                radius: range,
                area: area,
                city: city,
                state: state,
                pincode: pincode
            },
            success: function () {
                window.location.href="{{ url('/') }}";
                console.log("Location saved in session");
            }
        });

        $('#currentLocation').text(localStorage.getItem('user_address'));
        $('#myLocationEditModal').hide();
    });



    // Open modal again
    $('#openModalBtn').click(function () {

        $('#myLocationEditModal').show();

        let lat = localStorage.getItem('user_lat') || 23.2599;
        let lng = localStorage.getItem('user_lng') || 77.4126;

        // ADD THIS PART (restore slider)
        let savedRadius = localStorage.getItem('radius') || 20;

        $('#kmRange').val(savedRadius);
        $('#rangeValue').text(savedRadius + " KM");

        // update slider UI (gradient fill)
        setTimeout(() => {
            updateSliderBackground();
        }, 100);

        setTimeout(function () {

            initMap(parseFloat(lat), parseFloat(lng));

            // INIT AUTOCOMPLETE HERE
            initAutocomplete();

            // FIX: force focus
            $('#mapLocationSearch').focus();

        }, 500);

    });

    // Close modal
    $('#closeModalBtn').click(function () {
        $('#myLocationEditModal').hide();
    });
</script>

<script>
    $(document).ready(function () {

        function performSearch() {

            let keyword = $('input[name="search"]').val().trim();
            let category = $('.option').attr('data-type');

            let url = "{{ url('category-detail') }}/";

            url += category + "?search=" + encodeURIComponent(keyword);
            
            window.location.href = url;
        }

        // ENTER key search
        $('input[name="search"]').keypress(function (e) {
            if (e.which == 13) {
                e.preventDefault();
                performSearch();
            }
        });

        // Search icon click
        $('.search-button').click(function () {
            performSearch();
        });

    });
</script>

<!-- Check session -->
<script>
    $(document).ready(function () {

        let lat = localStorage.getItem('user_lat');
        let lng = localStorage.getItem('user_lng');
        let radius = localStorage.getItem('radius');

        // Only run if localStorage has data
        if (lat && lng) {

            $.ajax({
                url: "{{ route('check.session.location') }}",
                method: "GET",
                success: function (res) {

                    // If session missing → restore it
                    if (!res.exists) {

                        $.ajax({
                            url: "{{ route('save.location') }}",
                            method: "POST",
                            data: {
                                _token: "{{ csrf_token() }}",
                                lat: lat,
                                lng: lng,
                                radius: radius,
                                area: localStorage.getItem('user_area'),
                                city: localStorage.getItem('user_city'),
                                state: localStorage.getItem('user_state'),
                                pincode: localStorage.getItem('user_pincode')
                            },
                            success: function () {
                                console.log("Session restored from localStorage ✅");
                            }
                        });

                    }
                }
            });
        }
    });
</script>

<!-- load more category -->
<script>
    $(document).on('click', '#moreBtn', function (e) {

        e.stopPropagation();

        $('#moreCategories').slideToggle();

        let text = $(this).find('a').text();

        $(this).find('a').text(text == '+ '+"{{ __('lang.website.more') }}" ? '- '+"{{ __('lang.website.more') }}" : '+ '+"{{ __('lang.website.more') }}");
    });
</script>

<!-- Pakcage check -->
<script>
function handleSellClick() {

    let status = @json($packageCheck['status'] ?? false);
    let code   = @json($packageCheck['code'] ?? 'NO_PLAN');

    if (!status) {

        if (code === 'NO_PLAN') {
            Swal.fire({
                icon: 'warning',
                title: "{{ __('lang.website.no_active_plan') }}",
                text: "{{ __('lang.website.please_purchase_a_plan_to_add_listing') }}",
                confirmButtonText: "{{ __('lang.website.view_package') }}"
            }).then(() => {
                window.location.href = "{{ url('subscriptions') }}";
            });
        }

        if (code === 'LIMIT_OVER') {
            Swal.fire({
                icon: 'error',
                title: "{{ __('lang.website.limit_reached') }}",
                text: "{{ __('lang.website.your_plan_limit_is_over_please_upgrade_your_plan') }}",
                confirmButtonText: "{{ __('lang.website.upgrade_plan') }}"
            }).then(() => {
                window.location.href = "{{ url('subscriptions') }}";
            });
        }

        return false;
    }

    // Allowed
    window.location.href = "{{ url('sell') }}";
}
</script>