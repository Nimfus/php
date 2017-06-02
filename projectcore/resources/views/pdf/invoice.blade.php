<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        body {
            font-size: 12px;
            padding: 0;
            color: black;
        }
        .header-section {
            height: 100px;
        }
        .logo {
            width: 270px;
            display: block;
            float: left;
            padding: 5px;
            background: lightgrey;
        }
        .logo > img {
            height: 80px;
        }
        .company-info {
            width: 200px;
            padding: 8px 8px 8px 25px;
            float: left;
        }
        .invoice-data-left, .invoice-data-right {
            padding-top: 8px;
            width: 110px;
            float: left;
        }
        .pull-right {
            text-align: right;
        }
        .company-name-section {
            display: block;
            width: 100%;
        }
        .company-name-section > h1 {
            font-size: 32px;
        }

        .bill-section, .charges-section {
            padding-top: 3px;
            height: 200px;
            width: 50%;
            float: left;
        }

        .bill-section {
            border-right: 1px solid black;
        }

        .charges-section {

        }

        .bill-section > .bill-to-section {
            height: 100px;
            float: left;
        }

        .bill-section > .notes-section {
            margin-top: 110px;
        }

        .bill-section > .bill-to-section > .bill-to{
            height: 100px;
            float: left;
        }

        .bill-section > .bill-to-section > .bill-data{
            height: 100px;
            float: left;
            padding-left: 60px;
            border-bottom: 1px solid black;
        }

        .charges-section > .first-column, .charges-section > .second-column, .charges-section > .third-column {
            height: 200px;
        }

        .charges-section > .first-column {
            width: 180px;
            padding-left: 370px;
            float: left;
        }

        .charges-section > .second-column {
            width: 100px;
            padding-left: 600px;
            float: left;
        }

        .charges-section > .second-column > hr {
            margin-top: 30px;
            margin-bottom: 13px;
        }

        .charges-section > .third-column {
            width: 100px;
            padding-left: 700px;
            float: left;
        }

        .charges-section > .third-column > hr {
            padding-right: 50px;
            margin-right: 70px;
            margin-top: 30px;
            margin-bottom: 13px;
        }

        .details-table {
            margin-top: 230px;
        }

        .details-table > .head-row {
            width: 720px;
            display: inline-block;
            border-top: 1px solid grey;
            border-bottom: 1px solid grey;
        }

        .details-table > .head-row > .table-cell {
            display: inline-block;
            width: 90px;
            border-right: 1px solid grey;
            padding: 5px 3px 5px 3px;
            font-weight: bold;
        }

        .details-table > .head-row > .table-cell:nth-child(1) {
            width: 170px;
            border-left: 1px solid grey;
        }

        .details-table > .head-row > .table-cell:nth-child(2) {
            width: 130px;
        }

        .details-table > .body-row {
            width: 720px;
            border-bottom: 1px solid grey;
        }

        .details-table > .body-row > .table-cell {
            display: inline-block;
            width: 90px;
            border-right: 1px solid grey;
            padding: 5px 3px 5px 3px;
            height: 420px;
            font-size: 10px;
        }

        .details-table > .body-row > .table-cell:nth-child(1) {
            width: 170px;
            border-left: 1px solid grey;
        }

        .details-table > .body-row > .table-cell:nth-child(2) {
            width: 130px;
        }

        .summary-table {
            margin-top: 15px;
            width: 720px;
            border: 1px solid grey;
            height: 20px;
        }

        .summary-table > .table-cell {
            display: inline-block;
            height: 20px;
            line-height: 17px;
            text-align: right;
        }

        .summary-table > .table-cell:nth-child(1) {
            width: 80%;
            border-right: 1px solid grey;
        }

        .summary-table > .table-cell:nth-child(2) {
            width: 20%;
            text-align: right;
        }

    </style>
</head>
<body>
<h1></h1>
<div class="container">
    <div class="header-section">
        <div class="logo">
            <img src="http://reviewtower.com/images/reviewtower.png">
        </div>
        <div class="company-info">
            Reputation Butler <br>
            Company address <br>
            Address line 2 <br>
            702-472-7200
        </div>
        <div class="invoice-data-left">
            <b>Invoice Date:</b>
            <b>Invoice Due Date:</b>
            <b>Invoice Number:</b>
        </div>
        <div class="invoice-data-right pull-right">
            {{ date('M/d/Y', $invoice->date) }}<br>
            {{ date('M/d/Y', $invoice->date) }}<br>
<!--            --><?//=substr(strtolower($user->business), 0, 3) . '-' . date('Y', $invoice->date) . '-10' . date('m', $invoice->date)?>
        </div>
    </div>
    <br>
    <div class="company-name-section pull-right">
        <h1>{{ config('app.name', 'Laravel') }} Invoice</h1>
    </div>
    <div class="bill-section">
        <div class="bill-to-section">
            <div class="bill-to">
                <strong>Bill To:</strong>
            </div>
            <div class="bill-data">

                US
            </div>
        </div>
        <div class="notes-section">
            <div class="bill-to">
                <strong>Bill To:</strong> &nbsp;&nbsp;&nbsp;&nbsp;Your payment was charged on <u>{{ date('M/d/Y', $invoice->date) }}</u>
            </div>
        </div>
    </div>
    <div class="charges-section">
        <div class="first-column">
            Current Charges <br>
            Account Details <br>
            Amount Charged to Credit Card
            <br>
            <br>
            <br>
            <br>
            <br>
            <strong style="line-height: 30px;">Total Current Charges</strong> <br>
            <strong>Account Balance</strong> <br>
            <p style="font-size: 10px;">as of {{ date('M/d/Y', $invoice->date) }}</p>
        </div>
        <div class="second-column">
            $ <br>
            $ <br>
            $
            <hr>
            <br>
            <strong style="line-height: 30px;">$</strong> <br>
            <strong>$</strong>
            <hr>
        </div>
        <div class="third-column">
            {{ number_format($invoice->amount_due / 100, 2, '.', ',') }} <br>
            (0.00) <br>
            ({{ number_format($invoice->amount_due / 100, 2, '.', ',') }})
            <hr>
            <br>
            <strong style="line-height: 30px;">{{ number_format($invoice->amount_due / 100, 2, '.', ',') }}</strong> <br>
            <strong>0.00</strong>
            <hr>
        </div>
    </div>

    <div class="details-table">
        <div class="head-row">
            <div class="table-cell">Service Items</div>
            <div class="table-cell">Date Range</div>
            <div class="table-cell">Unit Price</div>
            <div class="table-cell">Quantity</div>
            <div class="table-cell">Discount</div>
            <div class="table-cell">Total Due</div>
        </div>
        <div class="body-row">
            <div class="table-cell">30 days access to reviews monitoring on Reviewtower.com</div>
            <div class="table-cell">{{ date('M/d/Y', $invoice->period_start) }} - {{ date('M/d/Y', $invoice->period_end + 60*60*24*30) }}</div>
            <div class="table-cell">{{ number_format($invoice->subtotal / 100, 2, '.', ',') }} $</div>
            <div class="table-cell">{{ $invoice->lines->data[0]->quantity }}</div>
            <div class="table-cell">{{ $invoice->discount == null ? '0.00' : number_format(($invoice->subtotal / 100 * $invoice->discount->coupon->percent_off) / 100, 2, '.', ',') }} $</div>
            <div class="table-cell">{{ number_format($invoice->amount_due / 100, 2, '.', ',') }} $</div>
        </div>
    </div>

    <div class="summary-table">
        <div class="table-cell"><strong>Total Current Charges:&nbsp;&nbsp;&nbsp;&nbsp;</strong></div>
        <div class="table-cell"><strong>$ {{ number_format($invoice->amount_due / 100, 2, '.', ',') }}</strong>&nbsp;&nbsp;&nbsp;&nbsp;</div>
    </div>
</div>
</body>
</html>