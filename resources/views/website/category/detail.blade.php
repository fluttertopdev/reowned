@extends('website.layout.app')
@section('content')

    <div class="container">
        <div class="brudcrum">
            <ul>
                <li><a href="{{url('/')}}">Home</a></li>
                <li><img src="{{asset('website_assets/images/r-errow.png')}}"></li>
                <li><a href="{{url('categories')}}">All categories</a></li>
                <li><img src="{{asset('website_assets/images/r-errow.png')}}"></li>
                <li class="active">{{ ucfirst($slug) ?? 'Search Result' }}</li>
            </ul>
        </div>
        <h2 class="title-page">{{ucfirst($slug)}} Category</h2>
        <div class="designer-row-box-saction">
            <div class="row">
                <div class="col-md-4">
                    <div class="categories-left-side">
                        <h4>Filters</h4>
                        <button class="filter"><img src="{{asset('website_assets/images/filter.png')}}"></button>

                        <div class="all-categories-dropdown onclick-button">
                            <span>All Category ({{count($category)}})
                                <img src="{{asset('website_assets/images/up-icon.svg')}}" class="up-icon"><img
                                    src="{{asset('website_assets/images/down-icon.svg')}}" class="down-icon">
                            </span>
                            <div class="dropdown-list">
                                <ul>
                                    @foreach($category as $row)
                                        <li class="inneronclick active">
                                            <a href="javascript:void(0)" class="inneronclick-disgine category-filter"
                                                data-slug="{{ $row->slug }}" data-name="{{ $row->name }}">
                                                {{ $row->name }} ({{ $row->items_count }})
                                                <span class="icon">+</span>
                                            </a>

                                            <div class="iner-dropdown">
                                                <ul class="categories-inner-list">

                                                    @foreach($row->children as $sub)
                                                        <li>
                                                            <a href="javascript:void(0)" class="subcategory-filter"
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
                            <span>Location
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
                             <span>Budget
                                <img src="{{asset('website_assets/images/up-icon.svg')}}" class="up-icon"><img
                                    src="{{asset('website_assets/images/down-icon.svg')}}" class="down-icon">
                            </span>

                            <div class="dropdown-list">
                                <ul>

                                    <div class="slider-container">

                                        <p class="range-label">Choose a range below</p>

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
                                        <input type="range" id="priceMin" min="0" max="{{ $maxPriceValue }}" step="500" value="0">
                                        <input type="range" id="priceMax" min="0" max="{{ $maxPriceValue }}" step="500" value="{{ $maxPriceValue }}">

                                    </div>

                                    <button id="applyPrice">Apply</button>
                                </ul>
                            </div>
                        </div>

                        <div class="all-categories-dropdown onclick-button">
                            <span>Date Posted
                                <img src="{{asset('website_assets/images/up-icon.svg')}}" class="up-icon"><img
                                    src="{{asset('website_assets/images/down-icon.svg')}}" class="down-icon">
                            </span>
                            <div class="dropdown-list">
                                <form>
                                    <div class="form-group">
                                        <input type="checkbox" id="alltime" name="date_filter" value="alltime">
                                        <label for="alltime">All time</label>
                                    </div>

                                    <div class="form-group">
                                        <input type="checkbox" id="today" name="date_filter" value="today">
                                        <label for="today">Today</label>
                                    </div>

                                    <div class="form-group">
                                        <input type="checkbox" id="week" name="date_filter" value="week"> 
                                        <label for="week">Last 7 days</label>
                                    </div>

                                    <div class="form-group">
                                        <input type="checkbox" id="month" name="date_filter" value="month"> 
                                        <label for="month">Last 30 days</label>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="all-categories-dropdown onclick-button">
                            <span>Nearby (KM Range)
                                <img src="{{asset('website_assets/images/up-icon.svg')}}" class="up-icon"><img
                                    src="{{asset('website_assets/images/down-icon.svg')}}" class="down-icon">
                            </span>
                            <div class="dropdown-list">
                                <div class="slider-container">
                                    <div class="slider-labels">
                                        <label id="rangeValue">20KM</label>
                                    </div>
                                    <input type="range" id="kmRange" min="0" max="100" value="20">
                                </div>
                                <div class="aply-button"><button class="apply-button">Apply</button></div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-8">
                    <div class="desginer-right-box home-apliances-right">
                        <div class="tabs">
                            <div class="tab-left-right">
                                <h5>{{count($items)}} Items</h5>
                                <div class="tab-right-box">
                                    <div class="short-by-btn">
                                        <div class="select">
                                            <div class="selectBtn" data-type="firstOption">Newest to oldest</div>
                                            <div class="selectDropdown">
                                                <div class="option sort-option" data-sort="low_to_high">Low to High</div>
                                                <div class="option sort-option" data-sort="high_to_low">High to Low</div>
                                                <div class="option sort-option" data-sort="oldest">Oldest to Newest</div>
                                                <div class="option sort-option" data-sort="newest">Newest to Oldest</div>
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
        let selectedCategory = '';

        $(document).on('click', '.sort-option', function () {

            let sort = $(this).data('sort');

            loadItems(sort);

        });


        $(document).on('click', '.category-filter, .subcategory-filter', function () {

            selectedCategory = $(this).data('slug');

            let name = $(this).data('name');

            addFilterTag(name);

            loadItems();

        });

        let priceRange = '';

        $(document).on('click', '.price-filter', function () {

            $('.price-filter').removeClass('active');
            $(this).addClass('active');

            priceRange = $(this).data('range');

            loadItems();
        });


        let minPrice = 0;
        let maxPrice = parseInt($('#priceMax').val());

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

        $('#applyPrice').click(function () {
            addFilterTag(`₹ ${minPrice} - ₹ ${maxPrice}`);
            loadItems();
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


        let selectedArea = '';

        $(document).on('click', '.area-filter', function () {

            $('.area-filter').removeClass('active');
            $(this).addClass('active');

            selectedArea = $(this).data('area');

            addFilterTag(selectedArea);

            loadItems();
        });

        let dateFilter = '';

        $(document).on('change', 'input[name="date_filter"]', function () {

            // only one checkbox active
            $('input[name="date_filter"]').not(this).prop('checked', false);

            if ($(this).is(':checked')) {

                dateFilter = $(this).val();

                let label = $(this).next('label').text();

                addFilterTag(label);

            } else {
                dateFilter = '';
            }

            loadItems();
        });

        
        let radius = 20;
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


        function loadItems(sort = '') {

            let url = window.location.pathname;

            let searchParams = new URLSearchParams();

            if (sort) searchParams.set('sort', sort);
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
                    $('#item-list').html(res);
                }
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


        function addFilterTag(name) {

            let tag = `
                <li class="filter-tag">
                    ${name}
                    <button class="remove-filter">
                        <img src="{{asset('website_assets/images/tage-close.png')}}">
                    </button>
                </li>`;

            $('#applied-filters').append(tag);
        }


        $(document).on('click', '.remove-filter', function () {

            $(this).closest('li').remove();

            // optional: reset all filters
            selectedCategory = '';
            selectedArea = '';
            priceRange = '';
            dateFilter = '';

            loadItems();
        });
    </script>
    <script>
        $(document).ready(function () {

            $('.inneronclick').on('click', function (e) {

                e.stopPropagation();

                let target = $(e.target);

                // CATEGORY CLICK
                if (target.closest('.category-filter').length) {

                    let el = target.closest('.category-filter');

                    let slug = el.data('slug');
                    let name = el.data('name');

                    selectedCategory = slug;

                    addFilterTag(name);
                    loadItems();

                }

                // SUBCATEGORY CLICK
                if (target.closest('.subcategory-filter').length) {

                    let el = target.closest('.subcategory-filter');

                    let slug = el.data('slug');
                    let name = el.data('name');

                    selectedCategory = slug;

                    addFilterTag(name);
                    loadItems();

                }

                // Dropdown toggle
                $('.iner-dropdown').removeClass('iner-dropdown-open');
                $('.inneronclick').removeClass('active');
                $('.icon').text('+');

                $(this).find('.iner-dropdown').addClass('iner-dropdown-open');
                $(this).addClass('active');
                $(this).find('.icon').text('-');

            });

        });
    </script>
    <script>
        $(document).ready(function () {
            $('.onclick-button').click(function (e) {
                e.stopPropagation(); // Prevent bubbling

                // Close others
                $('.onclick-button').not(this).removeClass('open-list-drop');

                // Toggle current
                $(this).toggleClass('open-list-drop');
            });

            // Optional: close if clicked outside
            $(document).click(function () {
                $('.onclick-button').removeClass('open-list-drop');
            });
        });
    </script>
@endsection