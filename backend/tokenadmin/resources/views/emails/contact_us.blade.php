@extends('emails.email-template')
@section('content')

Contact Us Details
<br/>
<table border="1">
    <th width="15%">NAME</th>
    <th width="15%">PHONE</th>
    <th width="15%">EMAIL</th>
    <th width="60%">MESSAGE</th>
    <tr>
        <td>{{ $NAME }}</td>
        <td>{{ $PHONE_NUMBER }}</td>
        <td>{{ $EMAIL }}</td>
        <td>{{ $MESSAGE }}</td>
    </tr>
</table>


@endsection