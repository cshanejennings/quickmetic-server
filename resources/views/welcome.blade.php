<?php
use Carbon\Carbon;
use App\Util\DateRangeManager;
    $test_invoices = [
        (object) ['num'=> 0, 'date' => '2020-01-01'],
        (object) ['num'=> 1, 'date' => '2020-01-01'],
        (object) ['num'=> 2, 'date' => '2020-01-01'],
        (object) ['num'=> 3, 'date' => '2020-01-01'],
        (object) ['num'=> 4, 'date' => '2020-01-01'],
        (object) ['num'=> 5, 'date' => '2020-01-01'],
        (object) ['num'=> 6, 'date' => '2020-01-02'],
        (object) ['num'=> 7, 'date' => '2020-01-03'],
        (object) ['num'=> 8, 'date' => '2020-01-03'],
        (object) ['num'=> 9, 'date' => '2020-01-03'],
        (object) ['num'=> 10, 'date' => '2020-01-04'],
        (object) ['num'=> 11, 'date' => '2020-01-04'],
        (object) ['num'=> 12, 'date' => '2020-01-04'],
        (object) ['num'=> 13, 'date' => '2020-01-04'],
        (object) ['num'=> 14, 'date' => '2020-01-04'],
        (object) ['num'=> 15, 'date' => '2020-01-04'],
        (object) ['num'=> 16, 'date' => '2020-01-04'],
        (object) ['num'=> 17, 'date' => '2020-01-05'],
        (object) ['num'=> 18, 'date' => '2020-01-05'],
        (object) ['num'=> 19, 'date' => '2020-01-05'],
        (object) ['num'=> 20, 'date' => '2020-01-05'],
    ];
    $test_date_range = (object) [
        'start' => '2020-01-01',
        'end' => '2020-01-05',
    ];

    // $res = DateRangeManager:: chunk_transaction_dates($test_date_range, 3, $test_invoices);


?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                /* height: 100vh; */
                margin: 0;
            }
            /* .full-height { height: 100vh; } */
            .flex-center { align-items: center; display: flex; justify-content: center; }
            .position-ref { position: relative; }
            .content { text-align: center; }
            .title { font-size: 14px; }
            .m-b-md { margin-bottom: 30px; }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    <?php
                        // print_r(json_encode($res));
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>
