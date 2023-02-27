<html>
<head>
    <link rel="stylesheet" href="{{ public_path('css/app.css') }}" type="text/css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Guia</title>
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
        <div id="cart-print">

            <div class="invoice-header" >
                <div>
                    <img class="invoice-logo" src="{{public_path()}}/uploads/logo/{{$invoiceLogo}}" alt="Logo">
                </div>
                <h1 style="font-weight: normal; margin: 5px 0;">{{$appName}}</h1>
                <p style="margin: 5px 0;">@lang('custom.reporte_guia')</p>
                <h3 style="font-weight: normal; line-height: .5em; margin-bottom: 10px">@lang('custom.guide_name_mayus')</h3>
            </div>

            <div class="invoice-middle" style="padding: 5%;">
                <table style="border-collapse: collapse !important; width: 65% !important; line-height: .5em; margin-bottom: -1em;">
                    <tr>
                        <td>
                            <p>
                                <span class="font-weight-bold">@lang('custom.guide'):</span> {{$guide->name}}
                            </p>
                            <p>
                                <span class="font-weight-bold">@lang('custom.fecha_entrega'):</span> {{$guide->fecha_entrega}}
                            </p>
                            <p>
                                <span class="font-weight-bold">@lang('custom.delivery'):</span> {{$guide->deliveryName}}
                            </p>
                            <p>
                                <span class="font-weight-bold">@lang('custom.route'):</span> {{$guide->routeName}}
                            </p>
{{--                            <p> class="text-right"--}}
                            <p>
                                <span class="font-weight-bold">@lang('custom.observacion'):</span> {{$guide->observacion}}
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
                        <th class="text-left">@lang('default.invoice_id')</th>
                        <th class="text-left">@lang('custom.fecha_entrega')</th>
                        <th class="text-left">@lang('default.sold_to')</th>
                        <th class="text-right">@lang('default.total')</th>
                    </tr>
                    </thead>
                    <tbody style="font-size: x-small; font-weight: normal; font-style: normal;">
                    @foreach($orders as $item)
                        <tr>
                            <td class="cart-summary-table">{{$item->invoice_id}}</td>
                            <td class="text-left">{{$item->date}}</td>                            
                            <td class="text-left">{{$item->customerName}}</td>
                            <td class="text-right">{{$item->total}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <td class="font-weight-bold">@lang('default.total')</td>
                        <td></td>
                        <td></td>
                        <td class=" text-right">{{$guide->total}}</td>
                    </tr>
                    </tfoot>
                </table>
                <div class="mb-3" style="margin: 0px auto;">
                    
                </div>
                    <div style="page-break-after:always;"></div>
            </div>
        </div>

</div>
</body>
</html>