@extends('website.layout.app')
@section('content')

<div class="container">
  <div class="brudcrum brudcrum-defrent">
    <ul>
      <li>{{ __('lang.website.home') }}</li>
      <li><img src="{{asset('website_assets/images/r-errow.png')}}"></li>
      <li><a href="#" class="active">{{ __('lang.website.faqs') }}</a></li>
    </ul>
  </div>
</div>



<div class="about-us-saction">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2>{{ __('lang.website.faqs') }}</h2>
        <div class="row">
          @foreach($data->chunk(ceil($data->count()/2)) as $chunkIndex => $chunk)
            <div class="col-md-6">
              <div class="accordion" id="accordion{{$chunkIndex}}">
                  
                  @foreach($chunk as $index => $row)
                  <div class="accordion-item faq-saction">
                      <h2 class="accordion-header">
                          <button class="accordion-button collapsed"
                              data-bs-toggle="collapse"
                              data-bs-target="#collapse{{$chunkIndex.$index}}">
                              {{$row->title}}
                          </button>
                      </h2>

                      <div id="collapse{{$chunkIndex.$index}}"
                          class="accordion-collapse collapse"
                          data-bs-parent="#accordion{{$chunkIndex}}">
                          
                          <div class="accordion-body">
                              {!! $row->description !!}
                          </div>
                      </div>
                  </div>
                  @endforeach

              </div>
            </div>
          @endforeach
        </div>

      </div>
    </div>
  </div>
</div>
@endsection