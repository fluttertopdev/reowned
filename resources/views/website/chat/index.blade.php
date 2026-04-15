@extends('website.layout.app')
@section('content')

  <div class="container">
    <div class="brudcrum brudcrum-defrent">
      <ul>
        <li>{{ __('lang.website.home_appliances') }}</li>
        <li><img src="{{asset('website_assets/images/r-errow.png')}}"></li>
        <li><a href="#" class="active">{{ __('lang.website.chat') }}</a></li>
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
                <h4>{{ __('lang.website.chat') }}</h4>
                <div class="chat-icon"><button class="block-user"><img src="{{asset('website_assets/images/chat-icon.png')}}"></button>
                  <div class="block-user-list">
                    <span>{{ __('lang.website.blocked_users') }}</span>
                    <ul>
                      @forelse($blockedUsers as $b)
                      <li>
                        <img src="{{ $b->blockedUser->image ? asset('uploads/user/'.$b->blockedUser->image) : asset('uploads/default-user.png') }}">
                        <div class="name">{{ $b->blockedUser->name }}</div>

                        <button type="button" class="unblock-user" data-id="{{ $b->blocked_user_id }}">
                            {{ __('lang.website.unblock') }}
                        </button>
                      </li>
                      @empty
                      <li class="no-user">{{ __('lang.website.no_user_found') }}</li>
                      @endforelse
                    </ul>
                  </div>
                </div>
                <div class="tabs">
                  <ul id="tabs-nav">
                    <li class="active"><a href="#tab1">{{ __('lang.website.selling') }}</a></li>
                    <li><a href="#tab2">{{ __('lang.website.buying') }}</a></li>
                  </ul>
                  <div id="tabs-content">
                    <div id="tab1" class="tab-content">
                      <div class="selling-list">
                        <ul id="selling-list">
                            @forelse($selling as $chat)
                              <li>
                                <a href="javascript:void(0)" 
                                   class="open-chat" 
                                   data-userid="{{ $chat->buyer->id }}"
                                   data-id="{{ $chat->id }}"
                                   data-user="{{ $chat->buyer->name }}"
                                   data-item="{{ $chat->item->title }}"
                                   data-item-url="<a class='item-name-a' target='_blank' href='{{ url('item/detail/'.$chat->item->slug) }}'>{{ $chat->item->title }}</a>"
                                   data-image="{{ $chat->buyer->image ? asset('uploads/user/'.$chat->buyer->image) : asset('uploads/default-user.png') }}">

                                    <div class="selling-list-user">
                                        <img src="{{ $chat->buyer->image ? asset('uploads/user/'.$chat->buyer->image) : asset('uploads/default-user.png') }}">
                                    </div>

                                    <div class="selling-list-name">
                                        <span>{{ $chat->buyer->name }}</span>
                                        <p>{{ $chat->item->title }}</p>
                                        <p class="last-msg-load">
                                        {{ $chat->lastMessage->message ?? __('lang.website.no_message_yet') }}
                                        </p>
                                        
                                    </div>

                                    <div class="time-ago" data-time="{{ optional($chat->lastMessage)->created_at }}">
                                        {{ optional($chat->lastMessage)->created_at?->diffForHumans() }}
                                    </div>
                                    <span class="unread-count badge" style="display:none;"></span>

                                </a>
                              </li>
                            @empty
                            <li>{{ __('lang.website.no_selling_users_found') }}</li>
                            @endforelse
                          </ul>
                      </div>
                    </div>
                    <div id="tab2" class="tab-content">
                      <div class="selling-list">
                        <ul id="buying-list">
                          @forelse($buying as $chat)
                            <li>
                              <a href="javascript:void(0)" 
                                 class="open-chat" 
                                 data-id="{{ $chat->id }}"
                                 data-userid="{{ $chat->seller->id }}"
                                 data-user="{{ $chat->seller->name }}"
                                 data-item="{{ $chat->item->title }}"
                                 data-item-url="<a class='item-name-a' target='_blank' href='{{ url('item/detail/'.$chat->item->slug) }}'>{{ $chat->item->title }}</a>"
                                 data-image="{{ $chat->seller->image ? asset('uploads/user/'.$chat->seller->image) : asset('uploads/default-user.png') }}">

                                  <div class="selling-list-user">
                                      <img src="{{ $chat->seller->image ? asset('uploads/user/'.$chat->seller->image) : asset('uploads/default-user.png') }}">
                                  </div>

                                  <div class="selling-list-name">
                                      <span>{{ $chat->seller->name }}</span>
                                      <p>{{ $chat->item->title }}</p>
                                      <p class="last-msg-load">
                                        {{ $chat->lastMessage->message ?? __('lang.website.no_message_yet') }}
                                      </p>
                                  </div>

                                  <div class="time-ago" data-time="{{ optional($chat->lastMessage)->created_at }}">
                                      {{ optional($chat->lastMessage)->created_at?->diffForHumans() }}
                                  </div>
                                  <span class="unread-count badge" style="display:none;"></span>

                              </a>
                            </li>
                          @empty
                          <li>{{ __('lang.website.no_buying_users_found') }}</li>
                          @endforelse
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="chat-right-box">
                <div class="no-chat-content">
                  <img src="{{asset('website_assets/images/no-chat-icon.png')}}">
                  <span>{{ __('lang.website.no_chat_data_found') }}</span>
                  <p>{{ __('lang.website.start_conversation') }}</p>
                </div>
                <div class="meassage-box-right d-none">
                  <div class="meassage-box-header">
                    <div class="meassage-box-header-left">
                      <div class="meassage-profile-box"> 
                        <img id="chat-user-image" src="{{asset('website_assets/images/selling-user-3.png')}}">
                      </div>
                      <div class="meassage-profile-name-box">
                        <span id="chat-user-name"></span>
                        <p id="chat-item-title"></p>
                        <div class="typing-indicator" id="typing-box" style="display:none;">
                          <span>{{ __('lang.website.typing') }}</span>
                        </div>
                      </div>
                    </div>
                    <div class="meassage-box-header-right">
                      <button id="blockBtn">{{ __('lang.website.block') }}</button>
                    </div>
                  </div>
                  <div class="chat-meassge-box" id="chat-box"></div>
                  <input type="hidden" id="conversation_id">
                  <div class="type-meassge-box">
                      <textarea class="type-your" id="message" placeholder="{{ __('lang.website.type_a_message') }}"></textarea>
                      <button class="send-meassge" id="sendBtn">➤</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/laravel-echo/1.15.0/echo.iife.js"></script>

  <script>
    window.Echo = new Echo({
        broadcaster: 'pusher',
        key: 'a1eab551463d55ab34eb',
        cluster: 'ap2',
        forceTLS: true
    });
  </script>

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

  <script>
    let activeChat = null;

    // CLICK CHAT
    $(document).on('click','.open-chat',function(){

        activeChat = $(this).data('id');
        $('.open-chat').removeClass('active');
        $(this).addClass('active');
        $(this).find('.unread-count').text('').hide();

        $('#conversation_id').val(activeChat);

        // SET HEADER
        $('#chat-user-name').text($(this).data('user'));
        $('#chat-item-title').html("{{ __('lang.website.item_name') }}" + $(this).data('item-url'));
        $('#chat-user-image').attr('src', $(this).data('image'));

        $('.no-chat-content').hide();
        $('.meassage-box-right').removeClass('d-none').show();

        loadMessages();

        // REALTIME LISTENER
        if(window.currentChannel){
            window.Echo.leave(window.currentChannel);
        }

        window.currentChannel = 'chat.'+activeChat;

        window.Echo.channel(window.currentChannel)

        if(typeof window.Echo !== 'undefined'){

            window.Echo.channel('chat.'+activeChat)

            .listen('.MessageSent', (e) => {

              // ignore own message
              if(e.message.sender_id == {{ auth()->id() }}) return;

              appendMessage(e.message);

              updateChatListUI(e.message);

              // CALL SEEN API IMMEDIATELY
              $.post(base_url+'/chat/seen', {
                  _token: '{{ csrf_token() }}',
                  conversation_id: activeChat
              });

            })

            .listen('.typing', (e) => {
                if(e.user_id != {{ auth()->id() }}){
                    showTyping();
                }
            })


            .listen('.seen', (e) => {

              // update only unseen messages
              $('.my-msg').each(function(){
                  $(this).find('.seen-status').text('✔✔');
              });

            });

        }
    });

    // Inner chat time format
    function formatDateLabel(dateStr){

      let date = new Date(dateStr);
      let today = new Date();
      let yesterday = new Date();
      yesterday.setDate(today.getDate() - 1);

      let d1 = date.toDateString();
      let d2 = today.toDateString();
      let d3 = yesterday.toDateString();

      if(d1 === d2) return 'Today';
      if(d1 === d3) return 'Yesterday';

      return date.toLocaleDateString(undefined, {
          day: 'numeric',
          month: 'short',
          year: 'numeric'
      });
    }
    
    // Ui List Time format
    function updateAllTimes(){

      $('.time-ago').each(function(){

          let time = $(this).attr('data-time');
          if(!time) return;

          let msgTime = new Date(time);
          let now = new Date();

          let diff = Math.floor((now - msgTime)/1000);

          let text = 'Just now';

          if(diff > 60){
              let mins = Math.floor(diff/60);
              text = mins + ' min ago';

              if(mins > 60){
                  let hrs = Math.floor(mins/60);
                  text = hrs + ' hr ago';

                  if(hrs > 24){
                      let days = Math.floor(hrs/24);
                      text = days + ' day ago';
                  }
              }
          }

          $(this).text(text);

      });
    }

    setInterval(updateAllTimes, 30000);
    
    // Ready
    $(document).ready(function(){

      if(typeof window.Echo !== 'undefined'){

        window.Echo.channel('chat-global')

        .listen('.MessageSent', (e) => {

            // update LEFT PANEL ALWAYS
            updateChatListUI(e.message);

        });

      }

    });

    // UPDSTE CHAT UI
    function updateChatListUI(message){

      let chatItem = $('.open-chat[data-id="'+message.conversation_id+'"]');

      if(chatItem.length){

          // update last message
          chatItem.find('.last-msg-load').text(message.message);

          let badge = chatItem.find('.unread-count');

          // IF CHAT IS CURRENTLY OPEN → NO UNREAD
          if(message.conversation_id == activeChat){
              badge.text('').hide();
          }
          else if(message.sender_id == {{ auth()->id() }}){
              badge.text('').hide();
          }
          else{
              let count = parseInt(badge.text()) || 0;
              count++;
              badge.text(count).show();
          }

          // time update
          let timeBox = chatItem.find('.time-ago');

          // set new time
          let now = new Date();
          timeBox.text('Just now');
          timeBox.attr('data-time', now.toISOString());

          // move to top
          chatItem.closest('li').prependTo(chatItem.closest('ul'));
      }
    }

    // LOAD MESSAGES
    function loadMessages(){

      $.get(base_url+'/chat/messages/'+activeChat,function(res){

          let html='';
          let lastDate = '';

          res.messages.forEach(m=>{

            let msgDate = formatDateLabel(m.created_at);

            // show date divider
            if(lastDate !== msgDate){
                html += `<div class="chat-date">${msgDate}</div>`;
                lastDate = msgDate;
            }

            html += renderMsg(m);
          });

          $('#chat-box').html(html);
          scrollBottom();

          // HANDLE BLOCK UI
          if(res.blocked_by_me){

              // I blocked → show Unblock
              $('#blockBtn').text('{{ __('lang.website.unblock') }}').addClass('unblock-btn');

              // cannot send
              $('.type-meassge-box').html('<p style="line-height: 4px;margin-top: 12px;">{{ __('lang.website.you_blocked_this_user') }}</p>');

          } else {

              // I did not block → show Block
              $('#blockBtn').text('{{ __('lang.website.block') }}').removeClass('unblock-btn');

              // BUT if other blocked me → still cannot send
              if(res.blocked_by_other){
                   $('.type-meassge-box').html('<p style="line-height: 4px;margin-top: 12px;">You cannot reply to this conversation</p>');
              } else {
                  $('.type-meassge-box').show();
              }
          }

      });
    }

    // APPEND
    function appendMessage(m){
        $('#chat-box').append(renderMsg(m));
        scrollBottom();
    }

    // SEND
    $('#sendBtn').click(function(){

        let message = $('#message').val();

        if(!message.trim()) return;

        $.post(base_url+'/chat/send',{
            _token:'{{ csrf_token() }}',
            conversation_id:activeChat,
            message:message
        },function(res){

            appendMessage(res);
            updateChatListUI(res);

            $('#message').val('');
            loadChats();
        });
    });

    // SCROLL
    function scrollBottom(){
      let box = $('#chat-box')[0];
      box.scrollTop = box.scrollHeight;
    }

    // UNBLOCK
    $(document).on('click','.unblock-user',function(){
        let id = $(this).data('id');

        $.post(base_url+'/chat/unblock',{
            _token:'{{ csrf_token() }}',
            user_id:id
        },function(){
            location.reload();
        });
    });

    // Block
    $(document).on('click','#blockBtn',function(){

      let userId = $('.open-chat.active').data('userid');
      let isUnblock = $(this).hasClass('unblock-btn');

      let url = isUnblock ? '/chat/unblock' : '/chat/block';

      $.post(url,{
          _token:'{{ csrf_token() }}',
          user_id:userId
      },function(){

          if(isUnblock){
              toastr.success('{{ __('lang.website.user_unblocked') }}');
              setTimeout(() => location.reload(), 2000);
          } else {
              toastr.success('{{ __('lang.website.user_blocked') }}');
              setTimeout(() => location.reload(), 2000);
          }
      });

    });
    
    // OPen Chat UI
    let urlParams = new URLSearchParams(window.location.search);
    let openChatId = urlParams.get('open');

    if(openChatId){
        setTimeout(()=>{
            $('.open-chat[data-id="'+openChatId+'"]').click();
        }, 500);
    }
    
    // Seen/Unseen
    function renderMsg(m){

      let cls = m.sender_id == {{ auth()->id() }} ? 'my-msg':'other-msg';

      let seen = '';

      if(m.sender_id == {{ auth()->id() }}){
          seen = m.is_seen ? '✔✔' : '✔';
      }

      // FORMAT TIME
      let date = new Date(m.created_at);
      let time = date.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});

      return `
      <div class="${cls}" data-id="${m.id}">
          <div class="msg-text">${m.message}</div>
          <div class="msg-meta">
              <span class="msg-time">${time}</span>
              <span class="seen-status">${seen}</span>
          </div>
      </div>`;
    }

    let typingTimeout;

    $('#message').on('input', function(){

        clearTimeout(typingTimeout);

        $.post(base_url+'/chat/typing',{
            _token:'{{ csrf_token() }}',
            conversation_id:activeChat
        });

        typingTimeout = setTimeout(()=>{}, 1000);
    });

    function showTyping(){

      $('#typing-box').show();

      setTimeout(()=>{
          $('#typing-box').hide();
      },1500);
    }

    function loadChats(){

      $.get(base_url+'/chat/list', function(res){

          let sellingHtml = '';
          let buyingHtml = '';

          res.forEach(c=>{

              let user = (c.seller_id == {{ auth()->id() }}) ? c.buyer : c.seller;

              let item = c.item.title;
              let msg = c.last_message ? c.last_message.message : 'No message';

              let html = `
              <p>${msg}</p>`;

              if(c.seller_id == {{ auth()->id() }})
                  sellingHtml += html;
              else
                  buyingHtml += html;
          });

          $('#selling-list .last-msg-load').html(sellingHtml);
          $('#buying-list .last-msg-load').html(buyingHtml);
      });
    }
  </script>

@endsection