@foreach($items as $item)

<div class="col-md-4 mb-4">
    <div class="total-add-box">
        <a href="{{ route('item.detail',$item->slug) }}">
            <img src="{{ isset($item->latestImage) ? url($item->latestImage?->image) : url('uploads/Image-not-found.png') }}" class="item-box-image">
        </a>

        <div class="total-add-box-text">

            <div class="add-text-left">
               @if($item->is_sold == 1)
                    <span class="badge bg-danger">Sold</span>
                @elseif($item->status == 0)
                    <span class="badge bg-warning">Under Review</span>
                @elseif($item->status == 1)
                    <span class="badge bg-success">Published</span>
                @elseif($item->status == 2)
                    <span class="badge bg-danger">Rejected</span>
                @endif
            </div>
            <div class="add-text-right">
                <ul>
                    @php
                        $encryptedId = Crypt::encrypt($item->id);
                    @endphp

                    <li>
                        <a href="{{ url('sell/edit-listing/'.$encryptedId) }}">
                            <i class="fa fa-pen"></i>
                        </a>
                    </li>

                    {{-- MARK AS SOLD --}}
                    @if($item->is_sold == 0)
                        <li>
                            <form action="{{ route('sell.item.markSold', $encryptedId) }}" method="POST" class="mark-as-sold-form">
                                @csrf
                                <button type="submit" style="border:none;background:none;">
                                    <i class="fa fa-check-circle text-success"></i>
                                </button>
                            </form>
                        </li>
                    @else
                        <li>
                            <span class="badge bg-danger">Sold</span>
                        </li>
                    @endif

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