<!DOCTYPE html>
<html lang="ar">
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
        :root {
            --borderWidth: 7px;
            --height: 18px;
            --width: 8px;
            --borderColor: #fff;
        }

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
            padding: 1rem 0rem;
            /* border: 1px solid rgb(207, 207, 207); */
            border-radius: 10px;
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

        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 2em;
            color: #706e6e;
        }

        .card-body {
        }

        .card-item {
            margin-bottom: 2em;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0px 4px 4px rgba(51, 51, 51, 0.04),
            0px 4px 16px rgba(51, 51, 51, 0.08);
            border-radius: 4px;
            padding: 1.5em;
        }

        .card-item .card-item_title {
            color: #172b4d;
            font-weight: 600;
        }

        .card-item .card-item_content {
            color: #7a869a;
        }

        .card-item-second {
            margin-bottom: 2em;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card-item-second .card-item_title {
            color: #7a869a;
            font-weight: 600;
        }

        .card-item-second .card-item_content {
            color: #1b76bc;
            font-weight: 600;
        }

        .actions {
            margin: auto;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .actions button {
            background: none;
            border: none;
            width: 80%;
            max-width: 250px;
            height: 50px;
            line-height: 50px;
            border-radius: 10px;
            border: 1px solid;
            margin-bottom: 1em;
            cursor: pointer;
        }

        .actions button:first-child {
            background-color: #0064b0;
            border-color: #0064b0;
            color: #fff;
        }

        .actions button:last-child {
            background-color: #fff;
            border-color: #0064b0;
            color: #0064b0;
        }

        .welcome {
            background-color: #ebf9f2;
            padding: 1rem;
            margin: auto;
            margin-bottom: 1em;
            width: 80%;
            max-width: 500px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .welcome h1 {
            color: #000;
            font-size: 1.5rem;
            /* margin-bottom: 1em; */
            font-weight: bold;
        }

        .welcome button {
            background: none;
            border: none;
            width: 60%;
            max-width: 250px;
            height: 45px;
            line-height: 45px;
            border-radius: 10px;
            border: 1px solid;
            margin-bottom: 1em;
            cursor: pointer;
            background-color: #1890ff;
            border-color: #1890ff;
            color: #fff;
        }

        .check-wrapper {
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
            height: var(--height);
            width: var(--width);
            border-bottom: var(--borderWidth) solid var(--borderColor);
            border-right: var(--borderWidth) solid var(--borderColor);
        }

        .footer {
            border-top: 1px solid;
            color: #706e6e;
            padding: 3em 2em;
            margin: auto;
            width: 80%;
            max-width: 500px;
        }

        .footer a {
            color: #706e6e;
        }

        .text-center {
            text-align: center;
        }

        /* .border-bottom-grey {
          border-bottom: 1px solid #c8c8c9;
          padding-bottom: 1.5em;
        } */
        .flex-dir-column {
            flex-direction: column;
            align-items: flex-start;
        }

        .mb-2 {
            margin-bottom: 0.5em;
        }

        .total {
            margin-bottom: 2em;

            box-shadow: 0px 4px 4px rgba(51, 51, 51, 0.04),
            0px 4px 16px rgba(51, 51, 51, 0.08);
            border-radius: 4px;
            padding: 1.5em;
        }

        .total .header,
        .total .breakdown {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .total .header {
            margin-bottom: 1.5rem;
        }

        .total .breakdown {
            margin-bottom: 1rem;
        }

        .total .breakdown > div {
            color: #7a869a;
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



    <div class="card">
        <form method="post" action="{{$url}}">
            <div class="card-body">


                <div class="card-item border-bottom-grey">
                    <div class="card-item_content">{{$paid_amount}}</div>

                    <div class="card-item_title">{{__('payment.amount',[],$language)}}</div>
                </div>


                <div class="card-item border-bottom-grey">
                    <div class="card-item_content">{{$user->name}}</div>

                    <div class="card-item_title">{{__('payment.parent_name',[],$language)}}</div>
                </div>
                <div class="card-item border-bottom-grey">
                    <div class="card-item_content">{{$child->name}}</div>

                    <div class="card-item_title">{{__('payment.student_name',[],$language)}}</div>
                </div>

                <div class="card-item border-bottom-grey">
                    <div class="card-item_content">{{$user->national_id}}</div>

                    <div class="card-item_title">{{__('payment.parent_national_id',[],$language)}}</div>
                </div>
                <div class="card-item border-bottom-grey">
                    <div class="card-item_content">{{$child->national_id}}</div>

                    <div class="card-item_title">{{__('payment.student_national_id',[],$language)}}</div>
                </div>
                <div class="total">
                    <div class="breakdown">
                        <div class="">{{__('payment.total',[],$language)}}</div>
                        <div class="">{{$paid_amount}}</div>
                    </div>


                </div>
                <input type="hidden" name="user_id" value="{{$user->uuid}}">
                <input type="hidden" name="child_id" value="{{$child->uuid}}">
                <input type="hidden" name="amount" value="{{$paid_amount}}">
                <input type="hidden" name="merchant_reference" value="{{$merchant_reference}}">
                <div class="actions">
                    <button type="submit" class="button">
                        {{__('payment.click_to_complete',[],$language)}}
                    </button>

                </div>

            </div>
        </form>

    </div>
</main>
</body>
</html>

