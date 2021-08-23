<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style type="text/css">
        html {
            font-family: sans-serif;
            line-height: 1.15;
            margin: 0;
        }
        body {
            font-family: Nikosh, sans-serif;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: left;
            background-color: #fff;
            font-size: 10px;
            margin: 36pt;
        }

        h4 {
            margin-top: 0;
            margin-bottom: 0.5rem;
        }

        p {
            margin-top: 0;
            margin-bottom: 1rem;
        }

        strong {
            font-weight: bolder;
        }

        img {
            vertical-align: middle;
            border-style: none;
        }

        table {
            border-collapse: collapse;
        }

        th {
            text-align: inherit;
        }

        h4, .h4 {
            margin-bottom: 0.5rem;
            font-weight: 500;
            line-height: 1.2;
        }

        h4, .h4 {
            font-size: 1.5rem;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
        }

        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }

        .table tbody + tbody {
            border-top: 2px solid #dee2e6;
        }

        .mt-5 {
            margin-top: 3rem !important;
        }

        .pr-0,
        .px-0 {
            padding-right: 0 !important;
        }

        .pl-0,
        .px-0 {
            padding-left: 0 !important;
        }

        .text-right {
            text-align: right !important;
        }

        .text-center {
            text-align: center !important;
        }

        .text-uppercase {
            text-transform: uppercase !important;
        }

        * {
            font-family: "DejaVu Sans";
        }

        body, h1, h2, h3, h4, h5, h6, table, th, tr, td, p, div {
            line-height: 1.1;
        }

        .party-header {
            font-size: 1.5rem;
            font-weight: 400;
        }

        .total-amount {
            font-size: 12px;
            font-weight: 700;
        }

        .border-0 {
            border: none !important;
        }
    </style>
{{--    <link rel="stylesheet" href="css/app.css">--}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-header">
                        <button  wire:click.prevent="addNew" class="btn btn-primary float-right"><i class="fa fa-plus-circle mr-1"></i> Add sell</button>
                        <p class="card-title">Manage your all sells</p>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        ল ফিচার যেমন যেকোন পোষ্ট এ লাইক,রিপোর্ট কমেন্ট করার সুবিধা পাবেন একদম হাতের মুঠোয়
                        – অফলাইন রিডিং, ইন্টারনেট না থাকলেও নিতে পারবেন প্রযুক্তিগত জ্ঞানের স্বাধ
                        – ডার্ক মুড , আপনার পছন্দের ফন্ট বাছাই এর সুবিধা
                        <div class="row table-responsive">
                            <table class="table table-bordered table-striped">

                                <thead>
                                <tr>
                                    <th><input type="checkbox" wire:model="selectall"></th>
                                    <th wire:click.prevent="FilterSerialize('product_id')">Product</th>
                                    <th wire:click.prevent="FilterSerialize('category_id')">Size</th>
                                    <th wire:click.prevent="FilterSerialize('quantity')">Quantity</th>
                                    <th wire:click.prevent="FilterSerialize('kg')">KG</th>
                                    <th wire:click.prevent="FilterSerialize('unit_price')">price</th>
                                    <th wire:click.prevent="FilterSerialize('total_price')">Total</th>
                                    <th wire:click.prevent="FilterSerialize('paid_price')">Paid</th>
                                    <th wire:click.prevent="FilterSerialize('due_price')">Due</th>
                                    <th wire:click.prevent="FilterSerialize('created_at')">Date</th>
                                    <th wire:click.prevent="FilterSerialize('price_status')">Paid Status</th>

                                </tr>
                                </thead>
                                <div class="progress"><div class="progress-bar" style="width:{{@$data['progressBar']}}%"></div></div>
                                <tbody>
                                @forelse($sells->reverse() as $key=>$sell)
                                    <tr  wire:key="row-{{ $sell->id }}">

                                        <td><input type="checkbox" value="{{ $sell->id }}" wire:model="selections"></td>
                                        <td class="text-capitalize"><a href="">{{ $sell->product->name }}</a></td>
                                        <td class="text-capitalize"><a href="">{{ $sell->category->name }}</a></td>
                                        <td class="text-capitalize">{{ $sell->quantity }}</td>
                                        <td class="text-capitalize">{{ $sell->kg }}</td>
                                        <td class="text-capitalize">{{ $sell->unit_price }}</td>
                                        <td class="text-capitalize">{{ $sell->total_price }}</td>
                                        <td class="text-capitalize">{{ $sell->paid_price }}</td>
                                        <td class="text-capitalize">{{ $sell->due_price }}</td>
                                        <td class="text-capitalize">{{ \Carbon\Carbon::parse($sell->created_at)->format('Y-m-d') }}</td>
                                        <td>
                                            <span class="text-capitalize badge @if($sell->price_status==='fullpaid') badge-success @elseif($sell->price_status==='subpaid') badge-warning @else badge-danger @endif ">{{ $sell->price_status }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <th class="text-center" colspan="12">No sell found</th>
                                @endforelse
                                <tr class="text-center">
                                    <th  colspan="7">Total</th>
                                    <td colspan="5">{{$data['total']}}</td>
                                </tr>
                                <tr class="text-center">
                                    <th colspan="7">Paid</th>
                                    <td colspan="5">{{$data['paid']}}</td>
                                </tr>
                                <tr class="text-center">
                                    <th colspan="7">Due</th>
                                    <td colspan="5">{{$data['due']}}</td>
                                </tr>
                                <tr class="text-center">
                                    <th colspan="4">Date</th>
                                    <th colspan="4">Amount</th>
                                    <th colspan="4">Due</th>
                                </tr>
                                @php
                                    $due = 0;
                                @endphp
                                @foreach($payments->reverse() as $payment)
                                    @php
                                        $due += $payment->amount;
                                        $due2 = $data['total']-$due;
                                    @endphp
                                    <tr class="text-center">
                                        <td colspan="4">{{$payment->created_at}}</td>
                                        <td colspan="4">{{$payment->amount}}</td>
                                        <td colspan="4">{{$due2}}</td>
                                    </tr>
                                @endforeach
                                <tr class="text-center">
                                    <td colspan="6">Total payment</td>
                                    <td colspan="6">{{$payments->sum('amount')}}</td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                        <div class="justify-content-center items-center row">
                            <div class="col-12"></div>
{{--                            {{ $payments->links() }}--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

</body>
</html>
