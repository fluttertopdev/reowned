@extends('website.layout.app')
@section('content')

    <div class="container">
        <div class="brudcrum">
            <ul class="mt-3">
                <li><a href="{{url('/')}}">{{ __('lang.website.home') }}</a></li>
                <li><img src="{{asset('website_assets/images/r-errow.png')}}"></li>
                <li><a href="{{url('categories')}}">{{ __('lang.website.all_categories') }}</a></li>
                <li><img src="{{asset('website_assets/images/r-errow.png')}}"></li>
                <li class="active">{{ ucfirst($slug) ?? __('lang.website.search_result')  }}</li>
            </ul>
        </div>
        <h4 class="title-page">{{ucfirst($slug)}} {{__('lang.website.category')}} </h4>
        <div class="designer-row-box-saction">
            <div class="row">
                <div class="col-md-4" id="filterContainer">
                    <div class="categories-left-side">
                        <h4>{{ __('lang.website.filters') }}</h4>
                        <button class="filter"><img src="{{asset('website_assets/images/filter.png')}}"></button>

                        <div class="all-categories-dropdown onclick-button">
                            <span>{{ __('lang.website.all_category') }} ({{count($category)}})
                                <img src="{{asset('website_assets/images/up-icon.svg')}}" class="up-icon"><img
                                    src="{{asset('website_assets/images/down-icon.svg')}}" class="down-icon">
                            </span>
                            <div class="dropdown-list">
                                <ul>
                                    @foreach($category as $row)
                                        <li class="inneronclick active">
                                            <a href="javascript:void(0)" class="inneronclick-disgine category-filter {{ $selectedCategory == $row->slug ? 'active' : '' }}"
                                                data-slug="{{ $row->slug }}" data-name="{{ $row->name }}">
                                                {{ $row->name }} ({{ $row->items_count }})
                                                <span class="icon">+</span>
                                            </a>

                                            <div class="iner-dropdown">
                                                <ul class="categories-inner-list">

                                                    @foreach($row->children as $sub)
                                                        <li>
                                                            <a href="javascript:void(0)" class="subcategory-filter {{ $selectedCategory == $sub->slug ? 'active' : '' }}"
                                                                data-slug="{{ $sub->slug }}" data-name="{{ $sub->name }}">
                                                                {{ $sub->name }} ({{ $sub->items_count }})
                                                            </a>
                                                        </li>
                                                    @endforeach

                                                </ul>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="all-categories-dropdown onclick-button">
                            <span>{{ __('lang.website.location') }}
                                <img src="{{asset('website_assets/images/up-icon.svg')}}" class="up-icon"><img
                                    src="{{asset('website_assets/images/down-icon.svg')}}" class="down-icon">
                            </span>
                            <div class="dropdown-list">
                                <ul>

                                    @foreach($locations as $country => $states)
                                        <div>— {{ $country }}</div>

                                        @foreach($states as $state => $cities)
                                            <div style="margin-left:15px;">— {{ $state }}</div>

                                            @foreach($cities as $city => $areas)
                                                <div style="margin-left:30px;">— {{ $city }}</div>

                                                @foreach($areas as $area)
                                                    <div style="margin-left:45px;" 
                                                         class="area-filter" 
                                                         data-area="{{ $area['area'] }}">
                                                        {{ $area['area'] }} ({{ $area['count'] }})
                                                    </div>
                                                @endforeach

                                            @endforeach
                                        @endforeach
                                    @endforeach

                                </ul>
                            </div>
                        </div>

                        <div class="all-categories-dropdown onclick-button">
                             <span>{{ __('lang.website.budget') }}
                                <img src="{{asset('website_assets/images/up-icon.svg')}}" class="up-icon"><img
                                    src="{{asset('website_assets/images/down-icon.svg')}}" class="down-icon">
                            </span>

                            <div class="dropdown-list">
                                <ul>

                                    <div class="slider-container">

                                        <p class="range-label">{{ __('lang.website.choose_range') }}</p>

                                        <div class="price-values">
                                            <span id="minPrice">0</span>
                                            <span id="maxPrice">{{ $maxPriceValue }}</span>
                                        </div>

                                        <!-- Histogram -->
                                        <div class="price-bars">
                                            <span></span><span></span><span></span><span></span>
                                            <span></span><span></span><span></span><span></span>
                                            <span></span><span></span>
                                        </div>

                                        <!-- Active Track -->
                                        <div class="slider-track" id="sliderTrack"></div>

                                        <!-- Sliders -->
                                        <input type="range" id="priceMin"
                                               min="0"
                                               max="{{ $maxPriceValue }}"
                                               step="100"
                                               value="{{ $minPrice }}">

                                        <input type="range" id="priceMax"
                                               min="0"
                                               max="{{ $maxPriceValue }}"
                                               step="100"
                                               value="{{ $maxPrice }}">

                                    </div>

                                    <button id="applyPrice">{{ __('lang.website.apply') }}</button>
                                </ul>
                            </div>
                        </div>

                        <div class="all-categories-dropdown onclick-button">
                            <span>{{ __('lang.website.date_posted') }}
                                <img src="{{asset('website_assets/images/up-icon.svg')}}" class="up-icon"><img
                                    src="{{asset('website_assets/images/down-icon.svg')}}" class="down-icon">
                            </span>
                            <div class="dropdown-list">
                                <form>
                                    <div class="form-group">
                                        <input type="checkbox" id="alltime" name="date_filter" value="alltime">
                                        <label for="alltime">{{ __('lang.website.all_time') }}</label>
                                    </div>

                                    <div class="form-group">
                                        <input type="checkbox" id="today" name="date_filter" value="today"{{ $selectedDate == 'today' ? 'checked' : '' }}>
                                        <label for="today">{{ __('lang.website.today') }}</label>
                                    </div>

                                    <div class="form-group">
                                        <input type="checkbox" id="week" name="date_filter" value="week"{{ $selectedDate == 'week' ? 'checked' : '' }}>
                                        <label for="week">{{ __('lang.website.last_7_days') }}</label>
                                    </div>

                                    <div class="form-group">
                                       <input type="checkbox" id="month" name="date_filter" value="month"{{ $selectedDate == 'month' ? 'checked' : '' }}>
                                        <label for="month">{{ __('lang.website.last_30_days') }}</label>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="all-categories-dropdown onclick-button">
                            <span>{{ __('lang.website.nearby_km_range') }}
                                <img src="{{asset('website_assets/images/up-icon.svg')}}" class="up-icon"><img
                                    src="{{asset('website_assets/images/down-icon.svg')}}" class="down-icon">
                            </span>
                            <div class="dropdown-list">
                                <div class="slider-container">
                                    <div class="slider-labels">
                                        <label id="rangeValue">{{ $radiusValue }} KM</label>
                                    </div>
                                   <input type="range" id="kmRange" min="0" max="100" value="{{ $radiusValue }}">
                                </div>
                                <div class="aply-button"><button class="apply-button">{{ __('lang.website.apply') }}</button></div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-8">
                    <div class="desginer-right-box home-apliances-right">
                        <div class="tabs">
                            <div class="tab-left-right">
                                <h5>{{count($items)}} {{ __('lang.website.items') }}</h5>
                                <div class="tab-right-box">
                                    <div class="short-by-btn">
                                        <div class="select">
                                            <div class="selectBtn" data-type="firstOption">{{ __('lang.website.newest_to_oldest') }}</div>
                                            <div class="selectDropdown">
                                                <div class="option sort-option" data-sort="low_to_high">{{ __('lang.website.low_to_high') }}</div>
                                                <div class="option sort-option" data-sort="high_to_low">{{ __('lang.website.high_to_low') }}</div>
                                                <div class="option sort-option" data-sort="oldest">{{ __('lang.website.oldest_to_newest') }}</div>
                                                <div class="option sort-option" data-sort="newest">{{ __('lang.website.newest_to_oldest') }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="grid-list-button">
                                        <button class="list-view on active"><img
                                                src="{{asset('website_assets/images/list-btn.png')}}"></button>
                                        <button class="grid-view"><img
                                                src="{{asset('website_assets/images/grid-btn.png')}}"></button>
                                    </div>
                                </div>
                            </div>
                            <div class="cetagorey-tage">
                                <ul id="applied-filters"></ul>
                            </div>

                            <div id="tabs-content">
                                <div class="wrapper list">
                                    <div id="tab1" class="tab-content">
                                        <div class="body-tab">
                                            <div class="recommendations-saction-shop list-boxlayout">
                                                <div class="row" id="item-list">
                                                    @include('website.partial.item_card_list_account', ['items' => $items])
                                                </div>
                                            </div>
                                        </div>
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
        let selectedSort = '';
        let openDropdowns = [];
        let selectedCategory = "{{ $selectedCategory ?? '' }}";
        let selectedArea = "{{ $selectedArea ?? '' }}";
        let dateFilter = "{{ $selectedDate ?? '' }}";

        let minPrice = {{ $minPrice ?? 0 }};
        let maxPrice = {{ $maxPrice ?? 0 }};
        let radius = {{ $radiusValue ?? 20 }};

        $(document).on('click', '.sort-option', function () {

            selectedSort = $(this).data('sort');

            let text = $(this).text();
            $(this).closest('.select').find('.selectBtn').text(text);

            // highlight active (optional)
            $('.sort-option').removeClass('active');
            $(this).addClass('active');

            loadItems();
        });


        // CATEGORY CLICK → only toggle
        $(document).on('click', '.category-filter', function (e) {

            e.preventDefault();
            e.stopPropagation();

            let parent = $(this).closest('li');
            let dropdown = parent.children('.iner-dropdown');
            let icon = $(this).find('.icon');

            parent.siblings().find('.iner-dropdown').slideUp(200);
            parent.siblings().find('.icon').text('+');

            dropdown.stop(true, true).slideToggle(200);

            icon.text(icon.text() === '+' ? '-' : '+');
        });

        // SUBCATEGORY CLICK → apply filter
        $(document).on('click', '.subcategory-filter', function (e) {

            e.stopPropagation();

            selectedCategory = $(this).data('slug');

            let name = $(this).data('name');
            addFilterTag('category', name);

            loadItems();
        });

        let priceRange = '';

        $(document).on('click', '.price-filter', function () {

            $('.price-filter').removeClass('active');
            $(this).addClass('active');

            priceRange = $(this).data('range');

            loadItems();
        });

        $('#priceMin').on('input', function () {

            let val = parseInt($(this).val());

            if (val > maxPrice) {
                val = maxPrice;
                $(this).val(val);
            }

            minPrice = val;
            $('#minPrice').text(val);

            updateSliderTrack();
        });

        $('#priceMax').on('input', function () {

            let val = parseInt($(this).val());

            if (val < minPrice) {
                val = minPrice;
                $(this).val(val);
            }

            maxPrice = val;
            $('#maxPrice').text(val);

            updateSliderTrack();
        });

        $(document).ready(function () {

            minPrice = parseInt($('#priceMin').val());
            maxPrice = parseInt($('#priceMax').val());

            $('#minPrice').text(minPrice);
            $('#maxPrice').text(maxPrice);

            updateSliderTrack();
        });


        function updateSliderTrack() {

            let min = parseInt($('#priceMin').val());
            let max = parseInt($('#priceMax').val());
            let maxLimit = parseInt($('#priceMax').attr('max'));

            let percent1 = (min / maxLimit) * 100;
            let percent2 = (max / maxLimit) * 100;

            $('#sliderTrack').css({
                left: percent1 + '%',
                width: (percent2 - percent1) + '%'
            });
        }


        $(document).on('click', '.area-filter', function () {

            $('.area-filter').removeClass('active');
            $(this).addClass('active');

            selectedArea = $(this).data('area');

            addFilterTag('area', selectedArea);

            loadItems();
        });


        $(document).on('change', 'input[name="date_filter"]', function () {

            // only one checkbox active
            $('input[name="date_filter"]').not(this).prop('checked', false);

            if ($(this).is(':checked')) {

                dateFilter = $(this).val();

                let label = $(this).next('label').text();

                addFilterTag('date', label);

            } else {
                dateFilter = '';
            }

            loadItems();
        });


        $(document).ready(function () {
            radius = $('#kmRange').val();
        });

        $('#kmRange').on('input', function () {
            radius = $(this).val();
            $('#rangeValue').text(radius + ' KM');
        });

        $('.apply-button').click(function () {
            radius = $('#kmRange').val();

            addFilterTag(radius + ' KM');
            loadItems();
        });


        function loadItems() {

            // SAVE OPEN DROPDOWNS
            openDropdowns = [];

            $('.onclick-button.active').each(function () {
                let index = $('.onclick-button').index(this);
                openDropdowns.push(index);
            });

            let url = window.location.pathname;
            let searchParams = new URLSearchParams();

            if (selectedSort) {
                searchParams.set('sort', selectedSort);
            }
            if (selectedCategory) searchParams.set('slug', selectedCategory);
            if (priceRange) searchParams.set('price_range', priceRange);
            if (selectedArea) searchParams.set('area', selectedArea);
            if (dateFilter) searchParams.set('date_filter', dateFilter);

            searchParams.set('min_price', minPrice);
            searchParams.set('max_price', maxPrice);
            searchParams.set('radius', radius);

            $.ajax({
                url: url + '?' + searchParams.toString(),
                type: 'GET',
                success: function (res) {

                    $('#item-list').html(res.items);

                    let newFilters = $(res.filters).find('#filterContainer').html();
                    $('#filterContainer').html(newFilters);

                    initFiltersUI();
                    initPriceSlider();
                    initKmSlider();

                    // RESTORE DROPDOWN STATE
                    restoreDropdowns();
                    restoreSubcategories();
                }
            });
        }

        function restoreDropdowns() {

            $('.onclick-button').each(function (index) {

                if (openDropdowns.includes(index)) {

                    $(this).addClass('active');
                    $(this).children('.dropdown-list').show();

                }
            });
        }

        function restoreSubcategories() {

            if (selectedCategory) {

                let el = $(`[data-slug="${selectedCategory}"]`);

                let parentLi = el.closest('li');

                parentLi.children('.iner-dropdown').show();

                parentLi.find('.icon').text('-');
            }
        }

        $(document).ready(function () {
            initFiltersUI();
            initPriceSlider();
            initKmSlider();
        });


        function initFiltersUI() {

            // =========================
            // RESTORE CATEGORY ACTIVE
            // =========================
            if (selectedCategory) {
                $(`[data-slug="${selectedCategory}"]`).addClass('active');
            }

            // =========================
            // RESTORE AREA ACTIVE
            // =========================
            if (selectedArea) {
                $(`.area-filter[data-area="${selectedArea}"]`).addClass('active');
            }

            // =========================
            // RESTORE DATE FILTER
            // =========================
            if (dateFilter) {
                $(`input[name="date_filter"][value="${dateFilter}"]`).prop('checked', true);
            }

            // =========================
            // EVENTS
            // =========================

            $('.area-filter').off('click').on('click', function () {
                selectedArea = $(this).data('area');
                loadItems();
            });

            $('input[name="date_filter"]').off('change').on('change', function () {

                $('input[name="date_filter"]').not(this).prop('checked', false);

                if ($(this).is(':checked')) {
                    dateFilter = $(this).val();
                } else {
                    dateFilter = '';
                }

                loadItems();
            });
        }


       $(document).on('click', '.pagination a', function (e) {

            e.preventDefault();

            let url = $(this).attr('href');

            if (selectedCategory) url += '&slug=' + selectedCategory;
            if (priceRange) url += '&price_range=' + priceRange;
            if (selectedArea) url += '&area=' + selectedArea;
            if (dateFilter) url += '&date_filter=' + dateFilter;

            // IMPORTANT (missing)
            url += '&min_price=' + minPrice;
            url += '&max_price=' + maxPrice;
            url += '&radius=' + radius;

            $.ajax({
                url: url,
                success: function (res) {
                    $('#item-list').html(res);
                }
            });
        });


        function addFilterTag(type, name) {

            // remove existing same type
            $(`#applied-filters li[data-type="${type}"]`).remove();

            let tag = `
                <li class="filter-tag" data-type="${type}">
                    ${name}
                    <button class="remove-filter" data-type="${type}">
                        <img src="{{asset('website_assets/images/tage-close.png')}}">
                    </button>
                </li>`;

            $('#applied-filters').append(tag);
        }


        $(document).on('click', '.remove-filter', function () {

            let type = $(this).data('type');

            if (type === 'category') selectedCategory = '';
            if (type === 'area') selectedArea = '';
            if (type === 'price') {
                minPrice = 0;
                maxPrice = $('#priceMax').attr('max');
            }
            if (type === 'radius') radius = 20;
            if (type === 'date') dateFilter = '';

            $(this).closest('li').remove();

            loadItems();
        });

        function initPriceSlider() {

            let $min = $('#priceMin');
            let $max = $('#priceMax');

            if (!$min.length || !$max.length) return;

            // Set values from existing variables
            $min.val(minPrice);
            $max.val(maxPrice);

            $('#minPrice').text(minPrice);
            $('#maxPrice').text(maxPrice);

            // REMOVE OLD EVENTS
            $min.off('input');
            $max.off('input');

            // REBIND EVENTS
            $min.on('input', function () {

                let val = parseInt($(this).val());

                if (val > maxPrice) {
                    val = maxPrice;
                    $(this).val(val);
                }

                minPrice = val;
                $('#minPrice').text(val);

                updateSliderTrack();
            });

            $max.on('input', function () {

                let val = parseInt($(this).val());

                if (val < minPrice) {
                    val = minPrice;
                    $(this).val(val);
                }

                maxPrice = val;
                $('#maxPrice').text(val);

                updateSliderTrack();
            });

            // apply button
            $('#applyPrice').off('click').on('click', function () {
                addFilterTag('price', `₹ ${minPrice} - ₹ ${maxPrice}`);
                loadItems();
            });

            updateSliderTrack();
        }

        function initKmSlider() {

            let $km = $('#kmRange');

            if (!$km.length) return;

            $km.val(radius);
            $('#rangeValue').text(radius + ' KM');

            $km.off('input').on('input', function () {
                radius = $(this).val();
                $('#rangeValue').text(radius + ' KM');
            });

            $('.apply-button').off('click').on('click', function () {
                radius = $('#kmRange').val();
                addFilterTag('radius', radius + ' KM');
                loadItems();
            });
        }

        $(document).on('click', '.onclick-button > span', function (e) {

            e.preventDefault();
            e.stopPropagation();

            let parent = $(this).parent();

            parent.toggleClass('active');
            parent.children('.dropdown-list').stop(true, true).slideToggle(200);
        });

        $(document).on('click', '.dropdown-list', function (e) {
            e.stopPropagation();
        });
    </script>
@endsection