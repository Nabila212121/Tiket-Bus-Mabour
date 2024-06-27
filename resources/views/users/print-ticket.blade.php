<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        h4 {
            margin: 0;
        }

        .w-full {
            width: 100%;
        }

        .w-half {
            width: 50%;
        }

        .margin-top {
            margin-top: 2.25rem;
        }

        .footer {
            font-size: 0.875rem;
            padding: 1rem;
            background-color: rgb(241 245 249);
        }

        table {
            width: 100%;
            border-spacing: 0;
        }

        table.products {
            font-size: 0.875rem;
        }

        table.products tr {
            background-color: rgb(96 165 250);
        }

        table.products th {
            color: #ffffff;
            padding: 0.5rem;
        }

        table tr.items {
            background-color: rgb(241 245 249);
        }

        table tr.items td {
            padding: 0.5rem;
        }

        .total {
            text-align: right;
            margin-top: 1rem;
            font-size: 0.875rem;
        }
    </style>
    <title>Invoice</title>
</head>

<body>
    <table class="w-full">
        <tr>
            <td class="w-half">
                <img src="data:image/png;base64,{!! $logo !!}" alt="" width="200" />
            </td>
            <td class="w-half">
                <h2>Order ID: {{$ticket->order_id}}</h2>
            </td>
        </tr>
    </table>

    <div class="margin-top">
        <table class="w-full">
            <tr>
                <td class="w-half">
                    <img src="{!! $ticket->qr !!}" height="150" width="150" alt="">
                </td>
                <td class="w-half">
                    <div>
                        <h4>Detail Pesanan</h4>
                    </div>
                    <div><br></div>
                    <div><b>Bus</b> : {{$ticket->bus->name}}</div>
                    <div><b>Jadwal</b> : {{$ticket->departure_time->format('l, d F Y')}}. <b>({{$ticket->busSchedule->name}})</b>.</div>
                    <div><b>Nomor Kursi</b> : {{$ticket->seat_number}}</div>
                    <br>
                    <div>
                        <h4>Detail Pelanggan</h4>
                    </div>
                    <br>
                    <div><b>Nama Pemesan</b> : {{$ticket->customer_name}}</div>
                    <div><b>Email</b> : {{$ticket->user->email}}</div>
                </td>
            </tr>
        </table>
    </div>

    <br><br>

    <div class="footer margin-top">
        <div>Thank you</div>
        <div>&copy; Dishub Kota Madiun</div>
    </div>
</body>

</html>