<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Order Placed Successfully</title>
</head>

<body style="margin:0;padding:0;background-color:#ececec;">

    <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ececec">
        <tr>
            <td align="center" style="padding:30px 10px;">


                <table width="600" border="0" cellspacing="0" cellpadding="0"
                    style="background:#ffffff;border:1px solid #dddddd;">

                    <tr>
                        <td bgcolor="#0F172A" style="padding:30px;">

                            <table width="100%" border="0" cellspacing="0" cellpadding="0">

                                <tr>


                                    <td valign="middle">

                                        <div style="font-size:11px;color:#9FE1CB;font-weight:bold;letter-spacing:1px;">
                                            TECHZONE ELECTRONICS
                                        </div>

                                        <div
                                            style="font-size:34px;line-height:42px;font-weight:bold;color:#ffffff;padding-top:10px;">
                                            Order Placed Successfully!
                                        </div>

                                        <div style="font-size:14px;color:#c7e7df;padding-top:10px;">
                                            Thank you for shopping with TechZone.
                                        </div>

                                    </td>

                                </tr>

                            </table>

                        </td>
                    </tr>


                    <tr>
                        <td style="padding:25px 30px 10px 30px;">

                            <div style="font-size:16px;color:#111111;">
                                Hello,
                                <strong>{{ $order->name }}</strong>
                            </div>


                            <div style="font-size:13px;color:#666666;line-height:22px;padding-top:8px;">
                                Your order has been placed successfully and is now being processed.
                            </div>

                        </td>
                    </tr>


                    <tr>
                        <td style="padding:10px 30px 0 30px;">

                            <table width="100%" border="0" cellspacing="0" cellpadding="0">

                                <tr>

                                    <td width="48%" style="background:#f5f5f5;padding:15px;border:1px solid #eeeeee;">

                                        <div style="font-size:11px;color:#888888;text-transform:uppercase;">
                                            Order ID
                                        </div>

                                        <div style="font-size:22px;font-weight:bold;color:#111111;padding-top:5px;">
                                            #{{ $order->id }}
                                        </div>

                                    </td>

                                    <td width="4%"></td>

                                    <td width="48%" style="background:#f5f5f5;padding:15px;border:1px solid #eeeeee;">

                                        <div style="font-size:11px;color:#888888;text-transform:uppercase;">
                                            Total Amount
                                        </div>

                                        <div style="font-size:22px;font-weight:bold;color:#111111;padding-top:5px;">
                                            &#8377;{{ number_format($order->total_price, 2) }}
                                        </div>

                                    </td>

                                </tr>

                                <tr>
                                    <td height="10"></td>
                                </tr>

                                <tr>

                                    <td style="background:#f5f5f5;padding:15px;border:1px solid #eeeeee;">

                                        <div style="font-size:11px;color:#888888;text-transform:uppercase;">
                                            Payment Method
                                        </div>

                                        <div style="font-size:14px;font-weight:bold;color:#111111;padding-top:5px;">
                                            {{ ucfirst($order->payment_method) }}
                                        </div>

                                    </td>

                                    <td></td>

                                    <td style="background:#f5f5f5;padding:15px;border:1px solid #eeeeee;">

                                        <div style="font-size:11px;color:#888888;text-transform:uppercase;">
                                            Payment Status
                                        </div>

                                        @if(strtolower($order->payment_status) === 'paid')

                                            <div style="font-size:14px;font-weight:bold;color:#1a6b44;padding-top:5px;">
                                                &#9679; Paid
                                            </div>

                                        @else

                                            <div style="font-size:14px;font-weight:bold;color:#854F0B;padding-top:5px;">
                                                &#9679; {{ ucfirst($order->payment_status) }}
                                            </div>

                                        @endif

                                    </td>

                                </tr>

                            </table>

                        </td>
                    </tr>


                    <tr>
                        <td style="padding:30px 30px 0 30px;">

                            <div
                                style="font-size:11px;color:#888888;font-weight:bold;text-transform:uppercase;letter-spacing:1px;padding-bottom:10px;">
                                Product Details
                            </div>

                            <table width="100%" border="0" cellspacing="0" cellpadding="0"
                                style="border:1px solid #eeeeee;">

                                <tr bgcolor="#f7f7f7">

                                    <td
                                        style="padding:12px;font-size:11px;font-weight:bold;color:#888888;text-transform:uppercase;">
                                        Product
                                    </td>

                                    <td align="center"
                                        style="padding:12px;font-size:11px;font-weight:bold;color:#888888;text-transform:uppercase;">
                                        Qty
                                    </td>

                                    <td align="right"
                                        style="padding:12px;font-size:11px;font-weight:bold;color:#888888;text-transform:uppercase;">
                                        Price
                                    </td>

                                    <td align="right"
                                        style="padding:12px;font-size:11px;font-weight:bold;color:#888888;text-transform:uppercase;">
                                        Total
                                    </td>

                                </tr>

                                <tr>

                                    <td
                                        style="padding:14px;border-top:1px solid #eeeeee;font-size:13px;font-weight:bold;color:#111111;">
                                        {{ $order->product->name }}
                                    </td>

                                    <td align="center"
                                        style="padding:14px;border-top:1px solid #eeeeee;font-size:13px;color:#444444;">
                                        {{ $order->quantity }}
                                    </td>

                                    <td align="right"
                                        style="padding:14px;border-top:1px solid #eeeeee;font-size:13px;color:#444444;">
                                        &#8377;{{ number_format(optional($order->product)->price ?? 0, 2) }}
                                    </td>

                                    <td align="right"
                                        style="padding:14px;border-top:1px solid #eeeeee;font-size:13px;font-weight:bold;color:#111111;">
                                        &#8377;{{ number_format($order->total_price, 2) }}
                                    </td>

                                </tr>

                                <tr bgcolor="#fafafa">

                                    <td colspan="3" align="right"
                                        style="padding:12px;border-top:1px solid #dddddd;font-size:13px;font-weight:bold;color:#666666;">
                                        Amount Paid
                                    </td>

                                    <td align="right"
                                        style="padding:12px;border-top:1px solid #dddddd;font-size:16px;font-weight:bold;color:#0C444C;">
                                        &#8377;{{ number_format($order->total_price, 2) }}
                                    </td>

                                </tr>

                            </table>

                        </td>
                    </tr>


                    <tr>
                        <td style="padding:30px 30px 0 30px;">

                            <div
                                style="font-size:11px;color:#888888;font-weight:bold;text-transform:uppercase;letter-spacing:1px;padding-bottom:10px;">
                                Delivery Information
                            </div>

                            <table width="100%" border="0" cellspacing="0" cellpadding="0">

                                <tr>

                                    <td width="140"
                                        style="padding:10px 0;border-bottom:1px solid #eeeeee;font-size:13px;color:#666666;">
                                        Shipping Address
                                    </td>

                                    <td align="right"
                                        style="padding:10px 0;border-bottom:1px solid #eeeeee;font-size:13px;color:#111111;">
                                        {{ $order->address }},
                                        {{ $order->city }},
                                        {{ $order->state }}
                                        {{ $order->pincode }}
                                    </td>

                                </tr>

                                <tr>

                                    <td
                                        style="padding:10px 0;border-bottom:1px solid #eeeeee;font-size:13px;color:#666666;">
                                        Phone
                                    </td>

                                    <td align="right"
                                        style="padding:10px 0;border-bottom:1px solid #eeeeee;font-size:13px;color:#111111;">
                                        {{ $order->phone }}
                                    </td>

                                </tr>

                                <tr>

                                    <td style="padding:10px 0;font-size:13px;color:#666666;">
                                        Estimated Delivery
                                    </td>

                                    <td align="right"
                                        style="padding:10px 0;font-size:13px;font-weight:bold;color:#111111;">
                                        {{ \Carbon\Carbon::parse($order->created_at)->addDays(5)->format('M d') }}
                                        -
                                        {{ \Carbon\Carbon::parse($order->created_at)->addDays(7)->format('M d, Y') }}
                                    </td>

                                </tr>

                            </table>

                        </td>
                    </tr>


                    <tr>
                        <td style="padding:30px;">

                            <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#f0faf5"
                                style="border:1px solid #b6e5cf;">

                                <tr>

                                    <td style="padding:18px;">

                                        <div style="font-size:15px;font-weight:bold;color:#1a6b44;">
                                            Thank you for shopping with TechZone!
                                        </div>

                                        <div style="font-size:13px;color:#2e8a5a;line-height:22px;padding-top:5px;">
                                            We are preparing your order and you will receive another email
                                            once your order ships.
                                        </div>

                                    </td>

                                </tr>

                            </table>

                        </td>
                    </tr>


                    <tr>
                        <td bgcolor="#f7f7f7" style="padding:18px 30px;border-top:1px solid #eeeeee;">

                            <table width="100%" border="0" cellspacing="0" cellpadding="0">

                                <tr>

                                    <td style="font-size:11px;color:#999999;">
                                        TechZone Electronics — Mohali, Punjab, India
                                    </td>

                                    <td align="right" style="font-size:11px;color:#999999;">
                                        support@techzone.com
                                    </td>

                                </tr>

                            </table>

                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>

</html>