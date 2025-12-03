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

if (!function_exists('formatDate')) {
    function formatDate($date, $format = 'd-m-Y')
    {
        return \Carbon\Carbon::parse($date)->timezone('Asia/Kolkata')->format('d/m/Y h:i A');
    }
}

function formatOnlyDate($date)
{
    return \Carbon\Carbon::parse($date)->timezone('Asia/Kolkata')->format('d/m/Y');
}


if (!function_exists('indian_number_format')) {
    function indian_number_format($num)
    {
        $num = (string) $num;
        $decimal = '';

        // Handle decimals
        if (strpos($num, '.') !== false) {
            list($num, $decimal) = explode('.', $num);
            $decimal = '.' . $decimal;
        }

        $len = strlen($num);
        if ($len > 3) {
            $last3 = substr($num, -3);
            $rest = substr($num, 0, -3);
            $rest = preg_replace("/\B(?=(\d{2})+(?!\d))/", ",", $rest);
            $num = $rest . ',' . $last3;
        }

        return $num . $decimal;
    }
}

if (!function_exists('format_price')) {
    function format_price($price = 0, $symbol = '₹')
    {
        // Use your existing formatter
        $formatted = indian_number_format($price);

        return $symbol . $formatted;
    }
}
