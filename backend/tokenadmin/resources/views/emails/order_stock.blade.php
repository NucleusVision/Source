@extends('emails.email-template')
@section('content')

Order Details
<br/>
<table border="1">
    <th width="20%">Username</th>
    <th width="20%">Variety</th>
    <th width="15%">Mill</th>
    <th width="25%">Quality</th>
    <th width="25%">Finish</th>
    <th width="10%">GSM</th>
    <th width="10%">Type</th>
    <th width="8%">Width</th>
    <th width="8%">Length</th>
    <th width="10%">Size Type</th>
    <th width="10%">Sheets</th>
    <th width="10%">Packet Weight</th>    
    <th width="10%">Quantity</th>
    @foreach($stocks as $stock)
    <tr>
        <td>{{ $stock['user_name'] }}</td>
        <td>{{ $stock['variety'] }}</td>
        <td>{{ $stock['mill'] }}</td>
        <td>{{ $stock['quality'] }}</td>
        <td>{{ $stock['finish'] }}</td>
        <td>{{ $stock['gsm'] }}</td>
        <td>{{ $stock['type'] }}</td>
        <td>{{ $stock['size1'] }}</td>
        <td>{{ $stock['size2'] }}</td>
        <td>{{ $stock['size_type'] }}</td>
        <td>{{ $stock['sheets'] }}</td>
        <td>{{ $stock['pkt_wt'] }}</td>
        <td>{{ $stock['quantity'] }}</td>    
    </tr>
    @endforeach
</table>
<br/>


@endsection