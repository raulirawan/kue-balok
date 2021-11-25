<!DOCTYPE html>
<html moznomarginboxes mozdisallowselectionprint>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kue Balok Batavia</title>
    <style type="text/css">
        html {
            font-family: "Verdana, Arial";
        }

        .content {
            width: 80mm;
            font-size: 12px;
            padding: 5px;
        }

        .title {
            text-align: center;
            font-size: 13px;
            padding-bottom: 5px;
            border-bottom: 1px dashed;
        }

        .head {
            margin-top: 5px;
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid;
        }

        table {
            width: 100%;
            font-size: 12px;
        }

        .thanks {
            margin-top: 10px;
            padding-top: 10px;
            text-align: center;
            border-top: 1px dashed;
        }

        .total {
            margin-top: 10px;
            padding-top: 10px;

            border-top: 1px dashed;
        }

        @media print {
            @page {
                width: 80mm;
                margin: 0mm;
            }
        }
    </style>
</head>
<!-- <body onload="window.print()"> -->

<body>

    <div class="content">
        <div class="title">
            <b>Kue Balok Batavia</b>
            <br>
            Jakarta Selatan
            <br>
            Jl. RS. Fatmawati Raya Kel No.11
            Jakarta 12450
        </div>

        <div class="head">
            <table>
                <tbody>
                    <tr>
                        <td>Invoice</td>
                        <td>:</td>
                        <td>#{{$transaction->invoice}}</td>
                    </tr>
                    <tr>
                        <td>Kasir</td>
                        <td>:</td>
                        <td>Fathan</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="transaction">
            <table>
                <thead>
                    <tr>
                        <th align="left">Menu</th>
                        <th align="left">Qty</th>
                        <th align="left">Price</th>
                    </tr>
                </thead>
                <tbody>
                   @foreach ($data as $item)
                        <tr>
                            <td style="max-width: 80px;">{{ $item->food->name }}</td>
                            <td>{{ $item->qty }}</td>
                            <td>{{ number_format($item->price) }}</td>
                        </tr>
                   @endforeach

                </tbody>
            </table>
        </div>


        <div class="total">
            <table>

                <tbody>
                    <tr>
                        <td style="width: 158px;">Total</td>
                        <td style="width: 44px;">{{ $total_qty }}</td>
                        <td align="right">{{ number_format($transaction->total_price) }}</td>
                    </tr>

                    <tr>
                        <td style="width: 158px;"></td>
                        <td style="width: 44px;">Cash</td>
                        <td align="right">{{ number_format($transaction->cash) }}</td>
                    </tr>
                    <tr>
                        <td style="width: 158px;"></td>
                        <td style="width: 44px;">Change</td>
                        <td align="right">{{ number_format($transaction->kembalian) }}</td>
                    </tr>


                </tbody>
            </table>
        </div>



        <div class="thanks">
            ---Thank You For Visiting---
            <br>
            Kue Balok Batavia
        </div>
    </div>
</body>

</html>
