@extends('website.layout.app')
@section('content')

<div class="container">
  <div class="brudcrum brudcrum-defrent">
    <ul>
      <li>{{ __('lang.website.home_appliances') }}</li>
      <li><img src="{{asset('website_assets/images/r-errow.png')}}"></li>
      <li><a href="#" class="active">{{ __('lang.website.transaction') }}</a></li>
    </ul>
  </div>
</div>


<div class="edit-profile-saction">
  <div class="container">
    <div class="row">
      @include('website.profile_partial.menu')
      <div class="col-md-9">
        <div class="edit-profile-saction-right">
          <div class="transaction-box-saction">
            <div class="table-transction">
              <table>
                <tbody>
                  <tr>
                      <th>{{ __('lang.website.id') }}</th>
                      <th>{{ __('lang.website.package_detail') }}</th>
                      <th>{{ __('lang.website.payment_method') }}</th>
                      <th>{{ __('lang.website.transaction_id') }}</th>
                      <th>{{ __('lang.website.date') }}</th>
                      <th>{{ __('lang.website.price') }}</th>
                      <th>{{ __('lang.website.validity') }}</th>
                      <th>{{ __('lang.website.status') }}</th>
                  </tr>

                  @forelse($payments as $payment)
                      <tr>
                          <td>{{ $payment->id }}</td>

                          <td>{{ $payment->package_name }}</td>

                          <td>{{ ucfirst($payment->payment_gateway) }}</td>

                          <td>{{ $payment->transaction_id ?? '-' }}</td>

                          <td>{{ \Carbon\Carbon::parse($payment->created_at)->format('d M, Y') }}</td>

                          <td>
                              {{ $payment->currency == 'INR' ? '₹' : '$' }}
                              {{ number_format($payment->amount, 2) }}
                          </td>

                          <td>
                              @if($payment->matched_package && $payment->matched_package->start_date && $payment->matched_package->end_date)
                                  {{ \Carbon\Carbon::parse($payment->matched_package->start_date)
                                      ->diffInDays(\Carbon\Carbon::parse($payment->matched_package->end_date)) }} Days
                              @else
                                  -
                              @endif
                          </td>

                          <td>
                              @if($payment->payment_status == 'success')
                                  <button class="succeed-btn">{{ __('lang.website.success') }}</button>
                              @elseif($payment->payment_status == 'failed')
                                  <button class="fail-btn">{{ __('lang.website.failed') }}</button>
                              @else
                                  <button class="pending-btn">{{ __('lang.website.pending') }}</button>
                              @endif
                          </td>
                      </tr>
                  @empty
                      <tr>
                          <td colspan="7" class="text-center">{{ __('lang.website.no_transactions_found') }}</td>
                      </tr>
                  @endforelse
              </tbody>
              </table>
            </div>
            <div class="paginaction-table">
                <p>
                    {{ __('lang.website.showing') }} {{ $payments->firstItem() }} {{ __('lang.website.to') }} {{ $payments->lastItem() }} 
                    {{ __('lang.website.of') }} {{ $payments->total() }} {{ __('lang.website.entries') }}
                </p>

                {{ $payments->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection