@extends('emails.email-template')
@section('content')

Order Details
<br/>
<table border="1">
    <th width="20%">BILLING_ON</th>
    <th width="20%">DELIVERY_AT</th>
    <th width="20%">MODVAT_REQUIRED</th>
    <th width="20%">CREATED BY</th>
    <th width="20%">CREATED AT</th>
    <tr>
        <td>{{ $BILLING_ON }}</td>
        <td>{{ $DELIVERY_AT }}</td>
        <td>{{ $MODVAT_REQUIRED }}</td>
        <td>{{ $CREATED_BY }}</td>
        <td>{{ $CREATED_AT }}</td>
    </tr>
</table>
<br/>
Item Details
<br/>
<table border="1">
    <th>MANUFACTURER</th>
    <th>QUALITY</th>
    <th>FINISH</th>
    <th>GSM</th>
    <th>TYPE</th>
    <th>WIDTH</th>
    <th>DIAMETER LENGTH</th>
    <th>GRAIN DIRECTION</th>
    <th>NUMBER OF SHEETS</th>
    <th>QUANTITY</th>
    <th>DATE</th>
    <th>PRICE</th>
    <th>PAYMENTS</th>
    <th>TAX</th>
    <th>REMARKS</th>
    @foreach($items as $item)
    <tr>
        <td>{{ $item['manufacturer'] }}</td>
        <td>{{ $item['quality'] }}</td>
        <td>{{ $item['finish'] }}</td>
        <td>{{ $item['gsm'] }}</td>
        <td>{{ $item['item_type'] }}</td>
        <td>{{ $item['width'] }}</td>
        <td>{{ $item['length'] }}</td>
        <td>{{ $item['grain_direction'] }}</td>
        <td>{{ $item['no_of_sheets'] }}</td>
        <td>{{ $item['quantity'] }}</td>
        <td>{{ $item['expected_delivery_date'] }}</td>
        <td>{{ $item['prize'] }}</td>
        <td>{{ $item['payment_terms'] }}</td>
        <td>{{ $item['tax'] }}</td>
        <td>{{ $item['remarks'] }}</td>
    </tr>
    @endforeach
</table>


@endsection