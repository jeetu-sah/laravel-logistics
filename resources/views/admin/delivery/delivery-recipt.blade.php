<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Laralink">
    <!-- Site Title -->
    <title>Vikash Logistic Pvt. ltd. </title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>


<style>
    /*--------------------------------------------------------------
>> TABLE OF CONTENTS:
----------------------------------------------------------------
1. Normalize
2. Typography
3. Invoice General Style
--------------------------------------------------------------*/
    /*--------------------------------------------------------------
2. Normalize
----------------------------------------------------------------*/
    @import url("https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;700&display=swap");

    *,
    ::after,
    ::before {
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
    }

    html {
        line-height: 1.15;
        -webkit-text-size-adjust: 100%;
    }

    /* Sections
   ========================================================================== */
    /**
 * Remove the margin in all browsers.
 */
    body {
        margin: 0;
    }

    /**
 * Render the `main` element consistently in IE.
 */
    main {
        display: block;
    }

    /**
 * Correct the font size and margin on `h1` elements within `section` and
 * `article` contexts in Chrome, Firefox, and Safari.
 */
    h1 {
        font-size: 2em;
        margin: 0.67em 0;
    }

    /* Grouping content
   ========================================================================== */
    /**
 * 1. Add the correct box sizing in Firefox.
 * 2. Show the overflow in Edge and IE.
 */
    hr {
        -webkit-box-sizing: content-box;
        box-sizing: content-box;
        /* 1 */
        height: 0;
        /* 1 */
        overflow: visible;
        /* 2 */
    }

    /**
 * 1. Correct the inheritance and scaling of font size in all browsers.
 * 2. Correct the odd `em` font sizing in all browsers.
 */
    pre {
        font-family: monospace, monospace;
        /* 1 */
        font-size: 1em;
        /* 2 */
    }

    /* Text-level semantics
   ========================================================================== */
    /**
 * Remove the gray background on active links in IE 10.
 */
    a {
        background-color: transparent;
    }

    /**
 * 1. Remove the bottom border in Chrome 57-
 * 2. Add the correct text decoration in Chrome, Edge, IE, Opera, and Safari.
 */
    abbr[title] {
        border-bottom: none;
        /* 1 */
        text-decoration: underline;
        /* 2 */
        -webkit-text-decoration: underline dotted;
        text-decoration: underline dotted;
        /* 2 */
    }

    /**
 * Add the correct font weight in Chrome, Edge, and Safari.
 */
    b,
    strong {
        font-weight: bolder;
    }

    /**
 * 1. Correct the inheritance and scaling of font size in all browsers.
 * 2. Correct the odd `em` font sizing in all browsers.
 */
    code,
    kbd,
    samp {
        font-family: monospace, monospace;
        /* 1 */
        font-size: 1em;
        /* 2 */
    }

    /**
 * Add the correct font size in all browsers.
 */
    small {
        font-size: 80%;
    }

    /**
 * Prevent `sub` and `sup` elements from affecting the line height in
 * all browsers.
 */
    sub,
    sup {
        font-size: 75%;
        line-height: 0;
        position: relative;
        vertical-align: baseline;
    }

    sub {
        bottom: -0.25em;
    }

    sup {
        top: -0.5em;
    }

    /* Embedded content
   ========================================================================== */
    /**
 * Remove the border on images inside links in IE 10.
 */
    img {
        border-style: none;
    }

    /* Forms
   ========================================================================== */
    /**
 * 1. Change the font styles in all browsers.
 * 2. Remove the margin in Firefox and Safari.
 */
    button,
    input,
    optgroup,
    select,
    textarea {
        font-family: inherit;
        /* 1 */
        font-size: 100%;
        /* 1 */
        line-height: 1.15;
        /* 1 */
        margin: 0;
        /* 2 */
    }

    /**
 * Show the overflow in IE.
 * 1. Show the overflow in Edge.
 */
    button,
    input {
        /* 1 */
        overflow: visible;
    }

    /**
 * Remove the inheritance of text transform in Edge, Firefox, and IE.
 * 1. Remove the inheritance of text transform in Firefox.
 */
    button,
    select {
        /* 1 */
        text-transform: none;
    }

    /**
 * Correct the inability to style clickable types in iOS and Safari.
 */
    button,
    [type=button],
    [type=reset],
    [type=submit] {
        -webkit-appearance: button;
    }

    /**
 * Remove the inner border and padding in Firefox.
 */
    button::-moz-focus-inner,
    [type=button]::-moz-focus-inner,
    [type=reset]::-moz-focus-inner,
    [type=submit]::-moz-focus-inner {
        border-style: none;
        padding: 0;
    }

    /**
 * Restore the focus styles unset by the previous rule.
 */
    button:-moz-focusring,
    [type=button]:-moz-focusring,
    [type=reset]:-moz-focusring,
    [type=submit]:-moz-focusring {
        outline: 1px dotted ButtonText;
    }

    /**
 * Correct the padding in Firefox.
 */
    fieldset {
        padding: 0.35em 0.75em 0.625em;
    }

    /**
 * 1. Correct the text wrapping in Edge and IE.
 * 2. Correct the color inheritance from `fieldset` elements in IE.
 * 3. Remove the padding so developers are not caught out when they zero out
 *    `fieldset` elements in all browsers.
 */
    legend {
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        /* 1 */
        color: inherit;
        /* 2 */
        display: table;
        /* 1 */
        max-width: 100%;
        /* 1 */
        padding: 0;
        /* 3 */
        white-space: normal;
        /* 1 */
    }

    /**
 * Add the correct vertical alignment in Chrome, Firefox, and Opera.
 */
    progress {
        vertical-align: baseline;
    }

    /**
 * Remove the default vertical scrollbar in IE 10+.
 */
    textarea {
        overflow: auto;
    }

    /**
 * 1. Add the correct box sizing in IE 10.
 * 2. Remove the padding in IE 10.
 */
    [type=checkbox],
    [type=radio] {
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        /* 1 */
        padding: 0;
        /* 2 */
    }

    /**
 * Correct the cursor style of increment and decrement buttons in Chrome.
 */
    [type=number]::-webkit-inner-spin-button,
    [type=number]::-webkit-outer-spin-button {
        height: auto;
    }

    /**
 * 1. Correct the odd appearance in Chrome and Safari.
 * 2. Correct the outline style in Safari.
 */
    [type=search] {
        -webkit-appearance: textfield;
        /* 1 */
        outline-offset: -2px;
        /* 2 */
    }

    /**
 * Remove the inner padding in Chrome and Safari on macOS.
 */
    [type=search]::-webkit-search-decoration {
        -webkit-appearance: none;
    }

    /**
 * 1. Correct the inability to style clickable types in iOS and Safari.
 * 2. Change font properties to `inherit` in Safari.
 */
    ::-webkit-file-upload-button {
        -webkit-appearance: button;
        /* 1 */
        font: inherit;
        /* 2 */
    }

    /* Interactive
   ========================================================================== */
    /*
 * Add the correct display in Edge, IE 10+, and Firefox.
 */
    details {
        display: block;
    }

    /*
 * Add the correct display in all browsers.
 */
    summary {
        display: list-item;
    }

    /* Misc
   ========================================================================== */
    /**
 * Add the correct display in IE 10+.
 */
    template {
        display: none;
    }

    /**
 * Add the correct display in IE 10.
 */
    [hidden] {
        display: none;
    }

    /*--------------------------------------------------------------
2. Typography
----------------------------------------------------------------*/
    body,
    html {
        color: #666;
        font-family: "Inter", sans-serif;
        font-size: 14px;
        font-weight: 400;
        line-height: 1.6em;
        overflow-x: hidden;
        background-color: #f5f6fa;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        clear: both;
        color: #111;
        padding: 0;
        margin: 0 0 20px 0;
        font-weight: 500;
        line-height: 1.2em;
    }

    h1 {
        font-size: 60px;
    }

    h2 {
        font-size: 48px;
    }

    h3 {
        font-size: 30px;
    }

    h4 {
        font-size: 24px;
    }

    h5 {
        font-size: 18px;
    }

    h6 {
        font-size: 16px;
    }

    p,
    div {

        line-height: 1.5em;
    }

    /* p {
        margin-bottom: 15px;
    } */

    ul {
        margin: 0 0 25px 0;
        padding-left: 20px;
        list-style: disc;
    }

    ol {
        padding-left: 20px;
        margin-bottom: 25px;
    }

    dfn,
    cite,
    em,
    i {
        font-style: italic;
    }

    blockquote {
        margin: 0 15px;
        font-style: italic;
        font-size: 20px;
        line-height: 1.6em;
        margin: 0;
    }

    address {
        margin: 0 0 15px;
    }

    img {
        border: 0;
        max-width: 100%;
        height: auto;
        vertical-align: middle;
    }

    a {
        color: inherit;
        text-decoration: none;
        -webkit-transition: all 0.3s ease;
        transition: all 0.3s ease;
    }

    a:hover {
        color: #007aff;
    }

    button {
        color: inherit;
        -webkit-transition: all 0.3s ease;
        transition: all 0.3s ease;
    }

    a:hover {
        text-decoration: none;
        color: inherit;
    }

    table {
        width: 100%;
        caption-side: bottom;
        border-collapse: collapse;
    }

    th {
        text-align: left;
    }

    td {
        border-top: 1px solid #dbdfea;
    }

    td {
        padding: 5px 10px;
        line-height: 1.55em;
    }

    th {
        padding: 5px 10px;
        line-height: 1.55em;
    }

    dl {
        margin-bottom: 25px;
    }

    dl dt {
        font-weight: 600;
    }

    b,
    strong {
        font-weight: bold;
    }

    pre {
        color: #666;
        border: 1px solid #dbdfea;
        font-size: 18px;
        padding: 25px;
        border-radius: 5px;
    }

    kbd {
        font-size: 100%;
        background-color: #666;
        border-radius: 5px;
    }

    a:hover {
        color: #007aff;
    }

    ul {
        padding-left: 15px;
    }

    /*--------------------------------------------------------------
3. Invoice General Style
----------------------------------------------------------------*/
    .tm_f10 {
        font-size: 10px;
    }

    .tm_f11 {
        font-size: 11px;
    }

    .tm_f12 {
        font-size: 12px;
    }

    .tm_f13 {
        font-size: 13px;
    }

    .tm_f14 {
        font-size: 14px;
    }

    .tm_f15 {
        font-size: 15px;
    }

    .tm_f16 {
        font-size: 16px;
    }

    .tm_f17 {
        font-size: 17px;
    }

    .tm_f18 {
        font-size: 18px;
    }

    .tm_f19 {
        font-size: 19px;
    }

    .tm_f20 {
        font-size: 20px;
    }

    .tm_f21 {
        font-size: 21px;
    }

    .tm_f22 {
        font-size: 22px;
    }

    .tm_f23 {
        font-size: 23px;
    }

    .tm_f24 {
        font-size: 24px;
    }

    .tm_f25 {
        font-size: 25px;
    }

    .tm_f26 {
        font-size: 26px;
    }

    .tm_f27 {
        font-size: 27px;
    }

    .tm_f28 {
        font-size: 28px;
    }

    .tm_f29 {
        font-size: 29px;
    }

    .tm_f30 {
        font-size: 30px;
    }

    .tm_f40 {
        font-size: 40px;
    }

    .tm_f50 {
        font-size: 50px;
    }

    .tm_light {
        font-weight: 300;
    }

    .tm_normal {
        font-weight: 400;
    }

    .tm_medium {
        font-weight: 500;
    }

    .tm_semi_bold {
        font-weight: 600;
    }

    .tm_bold {
        font-weight: 700;
    }

    .tm_m0 {
        margin: 0px;
    }

    .tm_mb0 {
        margin-bottom: 0px;
    }

    .tm_mb1 {
        margin-bottom: 1px;
    }

    .tm_mb2 {
        margin-bottom: 2px;
    }

    .tm_mb3 {
        margin-bottom: 3px;
    }

    .tm_mb4 {
        margin-bottom: 4px;
    }

    .tm_mb5 {
        margin-bottom: 5px;
    }

    .tm_mb6 {
        margin-bottom: 6px;
    }

    .tm_mb7 {
        margin-bottom: 7px;
    }

    .tm_mb8 {
        margin-bottom: 8px;
    }

    .tm_mb9 {
        margin-bottom: 9px;
    }

    .tm_mb10 {
        margin-bottom: 10px;
    }

    .tm_mb11 {
        margin-bottom: 11px;
    }

    .tm_mb12 {
        margin-bottom: 12px;
    }

    .tm_mb13 {
        margin-bottom: 13px;
    }

    .tm_mb14 {
        margin-bottom: 14px;
    }

    .tm_mb15 {
        margin-bottom: 15px;
    }

    .tm_mb16 {
        margin-bottom: 16px;
    }

    .tm_mb17 {
        margin-bottom: 17px;
    }

    .tm_mb18 {
        margin-bottom: 18px;
    }

    .tm_mb19 {
        margin-bottom: 19px;
    }

    /* .tm_mb20 {
        margin-bottom: 20px;
    } */

    .tm_mb21 {
        margin-bottom: 21px;
    }

    .tm_mb22 {
        margin-bottom: 22px;
    }

    .tm_mb23 {
        margin-bottom: 23px;
    }

    .tm_mb24 {
        margin-bottom: 24px;
    }

    .tm_mb25 {
        margin-bottom: 25px;
    }

    .tm_mb26 {
        margin-bottom: 26px;
    }

    .tm_mb27 {
        margin-bottom: 27px;
    }

    .tm_mb28 {
        margin-bottom: 28px;
    }

    .tm_mb29 {
        margin-bottom: 29px;
    }

    .tm_mb30 {
        margin-bottom: 30px;
    }

    .tm_mb40 {
        margin-bottom: 40px;
    }

    .tm_pt25 {
        padding-top: 25px;
    }

    .tm_pt0 {
        padding-top: 0;
    }

    .tm_radius_6_0_0_6 {
        border-radius: 6px 0 0 6px;
    }

    .tm_radius_0_6_6_0 {
        border-radius: 0 6px 6px 0;
    }

    .tm_radius_0 {
        border-radius: 0 !important;
    }

    .tm_width_1 {
        width: 53.33333333%;
    }

    .tm_width_2 {
        width: 16.66666667%;
    }

    .tm_width_3 {
        /* width: 15%; */
    }

    .tm_width_4 {
        width: 15%;
    }

    .tm_width_5 {
        width: 41.66666667%;
    }

    .tm_width_6 {
        width: 50%;
    }

    .tm_width_7 {
        width: 58.33333333%;
    }

    .tm_width_8 {
        width: 66.66666667%;
    }

    .tm_width_9 {
        width: 75%;
    }

    .tm_width_10 {
        width: 83.33333333%;
    }

    .tm_width_11 {
        width: 91.66666667%;
    }

    .tm_width_12 {
        width: 100%;
    }

    .tm_border {
        border: 1px solid #dbdfea;
    }

    .tm_border_bottom {
        border-bottom: 1px solid #dbdfea;
    }

    .tm_border_top {
        border-top: 1px solid #dbdfea;
    }

    .tm_border_left {
        border-left: 1px solid #dbdfea;
    }

    .tm_border_right {
        border-right: 1px solid #dbdfea;
    }

    .tm_round_border {
        border: 1px solid #dbdfea;
        overflow: hidden;
        border-radius: 6px;
    }

    .tm_accent_color,
    .tm_accent_color_hover:hover {
        color: #007aff;
    }

    .tm_accent_bg,
    .tm_accent_bg_hover:hover {
        background-color: #007aff;
    }

    .tm_accent_bg_10 {
        background-color: rgba(0, 122, 255, 0.1);
    }

    .tm_accent_bg_20 {
        background-color: rgba(0, 122, 255, 0.15);
    }

    .tm_green_bg {
        background-color: #34c759;
    }

    .tm_green_bg_15 {
        background-color: rgba(52, 199, 89, 0.1);
    }

    .tm_primary_bg,
    .tm_primary_bg_hover:hover {
        background-color: #111;
    }

    .tm_primary_bg_2 {
        background-color: #000036;
    }

    .tm_danger_color {
        color: red;
    }

    .tm_primary_color {
        color: #111;
    }

    .tm_secondary_color {
        color: #666;
    }

    .tm_ternary_color {
        color: #b5b5b5;
    }

    .tm_white_color {
        color: #fff;
    }

    .tm_white_color_60 {
        color: rgba(255, 255, 255, 0.6);
    }

    .tm_gray_bg {
        background: #f5f6fa;
    }

    .tm_ternary_bg {
        background-color: #b5b5b5;
    }

    .tm_accent_10_bg {
        background-color: rgba(0, 122, 255, 0.1);
    }

    .tm_accent_border {
        border-color: #007aff;
    }

    .tm_accent_border_10 {
        border-color: rgba(0, 122, 255, 0.1);
    }

    .tm_accent_border_20 {
        border-color: rgba(0, 122, 255, 0.2);
    }

    .tm_accent_border_30 {
        border-color: rgba(0, 122, 255, 0.3);
    }

    .tm_accent_border_40 {
        border-color: rgba(0, 122, 255, 0.4);
    }

    .tm_accent_border_50 {
        border-color: rgba(0, 122, 255, 0.5);
    }

    .tm_primary_border {
        border-color: #111;
    }

    .tm_gray_border {
        border-color: #f5f6fa;
    }

    .tm_primary_border_2 {
        border-color: #000036;
    }

    .tm_secondary_border {
        border-color: #666;
    }

    .tm_ternary_border {
        border-color: #b5b5b5;
    }

    .tm_border_color {
        border-color: #dbdfea;
    }

    .tm_border_1 {
        border-style: solid;
        border-width: 1px;
    }

    .tm_body_lineheight {
        line-height: 1.5em;
    }

    .tm_invoice_in {
        position: relative;
        z-index: 100;
    }

    .tm_container {
        max-width: 880px;
        padding: 30px 15px;
        margin-left: auto;
        margin-right: auto;
        position: relative;
    }

    .tm_text_center {
        text-align: center;
    }

    .tm_text_uppercase {
        text-transform: uppercase;
    }

    .tm_text_right {
        text-align: right;
    }

    .tm_align_center {
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
    }

    .tm_border_bottom_0 {
        border-bottom: 0;
    }

    .tm_border_top_0 {
        border-top: 0;
    }

    .tm_table_baseline {
        vertical-align: baseline;
    }

    .tm_border_none {
        border: none !important;
    }

    .tm_flex {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
    }

    .tm_justify_between {
        -webkit-box-pack: justify;
        -ms-flex-pack: justify;
        justify-content: space-between;
    }

    .tm__align_center {
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
    }

    .tm_border_left_none {
        border-left-width: 0;
    }

    .tm_border_right_none {
        border-right-width: 0;
    }

    .tm_table_responsive {
        overflow-x: auto;
    }

    .tm_table_responsive>table {
        min-width: 600px;
    }

    .tm_50_col>* {
        width: 50%;
        -webkit-box-flex: 0;
        -ms-flex: none;
        flex: none;
    }

    .tm_no_border {
        border: none !important;
    }

    .tm_grid_row {
        display: grid;
        grid-gap: 10px 20px;
        list-style: none;
        padding: 0;
    }

    .tm_col_2 {
        grid-template-columns: repeat(2, 1fr);
    }

    .tm_col_3 {
        grid-template-columns: repeat(3, 1fr);
    }

    .tm_col_4 {
        grid-template-columns: repeat(4, 1fr);
    }

    .tm_max_w_150 {
        max-width: 150px;
    }

    .tm_left_auto {
        margin-left: auto;
    }

    hr {
        background: #dbdfea;
        height: 1px;
        border: none;
        margin: 0;
    }

    .tm_invoice {
        background: #fff;
        border-radius: 10px;
        padding: 20px;
    }

    .tm_invoice_footer {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
    }

    .tm_invoice_footer table {
        margin-top: -1px;
    }

    .tm_invoice_footer .tm_left_footer {
        width: 71%;
        padding: 10px 15px;
        -webkit-box-flex: 0;
        -ms-flex: none;
        flex: none;
    }

    .tm_invoice_footer .tm_right_footer {
        width: 42%;
    }

    .tm_note {
        margin-top: 30px;
        font-style: italic;
    }

    .tm_font_style_normal {
        font-style: normal;
    }

    .tm_sign img {
        max-height: 45px;
    }

    .tm_coffee_shop_img {
        position: absolute;
        height: 200px;
        opacity: 0.04;
        top: 40px;
        left: 50%;
        -webkit-transform: translateX(-50%);
        transform: translateX(-50%);
    }

    .tm_coffee_shop_img img {
        max-height: 100%;
    }

    .tm_invoice.tm_style1 .tm_invoice_right {
        -webkit-box-flex: 0;
        -ms-flex: none;
        flex: none;
        /* width: 60%; */
    }

    .tm_invoice.tm_style1 .tm_invoice_table {
        grid-gap: 1px;
    }

    .tm_invoice.tm_style1 .tm_invoice_table>* {
        border: 1px solid #dbdfea;
        margin: -1px;
        padding: 8px 15px 10px;
    }

    .tm_invoice.tm_style1 .tm_invoice_head {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: justify;
        -ms-flex-pack: justify;
        justify-content: space-between;
    }

    .tm_invoice.tm_style1 .tm_invoice_head .tm_invoice_right div {
        line-height: 1em;
    }

    .tm_invoice.tm_style1 .tm_invoice_info {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;

        -webkit-box-pack: justify;
        -ms-flex-pack: justify;
        justify-content: space-between;
    }

    .tm_invoice.tm_style1 .tm_invoice_info_2 {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: justify;
        -ms-flex-pack: justify;
        justify-content: space-between;
        border-top: 1px solid #dbdfea;
        border-bottom: 1px solid #dbdfea;
        padding: 11px 0;
    }

    .tm_invoice.tm_style1 .tm_invoice_seperator {
        min-height: 18px;
        border-radius: 1.6em;
        -webkit-box-flex: 1;
        -ms-flex: 1;
        flex: 1;
        margin-right: 20px;
    }

    .tm_invoice.tm_style1 .tm_invoice_info_list {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
    }

    .tm_invoice.tm_style1 .tm_invoice_info_list>*:not(:last-child) {
        margin-right: 20px;
    }

    .tm_invoice.tm_style1 .tm_logo img {
        /* max-height: 50px; */
        width: 100px;
    }

    .tm_invoice.tm_style1 .tm_logo.tm_size1 img {
        max-height: 60px;
    }

    .tm_invoice.tm_style1 .tm_logo.tm_size2 img {
        max-height: 70px;
    }

    .tm_invoice.tm_style1 .tm_grand_total {
        padding: 8px 15px;
    }

    .tm_invoice.tm_style1 .tm_box_3 {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
    }

    .tm_invoice.tm_style1 .tm_box_3>* {
        -webkit-box-flex: 1;
        -ms-flex: 1;
        flex: 1;
    }

    .tm_invoice.tm_style1 .tm_box_3 ul {
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .tm_invoice.tm_style1 .tm_box_3 ul li {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
    }

    .tm_invoice.tm_style1 .tm_box_3 ul li:not(:last-child) {
        margin-bottom: 5px;
    }

    .tm_invoice.tm_style1 .tm_box_3 ul span {
        -webkit-box-flex: 0;
        -ms-flex: none;
        flex: none;
    }

    .tm_invoice.tm_style1 .tm_box_3 ul span:first-child {
        margin-right: 5px;
    }

    .tm_invoice.tm_style1 .tm_box_3 ul span:last-child {
        -webkit-box-flex: 1;
        -ms-flex: 1;
        flex: 1;
    }

    .tm_invoice.tm_style2 .tm_invoice_head {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        border-bottom: 1px solid #dbdfea;
        padding-bottom: 15px;
        position: relative;
    }

    .tm_invoice.tm_style2 .tm_invoice_left {
        width: 30%;
        -webkit-box-flex: 0;
        -ms-flex: none;
        flex: none;
    }

    .tm_invoice.tm_style2 .tm_invoice_right {
        width: 70%;
        -webkit-box-flex: 0;
        -ms-flex: none;
        flex: none;
    }

    .tm_invoice.tm_style2 .tm_invoice_info {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
    }

    .tm_invoice.tm_style2 .tm_invoice_info_left {
        width: 30%;
        -webkit-box-flex: 0;
        -ms-flex: none;
        flex: none;
    }

    .tm_invoice.tm_style2 .tm_invoice_info_right {
        width: 70%;
        -webkit-box-flex: 0;
        -ms-flex: none;
        flex: none;
    }

    .tm_invoice.tm_style2 .tm_logo img {
        max-height: 60px;
    }

    .tm_invoice.tm_style2 .tm_invoice_title {
        line-height: 0.8em;
    }

    .tm_invoice.tm_style2 .tm_invoice_info_in {
        padding: 12px 20px;
        border-radius: 10px;
    }

    .tm_invoice.tm_style2 .tm_card_note {
        display: inline-block;
        padding: 6px 15px;
        border-radius: 6px;
        margin-bottom: 10px;
        margin-top: 5px;
    }

    .tm_invoice.tm_style2 .tm_invoice_footer .tm_left_footer {
        padding-left: 0;
    }

    .tm_invoice.tm_style1.tm_type1 {
        padding: 0px 50px 30px;
        position: relative;
        overflow: hidden;
        border-radius: 0;
    }

    .tm_invoice.tm_style1.tm_type1 .tm_invoice_head {
        height: 110px;
        position: relative;
    }

    .tm_invoice.tm_style1.tm_type1 .tm_shape_bg {
        position: absolute;
        height: 100%;
        width: 70%;
        -webkit-transform: skewX(35deg);
        transform: skewX(35deg);
        top: 0px;
        right: -100px;
        overflow: hidden;
    }

    .tm_invoice.tm_style1.tm_type1 .tm_shape_bg img {
        height: 100%;
        width: 100%;
        -o-object-fit: cover;
        object-fit: cover;
        -webkit-transform: skewX(-35deg) translateX(-45px);
        transform: skewX(-35deg) translateX(-45px);
    }

    .tm_invoice.tm_style1.tm_type1 .tm_invoice_right {
        position: relative;
        z-index: 2;
    }

    .tm_invoice.tm_style1.tm_type1 .tm_logo img {
        max-height: 70px;
    }

    .tm_invoice.tm_style1.tm_type1 .tm_invoice_seperator {
        margin-right: 0;
        border-radius: 0;
        -webkit-transform: skewX(35deg);
        transform: skewX(35deg);
        position: absolute;
        height: 100%;
        width: 57.5%;
        right: -60px;
        overflow: hidden;
        border: none;
    }

    .tm_invoice.tm_style1.tm_type1 .tm_invoice_seperator img {
        height: 100%;
        width: 100%;
        -o-object-fit: cover;
        object-fit: cover;
        -webkit-transform: skewX(-35deg);
        transform: skewX(-35deg);
        -webkit-transform: skewX(-35deg) translateX(-10px);
        transform: skewX(-35deg) translateX(-10px);
    }

    .tm_invoice.tm_style1.tm_type1 .tm_invoice_info {
        position: relative;
        padding: 4px 0;
    }

    .tm_invoice.tm_style1.tm_type1 .tm_card_note,
    .tm_invoice.tm_style1.tm_type1 .tm_invoice_info_list {
        position: relative;
        z-index: 1;
    }

    .tm_invoice.tm_style3 {
        padding: 0;
    }

    .tm_invoice.tm_style3 .tm_invoice_head {
        padding: 60px 50px;
        position: relative;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: justify;
        -ms-flex-pack: justify;
        justify-content: space-between;
        border-radius: 10px 10px 0 0;
    }

    .tm_invoice.tm_style3 .tm_head_address {
        border-left: 2px solid;
        padding: 0px 0 0px 15px;
    }

    .tm_invoice.tm_style3 .tm_invoice_left,
    .tm_invoice.tm_style3 .tm_invoice_right {
        position: relative;
        z-index: 1;
    }

    .tm_invoice.tm_style3 .tm_watermark_title {
        position: absolute;
        left: 0;
        top: 0;
        line-height: 1em;
        font-size: 165px;
        font-weight: bold;
        padding: 20px 30px 20px 30px;
        letter-spacing: 18px;
        opacity: 0.08;
    }

    .tm_invoice.tm_style3 .tm_invoice_info {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: justify;
        -ms-flex-pack: justify;
        justify-content: space-between;
        -webkit-box-align: end;
        -ms-flex-align: end;
        align-items: flex-end;
        padding: 0 50px;
        margin-top: -25px;
        padding-bottom: 40px;
    }

    .tm_invoice.tm_style3 .tm_invoice_info_left {
        padding: 20px 30px;
        position: relative;
        z-index: 2;
    }

    .tm_invoice.tm_style3 .tm_invoice_details {
        padding: 0 50px 50px 50px;
    }

    .tm_invoice.tm_style3 .tm_table.tm_style1 th {
        border-color: rgba(255, 255, 255, 0.231372549);
    }

    .tm_invoice.tm_style3 .tm_invoice_footer .tm_left_footer {
        padding: 20px 15px;
    }

    @media (min-width: 500px) {
        .tm_invoice.tm_style1.tm_type2 {
            position: relative;
            overflow: hidden;
            border-radius: 0;
        }

        .tm_invoice.tm_style1.tm_type2 td {
            padding-top: 12px;
            padding-bottom: 12px;
        }

        .tm_invoice.tm_style1.tm_type2 .tm_pt0 {
            padding-top: 0;
        }

        .tm_invoice.tm_style1.tm_type2 .tm_bars {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            position: absolute;
            top: 0px;
            left: 50%;
            -webkit-transform: translateX(-50%);
            transform: translateX(-50%);
            overflow: hidden;
            padding: 0 15px;
        }

        .tm_invoice.tm_style1.tm_type2 .tm_bars span {
            height: 100px;
            width: 5px;
            display: block;
            margin: -15px 20px 0;
            -webkit-transform: rotate(-40deg);
            transform: rotate(-40deg);
        }

        .tm_invoice.tm_style1.tm_type2 .tm_bars.tm_type1 {
            top: initial;
            bottom: 0;
        }

        .tm_invoice.tm_style1.tm_type2 .tm_bars.tm_type1 span {
            margin: 0 20px 0;
            position: relative;
            bottom: -15px;
        }

        .tm_invoice.tm_style1.tm_type2 .tm_shape {
            height: 230px;
            width: 250px;
            position: absolute;
            top: 0;
            right: 0;
            overflow: hidden;
        }

        .tm_invoice.tm_style1.tm_type2 .tm_shape .tm_shape_in {
            position: absolute;
            height: 350px;
            width: 350px;
            -webkit-transform: rotate(40deg);
            transform: rotate(40deg);
            top: -199px;
            left: 67px;
            overflow: hidden;
        }

        .tm_invoice.tm_style1.tm_type2 .tm_shape.tm_type1 {
            top: initial;
            bottom: 0;
            right: initial;
            left: 0;
        }

        .tm_invoice.tm_style1.tm_type2 .tm_shape.tm_type1 .tm_shape_in {
            top: 135px;
            left: -153px;
        }

        .tm_invoice.tm_style1.tm_type2 .tm_shape_2 {
            height: 120px;
            width: 120px;
            border: 5px solid currentColor;
            padding: 20px;
            position: absolute;
            bottom: -30px;
            right: 77px;
            -webkit-transform: rotate(45deg);
            transform: rotate(45deg);
        }

        .tm_invoice.tm_style1.tm_type2 .tm_shape_2 .tm_shape_2_in {
            height: 100%;
            width: 100%;
            border: 20px solid currentColor;
        }

        .tm_invoice.tm_style1.tm_type2 .tm_shape_2.tm_type1 {
            left: -76px;
            right: initial;
            bottom: 245px;
        }

        .tm_invoice.tm_style1.tm_type2 .tm_shape_2.tm_type1 .tm_shape_2_in {
            border-width: 6px;
        }

        .tm_invoice.tm_style1.tm_type2 .tm_invoice_right {
            width: 40%;
        }

        .tm_invoice.tm_style1.tm_type2 .tm_logo img {
            max-height: 65px;
        }

        .tm_invoice.tm_style1.tm_type2 .tm_invoice_footer {
            margin-bottom: 120px;
        }

        .tm_invoice.tm_style1.tm_type2 .tm_right_footer {
            position: relative;
            padding: 6px 0;
        }

        .tm_invoice.tm_style1.tm_type2 .tm_right_footer table {
            position: relative;
            z-index: 2;
        }

        .tm_invoice.tm_style1.tm_type2 .tm_left_footer {
            padding: 30px 15px;
        }

        .tm_invoice.tm_style1.tm_type2 .tm_shape_3 {
            position: absolute;
            top: 0;
            left: -40px;
            height: 100%;
            width: calc(100% + 150px);
            -webkit-transform: skewX(35deg);
            transform: skewX(35deg);
        }

        .tm_invoice.tm_style1.tm_type2 .tm_shape_4 {
            position: absolute;
            bottom: 200px;
            left: 0;
            height: 200px;
            width: 200px;
        }
    }

    .tm_invoice.tm_style1.tm_type3 {
        position: relative;
        overflow: hidden;
        border-radius: 0;
    }

    .tm_invoice.tm_style1.tm_type3 .tm_shape_1 {
        position: absolute;
        top: -1px;
        left: 0;
    }

    .tm_invoice.tm_style1.tm_type3 .tm_shape_2 {
        position: absolute;
        bottom: 0;
        left: 0;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
    }

    .tm_invoice.tm_style1.tm_type3 .tm_logo img {
        max-height: 60px;
    }

    .tm_invoice.tm_style1.tm_type3 .tm_invoice_head.tm_mb20 {
        margin-bottom: 65px;
    }

    .tm_invoice.tm_style1.tm_type3 .tm_invoice_info_list {
        position: relative;
        padding: 10px 0 10px 40px;
    }

    .tm_invoice.tm_style1.tm_type3 .tm_invoice_info_list_bg {
        position: absolute;
        height: 100%;
        width: calc(100% + 100px);
        top: 0;
        left: 0;
        border-radius: 20px 0 0 0px;
        -webkit-transform: skewX(-35deg);
        transform: skewX(-35deg);
    }

    .tm_invoice.tm_style2.tm_type1 {
        padding-top: 0;
        padding-bottom: 0;
        border-width: 40px 0 0;
        border-style: solid;
        position: relative;
        overflow: hidden;
    }

    .tm_invoice.tm_style2.tm_type1.tm_small_border {
        border-width: 7px 0 0;
    }

    .tm_invoice.tm_style2.tm_type1 .tm_shape_bg {
        position: absolute;
        height: 100%;
        width: 42%;
        -webkit-transform: skewX(-35deg);
        transform: skewX(-35deg);
        top: 0px;
        left: -100px;
    }

    .tm_invoice.tm_style2.tm_type1 .tm_invoice_head {
        padding-top: 15px;
        border-bottom: none;
    }

    .tm_invoice.tm_style2.tm_type1 .tm_logo {
        position: relative;
        z-index: 2;
    }

    .tm_invoice.tm_style2.tm_type1 .tm_bottom_invoice {
        position: relative;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        padding: 15px 50px 20px;
        border-top: 1px solid #dbdfea;
        -webkit-box-pack: justify;
        -ms-flex-pack: justify;
        justify-content: space-between;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        margin: 30px -50px 0;
    }

    .tm_invoice_content {
        position: relative;
        z-index: 10;
    }

    .tm_invoice_wrap {
        position: relative;
    }

    .tm_note_list li:not(:last-child) {
        margin-bottom: 5px;
    }

    .tm_list.tm_style1 {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .tm_list.tm_style1 svg {
        width: 16px;
        height: initial;
    }

    .tm_list.tm_style1 .tm_list_icon {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        position: absolute;
        left: 0;
        top: 3px;
    }

    .tm_list.tm_style1 li {
        padding-left: 25px;
        position: relative;
    }

    .tm_list.tm_style1 li:not(:last-child) {
        margin-bottom: 5px;
    }

    .tm_list.tm_style1.tm_text_right li {
        padding-left: 0;
        padding-right: 25px;
    }

    .tm_list.tm_style1.tm_text_right .tm_list_icon {
        left: initial;
        right: 0;
    }

    .tm_section_heading {
        border-width: 0 0 1px 0;
        border-style: solid;
    }

    .tm_section_heading>span {
        display: inline-block;
        padding: 8px 15px;
        border-radius: 7px 7px 0 0;
    }

    .tm_section_heading .tm_curve_35 {
        margin-left: 12px;
        margin-right: 0;
    }

    .tm_section_heading .tm_curve_35 span {
        display: inline-block;
    }

    .tm_padd_15_20 {
        padding: 15px 20px;
    }

    .tm_padd_8_20 {
        padding: 8px 20px;
    }

    .tm_padd_20 {
        padding: 20px;
    }

    .tm_padd_15 {
        padding: 15px;
    }

    .tm_padd_10 {
        padding: 10px;
    }

    .tm_padd_5 {
        padding: 5px;
    }

    .tm_curve_35 {
        -webkit-transform: skewX(-35deg);
        transform: skewX(-35deg);
        padding: 12px 20px 12px 30px;
        margin-left: 22px;
        margin-right: 22px;
    }

    .tm_curve_35>* {
        -webkit-transform: skewX(35deg);
        transform: skewX(35deg);
    }

    .tm_dark_invoice_body {
        background-color: #18191a;
    }

    .tm_dark_invoice {
        background: #252526;
        color: rgba(255, 255, 255, 0.65);
    }

    .tm_dark_invoice .tm_primary_color {
        color: rgba(255, 255, 255, 0.9);
    }

    .tm_dark_invoice .tm_secondary_color {
        color: rgba(255, 255, 255, 0.65);
    }

    .tm_dark_invoice .tm_ternary_color {
        color: rgba(255, 255, 255, 0.4);
    }

    .tm_dark_invoice .tm_gray_bg {
        background: rgba(255, 255, 255, 0.08);
    }

    .tm_dark_invoice .tm_border_color,
    .tm_dark_invoice .tm_round_border,
    .tm_dark_invoice td,
    .tm_dark_invoice th,
    .tm_dark_invoice .tm_border_top,
    .tm_dark_invoice .tm_border_bottom {
        border-color: rgba(255, 255, 255, 0.1);
    }

    .tm_dark_invoice+.tm_invoice_btns {
        background: #252526;
        border-color: #252526;
    }

    @media (min-width: 1000px) {
        .tm_invoice_btns {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            margin-top: 0px;
            margin-left: 20px;
            position: absolute;
            left: 100%;
            top: 0;
            -webkit-box-shadow: -2px 0 24px -2px rgba(43, 55, 72, 0.05);
            box-shadow: -2px 0 24px -2px rgba(43, 55, 72, 0.05);
            border: 3px solid #fff;
            border-radius: 6px;
            background-color: #fff;
        }

        .tm_invoice_btn {
            display: -webkit-inline-box;
            display: -ms-inline-flexbox;
            display: inline-flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            border: none;
            font-weight: 600;
            cursor: pointer;
            padding: 0;
            background-color: transparent;
            position: relative;
        }

        .tm_invoice_btn svg {
            width: 24px;
        }

        .tm_invoice_btn .tm_btn_icon {
            padding: 0;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            height: 42px;
            width: 42px;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
        }

        .tm_invoice_btn .tm_btn_text {
            position: absolute;
            left: 100%;
            background-color: #111;
            color: #fff;
            padding: 3px 12px;
            display: inline-block;
            margin-left: 10px;
            border-radius: 5px;
            top: 50%;
            -webkit-transform: translateY(-50%);
            transform: translateY(-50%);
            font-weight: 500;
            min-height: 28px;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            opacity: 0;
            visibility: hidden;
        }

        .tm_invoice_btn .tm_btn_text:before {
            content: "";
            height: 10px;
            width: 10px;
            position: absolute;
            background-color: #111;
            -webkit-transform: rotate(45deg);
            transform: rotate(45deg);
            left: -3px;
            top: 50%;
            margin-top: -6px;
            border-radius: 2px;
        }

        .tm_invoice_btn:hover .tm_btn_text {
            opacity: 1;
            visibility: visible;
        }

        .tm_invoice_btn:not(:last-child) {
            margin-bottom: 3px;
        }

        .tm_invoice_btn.tm_color1 {
            background-color: rgba(0, 122, 255, 0.1);
            color: #007aff;
            border-radius: 5px 5px 0 0;
        }

        .tm_invoice_btn.tm_color1:hover {
            background-color: rgba(0, 122, 255, 0.2);
        }

        .tm_invoice_btn.tm_color2 {
            background-color: rgba(52, 199, 89, 0.1);
            color: #34c759;
            border-radius: 0 0 5px 5px;
        }

        .tm_invoice_btn.tm_color2:hover {
            background-color: rgba(52, 199, 89, 0.2);
        }
    }

    @media (max-width: 999px) {
        .tm_invoice_btns {
            display: -webkit-inline-box;
            display: -ms-inline-flexbox;
            display: inline-flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            margin-top: 0px;
            margin-top: 20px;
            -webkit-box-shadow: -2px 0 24px -2px rgba(43, 55, 72, 0.05);
            box-shadow: -2px 0 24px -2px rgba(43, 55, 72, 0.05);
            border: 3px solid #fff;
            border-radius: 6px;
            background-color: #fff;
            position: relative;
            left: 50%;
            -webkit-transform: translateX(-50%);
            transform: translateX(-50%);
        }

        .tm_invoice_btn {
            display: -webkit-inline-box;
            display: -ms-inline-flexbox;
            display: inline-flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            border: none;
            font-weight: 600;
            cursor: pointer;
            padding: 0;
            background-color: transparent;
            position: relative;
            border-radius: 5px;
            padding: 6px 15px;
        }

        .tm_invoice_btn svg {
            width: 24px;
        }

        .tm_invoice_btn .tm_btn_icon {
            padding: 0;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            margin-right: 8px;
        }

        .tm_invoice_btn:not(:last-child) {
            margin-right: 3px;
        }

        .tm_invoice_btn.tm_color1 {
            background-color: rgba(0, 122, 255, 0.1);
            color: #007aff;
        }

        .tm_invoice_btn.tm_color1:hover {
            background-color: rgba(0, 122, 255, 0.2);
        }

        .tm_invoice_btn.tm_color2 {
            background-color: rgba(52, 199, 89, 0.1);
            color: #34c759;
        }

        .tm_invoice_btn.tm_color2:hover {
            background-color: rgba(52, 199, 89, 0.2);
        }
    }

    @media (max-width: 767px) {
        .tm_col_4 {
            grid-template-columns: repeat(1, 1fr);
        }

        .tm_col_2_md {
            grid-template-columns: repeat(2, 1fr);
        }

        .tm_m0_md {
            margin: 0;
        }

        .tm_mb10_md {
            margin-bottom: 10px;
        }

        .tm_mb15_md {
            margin-bottom: 15px;
        }

        .tm_mb20_md {
            margin-bottom: 20px;
        }

        .tm_mobile_hide {
            display: none;
        }

        .tm_invoice {
            padding: 30px 20px;
        }

        .tm_invoice .tm_right_footer {
            width: 100%;
        }

        .tm_invoice_footer {
            -webkit-box-orient: vertical;
            -webkit-box-direction: reverse;
            -ms-flex-direction: column-reverse;
            flex-direction: column-reverse;
        }

        .tm_invoice_footer .tm_left_footer {
            width: 100%;
            border-top: 1px solid #dbdfea;
            margin-top: -1px;
            padding: 15px 0;
        }

        .tm_invoice.tm_style2 .tm_card_note {
            margin-top: 0;
        }

        .tm_note.tm_text_center {
            text-align: left;
        }

        .tm_note.tm_text_center p br {
            display: none;
        }

        .tm_invoice_footer.tm_type1 {
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
        }

        .tm_invoice.tm_style2 .tm_invoice_head {
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
        }

        .tm_invoice.tm_style2 .tm_invoice_head>* {
            width: 100%;
        }

        .tm_invoice.tm_style2 .tm_invoice_head .tm_invoice_left {
            margin-bottom: 15px;
        }

        .tm_invoice.tm_style2 .tm_invoice_head .tm_text_right {
            text-align: left;
        }

        .tm_invoice.tm_style2 .tm_invoice_info {
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
        }

        .tm_invoice.tm_style2 .tm_invoice_info>* {
            width: 100%;
        }

        .tm_invoice.tm_style1.tm_type1 {
            padding: 30px 20px;
        }

        .tm_invoice.tm_style1.tm_type1 .tm_invoice_head {
            height: initial;
        }

        .tm_invoice.tm_style1.tm_type1 .tm_invoice_info {
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            -webkit-box-align: start;
            -ms-flex-align: start;
            align-items: flex-start;
            padding-left: 15px;
            padding-right: 15px;
        }

        .tm_invoice.tm_style1.tm_type1 .tm_invoice_seperator {
            width: 100%;
            -webkit-transform: initial;
            transform: initial;
            right: 0;
            top: 0;
        }

        .tm_invoice.tm_style1.tm_type1 .tm_logo img {
            max-height: 60px;
        }

        .tm_invoice.tm_style2.tm_type1 {
            border-width: 20px 0 0;
        }

        .tm_invoice.tm_style2.tm_type1 .tm_shape_bg {
            width: 250px;
            height: 80px;
        }

        .tm_invoice.tm_style2.tm_type1 .tm_invoice_head .tm_text_center {
            text-align: left;
        }

        .tm_invoice.tm_style2.tm_type1 .tm_logo {
            top: -8px;
            margin-bottom: 15px;
        }

        .tm_invoice.tm_style2 .tm_invoice_info_in {
            padding: 12px 15px;
        }

        .tm_border_none_md {
            border: none !important;
        }

        .tm_border_left_none_md {
            border-left-width: 0;
        }

        .tm_border_right_none_md {
            border-right-width: 0;
        }

        .tm_padd_left_15_md {
            padding-left: 15px !important;
        }

        .tm_invoice.tm_style2 .tm_logo img {
            max-height: 50px;
        }

        .tm_curve_35 {
            -webkit-transform: skewX(0deg);
            transform: skewX(0deg);
            margin-left: 0;
            margin-right: 0;
        }

        .tm_curve_35>* {
            -webkit-transform: inherit;
            transform: inherit;
        }

        .tm_invoice.tm_style1.tm_type1 .tm_invoice_seperator,
        .tm_invoice.tm_style1.tm_type1 .tm_invoice_seperator img {
            -webkit-transform: initial;
            transform: initial;
        }

        .tm_section_heading .tm_curve_35 {
            margin-left: 0;
        }

        .tm_shape_2.tm_type1 {
            display: none;
        }

        .tm_invoice.tm_style3 .tm_invoice_info {
            padding: 0px 20px 40px;
        }

        .tm_invoice.tm_style3 .tm_invoice_details {
            padding: 0px 20px 50px;
        }

        .tm_invoice.tm_style3 .tm_invoice_head {
            padding: 60px 20px;
        }

        .tm_invoice.tm_style3 .tm_watermark_title {
            letter-spacing: 5px;
            font-size: 20vw;
            padding: 27px 20px;
            top: 50%;
            -webkit-transform: translateY(-50%);
            transform: translateY(-50%);
            line-height: 1em;
        }
    }

    @media (max-width: 500px) {
        .tm_border_none_sm {
            border: none !important;
        }

        .tm_flex_column_sm {
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
        }

        .tm_align_start_sm {
            -webkit-box-align: start;
            -ms-flex-align: start;
            align-items: flex-start;
        }

        .tm_m0_sm {
            margin-bottom: 0;
        }

        .tm_invoice.tm_style1 .tm_logo {
            margin-bottom: 10px;
        }

        .tm_invoice.tm_style1 .tm_invoice_head {
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
        }

        .tm_invoice.tm_style1 .tm_invoice_head .tm_invoice_left,
        .tm_invoice.tm_style1 .tm_invoice_head .tm_invoice_right {
            width: 100%;
        }

        .tm_invoice.tm_style1 .tm_invoice_head .tm_invoice_right {
            text-align: left;
        }

        .tm_list.tm_style2 li {
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
        }

        .tm_list.tm_style2 li>* {
            padding: 5px 20px;
        }

        .tm_col_2,
        .tm_col_3 {
            grid-template-columns: repeat(1, 1fr);
        }

        .tm_col_2_sm {
            grid-template-columns: repeat(2, 1fr);
        }

        .tm_table.tm_style1.tm_type1 {
            padding: 0px 20px;
        }

        .tm_box2_wrap {
            grid-template-columns: repeat(1, 1fr);
        }

        .tm_box.tm_style1.tm_type1 {
            max-width: 100%;
            width: 100%;
        }

        .tm_invoice.tm_style1 .tm_invoice_left {
            max-width: 100%;
        }

        .tm_f50 {
            font-size: 30px;
        }

        .tm_invoice.tm_style1 .tm_invoice_info {
            -webkit-box-orient: vertical;
            -webkit-box-direction: reverse;
            -ms-flex-direction: column-reverse;
            flex-direction: column-reverse;
        }

        .tm_invoice.tm_style1 .tm_invoice_seperator {
            -webkit-box-flex: 0;
            -ms-flex: none;
            flex: none;
            width: 100%;
            margin-right: 0;
            min-height: 5px;
        }

        .tm_invoice.tm_style1 .tm_invoice_info_list {
            width: 100%;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
        }

        .tm_invoice.tm_style1 .tm_invoice_seperator+.tm_invoice_info_list {
            margin-bottom: 5px;
        }

        .tm_f30 {
            font-size: 22px;
        }

        .tm_invoice.tm_style1 .tm_box_3 {
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
        }

        .tm_invoice.tm_style1 .tm_box_3 span br {
            display: none;
        }

        .tm_invoice.tm_style1 .tm_box_3>*:not(:last-child) {
            margin-bottom: 15px;
        }

        .tm_invoice.tm_style1 .tm_box_3 ul li {
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
        }

        .tm_invoice.tm_style1 .tm_box_3 ul li:not(:last-child) {
            margin-bottom: 5px;
        }

        .tm_invoice.tm_style3 .tm_watermark_title {
            font-size: 18.4vw;
            padding: 10px 15px;
            top: 0;
            -webkit-transform: initial;
            transform: initial;
            line-height: 1em;
        }

        .tm_invoice.tm_style3 .tm_invoice_head,
        .tm_invoice.tm_style3 .tm_invoice_info {
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            -webkit-box-align: start;
            -ms-flex-align: start;
            align-items: flex-start;
        }

        .tm_invoice.tm_style3 .tm_invoice_right {
            margin-top: 30px;
        }

        .tm_invoice.tm_style3 .tm_text_right {
            text-align: left;
        }

        .tm_invoice.tm_style3 .tm_invoice_info_right {
            margin-top: 20px;
        }

        .tm_invoice.tm_style3 .tm_table.tm_style1 {
            margin-bottom: 10px;
        }
    }

    /*--------------------------------------------------------------
  Will apply only print window
----------------------------------------------------------------*/
    @media print {
        .tm_gray_bg {
            background-color: #f5f6fa !important;
            -webkit-print-color-adjust: exact;
        }

        .tm_ternary_bg {
            background-color: #b5b5b5 !important;
            -webkit-print-color-adjust: exact;
        }

        .tm_primary_bg {
            background-color: #111 !important;
            -webkit-print-color-adjust: exact;
        }

        .tm_secondary_bg {
            background-color: #666 !important;
            -webkit-print-color-adjust: exact;
        }

        .tm_accent_bg {
            background-color: #007aff;
            -webkit-print-color-adjust: exact;
        }

        .tm_accent_bg_10 {
            background-color: rgba(0, 122, 255, 0.1) !important;
            -webkit-print-color-adjust: exact;
        }

        .tm_accent_bg_20 {
            background-color: rgba(0, 122, 255, 0.15) !important;
            -webkit-print-color-adjust: exact;
        }

        .tm_white_color {
            color: #fff !important;
            -webkit-print-color-adjust: exact;
        }

        .tm_accent_color {
            color: #007aff !important;
            -webkit-print-color-adjust: exact;
        }

        .tm_ternary_color {
            color: #b5b5b5 !important;
            -webkit-print-color-adjust: exact;
        }

        .tm_hide_print {
            display: none !important;
        }

        .tm_dark_invoice .tm_gray_bg {
            background-color: #111 !important;
            -webkit-print-color-adjust: exact;
        }

        .tm_dark_invoice {
            background: #111 !important;
            color: rgba(255, 255, 255, 0.65) !important;
            -webkit-print-color-adjust: exact;
        }

        .tm_dark_invoice .tm_gray_bg {
            background: rgba(255, 255, 255, 0.05) !important;
            -webkit-print-color-adjust: exact;
        }

        hr {
            background: #dbdfea !important;
            -webkit-print-color-adjust: exact;
        }

        .tm_col_4,
        .tm_col_4.tm_col_2_md {
            grid-template-columns: repeat(4, 1fr);
        }

        .tm_col_2_md {
            grid-template-columns: repeat(2, 1fr);
        }

        .tm_mb1 {
            margin-bottom: 1px;
        }

        .tm_mb2 {
            margin-bottom: 2px;
        }

        .tm_mb3 {
            margin-bottom: 3px;
        }

        .tm_mb4 {
            margin-bottom: 4px;
        }

        .tm_mb5 {
            margin-bottom: 5px;
        }

        .tm_mb6 {
            margin-bottom: 6px;
        }

        .tm_mb7 {
            margin-bottom: 7px;
        }

        .tm_mb8 {
            margin-bottom: 8px;
        }

        .tm_mb9 {
            margin-bottom: 9px;
        }

        .tm_mb10 {
            margin-bottom: 10px;
        }

        .tm_mb11 {
            margin-bottom: 11px;
        }

        .tm_mb12 {
            margin-bottom: 12px;
        }

        .tm_mb13 {
            margin-bottom: 13px;
        }

        .tm_mb14 {
            margin-bottom: 14px;
        }

        .tm_mb15 {
            margin-bottom: 15px;
        }

        .tm_mb16 {
            margin-bottom: 16px;
        }

        .tm_mb17 {
            margin-bottom: 17px;
        }

        .tm_mb18 {
            margin-bottom: 18px;
        }

        .tm_mb19 {
            margin-bottom: 19px;
        }

        .tm_mb20 {
            margin-bottom: 20px;
        }

        .tm_mb21 {
            margin-bottom: 21px;
        }

        .tm_mb22 {
            margin-bottom: 22px;
        }

        .tm_mb23 {
            margin-bottom: 23px;
        }

        .tm_mb24 {
            margin-bottom: 24px;
        }

        .tm_mb25 {
            margin-bottom: 25px;
        }

        .tm_mb26 {
            margin-bottom: 26px;
        }

        .tm_mb27 {
            margin-bottom: 27px;
        }

        .tm_mb28 {
            margin-bottom: 28px;
        }

        .tm_mb29 {
            margin-bottom: 29px;
        }

        .tm_mb30 {
            margin-bottom: 30px;
        }

        .tm_mb40 {
            margin-bottom: 40px;
        }

        .tm_mobile_hide {
            display: block;
        }

        .tm_invoice {
            padding: 10px;
        }

        .tm_invoice .tm_right_footer {
            width: 42%;
        }

        .tm_invoice_footer {
            -webkit-box-orient: initial;
            -webkit-box-direction: initial;
            -ms-flex-direction: initial;
            flex-direction: initial;
        }

        .tm_invoice_footer .tm_left_footer {
            width: 58%;
            padding: 10px 15px;
            -webkit-box-flex: 0;
            -ms-flex: none;
            flex: none;
            border-top: none;
            margin-top: 0px;
        }

        .tm_invoice.tm_style2 .tm_card_note {
            margin-top: 5px;
        }

        .tm_note.tm_text_center {
            text-align: center;
        }

        .tm_note.tm_text_center p br {
            display: initial;
        }

        .tm_invoice_footer.tm_type1 {
            -webkit-box-orient: initial;
            -webkit-box-direction: initial;
            -ms-flex-direction: initial;
            flex-direction: initial;
        }

        .tm_invoice.tm_style2 .tm_invoice_head {
            -webkit-box-orient: initial;
            -webkit-box-direction: initial;
            -ms-flex-direction: initial;
            flex-direction: initial;
        }

        .tm_invoice.tm_style2 .tm_invoice_head>.tm_invoice_left {
            width: 30%;
        }

        .tm_invoice.tm_style2 .tm_invoice_head>.tm_invoice_right {
            width: 70%;
        }

        .tm_invoice.tm_style2 .tm_invoice_head .tm_invoice_left {
            margin-bottom: initial;
        }

        .tm_invoice.tm_style2 .tm_invoice_head .tm_text_right {
            text-align: right;
        }

        .tm_invoice.tm_style2 .tm_invoice_info {
            -webkit-box-orient: initial;
            -webkit-box-direction: initial;
            -ms-flex-direction: initial;
            flex-direction: initial;
        }

        .tm_invoice.tm_style2 .tm_invoice_info>.tm_invoice_info_left {
            width: 30%;
        }

        .tm_invoice.tm_style2 .tm_invoice_info>.tm_invoice_info_right {
            width: 70%;
        }

        .tm_invoice.tm_style1.tm_type1 {
            padding: 0px 20px 30px;
        }

        .tm_invoice.tm_style1.tm_type1 .tm_invoice_head {
            height: 110px;
        }

        .tm_invoice.tm_style1.tm_type1 .tm_invoice_info {
            padding: 4px 0;
            -webkit-box-orient: initial;
            -webkit-box-direction: initial;
            -ms-flex-direction: initial;
            flex-direction: initial;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
        }

        .tm_invoice.tm_style1.tm_type1 .tm_invoice_seperator {
            top: initial;
            margin-right: 0;
            border-radius: 0;
            -webkit-transform: skewX(35deg);
            transform: skewX(35deg);
            position: absolute;
            height: 100%;
            width: 57.5%;
            right: -60px;
            overflow: hidden;
            border: none;
        }

        .tm_invoice.tm_style1.tm_type1 .tm_logo img {
            max-height: 70px;
        }

        .tm_invoice.tm_style2.tm_type1 {
            border-width: 20px 0 0;
        }

        .tm_invoice.tm_style2.tm_type1 .tm_shape_bg {
            height: 100%;
            width: 42%;
        }

        .tm_invoice.tm_style2.tm_type1 .tm_invoice_head .tm_text_center {
            text-align: center;
        }

        .tm_invoice.tm_style2.tm_type1 .tm_logo {
            top: initial;
            margin-bottom: initial;
        }

        .tm_invoice.tm_style2 .tm_invoice_info_in {
            padding: 12px 20px;
        }

        .tm_invoice.tm_style2 .tm_logo img {
            max-height: 60px;
        }

        .tm_curve_35 {
            -webkit-transform: skewX(-35deg);
            transform: skewX(-35deg);
            margin-left: 22px;
            margin-right: 22px;
        }

        .tm_curve_35>* {
            -webkit-transform: skewX(35deg);
            transform: skewX(35deg);
        }

        .tm_invoice.tm_style1.tm_type1 .tm_invoice_seperator {
            -webkit-transform: skewX(35deg);
            transform: skewX(35deg);
        }

        .tm_invoice.tm_style1.tm_type1 .tm_invoice_seperator img {
            -webkit-transform: skewX(-35deg) translateX(-45px);
            transform: skewX(-35deg) translateX(-45px);
        }

        .tm_section_heading .tm_curve_35 {
            margin-left: 12px;
        }

        .tm_round_border {
            border-top-width: 2px;
        }

        .tm_border_left_none_md {
            border-left-width: 1px;
        }

        .tm_border_right_none_md {
            border-right-width: 1px;
        }

        .tm_note {
            margin-top: 30px;
        }

        .tm_pagebreak {
            page-break-before: always;
        }

        .tm_invoice.tm_style3 {
            padding: 0;
        }

        .tm_invoice.tm_style3 .tm_invoice_info {
            padding: 0px 15px 40px;
        }

        .tm_invoice.tm_style3 .tm_invoice_details {
            padding: 0px 15px 50px;
        }

        .tm_invoice.tm_style3 .tm_invoice_head {
            padding: 60px 15px;
        }

        .tm_invoice.tm_style3 .tm_watermark_title {
            letter-spacing: 5px;
            font-size: 150px;
            padding: 27px 15px 27px 15px;
        }
    }

    /*# sourceMappingURL=style.css.map */
</style>

<body>
    <div class="tm_container">
        <div class="tm_invoice_wrap">
            <div class="tm_invoice tm_style1" id="tm_download_section">
                <div class="tm_invoice_in">
                    <div class="tm_invoice_head tm_align_center tm_mb20">

                        <div class="tm_invoice_left">
                            <b>Reg. UDYAM-UP-43-0045811</b>
                            <div class="tm_logo"><img src="{{ asset('site/img/logo-log.png') }}" alt="Logo"
                                    width="40px;"></div>
                        </div>
                        <div class="tm_invoice_center" style="text-align: center; margin-top:-20px; width: 400px;">
                            <div class="tm_logo">
                                <div class="tm_primary_color tm_f30 tm_text_uppercase">Vikas Logistics</div>
                            </div>
                            <span style=""><br> Head Office:
                                256 Damodar Nagar Barra
                                Kanpur Nagar - 27
                                Uttar Pradesh
                                Contact: +91 88403 54461<br>
                                Email: vikaslogistics14320@gmail.com<br><b></b></span>
                        </div>
                        <div class="tm_invoice_right tm_text_right" style="margin-top:-47px;">

                            <p><b>GSTIN: 09AHQPV3722R2Z7</b></p><span style="font-size: 20px;">

                                <b> <br>Recipt Number<br>
                                    {{ $deliveryReceipt->delivery_number }}

                                </b>
                            </span>

                        </div>
                    </div>
                    <div class="tm_invoice_info tm_mb20">
                        <p class="tm_invoice_seperator tm_primary_color"><b>
                            </b> </p>
                        <div class="tm_invoice_info_list">
                            <b>Booking Type:
                                @if ($deliveryReceipt->booking_type == 'Paid')
                                    Paid
                                @elseif ($deliveryReceipt->booking_type == 'Topay')
                                    Paid
                                @elseif ($deliveryReceipt->booking_type == 3)
                                    To Pay
                                @else
                                    Unknown
                                @endif
                            </b>


                        </div>
                    </div>

                    <div class="tm_table tm_style1">
                        <div class="tm_round_border tm_radius_0">
                            <div class="tm_table_responsive">
                                <table border="1">
                                    <tbody>
                                        <tr>
                                            <th class="tm_width_4 tm_semi_bold tm_primary_color tm_gray_bg"> Booking
                                                Station -
                                                {{ $deliveryReceipt->consignor_branch_name }}
                                            </th>
                                            <th class="tm_width_4 tm_semi_bold tm_primary_color tm_gray_bg">
                                                Delivery Station - {{ $deliveryReceipt->consignee_branch_name }}
                                            </th>

                                            <th class="tm_width_4 tm_semi_bold tm_primary_color tm_gray_bg">
                                                Article:{{ $deliveryReceipt->no_of_artical }}

                                            </th>
                                            <th class="tm_width_4 tm_semi_bold tm_primary_color tm_gray_bg">
                                                Offline Bilti:{{ $deliveryReceipt->manual_bilty_number ?: 'NA' }}<br>
                                                LR Number:{{ $deliveryReceipt->bilti_number }}


                                            </th>

                                        </tr>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tm_invoice_footer tm_border_left tm_border_left_none_md">
                            <div class="tm_left_footer tm_padd_left_15_md">
                                <div style="margin-top:10px;">


                                    <table>
                                        <tbody>

                                            
                                            <tr class="tm_gray_bg tm_border_left tm_border_right">
                                                <td class="tm_width_1 tm_primary_color tm_border_none tm_pt0"><b>
                                                    <b>Date Of Booking - {{ \Carbon\Carbon::parse($deliveryReceipt->bookingDate)->format('d-m-Y') }}</b>
                                                </td>

                                            </tr>
                                            <tr class="tm_gray_bg tm_border_left tm_border_right">
                                                <td class="tm_width_1 tm_primary_color tm_border_none tm_pt0"><b>Recived By
                                                    Thank From:</b>

                                                    <b> {{ ucfirst($deliveryReceipt->recived_by) }}</b>
                                                </td>

                                            </tr>
                                            <tr class="tm_gray_bg tm_border_left tm_border_right">
                                                <td class="tm_width_1 tm_primary_color tm_border_none tm_pt0"><b>Mobile:</b>
                                                    <b>{{ $deliveryReceipt->reciver_mobile }}</b>
                                                    <span class="tm_ternary_color"></span>
                                                </td>

                                            </tr>
                                           
                                        </tbody>

                                    </table>

                                </div>
                                <table border="1" style="margin-top: 5px; font-size: 12px;">
                                    <tbody>

                                        <tr>
                                            <th class="tm_width_1 tm_primary_color tm_gray_bg">Goods Contained (Declare
                                                by Consignor)</th>

                                            <th class="tm_width_1 tm_primary_color tm_gray_bg">
                                            </th>

                                        </tr>


                                        <tr>
                                            <th class="tm_width_1 tm_primary_color tm_gray_bg">Actual Goods value
                                                declared by consignor</th>

                                            <th class="tm_width_1 tm_primary_color tm_gray_bg">

                                            </th>

                                        </tr>
                                        <tr>
                                            <th class="tm_width_1 tm_primary_color tm_gray_bg"> Remark</th>

                                            <th class="tm_width_1 tm_primary_color tm_gray_bg">

                                            </th>

                                        </tr>

                                    </tbody>
                                </table>

                                <div style="display: flex; align-items: center;">
                                    <p style="margin-left: 10px; padding-right: 20px;">
                                        <b> Ac- 5530142311<br>
                                            Bank Name - Central Bank of India<br>
                                            IFSC - CBIN0283681<br>
                                            Account Holder - Vikas Logistics</b>
                                    </p>

                                    <p style="margin-left: 20px; margin-right: 20px; line-height: 1.6;">
                                        <img src="{{ asset('site/img/indianQr.jpg') }}" width="150px" height="auto" />
                                    </p>
                                </div>
                                <Small><b>Note : 1)Material must have been insured by owner in case of total value is
                                        more than
                                        Rs.2000. (2)Party shall have to
                                        collect the goods within three days, there after company shall not be
                                        responsible and have
                                        to pay demurrage. (3)In
                                        case of loss or damage, we are liable for only risk cover value for transit
                                        which declared by
                                        consignor at the time of booking.
                                        (4) *Terms & Conditions Apply. (5) All Dispute at Kanpur jurisdiction only.</b>
                                </Small>
                                {{-- <div style="display: flex; align-items: center;">
                                    <p style="margin-left: 10px; border-right: 1px solid; padding-right: 20px;">
                                        <b>Head Office:<br>
                                            256 Damodar Nagar Barra<br>
                                            Kanpur Nagar - 27<br>
                                            Uttar Pradesh<br>
                                            Contact: +91 88403 54461<br>
                                            Email: vikaslogistics14320@gmail.com
                                        </b>
                                    </p>

                                    <p style="margin-left: 20px; margin-right: 20px; line-height: 1.6;">
                                        <b>Help Line:<br>
                                            Contact: +91 7860578111<br>
                                            WhatsApp: +91 7271920999
                                        </b>
                                    </p>
                                </div> --}}




                            </div>
                            <div class="tm_right_footer">
                                <table>
                                    <tbody>
                                        <tr class="tm_gray_bg tm_border_top tm_border_left tm_border_right">
                                            <td class="tm_width_3 tm_primary_color tm_border_none tm_bold">Description
                                            </td>
                                            <td
                                                class="tm_width_3 tm_primary_color tm_text_right tm_border_none tm_bold">
                                                Amount(Rs.)</td>
                                        </tr>



                                        <tr class="tm_gray_bg tm_border_left tm_border_right">
                                            <td class="tm_width_3 tm_primary_color tm_border_none tm_pt0">Freight
                                                Charges
                                                <span class="tm_ternary_color"></span>
                                            </td>
                                            <td class="tm_width_3 tm_text_right tm_border_none tm_pt0 tm_danger_color">
                                                {{ $deliveryReceipt->freight_charges }}
                                            </td>
                                        </tr>
                                        <tr class="tm_gray_bg tm_border_left tm_border_right">
                                            <td class="tm_width_3 tm_primary_color tm_border_none tm_pt0">Hamali
                                                <span class="tm_ternary_color"></span>
                                            </td>
                                            <td class="tm_width_3 tm_text_right tm_border_none tm_pt0 tm_danger_color">
                                                {{ $deliveryReceipt->hamali_charges }}
                                            </td>
                                        </tr>
                                        <tr class="tm_gray_bg tm_border_left tm_border_right">
                                            <td class="tm_width_3 tm_primary_color tm_border_none tm_pt0">Demruge
                                                Charge
                                                <span class="tm_ternary_color"></span>
                                            </td>
                                            <td class="tm_width_3 tm_text_right tm_border_none tm_pt0 tm_danger_color">
                                                {{ $deliveryReceipt->demruge_charges }}
                                            </td>
                                        </tr>
                                        <tr class="tm_gray_bg tm_border_left tm_border_right">
                                            <td class="tm_width_3 tm_primary_color tm_border_none tm_pt0">Others Chg.
                                                <span class="tm_ternary_color"></span>
                                            </td>
                                            <td class="tm_width_3 tm_text_right tm_border_none tm_pt0 tm_danger_color">
                                                {{ $deliveryReceipt->others_charges }}
                                            </td>
                                        </tr>

                                        <tr class="tm_border_top tm_gray_bg tm_border_left tm_border_right">
                                            <td class="tm_width_3 tm_border_top_0 tm_bold tm_f16 tm_primary_color">
                                                Grand
                                                Total </td>
                                            <td
                                                class="tm_width_3 tm_border_top_0 tm_bold tm_f16 tm_primary_color tm_text_right">
                                                {{ $deliveryReceipt->grand_total }}
                                            </td>
                                        </tr>

                                    </tbody>

                                </table>

                                {{-- <p class=" tm_border_top_0 tm_bold tm_f16 tm_primary_color">Rs.
                                    {{ numberToWords($booking->grand_total_amount) }}
                                    Only</p> --}}

                                </tr>

                            </div>

                        </div>
                    </div>

                    <hr class="tm_mb20">
                    <div style="display: flex; justify-content: space-between; padding: 10px;">
                        <p><b>Recived By: {{ ucfirst($deliveryReceipt->recived_by) }}</b></p>
                        <p><b>Pre Paid by</b></p>
                        <p><b>Checkd by</b></p>
                    </div>

                </div>
                <div class="tm_invoice_btns tm_hide_print">
                    <a href="javascript:window.print()" class="tm_invoice_btn tm_color1">
                        <span class="tm_btn_icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                                <path
                                    d="M384 368h24a40.12 40.12 0 0040-40V168a40.12 40.12 0 00-40-40H104a40.12 40.12 0 00-40 40v160a40.12 40.12 0 0040 40h24"
                                    fill="none" stroke="currentColor" stroke-linejoin="round"
                                    stroke-width="32" />
                                <rect x="128" y="240" width="256" height="208" rx="24.32" ry="24.32"
                                    fill="none" stroke="currentColor" stroke-linejoin="round"
                                    stroke-width="32" />
                                <path d="M384 128v-24a40.12 40.12 0 00-40-40H168a40.12 40.12 0 00-40 40v24"
                                    fill="none" stroke="currentColor" stroke-linejoin="round"
                                    stroke-width="32" />
                                <circle cx="392" cy="184" r="24" fill='currentColor' />
                            </svg>
                        </span>
                        <span class="tm_btn_text">Print</span>
                    </a>
                    {{-- <button id="tm_download_btn" class="tm_invoice_btn tm_color2">
                        <span class="tm_btn_icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                                <path
                                    d="M320 336h76c55 0 100-21.21 100-75.6s-53-73.47-96-75.6C391.11 99.74 329 48 256 48c-69 0-113.44 45.79-128 91.2-60 5.7-112 35.88-112 98.4S70 336 136 336h56M192 400.1l64 63.9 64-63.9M256 224v224.03"
                                    fill="none" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="32" />
                            </svg>
                        </span>
                        <span class="tm_btn_text">Download</span>
                    </button> --}}
                    <button id="tm_back_btn" class="tm_invoice_btn tm_color2" onclick="window.history.back();">
                        <span class="tm_btn_icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                                <path
                                    d="M144 256l192-192v128h160v128H336v128L144 256z"
                                    fill="none" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="32" />
                            </svg>
                        </span>
                        <span class="tm_btn_text">Back</span>
                    </button>
                </div>
            </div>
        </div>
        <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/jspdf.min.js"></script>
        <script src="assets/js/html2canvas.min.js"></script>
        <script src="assets/js/main.js"></script>
        <script>
            (function() {
                function c() {
                    var b = a.contentDocument || a.contentWindow.document;
                    if (b) {
                        var d = b.createElement('script');
                        d.innerHTML =
                            "window.__CF$cv$params={r:'904d61013ae92450',t:'MTczNzM1ODQzMy4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";
                        b.getElementsByTagName('head')[0].appendChild(d)
                    }
                }
                if (document.body) {
                    var a = document.createElement('iframe');
                    a.height = 1;
                    a.width = 1;
                    a.style.position = 'absolute';
                    a.style.top = 0;
                    a.style.left = 0;
                    a.style.border = 'none';
                    a.style.visibility = 'hidden';
                    document.body.appendChild(a);
                    if ('loading' !== document.readyState) c();
                    else if (window.addEventListener) document.addEventListener('DOMContentLoaded', c);
                    else {
                        var e = document.onreadystatechange || function() {};
                        document.onreadystatechange = function(b) {
                            e(b);
                            'loading' !== document.readyState && (document.onreadystatechange = e, c())
                        }
                    }
                }
            })();
        </script>
        <script defer src="https://static.cloudflareinsights.com/beacon.min.js/vcd15cbe7772f49c399c6a5babf22c1241717689176015"
            integrity="sha512-ZpsOmlRQV6y907TI0dKBHq9Md29nnaEIPlkf84rnaERnq6zvWvPUqr2ft8M1aS28oN72PdrCzSjY4U6VaAw1EQ=="
            data-cf-beacon='{"rayId":"904d61013ae92450","version":"2025.1.0","r":1,"token":"6f756f02820545e3be40ddc6eb6154c3","serverTiming":{"name":{"cfExtPri":true,"cfL4":true,"cfSpeedBrain":true,"cfCacheStatus":true}}}'
            crossorigin="anonymous"></script>
</body>

</html>
