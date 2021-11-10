<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="preconnect" href="https://fonts.gstatic.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com"/>
    <link
            href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;900&display=swap"
            rel="stylesheet"
    />


    <title></title>
    <style>
        /* http://meyerweb.com/eric/tools/css/reset/
     v2.0 | 20110126
     License: none (public domain)
  */

        html,
        body,
        div,
        span,
        applet,
        object,
        iframe,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        blockquote,
        pre,
        a,
        abbr,
        acronym,
        address,
        big,
        cite,
        code,
        del,
        dfn,
        em,
        img,
        ins,
        kbd,
        q,
        s,
        samp,
        small,
        strike,
        strong,
        sub,
        sup,
        tt,
        var,
        b,
        u,
        i,
        center,
        dl,
        dt,
        dd,
        ol,
        ul,
        li,
        fieldset,
        form,
        label,
        legend,
        table,
        caption,
        tbody,
        tfoot,
        thead,
        tr,
        th,
        td,
        article,
        aside,
        canvas,
        details,
        embed,
        figure,
        figcaption,
        footer,
        header,
        hgroup,
        menu,
        nav,
        output,
        ruby,
        section,
        summary,
        time,
        mark,
        audio,
        video {
            margin: 0;
            padding: 0;
            border: 0;
            font-size: 100%;
            font: inherit;
            vertical-align: baseline;
        }
        /* HTML5 display-role reset for older browsers */
        article,
        aside,
        details,
        figcaption,
        figure,
        footer,
        header,
        hgroup,
        menu,
        nav,
        section {
            display: block;
        }
        body {
            line-height: 1;
        }
        ol,
        ul {
            list-style: none;
        }
        blockquote,
        q {
            quotes: none;
        }
        blockquote:before,
        blockquote:after,
        q:before,
        q:after {
            content: "";
            content: none;
        }
        table {
            border-collapse: collapse;
            border-spacing: 0;
        }
        /* -------------------- */
        body {
            font-family: "Cairo", sans-serif;
        }
        main {
        }
        nav {
            text-align: center;
            padding: 2em;
            margin-bottom: 2em;
        }
        nav img {
        }
        .card {
            padding: 1rem;
            border: 1px solid rgb(207, 207, 207);
            /* border-radius: 10px; */
            margin: auto;
            width: 80%;
            max-width: 500px;
            color: #3a3a3a;
            margin-bottom: 1em;
            /* box-shadow: 0px 0px 1px #c2c1c1; */
        }
        .card-title {
            margin-bottom: 2em;
            font-weight: bold;
            color: grey;
            font-size: 1.5rem;
        }
        .card-body {
        }
        .card-item {
            margin-bottom: 1em;
            padding: 1em 0;
        }

        .card-item .card-item_title {
            color: #172B4D;
            font-weight: 600;
            /* float: left; */
            display: inline-block;
            width: 49%;
            text-align: right;
        }
        .card-item .card-item_content {
            color: #7A869A;
            /* float: right; */
            display: inline-block;
            width: 49%;
            text-align: left;
        }
        .welcome {
            background-color: #ebf9f2;
            padding: 1rem;
            margin: auto;
            margin-bottom: 1em;
            width: 80%;
            max-width: 500px;
        }
        .welcome h1 {
            color: #000;
            font-size: 1.5rem;
            /* margin-bottom: 1em; */
            font-weight: bold;
        }
        /* .check-wrapper {
          background-color: green;
          width: 40px;
          height: 40px;
          border-radius: 50%;
          line-height: 50px;
          margin: 0 1rem;
        }
        .check {
          display: inline-block;
          transform: rotate(45deg);
          height: 18px;
          width: 8px;
          border-bottom: 7px solid #fff;
          border-right: 7px solid #fff;
        } */
        .text-center {
            text-align: center;
        }
        .border-bottom-grey {
            border-bottom: 1px solid #c8c8c9;
            padding-bottom: 1.5em;
        }
        .flex-dir-column {
            flex-direction: column;
            align-items: flex-start;
        }
        .mb-2 {
            margin-bottom: 0.5em;
        }
        .header {
            margin-bottom: 1.5rem;
            overflow: auto;
        }
        .header .card-item_title {
            float: left;
        }
        .header .card-item_content {
            float: right;
        }
        .breakdown {
            margin-bottom: 1rem !important;
            overflow: auto;
        }
        .breakdown > div {
            color: #7a869a;
        }
        .breakdown .left {
            float: left;
        }
        .breakdown .right {
            float: right;
        }

    </style>
</head>
<body>
<nav>
    <img
            src="{{env('APP_URL')}}/assets/images/6Qo-yqjYIU0HgZXDcD8IniikzvfWjUZH.png"
            alt="ibn khaldon"
            width="150px"
    />
</nav>
<main>


    <div class="welcome text-center">
        <div class="check-wrapper">
            <div class="check"></div>
        </div>
        <h1>{{$response_message}}</h1>
    </div>
    <div class="card">
        <div class="card-body">




            <div class="card-item border-bottom-grey">
                <div class="card-item_title">{{__('payment.amount',[],$language)}}</div>

                <div class="card-item_content">{{$paid_amount}}</div>

            </div>
            <div class="card-item border-bottom-grey">
                <div class="card-item_title">{{__('payment.card_number',[],$language)}}</div>

                <div class="card-item_content">{{$card_number}}</div>

            </div>


            <div class="card-item border-bottom-grey">
                <div class="card-item_title">{{__('payment.payment_option',[],$language)}}</div>

                <div class="card-item_content">{{$payment_option}}</div>

            </div>


            <div class="card-item border-bottom-grey">
                <div class="card-item_title">{{__('payment.card_holder_name',[],$language)}}</div>

                <div class="card-item_content">{{$card_holder_name}}</div>

            </div>


            <div class="card-item border-bottom-grey">
                <div class="card-item_title">{{__('payment.parent_name',[],$language)}}</div>

                <div class="card-item_content">{{$parent_first_name}} {{$parent_last_name}}</div>

            </div>

            <div class="card-item border-bottom-grey">
                <div class="card-item_title">{{__('payment.student_name',[],$language)}}</div>

                <div class="card-item_content">{{$first_name}} {{$last_name}}</div>

            </div>


            <!-- sssssssss -->
            <div class="total">
                <div class="header">
                    <div class="card-item_title">{{__('payment.full_total_amount',[],$language)}}</div>

                    <div class="card-item_content" style="color: #32ba7c">{{$amount_with_vat}}</div>

                </div>

                @foreach($items as $item)

                    <div class="breakdown">
                        <div class="">{{$item->name}}</div>
                        <div class="">{{$item->semester}}</div>
                        <div class="">{{$item->price}}</div>
                    </div>
                @endforeach
                <div class="breakdown">
                    <div class="">{{__('payment.vat',[],$language)}}</div>
                    <div class="">{{$vat}}</div>
                </div>
                <div class="breakdown">
                    <div class="">{{__('payment.total',[],$language)}}</div>
                    <div class="">{{$bill_amount}}</div>
                </div>
                <div class="breakdown">
                    <div class="">{{__('payment.bill_reaming',[],$language)}}</div>
                    <div class="">{{$bill_reaming}}</div>
                </div>

            </div>


        </div>
    </div>
</main>
</body>
</html>