<?php

// namespace Bookings;
// use \Booking as B;
include "./Booking.php";

$realpath = realpath(__DIR__);

if (!isset($argc)) {
  die("Error, no csv filename provided.");
}

// $inputFile = $realpath . "/inbound/" . $argv[1];
// $inputFile = $realpath . $argv[1];
$inputFile = "./" . $argv[1];
// echo $inputFile;




$csvFile = file($inputFile);
    $bookings = [];
    foreach ($csvFile as $line) {
        // echo $line;
        $lineArray = str_getcsv($line);
        // var_dump( $lineArray);

        $booking = new Booking($lineArray);

        $bookings[] = $booking;
    }

    var_dump($bookings)



?>