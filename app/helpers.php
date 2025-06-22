<?php

use Illuminate\Support\Str;

// app/helpers.php

function numberToWords($number)
{


    // $formatter = new NumberFormatter("en", NumberFormatter::SPELLOUT);
    // return Str::ucfirst($formatter->format($number));

    $words = [
        0 => 'zero',
        1 => 'one',
        2 => 'two',
        3 => 'three',
        4 => 'four',
        5 => 'five',
        6 => 'six',
        7 => 'seven',
        8 => 'eight',
        9 => 'nine',
        10 => 'ten',
        11 => 'eleven',
        12 => 'twelve',
        13 => 'thirteen',
        14 => 'fourteen',
        15 => 'fifteen',
        16 => 'sixteen',
        17 => 'seventeen',
        18 => 'eighteen',
        19 => 'nineteen',
        20 => 'twenty',
        30 => 'thirty',
        40 => 'forty',
        50 => 'fifty',
        60 => 'sixty',
        70 => 'seventy',
        80 => 'eighty',
        90 => 'ninety'
    ];

    if ($number < 20) {
        return ucwords($words[$number]); // Capitalize each word
    } elseif ($number < 100) {
        return ucwords($words[($number - $number % 10)]) .
            ($number % 10 ? ' ' . $words[$number % 10] : '');
    } elseif ($number < 1000) {
        return ucwords($words[intval($number / 100)]) . ' Hundred' .
            ($number % 100 ? '  ' . numberToWords($number % 100) : 'O');
    } else {
        return ucwords(numberToWords(intval($number / 1000))) . ' Thousand' .
            ($number % 1000 ? ' ' . numberToWords($number % 1000) : '');
    }
}


function formatDate($date)
{
    return \Carbon\Carbon::parse($date)->format('d/m/Y h:i A');
}

function formatOnlyDate($date)
{
    return \Carbon\Carbon::parse($date)->format('d/m/Y');
}
