@foreach($items as $item)

<div class="col-md-4 mb-4">
    <div class="total-add-box">
        <a href="{{ route('item.detail',$item->slug) }}">
            <img src="{{ isset($item->latestImage) ? url($item->latestImage?->image) : url('uploads/Image-not-found.png') }}" class="item-box-image">
        </a>

        <div class="total-add-box-text">

            <div class="add-text-left">
                {{ ucfirst($item->status == 1 ? 'Approved' : 'Under review') }}
            </div>
            <div class="add-text-right">
                <ul>
                   <li>
                        <a href="#">
                            <img src="{{asset('website_assets/images/eyea-add-1.png')}}">
                            <span>{{ $item->views ?? 0 }}</span>
                        </a>
                    </li>

                    <li>
                        <a href="#">
                            <img src="{{asset('website_assets/images/hart-add-2.png')}}">
                            <span>{{ $item->favorite_count ?? 0 }}</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="price-add">
                ₹{{ number_format($item->price) }}
            </div>

            <p>{{ $item->title }}</p>

        </div>        
    </div>
</div>

@endforeach