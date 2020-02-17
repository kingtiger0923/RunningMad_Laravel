@extends('layouts.app')

@section('content')
<!--Begin Banner Section-->

<?php
  if( !isset($cur_month) ) {
    $cur_month = date('m');
    $cur_year  = date('y');
    $month_str = [
      "01" => "January",
      "02" => "February",
      "03" => "March",
      "04" => "April",
      "05" => "May",
      "06" => "June",
      "07" => "July",
      "08" => "August",
      "09" => "September",
      "10" => "October",
      "11" => "November",
      "12" => "December"
    ];
  }
?>

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
                        <div class="evidence-container" id="mycalendar">
                          
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

    <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
            <span class="close">&times;</span>
            <h2>Add Distance</h2>
            </div>
            <div class="modal-body">
                <div class="row"></div>
                <div class="row">
                    <div class="col-md-4">Activity</div>
                    <div class="col-md-8"></div>
                </div>
                <div class="row">
                    <div class="col-md-3">Amount</div>
                    <div class="col-md-2"><input type="text" style="width:100%;"/></div>
                    <div class="col-md-3">Kilometres</div>
                    <div class="col-md-1"></div>
                    <div class="col-md-2">Miles</div>
                    <div class="col-md-1"></div>
                </div>
                <div class="row">
                    <div class="col-md-6">Upload Screenshot</div>
                    <div class="col-md-6">Optional</div>
                </div>
                <div class="row">
                    <input type="textarea" />
                </div>
            </div>
            <div class="modal-footer">
            <h3>Modal Footer</h3>
            </div>
        </div>
    </div>
    
    <script type="text/javascript"> //Calendar Script
      var current_month = "<?php echo $month_str[$cur_month]; ?>";
      var current_year  = "<?php echo $cur_year; ?>";
      var Selected_date;
      var month_str = [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December"
      ];
      var modal = document.getElementById("myModal");
      var span = document.getElementsByClassName("close")[0];
      span.onclick = function() {
        modal.style.display = "none";
      }
      window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
      }

      function showPopup() {
        modal.style.display = "block";
      }

      $(document).ready(function(){
        Selected_date = new Date(current_month + " 1, " + current_year);
        update();
      });

      function update() {
        var text_html="";
        var i = 0, j = 0;
        var dayOfWeek = Selected_date.getDay();
        var Selected_Month= Selected_date.getMonth();
        var Selected_Year = Selected_date.getFullYear();
        var Order_Date = new Date("<?php echo $order->created_at ?>");
        //Caption
        text_html += '<h2>Evidence</h2><table id="calendar"><caption><div class="row"><div class="col-md-3" onclick="previousMonth();"></div><div class="col-md-6"><p class="calendar-caption">';
        if( Selected_Month < 9 ) text_html += '0';
        text_html += (Selected_Month + 1);
        text_html += '</p><p class="calendar-caption" style="color:#f47921; font-weight:bold;">';
        text_html += month_str[Selected_Month];
        text_html += '</p><p class="calendar-caption-year">';
        text_html += Selected_Year;
        text_html += '</p></div><div class="col-md-3"></div></div></caption>';
        text_html += '<tr class="weekdays"><th scope="col">Sunday</th><th scope="col">Monday</th><th scope="col">Tuesday</th><th scope="col">Wednesday</th><th scope="col">Thursday</th><th scope="col">Friday</th><th scope="col">Saturday</th></tr>';
        //End Caption

        //Days Start
        Selected_date.setDate(Selected_date.getDate() - dayOfWeek);
        for( i = 0; ; i ++ )
        {
            var nowDay = Selected_date.getDate();
            var nowMonth = Selected_date.getMonth();

            if( i % 7 == 0 ) {
                text_html += '<tr class="days">';
            }

            if( nowMonth != Selected_Month ) {
                text_html += '<td class="day other-month" onclick="ChangeDate(' + i + ');"><div class="date">' + nowDay + '</div></td>';
            } else {
                text_html += '<td class="day">';

                text_html += '<div class="day_activity">';
                    text_html += '<div class="row">';
                        text_html += '<div class="col-md-7 day_activity-title">Activity:';
                        text_html += '</div>';
                        text_html += '<div class="col-md-5 day_activity-value"> Cycling';
                        text_html += '</div>';
                    text_html += '</div>';
                    text_html += '<div class="row">';
                        text_html += '<div class="col-md-7 day_activity-title">Amount:';
                        text_html += '</div>';
                        text_html += '<div class="col-md-5 day_activity-value"> 13.1 Miles';
                        text_html += '</div>';
                    text_html += '</div>';
                    text_html += '<div class="row">';
                        text_html += '<div class="col-md-7 day_activity-title" style="font-size: 0.4em;">ScreenShot:';
                        text_html += '</div>';
                        text_html += '<div class="col-md-5 day_activity-value" style="border-bottom: none;"> Yes';
                        text_html += '</div>';
                    text_html += '</div>';
                text_html += '</div>';

                text_html += '<div class="row">'
                    text_html += '<div class="col-md-8">';
                        text_html += '<button type="button" class="btn btn-primary btn-order" onclick="showPopup();">Add Order</button>';
                    text_html += '</div>';
                    text_html += '<div class="col-md-4">';
                        text_html += '<div class="date">';
                        text_html += nowDay;
                        text_html += '</div>';
                    text_html += '</div>';
                text_html += '</div>';

                text_html += '</td>';
            }

            if( i % 7 == 6 ) {
                text_html += '</tr>';
            }
            
            if( i % 7 == 6 && i >= 20 && nowDay <= 7 ) break;

            Selected_date.setDate(Selected_date.getDate() + 1);
        }
        //Days End
        text_html += "</table>";
        $('#mycalendar').html(text_html);

        Selected_date.setDate(-10);
        Selected_date.setDate(1);
      }

      function ChangeDate(index) {
          if( index <= 10 )  { //Previous Month
            Selected_date.setDate(-10);
            Selected_date.setDate(1);
          } else { //Next Month
            Selected_date.setDate(45);
            Selected_date.setDate(1);
          }
          update();
      }

    </script>
</section><!--// End Dashboard Section -->
@endsection
