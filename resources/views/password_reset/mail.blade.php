<html>
<head>
    <title>RMD password reset Email</title>
    <meta name="viewport" content="initial-scale=1.0">
    <style type="text/css">

        body {
            margin: 0;
            padding: 0;
            background-color: #f5f5f5
        }

        .emailbody {
            background-color: #f5f5f5
        }

        td {
            font-family: "Open Sans", sans-serif
        }

        .emailcontent {
            background-color: #fff;
            border-radius: 10px
        }

        h1 {
            font-size: 25px;
            color: #4c5868;
            letter-spacing: -.02em
        }

        h2 {
            font-size: 19px;
            color: #4c5868;
            letter-spacing: -.02em
        }

        p {
            font-size: 15px;
            line-height: 27px;
            color: #63686d
        }

        .bigp {
            font-size: 19px
        }

        hr {
            border: 0;
            border-bottom: 1px solid #e0e3e6;
            color: #e0e3e6;
            height: 1px;
            margin-top: 35px;
            margin-bottom: 35px
        }

        .btn {
            background-color: #ec5545;
            color: #fff;
            font-size: 19px;
            border-radius: 10px
        }

        .btn a, .btn a:active, .btn a:hover, .btn a:link, .btn a:visited {
            color: #fff;
            text-decoration: none !important
        }

        .emailfooter {
            font-size: 19px
        }

        .emailfooter strong {
            color: #ec5545;
            font-size: 27px
        }

        .emailfooter b {
            color: #4c5868;
            font-size: 27px
        }

        .emailfooter a, .emailfooter a:active, .emailfooter a:hover, .emailfooter a:link, .emailfooter a:visited {
            color: #4c5868;
            text-decoration: none !important
        }

        td a, td a:active, td a:hover, td a:link, td a:visited {
            color: #ec5545;
            text-decoration: none !important
        }

        .flex1 {
            width: 660px
        }

        .flex2 {
            width: 560px
        }

        @media (max-width: 680px) {
            .flex1 {
                width: 96%
            }

            .flex2 {
                width: 80%
            }
        }

        .ratingstarscenter {
            width: 101px;
            height: 23px;
            margin: 0 auto;
            margin-top: 6px;
            background-image: url(/images/rating.png);
            background-position: 0 -269px
        }

        .ratingstarsleftinline {
            width: 101px;
            height: 23px;
            display: inline;
            float: left;
            background-image: url(/images/rating.png);
            background-position: 0 -269px;
            margin-top: 2px
        }

        .ratingfive {
            background-position: 0 0
        }

        .ratingfourhalf {
            background-position: 0 -28px
        }

        .ratingfour {
            background-position: 0 -53px
        }

        .ratingthreehalf {
            background-position: 0 -81px
        }

        .ratingthree {
            background-position: 0 -108px
        }

        .ratingtwohalf {
            background-position: 0 -134px
        }

        .ratingtwo {
            background-position: 0 -162px
        }

        .ratingonehalf {
            background-position: 0 -188px
        }

        .ratingone {
            background-position: 0 -214px
        }

        .ratinghalf {
            background-position: 0 -241px
        }
    </style>
</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="emailbody">
    <tbody>

    <tr>
        <td>
            <!--- start main table ---->
            <table class="flex1" border="0" cellspacing="0" cellpadding="0" align="center">
                <tbody>
                <tr>
                    <td height="200" valign="bottom"><img src="https://rmd.local/images/logo.png" width="289"
                                                          height="169"></td>
                </tr>
                <tr>
                    <td class="emailcontent">
                        <!-- start content --->
                        <table class="flex2" border="0" cellspacing="0" cellpadding="0" align="center">
                            <tbody>
                            <tr>
                                <td height="50">&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <h1>Password reset from RepairMyDevice.com.</h1>

                                    <p><b>Hello {{ $user->name }}, Thank you for using our website!</b> We greatly appreciate you choosing
                                        RepairMyDevice.com to serve you! Please reset your account password.</p>

                                    <p></p>
                                    <hr>
                                    <p></p>
                                    <!--- Button Start --->
                                    <table width="220" border="0" cellspacing="0" cellpadding="0" class="btn">
                                        <tbody>
                                        <tr>
                                            <td height="5">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td align="center">

                                                <a href="{{ $link }}">Reset password</a>


                                            </td>
                                        </tr>
                                        <tr>
                                            <td height="5">&nbsp;</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <!--- Button End --->
                                    <p></p>
                                    <hr>
                                    <p></p>


                                    <p>Whenever you are looking for a device repair, choose RepairMyDevice.com to help
                                        you select the best repair store for your repair needs! </p>


                                </td>
                            </tr>
                            <tr>
                                <td height="50">&nbsp;</td>
                            </tr>
                            </tbody>
                        </table>

                        <!-- end content --->
                    </td>
                </tr>
                <tr>
                    <td height="150" class="emailfooter">
                        <center>
                            <strong>Thank you!</strong> <b>RepairMyDevice.com</b></center>

                        <center>
                            <a href="mailto:contact@repairmydevice.com">contact@repairmydevice.com</a>
                        </center>
                    </td>
                </tr>
                </tbody>
            </table>
            <!--- end main table ---->
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>
