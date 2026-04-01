@extends('website.layout.app')
@section('content')

<div class="container">
  <div class="brudcrum brudcrum-defrent">
    <ul>
      <li>Home appliances</li>
      <li><img src="{{asset('website_assets/images/r-errow.png')}}"></li>
      <li><a href="#" class="active">Transaction</a></li>
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
                      <th>ID</th>
                      <th>Package Detail</th>
                      <th>Payment Method</th>
                      <th>Transaction ID</th>
                      <th>Date</th>
                      <th>Price</th>
                      <th>Status</th>
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
                              @if($payment->payment_status == 'success')
                                  <button class="succeed-btn">Success</button>
                              @elseif($payment->payment_status == 'failed')
                                  <button class="fail-btn">Failed</button>
                              @else
                                  <button class="pending-btn">Pending</button>
                              @endif
                          </td>
                      </tr>
                  @empty
                      <tr>
                          <td colspan="7" class="text-center">No transactions found</td>
                      </tr>
                  @endforelse
              </tbody>
              </table>
            </div>
            <div class="paginaction-table">
                <p>
                    Showing {{ $payments->firstItem() }} to {{ $payments->lastItem() }} 
                    of {{ $payments->total() }} entries
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