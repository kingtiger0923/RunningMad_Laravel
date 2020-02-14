<html>
<head></head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<table style="border-collapse:collapse; margin:0;padding:0;width:100%;background-color:#dbdcdf; mso-table-lspace: 0;mso-table-rspace: 0;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" bgcolor="#dbdcdf" cellspacing="0" cellpadding="0" border="0" align="center">
	<tr>
		<td valign="top" align="center" height="30" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">&nbsp;</td>
	</tr>
	<tr>
		<td style="margin:0;padding:0;width:100%;border-top:0;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" valign="top" align="center">
			<table cellspacing="0" cellpadding="0" border="0" bgcolor="#FF7A00" style="mso-table-lspace: 0;mso-table-rspace: 0;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%; width: 100%; max-width: 700px;">
				<tr>
					<td valign="top" align="center" style="text-align:center; padding-top:20px; padding-bottom:15px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
						<a href="https://runningmad.co.uk/" style="display: inline-block;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" target="_blank"><img src="https://runningmad.co.uk/images/running-mad-email.png" alt="Running Mad" style="width: 180px;vertical-align: bottom;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;" width="180"></a>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td style="margin:0;padding:0;width:100%;border-top:0; mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" valign="top" align="center">
			<table width="100%" cellspacing="0" cellpadding="0" border="0" align="center" bgcolor="#ffffff" style="font-family:Arial, Helvetica, sans-serif; mso-table-lspace: 0;mso-table-rspace: 0;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%; width: 100%; max-width: 700px;">
				<tr>
					<td valign="top" align="center" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%; padding: 0 40px;">
						<table width="100%" cellspacing="0" cellpadding="0" border="0" align="center" style="mso-table-lspace: 0;mso-table-rspace: 0;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
							<tr>
								<td valign="top" align="center" height="50" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">&nbsp;</td>
							</tr>
							<tr>
								<td valign="top" align="center" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
									<h2 style="font-family:Arial, Helvetica, sans-serif;font-size:18px; line-height:22px; color:#888888; text-align:left; padding:0px 0 15px; margin:0px; font-weight: 700; mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">You have got a new order</h2>
									<p style="font-family:Arial, Helvetica, sans-serif;font-size:16px; line-height:18px; color:#888888; text-align:left; padding:0px; margin:0px; font-weight: 400; mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">You have received an order form <strong style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">@if(Auth::guest()) 
									{{$order['firstname']}} &nbsp; &nbsp;{{$order['lastname']}}
									@else
									@php $user = Auth::user(); @endphp
									{{$user->name}} 
									@endif</strong>. The order is as follows:</p>
								</td>
							</tr>

							<tr>
								<td valign="top" align="center" height="30" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">&nbsp;</td>
							</tr>
							<tr>
								<td valign="top" align="center" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
									<h2 style="font-family:Arial, Helvetica, sans-serif;font-size:18px; line-height:22px; color:#888888; text-align:left; padding:0px 0 15px; margin:0px; font-weight: 700;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
								          <!-- Order Reference: {{$donation_data[0]['reference']}} ({{date("j F Y")}}) -->
									</h2>
								</td>
							</tr>
							<tr>
								<td valign="top" align="center" height="30" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">&nbsp;</td>
							</tr>
							
							<tr>
								<td valign="top" align="center" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
									<table style="border-collapse: collapse; width: 100%; border-top: 1px solid #DDDDDD; border-left: 1px solid #DDDDDD; margin-bottom: 20px; color:#888888; mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
								      <tr>
								        <td style="font-size: 16px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; font-weight: bold; text-align: left; padding: 10px 7px; mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">Product</td>
								        <td style="font-size: 16px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; font-weight: bold; text-align: right; padding: 10px 7px; mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">Quantity</td>
								        <td style="font-size: 16px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; font-weight: bold; text-align: right; padding: 10px 7px; mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">Price</td>
								        <!-- <td style="font-size: 16px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; font-weight: bold; text-align: right; padding: 10px 7px;">Total</td> -->
								      </tr>
								      
										@php $total =0; $total_contribution =0; $total_coupon = 0; foreach($cart_data as $row){ 
										$total += ($row->qty*$row->price); 
										if($row->options->contribution)
										$total_contribution += $row->options->contribution;
										if($row->options->coupon)
										$total_coupon += $row->options->coupon;
										@endphp
								      <tr>
								        <td style="font-size: 16px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding:10px 7px; mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">{{$row->name}}
								        </td>
								        <td style="font-size: 16px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding: 10px 7px; mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">{{$row->qty}}
								        	
								        </td>
								        <td style="font-size: 16px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding: 10px 7px; mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
								        	<span style="float: left; width: 100%; mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">£{{$row->price}}</span>
								        	<span style="float: left; width: 100%; font-size: 12px; mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">Discount <span style="color:#FF7A00">-£{{$row->options->coupon}}</span></span>
								        	<span style="float: left; width: 100%; font-size: 12px; mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">Voluntary  £{{$row->options->contribution}}</span>
								        </td>
								        <!-- <td style="font-size: 16px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding: 10px 7px;">£{{$row->qty*$row->price}}
								        </td> -->
								      </tr>
								      @php } @endphp
								     <!--  <tr>
								        <td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding: 7px;" colspan="4"><b>Sub-Total:</b></td>
								        <td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding: 7px;">£16</td>
								      </tr>
								      <tr>
								        <td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding: 7px;" colspan="4"><b>Free Shipping:</b></td>
								        <td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding: 7px;">£0.00</td>
								      </tr> -->
								      <tr>
								        <td style="font-size: 16px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding: 10px 7px; mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" colspan="2"><b>Subtotal:</b></td>
								        <td style="font-size: 16px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding: 10px 7px; mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">£{{$total}}</td>
								      </tr>
								      <tr>
								        <td style="font-size: 16px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding: 10px 7px; mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" colspan="2"><b style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">Shipping:</b></td>
								        <td style="font-size: 16px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding: 10px 7px; mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">£0</td>
								      </tr>
								      <tr>
								        <td style="font-size: 16px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding: 10px 7px; mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" colspan="2"><b>Promo discount:</b></td>
								        <td style="font-size: 16px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding: 10px 7px; mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;"><span style="color:#FF7A00">-£{{$total_coupon}}</span></td>
								      </tr>
								      <tr>
								        <td style="font-size: 16px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding: 10px 7px; mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" colspan="2"><b>Voluntary contribution:</b></td>
								        <td style="font-size: 16px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding: 10px 7px; mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;"><span style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">£{{$total_contribution}}</span></td>
								      </tr>
								      <tr>
								        <td style="font-size: 16px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding: 10px 7px; mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" colspan="2"><b>Total:</b></td>
								        <td style="font-size: 16px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding: 10px 7px; mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">£{{($total+$total_contribution)-$total_coupon}}</td>
								      </tr>
								  </table>
									
								</td>
							</tr>

							<tr>
								<td valign="top" align="center" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
									<table width="100%" cellspacing="0" cellpadding="0" border="0" style="border-collapse: collapse; border-top: 1px solid #DDDDDD; border-left: 1px solid #DDDDDD; margin-bottom: 20px; mso-table-lspace: 0;mso-table-rspace: 0;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
								      <tr>
								        <td style="font-size: 16px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; font-weight: bold; text-align: left; padding: 10px 7px; color: #888888; width: 50%; mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">Billing address</td>
								        <td style="font-size: 16px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; font-weight: bold; text-align: left; padding: 10px 7px; color: #888888; width: 50%; mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">Shipping address</td>
								      </tr>
								      <tr>
								        <td style="font-size: 16px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 10px 7px; width: 50%; color: #888888; mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
								          <!-- <b>Order No:</b> {{$orderid}}<br> -->
										    @if(Auth::guest()) 
												{{$order['firstname']}} {{$order['lastname']}}
												@else
												@php $user = Auth::user(); @endphp
												{{$user->name}} 
											@endif, <br>
								            {{$donation_data[0]['address']}},<br>
								            {{$donation_data[0]['city']}},<br>
								            {{$donation_data[0]['postcode']}},<br>
								            {{$donation_data[0]['country']}}.<br>
								            {{$donation_data[0]['email']}}<br>
								            {{$donation_data[0]['phone']}}
								        </td>
								        <td style="font-size: 16px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 10px 7px; width: 50%; color: #888888; mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
									        @if(Auth::guest()) 
												{{$order['firstname']}} {{$order['lastname']}}
												@else
												@php $user = Auth::user(); @endphp
												{{$user->name}} 
											@endif, <br>
								            {{$donation_data[0]['delivery_address']}},<br>
								            {{$donation_data[0]['delivery_city']}},<br>
								            {{$donation_data[0]['delivery_postcode']}},<br>
								            {{$donation_data[0]['delivery_country']}}.<br>
								            {{$donation_data[0]['email']}}<br>
								            {{$donation_data[0]['phone']}}
								        </td>
								      </tr>
								  </table>
								</td>
							</tr>
							<!-- <tr>
								<td valign="top" align="center" style="font-size:16px; line-height:22px; color:#888888; text-align:left; padding:0px; margin:0px; font-weight: 400;">
									<p style="width: 80%;">Thank you for your order! We want to wish you the best of luck with this challenge and hope that you smash it!</p>
								</td>
							</tr> -->
							<tr>
								<td valign="top" align="center" height="25" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">&nbsp;</td>
							</tr>
							<tr>
								<td valign="top" align="center" style="font-size:16px; line-height:22px; color:#888888; text-align:left; padding:0px; margin:0px; font-weight: 400; padding-bottom: 15px; mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
									Happy Running!
								</td>
							</tr>
							<tr>
								<td valign="top" align="left" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
									<a href="https://runningmad.co.uk/" style="display: inline-block; padding-bottom: 20px; mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" target="_blank" ><img src="https://runningmad.co.uk/images/running-mad-email.png" alt="Running Mad" style="width: 180px; vertical-align: bottom;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;" width="180"></a>
								</td>
							</tr>
							<tr>
								<td valign="top" align="center" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%; padding: 0px;">
									<table width="100%" cellspacing="0" cellpadding="0" border="0" style="mso-table-lspace: 0;mso-table-rspace: 0;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
										<tr>
											<td valign="top" align="left" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
												<table cellspacing="0" cellpadding="0" border="0" style="width: 100%; text-align: left; margin-top: 15px; mso-table-lspace: 0;mso-table-rspace: 0;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
													<tr>
														<td valign="top" align="left" width="30" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;"><a href="https://www.facebook.com/runningmad.co.uk" target="_blank" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;"><img src="https://runningmad.co.uk/images/facebook-icon.png" alt="" style="vertical-align: bottom;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;"></a></td>
														<td valign="top" align="left" width="45" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;"><a href="https://twitter.com/runn1ngMad" target="_blank" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;"><img src="https://runningmad.co.uk/images/twitter-icon.png" alt="" style="vertical-align: bottom;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;"></a></td>
														<td valign="top" align="left" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
														<a href="https://www.instagram.com/runningmad.co.uk/" target="_blank" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;"><img src="https://runningmad.co.uk/images/instagram-icon.png" alt="" style="vertical-align: bottom;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;"></a>
														</td>
													</tr>
												</table>
											</td>
										</tr>							
									</table>
								</td>
							</tr>
							<tr>
								<td valign="top" align="center" height="50" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">&nbsp;</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td valign="top" align="center" height="100" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">&nbsp;</td>
	</tr>
</table>
</body>
</html>