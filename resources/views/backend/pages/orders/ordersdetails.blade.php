@extends('backend.layouts.master')
@section('content')
<div class="card">
	<div class="card-header">
		<h3 class="card-title ">Transaction Id:- {{$orders->transaction_id}} ({{ ucfirst($orders->status) }})</h3>
		<div class="card-options">
			<a href="{{ url()->previous() }}" class="btn btn-sm btn-outline-primary"  data-toggle="tooltip" data-placement="right" title="" data-original-title="Go To Back"><i class="fa fa-mail-reply"></i></a>
		</div>
	</div>
	<div class="card-body">
		<div class="">
			<h4 class="mb-1"><strong>{{$orders->userDetails->fullname}}</strong>,</h4>
			<!-- This is the receipt for a payment of <strong>$450.00</strong> (USD) for your works -->
		</div>
		<div class="card-body pl-0 pr-0">
			<div class="row">
				<div class="col-sm-6">
					<span>Payment No.</span><br>
					<strong>{{$orders->transaction_id}}</strong>
				</div>
				<div class="col-sm-6 text-right">
					<span>Payment Date/Time</span><br>
					<strong>{{$orders->created_at}}</strong>
				</div>
			</div>
		</div>
		<div class="dropdown-divider"></div>
		<div class="row pt-4">
			<div class="col-lg-6 ">
				<p class="h3">Billing Address</p>
				<address>
					{{$orders->address}}, {{$orders->city}}, {{$orders->state}}, {{$orders->country}}
				</address>
			</div>
			<div class="col-lg-6 text-right">
				
			</div>
		</div>
		<div class="table-responsive push">
			<table class="table table-bordered table-hover">
				<tr class="">
					<th class="text-center ">S No.</th>
					<th>Product</th>
					<th class="text-center">Qty</th>
					<th class="text-right">Price</th>
					<th class="text-right">Amount</th>
				</tr>
				@foreach($orders->ordersDetails as $key => $allorderdetails)
				<tr>
					<td class="text-center">{{ $key+1 }}</td>
					<td>
						<p class="font-w600 mb-1">{{$allorderdetails->productDetails['product_title']}}</p>
					</td>
					<td class="text-center">{{$allorderdetails->quantity}}</td>
					<td class="text-right">{{$allorderdetails->product_price}}</td>
					<td class="text-right">{{$allorderdetails->total_amount}}</td>
				</tr>
				@endforeach
				<tr>
					<td colspan="4" class="font-w600 text-right">Subtotal</td>
					<td class="text-right">{{$orders->subtotal}}</td>
				</tr>
				<tr>
					<td colspan="4" class="font-w600 text-right">Total Discount</td>
					<td class="text-right">{{$orders->total_discount}}</td>
				</tr>
				<tr>
					<td colspan="4" class="font-w600 text-right">Tax Rate</td>
					<td class="text-right">{{$orders->total_tax}}</td>
				</tr>
				<tr>
					<td colspan="4" class="font-w600 text-right">Total</td>
					<td class="text-right">{{$orders->total}}</td>
				</tr>
				<tr>
					<td colspan="4" class="font-weight-bold text-uppercase text-right">Total Due</td>
					<td class="font-weight-bold text-right">0</td>
				</tr>
				<tr>
					{{ Form::open(array('route' => 'order-action', 'class'=> 'form-horizontal', 'autocomplete'=>'off')) }}
					@csrf
					{!! Form::hidden('id',$orders->id,array('class'=>'form-control')) !!}
					<td colspan="5" class="text-right">
						@if($orders->status != 'cancelled')
							@if($orders->status == 'pending')
								<button type="submit" name="submit" value="delivered" class="btn btn-secondary" ><i class="si si-paper-plane"></i>Deliver</button>
							@elseif($orders->status == 'delivered')
								<button type="submit" name="submit" value="confirmed" class="btn btn-primary"><i class="si si-wallet"></i>Confirm</button>
							@endif
							<button type="submit" name="submit" value="cancelled" class="btn btn-warning" ><i class="si si-printer"></i>Cancel</button>
						@endif
					</td>
					{{ Form::close() }}
				</tr>
			</table>
		</div>
		<p class="text-muted text-center">Thank you very much for doing business with us. We look forward to working with you again!</p>
	</div>
</div>

@endsection