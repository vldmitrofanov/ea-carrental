<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Emabssy Alliance Contact Us</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
</head>
<body style="margin:0;background-color:#fefefe;">
<div style="background-color:#fefefe;">
    <table bgcolor="#fff" width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #ddd;margin:0 auto;font-family: 'Source Sans Pro', 'Helvetica Neue',Helvetica,Arial,sans-serif;">
        <tr>
            <td>
                <table width="100%" border="0" bgcolor="#fff" cellspacing="0" cellpadding="0">
                    <tr>
                        <td style="text-align:center; padding:5px 10px; background-color:#fff; border:2px solid #D3006C;"><img src="http://fingertipmail.com/car/images/logo.png" alt=""></td>
                        <td width="75%" valign="top" style="font-size:12px;text-align:right; padding:10px; background-color:#D3006C; color:#eee;border:2px solid #D3006C;border-left:0;">Date:{{ date('m-d-Y') }}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td height="20">&nbsp;</td>
        </tr>
        <tr>
            <td>
                <table width="100%" border="0" bgcolor="#fff" cellspacing="0" cellpadding="0" style=" font-size:14px;">
                    <tr>
                        <td width="100%" style="padding:5px 10px;">
                            <strong>From</strong>: {{ $request->input('name')  }}<br/>
                            <strong>Contact Number</strong>: {{ $request->input('contact_number')  }}<br/>
                            <strong>Email</strong>: {{ $request->input('email')  }}<br/>
                            <strong>Message</strong>: {{ $request->input('message')  }}<br/>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td height="20">&nbsp;</td>
        </tr>
    </table>
</div>
</body>

</html>
