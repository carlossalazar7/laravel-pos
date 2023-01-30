<html>
<head>
    <link rel="stylesheet" href="{{ public_path('css/app.css') }}" type="text/css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body{
            font-family: -apple-system,DejaVu Sans, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
        }
        .font-weight-bold{
            font-weight: 700 !important;
        }
        .text-left{
            text-align: left !important;
        }
        .text-right{
            text-align: right !important;
        }
        .invoice-header{
            text-align: center !important;
            line-height: 1.5em;
        }
        .invoice-header .invoice-logo{
            max-width: 180px !important;
            height: auto !important;
            display: block !important;
            padding-bottom: 15px;
        }
        .invoice-middle{
            display: block;
            width: 70%;
            margin: 0px auto;
            overflow: hidden;
        }
        .invoice-table{
            display: block;
            width: 70%;
            margin: 0px auto;

        }
        .invoice-table .table{
            border-collapse: collapse !important;
            width: 100% !important;
            padding: 5px;
        }
        .invoice-table .table thead{
            border-top: 1px solid #bfbfbf;
            border-bottom: 1px solid #bfbfbf;
        }
        .invoice-table .table tfoot{
            border-top: 1px solid #bfbfbf;
            border-bottom: 1px solid #bfbfbf;
        }
        .invoice-table .table tr{
            border-bottom: 1px solid #bfbfbf !important;
        }
        .invoice-table .table tbody tr td{
            border-bottom: 1px solid #bfbfbf !important;
        }
        .invoice-table th,
        .invoice-table td{
            padding: 7px 0;
        }

    </style>
</head>
<body>
<div class="p-3">
    @foreach($orders as $order)
        <div id="cart-print">

            <div class="invoice-header" >
                <div>
                    <img class="invoice-logo" src="{{public_path()}}/uploads/logo/{{$invoiceLogo}}" alt="Logo">
                </div>
                <h1 style="font-weight: normal; margin: 5px 0;">{{$appName}}</h1>
                <p style="margin: 5px 0;">@lang('default.sales_receipt')</p>
                <h3 style="font-weight: normal; line-height: .5em; margin-bottom: 10px">@lang('default.invoice')</h3>
            </div>

            <div class="invoice-middle" style="padding: 5%;">
                <table style="border-collapse: collapse !important; width: 65% !important; line-height: .5em; margin-bottom: -1em;">
                    <tr>
                        <td>
                            <p>
                                <span class="font-weight-bold">@lang('default.invoice_id'):</span> {{$order->invoice_id}}
                            </p>
                            <p>
                                <span class="font-weight-bold">@lang('default.sold_to'):</span>
                                @if($order->customer!=null){
                                {{$order->customers->customer_name}}
                                }
                                @endif
                            </p>
                            <p>
                                <span class="font-weight-bold">@lang('default.sold_by'):</span> {{$order->created_by_name}}
                            </p>
{{--                            <p> class="text-right"--}}
                            <p>
                                <span class="font-weight-bold">@lang('default.date') :</span> {{$order->date}}
                            </p>
                        </td>
{{--                        <td></td>--}}
                    </tr>
                </table>
            </div>

            <div class="invoice-table" style="line-height: 1em;">
                <table class="table product-card-font">
                    <thead>
                    <tr style="font-size: small">
                        <th class="text-left">@lang('default.item')</th>
                        <th class="text-right">@lang('default.qty')</th>
                        <th class="text-right">@lang('default.price')</th>
                        <th class="text-right">@lang('default.discount')</th>
                        <th class="text-right">@lang('default.total')</th>
                    </tr>
                    </thead>
                    <tbody style="font-size: x-small; font-weight: normal; font-style: normal;">
                    @foreach($order->orderItems as $item)
                        <tr>
                            <td class="cart-summary-table">{{$item->title}}</td>
                            <td class="text-right">{{$item->quantity*(-1)}}</td>
                            <td class="text-right">{{$item->price}}</td>
                            <td class="text-right">{{$item->discount}}</td>
                            <td class="text-right">{{$item->total}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <td class="font-weight-bold">@lang('default.sub_total')</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class=" text-right">{{$order->sub_total}}</td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">@lang('default.total')</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-right">{{$order->total}}</td>
                    </tr>
                    <tr>
                        {{--                            <td class="font-weight-bold">{{$order->method}}</td>--}}
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-right">{{$order->total}}</td>
                    </tr>
                    <tr>
{{--                        <td class="font-weight-bold">@lang('default.due')</td>--}}
                        <td></td>
                        <td></td>
                        <td></td>
                        {{--                            <td class="cart-summary-table text-right ">{{$order->due}}</td>--}}
                    </tr>
                    </tfoot>
                </table>
                <div class="mb-3" style="margin: 0px auto;">
                    {!! DNS1D::getBarcodeHTML("$order->invoice_id", 'C128B') !!}
                </div>
                    <div style="page-break-after:always;"></div>
            </div>
        </div>
    @endforeach
</div>
</body>
</html>