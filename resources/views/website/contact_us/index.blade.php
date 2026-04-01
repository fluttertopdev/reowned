@extends('website.layout.app')
@section('content')

<div class="container">
  <div class="brudcrum brudcrum-defrent">
    <ul>
      <li>Home</li>
      <li><img src="{{asset('website_assets/images/r-errow.png')}}"></li>
      <li><a href="#" class="active">Contact us</a></li>
    </ul>
  </div>
</div>



<div class="contact-saction">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="contact-saction-left">
          <h2>Contact us</h2>
          <p>Get in touch with us! whether you have questions, feedback, or just want to hello, our contact page is the
            gateway to reaching our team.</p>
          <ul>
            <li><a href="#"><img src="{{asset('website_assets/images/contact-icon-1.png')}}"></a></li>
            <li><a href="#"><img src="{{asset('website_assets/images/contact-icon-2.png')}}"></a></li>
            <li><a href="#"><img src="{{asset('website_assets/images/contact-icon-3.png')}}"></a></li>
            <li><a href="#"><img src="{{asset('website_assets/images/contact-icon-4.png')}}"></a></li>
            <li><a href="#"><img src="{{asset('website_assets/images/contact-icon-5.png')}}"></a></li>
          </ul>
          <div class="gamil-contact-btn">
            <a href="#"><img src="{{asset('website_assets/images/contact-sms.png')}}">{{setting('email')}}</a>
            <a href="tel:{{setting('contact_number1')}}"><img src="{{asset('website_assets/images/contact-call.png')}}"> {{setting('contact_number1')}}</a>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="contact-saction-right">
          <form id="contactForm" method="POST" action="{{ route('store-contact-us') }}">
              @csrf

              <div class="contact-from-row">
                  <label>Name</label>
                  <input type="text" name="name" placeholder="Enter name" />
              </div>

              <div class="contact-from-row">
                  <label>Email</label>
                  <input type="text" name="email" placeholder="Enter email" />
              </div>

              <div class="contact-from-row">
                  <label>Subject</label>
                  <input type="text" name="subject" placeholder="Enter subject" />
              </div>

              <div class="contact-from-row">
                  <label>Message</label>
                  <textarea name="message" placeholder="Enter message"></textarea>
              </div>

              <div class="submit-btn">
                  <button type="submit">Submit</button>
              </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="google-map-contact">
  <iframe
    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14664.93215615645!2d77.423294715146!3d23.234605431905!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x397c4269deb07df9%3A0xfee61a854a2e5374!2sMaharana%20Pratap%20Nagar%2C%20Bhopal%2C%20Madhya%20Pradesh!5e0!3m2!1sen!2sin!4v1744381241739!5m2!1sen!2sin"
    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
    referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>

<script>
    $('#contactForm').submit(function(e){

      let name = $('input[name="name"]').val().trim();
      let email = $('input[name="email"]').val().trim();
      let subject = $('input[name="subject"]').val().trim();
      let message = $('textarea[name="message"]').val().trim();

      let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

      if(name == ''){
          toastr.error('Name is required');
          e.preventDefault();
          return false;
      }

      if(email == ''){
          toastr.error('Email is required');
          e.preventDefault();
          return false;
      }

      if(!emailPattern.test(email)){
          toastr.error('Enter valid email');
          e.preventDefault();
          return false;
      }

      if(subject == ''){
          toastr.error('Subject is required');
          e.preventDefault();
          return false;
      }

      if(message == ''){
          toastr.error('Message is required');
          e.preventDefault();
          return false;
      }

  });
</script>

@endsection