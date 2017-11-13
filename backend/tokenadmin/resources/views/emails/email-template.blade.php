<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>BANG PAPERS</title>
        <style>
            body,table.body,h1,h2,h3,h4,h5,h6,p,td{font-family:"Helvetica","Arial",sans-serif;font-weight:normal; color:#717171; font-size:14px; line-height:20px;}
            body{
                margin:0; 
                padding:0;
                background: #d4d4d4 !important;	
            }
            p{
                margin-bottom: 15px;
            }
        </style>
    </head>
    <body>
        <table cellpadding="0" width="100%" cellspacing="0" border="0">
            <tr>
                <td>
                    <table cellpadding="0" width="620" align="center" cellspacing="0" border="0" style="background:#FFF; padding:15px 30px; margin:30px auto; color:#717171; font-family:Arial,sans-serif; font-size:14px; line-height:20px;">
                        <tr>
                            <td bgcolor="FFFFFF">
                                <p align="center"><a href="http://www.bangpapers.in"><img src="{{ asset('assets/img/logo-main.png') }}" alt="" style="max-width: 380px;"></a></p>
                                <p class="brtop" style="border-top:solid 1px #e5e5e5;"></p>
                                @yield('content')
                                <p class="brtop" style="border-top:solid 1px #e5e5e5;"></p>
                                <table width="100%">
                                    <tr>
                                        <td align="center" valign="top">
                                            <b>BANG PAPERS PVT. LTD. </b> <br>
                                            <!-- P | 0123456789 <br> -->
                                            E | <a style="color:#717171; text-decoration:none;" href="mailto:{{env('MAIL_FROM')}}">{{env('MAIL_FROM')}}</a><br>
                                            W | <a style="color:#717171; text-decoration:none;" href="http://www.bangpapers.in">www.bangpapers.in</a>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>
