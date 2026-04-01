@extends('website.layout.app')
@section('content')

  <div class="container">
    <div class="brudcrum brudcrum-defrent">
      <ul>
        <li>Home appliances</li>
        <li><img src="{{asset('website_assets/images/r-errow.png')}}"></li>
        <li><a href="#" class="active">Chat</a></li>
      </ul>
    </div>
  </div>


  <div class="edit-profile-saction">
    <div class="container">
      <div class="row">
        @include('website.profile_partial.menu')
        <div class="col-md-9">
          <div class="edit-profile-saction-right">
            <div class="user-chat">

              <div class="user-chat-left-side">
                <h4>Chat</h4>
                <div class="tabs">
                  <ul id="tabs-nav">
                    <li class="active"><a href="#tab1">Selling</a></li>
                    <li><a href="#tab2">Buying</a></li>
                    <div class="chat-icon"><button class="block-user"><img src="{{asset('website_assets/images/chat-icon.png')}}"></button>
                      <div class="block-user-list">
                        <span>Blocked Users</span>
                        <ul>
                          <li><img src="{{asset('website_assets/images/selling-user-4.png')}}">
                            <div class="name">Marvin McKinney</div><button class="unblock-user">Unblock</button>
                          </li>
                          <li><img src="{{asset('website_assets/images/selling-user-5.png')}}">
                            <div class="name">Annette Black</div><button class="unblock-user">Unblock</button>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </ul>
                  <div id="tabs-content">
                    <div id="tab1" class="tab-content">
                      <div class="selling-list">
                        <ul>
                          <li><a href="#">
                              <div class="selling-list-user"><img src="{{asset('website_assets/images/selling-user-1.png')}}"></div>
                              <div class="selling-list-name"><span>Theresa Webb</span>
                                <p>iPhone 15 Pro max</p>
                              </div>
                              <div class="time-ago">2d</div>
                            </a></li>
                        </ul>
                      </div>
                    </div>
                    <div id="tab2" class="tab-content">
                      <div class="selling-list">
                        <ul>
                          <li><a href="#">
                              <div class="selling-list-user"><img src="{{asset('website_assets/images/selling-user-1.png')}}"></div>
                              <div class="selling-list-name"><span>Theresa Webb</span>
                                <p>iPhone 15 Pro max</p>
                              </div>
                              <div class="time-ago">2d</div>
                            </a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="chat-right-box">
                <div class="no-chat-content">
                  <img src="{{asset('website_assets/images/no-chat-icon.png')}}">
                  <span>No Chat data found</span>
                  <p>Start conversation</p>
                </div>
                <div class="meassage-box-right">
                  <div class="meassage-box-header">
                    <div class="meassage-box-header-left">
                      <div class="meassage-profile-box"><img src="{{asset('website_assets/images/search-button.png')}}"> <img
                          src="{{asset('website_assets/images/selling-user-3.png')}}" class="user-chat-box"></div>
                      <div class="meassage-profile-name-box"><span>Kristin Watson</span>
                        <p>iPhone 15 Pro max</p>
                      </div>
                    </div>
                    <div class="meassage-box-header-right"><button>Block</button></div>
                  </div>
                  <div class="chat-meassge-box">
                    <div class="no-conversation">
                      <span>No Conversation with seller yet!</span>
                      <p>You haven’t initiated any chat with the seller. Feel free to make your offer for this product or
                        start a direct chat with the seller!</p>
                      <a href="#">Make an offer</a>
                    </div>
                  </div>
                  <div class="type-meassge-box">
                    <button class="atteched-box"><img src="{{asset('website_assets/images/attechd.png')}}"></button>
                    <textarea placeholder="Type your message..." class="type-your"></textarea>
                    <button class="send-meassge"><img src="{{asset('website_assets/images/voices-record.png')}}"></button>
                  </div>
                </div>


              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    $(document).ready(function () {
      $('#tabs-nav a').on('click', function (e) {
        e.preventDefault(); // Prevent anchor default behavior

        var target = $(this).attr('href');

        if (target === '#tab2') {
          $('.chat-right-box').addClass('meassage-box');
        } else if (target === '#tab1') {
          $('.chat-right-box').removeClass('meassage-box');
        }
      });
    });
  </script>

  <script>
    const toggleBtn = document.querySelector('.block-user');
    const userList = document.querySelector('.block-user-list');

    toggleBtn.addEventListener('click', () => {
      toggleBtn.classList.toggle('open-add-user');

      if (toggleBtn.classList.contains('open-add-user')) {
        userList.classList.add('user-list-block');
      } else {
        userList.classList.remove('user-list-block');
      }
    });
  </script>

@endsection