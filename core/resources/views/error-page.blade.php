<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="preconnect" href="https://fonts.gstatic.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;900&display=swap" rel="stylesheet">
    <title>Payment error</title>
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
            margin: auto;
            padding: 1rem;
            border: 1px solid grey;
            border-radius: 10px;
            width: 80%;
            max-width: 500px;
            color: #3a3a3a;
            margin-bottom: 1em;
            box-shadow: 0px 0px 2px #888888;
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
        }

        .card-item .card-item_title {
            margin-bottom: 0.5em;
        }

        .card-item .card-item_content {
            color: rgb(71, 70, 70);
            font-weight: 700;
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

        }

        .actions button:first-child {
            background-color: #0064b0;
            border-color: #0064b0;
            color: #FFF;
        }

        .actions button:last-child {
            background-color: #FFF;
            border-color: #0064b0;
            color: #0064b0;
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
        <h3 class="card-title">{{ __('payment.errors.header',[],app()->getLocale()) }}</h3>
        <div class="card-header">
            <div></div>
        </div>
        <div class="card-body">

            <div class="card-item">
                <div class="card-item_title"></div>
                <div class="card-item_content">{{$errorMessage}}</div>
            </div>

        </div>
    </div>

</main>
</body>
</html>
