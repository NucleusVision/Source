<!Doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>The Flyer</title>
    </head>
    <body style="background: #fbfeff;">
        <div style="margin:0 auto;max-width:700px;">
            <table class="" style="width:100%;font-size:0px;background:#d8e2e7;">
                <tbody>
                    <tr>
                        <td style="text-align:center;vertical-align:top;font-size:0;padding:1px;">
                            <div style="vertical-align:top;display:inline-block;font-size:13px;text-align:left;width:100%;">
                                <table style="background:white;width:100%">
                                    <tbody>

                                        <tr>
                                            <td style="font-size:0;padding:0 30px 6px;">
                                                <p style="padding:20px 0px 50px; 0px"><a href="index.php" class="logo"><img src="{{ asset("/assets/img/logo-main.png") }}"></a></p>
                                                <div style="cursor:auto;color:#000000;font-family:Proxima Nova, Arial, Arial, Helvetica, sans-serif;font-size:14px;line-height:22px; padding:6px 0px;">
                                                    <div style="cursor:auto;color:#000000;font-family:Proxima Nova, Arial, Arial, Helvetica, sans-serif;font-size:16px;line-height:22px;">
                                                    </div>
                                                    <p>Welcome to BANG PAPERS. Your Account has been Activated.</p> 
                                                    <p>Click on the link below to login.</p>
                                                    <p><a href="{{ route('admin.login') }}" target="_blank">{{ route('admin.login') }}</a></p>

                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-size:0;padding:30px 30px 30px 30px;">
                                                <div style="cursor:auto;color:#000000;font-family:Proxima Nova, Arial, Arial, Helvetica, sans-serif;font-size:14px;line-height:22px;">
                                                    Thank you<br>
                                                    - The BANG PAPERS Team
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </body>
</html>