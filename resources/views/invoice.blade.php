<!DOCTYPE html>
<html>

<head>

    <title>
        Invoice
    </title>

    <style>
        body {
            font-family: Helvetica, Arial, sans-serif;
            background: #fff;
            color: #000;
            margin: 0;
            padding: 10px;
            font-size: 12px;
            line-height: 1.5;
        }

        .top {
            width: 100%;
            margin-bottom: 45px;
        }

        .left {
            width: 50%;
            float: left;
        }

        .right {
            width: 50%;
            float: right;
            text-align: right;
        }

        .clear {
            clear: both;
        }

        .invoice-title {
            font-size: 34px;
            font-weight: 700;
            margin-bottom: 18px;
        }

        .small {
            font-size: 11px;
            line-height: 1.8;
            color: #222;
        }

       
        .bill-section {
            width: 100%;
            margin-top: 15px;
            margin-bottom: 30px;
            border: 1px solid #ddd;
            border-radius: 4px;
            display: table;
            table-layout: fixed;
            box-sizing: border-box;
        }

        .bill-left {
            display: table-cell;
            width: 45%;
            padding: 14px 18px;
            vertical-align: top;
        }

        .bill-right {
            display: table-cell;
            width: 55%;
            padding: 14px 18px;
            vertical-align: top;
            border-left: 1px solid #ddd;
        }

        .heading {
            font-size: 11px;
            font-weight: bold;
            margin-bottom: 10px;
        }

       
        .amount-due-wrap {
            margin-top: 10px;
            margin-bottom: 30px;
            padding: 14px 18px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background: #fafafa;
        }

        .amount-due-inner {
            display: table;
            width: 100%;
        }

        .amount-due-left {
            display: table-cell;
            vertical-align: middle;
        }

        .amount-due-text {
            font-size: 13px;
            color: #555;
            font-weight: normal;
            margin-right: 8px;
        }

        .amount-due-number {
            font-size: 22px;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .amount-due-right {
            display: table-cell;
            vertical-align: middle;
            text-align: right;
            font-size: 12px;
            color: #555;
            white-space: nowrap;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .items {
            margin-top: 20px;
        }

        .items th {
            text-align: left;
            border-bottom: 1px solid #000;
            padding: 10px 0;
            font-size: 11px;
            font-weight: bold;
        }

        .items td {
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
            vertical-align: top;
        }

        .text-right {
            text-align: right;
        }

        .summary {
            width: 300px;
            margin-left: auto;
            margin-top: 10px;
        }

        .summary td {
            padding: 7px 0;
            font-size: 12px;
        }

        .grand {
            font-size: 18px;
            
        }

        .footer {
            margin-top: 70px;
            font-size: 10px;
            color: #444;
        }

        
        .pay-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 4px;
        }

        .pay-table td {
            border: none;
            padding: 0px 0;
            font-size: 11px;
            vertical-align: top;
        }

        .pay-table .pay-label {
            width: 100px;
            color: #444;
        }

        .pay-table .pay-val {
            font-weight: normal;
            color: #111;
            text-align: center;
        }
    </style>

</head>

<body>

    @php

        $unitPrice = floatval($order->product->price);

        $qty = intval($order->quantity);

        $lineTotal = $unitPrice * $qty;

    @endphp


    <div class="top">

        <div class="left">

            <div class="invoice-title">
                Invoice
            </div>

            <div class="small">

                <strong>
                    Invoice number
                </strong>

                &nbsp;&nbsp;

                INV-{{ $order->id }}

                <br>

                <strong>
                    Date of issue
                </strong>

                &nbsp;&nbsp;

                {{ \Carbon\Carbon::parse($order->created_at)->format('M d, Y') }}

                <br>

                <strong>
                    Date due
                </strong>

                &nbsp;&nbsp;

                {{ \Carbon\Carbon::parse($order->created_at)->format('M d, Y') }}

                <br><br>

                <strong>
                    TechZone Electronics
                </strong>

                <br>

                Mohali, Punjab

                <br>

                India

                <br>

                support@techzone.com

                <br>

                IN GST 29ABCDE1234F1Z5

            </div>

        </div>


        <div class="right">

            <table align="right" cellpadding="0" cellspacing="0" style="width:auto;">

                <tr>

                    <td>
                        @php
                            $logo = public_path('logo.png');
                            $logoData = base64_encode(file_get_contents($logo));
                            $logoSrc = 'data:image/png;base64,' . $logoData;
                        @endphp

                        <img src="{{ $logoSrc }}" style="height:250px; margin-top:-75px;">

                    </td>

                </tr>

            </table>

        </div>

        <div class="clear"></div>

    </div>


   
    <div class="bill-section">

        <div class="bill-left">

            <div class="heading">
                BILL TO
            </div>

            <div class="small">

                {{ $order->name }}

                <br>

                {{ $order->address }}

                <br>

                {{ $order->city }},
                {{ $order->state }}

                <br>

                {{ $order->pincode }}

                <br>

                {{ $order->email }}

                <br>

                {{ $order->phone }}

            </div>

        </div>

        <div class="bill-right">

            <div class="heading">
                PAYMENT DETAILS
            </div>

            <table class="pay-table" cellpadding="0" cellspacing="0">

                <tr>
                    <td class="pay-label">Payment Method</td>
                    <td class="pay-val">{{ ucfirst($order->payment_method) }}</td>
                </tr>

                <tr>
                    <td class="pay-label">Payment Status</td>
                    <td class="pay-val">{{ ucfirst($order->payment_status) }}</td>
                </tr>

                <tr>
                    <td class="pay-label">Order ID</td>
                    <td class="pay-val">{{ $order->id }}</td>
                </tr>

            </table>

        </div>

    </div>


   
    <div class="amount-due-wrap">
        <div class="amount-due-inner">
            <div class="amount-due-left">
                <span class="amount-due-text">AMOUNT DUE</span>
                <span class="amount-due-number">{{ number_format($lineTotal, 2) }}</span>
            </div>
            <div class="amount-due-right">
                due {{ \Carbon\Carbon::parse($order->created_at)->format('M d, Y') }}
            </div>
        </div>
    </div>


    <table class="items">

        <thead>

            <tr>

                <th>
                    Description
                </th>

                <th>
                    Qty
                </th>

                <th class="text-right">
                    Unit price
                </th>

                <th class="text-right">
                    Amount
                </th>

            </tr>

        </thead>


        <tbody>

            <tr>

                <td>

                    <table cellpadding="0" cellspacing="0" style="width:100%;">

                        <tr>

                            <td style="
                                    width:90px;
                                    border:none;
                                    vertical-align:top;
                                ">

                                @php
                                    $productImage = public_path('storage/' . $order->product->image);

                                    $productImageData = base64_encode(file_get_contents($productImage));

                                    $productImageSrc = 'data:image/png;base64,' . $productImageData;
                                @endphp

                                <img src="{{ $productImageSrc }}" style="
        width:95px;
        height:72px;
        object-fit:cover;
        border-radius:10px;
        border:1px solid #ddd;
    ">

                            </td>


                            <td style="
                                    border:none;
                                    vertical-align:top;
                                ">

                                <strong style="
                                        font-size:13px;
                                        margin-left:8px;
                                    ">
                                    {{ $order->product->name }}
                                </strong>

                                <br><br>
                                <strong style="
                                        font-size:13px;
                                        margin-left:8px;
                                    ">
                                    {{ \Carbon\Carbon::parse($order->created_at)->format('M d') }}
                                    -
                                    {{ \Carbon\Carbon::parse($order->created_at)->addDays(7)->format('M d, Y') }}
                                </strong>
                            </td>

                        </tr>

                    </table>

                </td>


                <td>

                    {{ $qty }}

                </td>


                <td class="text-right">

                    {{ number_format($unitPrice, 2) }}

                </td>


                <td class="text-right">

                    {{ number_format($lineTotal, 2) }}

                </td>

            </tr>

        </tbody>

    </table>



    <div class="summary">

        <table>

            <tr>

                <td>
                    Subtotal
                </td>

                <td class="text-right">
                    {{ number_format($lineTotal, 2) }}
                </td>

            </tr>

            <tr>

                <td>
                    Total
                </td>

                <td class="text-right">
                    {{ number_format($lineTotal, 2) }}
                </td>

            </tr>

            <tr>

                <td class="grand">
                    Amount due
                </td>

                <td class="text-right grand">
                    {{ number_format($lineTotal, 2) }}
                </td>

            </tr>

        </table>

    </div>


</body>

</html>