@extends('layouts.app')

@section('content')
<!--Begin Banner Section-->
<section class="single-banner small-banner clear">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="title">
                    <h1>Order</h1>
                </div>
            </div>
        </div>
    </div>
</section><!--// End Banner Section -->
<!--Begin Dashboard Section -->
<section class="content-section order-section">
    <div class="container-fluid">
        <div class="row">
            <div class="order-content-wrap">
                <div class="col-sm-3 left-column">
                    <div class="white-content">
                        <h2>Customer Information</h2>
                        <div class="customer-info-wrap">
                            <span class="icon-wrap"><i class="far fa-user"></i></span>
                            <div class="customer-info">
                                @php $user = Auth::user();  @endphp
                                <h3>{{$user->name}}</h3>
                                <a href="mailto:{{$user->email}}" class="user-email">{{$user->email}}</a>
                                <span class="phone-number">Phone: <a href="tel:+{{$order->phone}}">+{{$order->phone}}</a></span>
                            </div>
                        </div>
                        <h2>Delivery Address</h2>
                        <div class="customer-info-wrap">
                            <span class="icon-wrap"><i class="fas fa-map-marker-alt"></i></span>
                            <div class="customer-info">
                                <h3>{{$user->name}}</h3>
                                <address>{{$order->delivery_address}},{{$order->delivery_city}}, {{$order->delivery_postcode}},{{$order->delivery_country}}</address>
                                <span class="phone-number">Phone: <a href="tel:+{{$order->phone}}">+{{$order->phone}}</a></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 mid-column">
                    <div class="white-content">
                        <!-- Begin Table Content -->
                        <div class="table-wrap">
                            <table class="table data-table userorderTable">
                                <thead>
                                    <tr>
                                        <th>Order no</th>
                                        <th>Product</th>
                                        <th>Product name</th>
                                        <th>Purchase date</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{$order->id}}</td>
                                        <td>
                                            <div class="thumb-wrap"><img src="{{URL::to('/')}}/storage/app/public/{{$order->raceId->image}}" alt=""></div>
                                        </td>
                                        <td>{{$order->raceId->title}}</td>
                                        <td>{{ Carbon\Carbon::parse($order->created_at)->format('j F Y ') }}</td>
                                        <td>{{$order->quantity}}</td>
                                        <td>£{{number_format((float)$order->amount, 2, '.', '')}}</td>
                                        <td>{{$order->status}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div><!--// End Table Content -->

                        <div class="order-total-wrap">
                            <ul>
                                <li>
                                    <span>Subtotal:</span>
                                    <span>£{{number_format((float)$order->amount*$order->quantity, 2, '.', '')}}</span>
                                </li>
                                <li>
                                    <span>Promo discount:</span>
                                    <span>-£{{number_format((float)$order->discount, 2, '.', '')}}</span>
                                </li>
                                <li>
                                    <span>Voluntary contribution:</span>
                                    <span>£{{number_format((float)$order->contribution, 2, '.', '')}}</span>
                                </li>
                               <!--  <li>
                                    <span>Shipping cost:</span>
                                    <span>£2</span>
                                </li> -->
                                <li  class="order-total-txt">
                                    <span>Total:</span>
                                    <span>£{{number_format((float)($order->amount*$order->quantity)+$order->contribution-$order->discount, 2, '.', '')}}</span>
                                </li>
                            </ul>
                        </div>
                        <div class="evidence-container">
                            <h2>Evidence</h2>
                            <ul>
                                @php $evidencefiles = json_decode($order->evidence, true); @endphp
                                @if($evidencefiles)
                                @foreach($evidencefiles as $efile)
                                <li>
                                    <div class="evidence-item-wrap">
                                        <div class="uploaded_image">
                                            @if (strpos($efile, 'pdf') !== false)
                                                <img src="{{URL::to('/')}}/images/pdf-placeholder.png" class="img-thumbnail" alt="Evidence">
                                                <a href="{{URL::to('/')}}/public/evidence/{{ $efile }}" download="{{ $efile}}"><span><i class="fas fa-download"></i></span> Download</a>
                                            @else
                                                <img src="{{URL::to('/')}}/public/evidence/{{ $efile }}" class="img-thumbnail"  alt="Evidence">
                                                <a href="{{URL::to('/')}}/public/evidence/{{ $efile }}" download>
                                                <span><i class="fas fa-download"></i></span> {{ __('voyager::generic.download') }}</a>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 right-column">
                    <div class="white-content">
                        <div class="order-page-status">
                            <div class="custom-row">
                                <div class="status-info">
                                    <div class="status-wrap">
                                        <span class="status-txt">Status :</span>
                                        <span class="active-status-txt">{{$order->status}}</span>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="custom-row">
                                <div class="payment-info">
                                    <h2>Payment information</h2>
                                    <div class="method-wrap">
                                        <span class="method-txt">Method</span>
                                        <span class="card-txt">Credit card (Visa, Mastercard, etc...)</span>
                                    </div>
                                </div>
                            </div> -->
                            <div class="custom-row">
                                <div class="evidence-browse-wrap">
                                    <h2>Upload your evidence:</h2>
                                    <form action="#" method="post" id="evidenceprocess" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                        <!-- Begin multiple files upload -->
                                        <div class="custom-row ">
                                            <div class="multiple-filesupload-container">
                                                <span class="btn btn-success fileinput-button">
                                                    <span>Select file</span>
                                                    <input type="file" name="files[]" id="files" multiple accept="image/jpeg, image/png, image/gif,"><br />
                                                    <input type="hidden" name="order_id" value="{{$order->id}}">
                                                    <input type="hidden" name="order_email" value="{{$order->email}}">
                                                </span>
                                                <output id="Filelist"></output>
                                            </div>
                                        </div>
                                        <!--// End multiple files upload  -->
                                        <div class="btn-wrap-row">
                                            <button type="submit" class="btn-wrap btnslideL"><span>Submit</span>
                                                <dfn class="loading-img evidence-loading-img"></dfn>
                                            </button>
                                        </div>
                                        <div class="custom-row">
                                            <div class="evidence-process-result"></div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!--// End Dashboard Section -->
@endsection
