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
    main {}
    nav {
        text-align: center;
        padding: 2em;
        margin-bottom: 2em;
    }
    nav img {}
    .card {
        padding: 1rem 0rem;
        /* border: 1px solid rgb(207, 207, 207); */
        border-radius: 10px;
        margin: auto;
        width: 80%;
        max-width: 500px;
        color: #3A3A3A;
        margin-bottom: 1em;
        /* box-shadow: 0px 0px 1px #C2C1C1; */
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
        color: #706E6E;
    }
    .card-body {}
    .card-item {
        margin-bottom: 3em;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0px 4px 4px rgba(51, 51, 51, 0.04),
        0px 4px 16px rgba(51, 51, 51, 0.08);
        border-radius: 4px;
        padding: 1.5em;
    }
    .card-item .card-item_title {
        color: #172B4D;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }
    .card-item .card-item_content {
        color: #7A869A;
    }
    .card-item-second {
        margin-bottom: 2em;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .card-item-second .card-item_title {
        color: #7A869A;
        font-weight: 600;
    }
    .card-item-second .card-item_content {
        color: #1B76BC;
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
        background-color: #0064B0;
        border-color: #fff;
        color: #fff;
    }
    .actions button:first-child:hover {
        background-color: #172B4D;
        transition: 0.5s;
    }
    .actions button:last-child {
        background-color: #fff;
        border-color: #0064B0;
        color: #0064B0;
    }
    .welcome {
        background-color: #EBF9F2;
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
        background-color: #1890FF;
        border-color: #1890FF;
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
        color: #706E6E;
        padding: 3em 2em;
        margin: auto;
        width: 80%;
        max-width: 500px;
    }
    .footer a {
        color: #706E6E;
    }
    .text-center {
        text-align: center;
    }
    /* .border-bottom-grey {
  border-bottom: 1px solid #C8C8C9;
  padding-bottom: 1.5em;
} */
    .flex-dir-column {
        flex-direction: column;
        align-items: flex-start;
    }
    .mb-2 {
        margin-bottom: 0.5em;
    }
    .mx-2 {
        margin: 0 5px;
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
    .total .breakdown>div {
        color: #7A869A;
    }
    .form-control {
        padding: 10px 15px;
        outline: none;
        border-radius: 5px;
        margin-bottom: 0.3rem;
        width: 100%;
        border: 1px solid #0064B0;
    }
    .form-control:active,
    .form-control:focus,
    .form-control:focus-visible {
        border: 1px solid #0064B0;
        outline: none;
    }
</style>