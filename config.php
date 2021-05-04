<!==
Author:Nguyễn Thị Tố Tâm
Website:http://websitedulich.abc/
=>
<?php 
// duong dan toi module trong admin
define("MODULES", $_SERVER['DOCUMENT_ROOT'] ."/admin/modules/");

// duong dan toi  layouts 
define("MAIN", $_SERVER['DOCUMENT_ROOT'] ."/admin/layouts/main/");

// duong dan upload 
define("UPLOADS", $_SERVER['DOCUMENT_ROOT'] ."/uploads/tours/");
// config database
define("LOCALHOST","localhost");
define("USER","root");
define("PASS","");
define("DATABASE","db_tour");


// Config thông tin website

define("INFO_NAME","");
define("INFO_CLASS","");
define("INFO_ADDRESS","");
define("INFO_PHONE","");
define("INFO_EMAIL","");

$arrayPrice = [
    '1-3' => [
        '1.000.000',
        '3.000.000'
    ],
    '3-5' =>[
        '3.000.000',
        '5.000.000'
    ],
    '5-7' =>[
        '5.000.000',
        '7.000.000'
    ],
    '7-10' => [
        '7.000.000',
        '10.000.000'
    ],
    '10-15' => [
        '10.000.000',
        '15.000.000'
    ],
    '15-20' => [
        '15.000.000',
        '20.000.000'
    ]
];

//phuong tien
$arrayVehicle = [
    1 => 'Ô tô',
    2 => 'Máy bay',
    3 => 'Tàu',
    4 => 'Ô tô, Tàu biển'
];


// thoi gian

$arrayTime = [
    1 => '1 ngày',
    2 => '2 ngày 1 đêm',
    3 => '2 ngày 2 đêm',
    4 => '3 ngày 2 đêm',
	5 => '4 ngày 3 đêm',
	6 => '5 ngày 4 đêm'
];

$typeNews = [
    1 => 'Bài viết tin tức',
    2 => 'Giới thiệu khách sạn',
    3 => 'Giới thiệu nhà hàng'
];

// Stripe
define("STRIPE_SECRET_KEY", "sk_test_51IevYbK7nOehjoyWo9NMd2VHgm30fC6eExzmMkCsek4dcYLBiS7uOn83QhuVwcFp0Hm4HThbVQrOeBR2lGYWQfmu00D6092bQK");
define("STRIPE_PUBLISHABLE_KEY", "pk_test_51IevYbK7nOehjoyWtEBW4pHkiFgCNrLA2c1q4CEdraYFuyV4kkNm1cteIrCB41sQhyqSyWetndyptgmSLxnFDoGa00diqVSnL0");