<?php

include "./Booking.php";

class CreateCheckInsLists
{
    /**
     * bookings
     *
     * @var array
     */
    private $bookings = [];
       
    /**
     * execute
     *
     * @param  string $filename
     * @return void
     */
    public static function execute(string $filename)
    {
        // This 'die' message would be logged somewhere irl.
        if (!isset($filename)) {
        die("Error, no csv filename provided.");
        }

        // shoud this be in a try/catch
        $inputFile = "./" . $filename;

        echo $inputFile;
        $csvFile = file($inputFile);

        foreach ($csvFile as $line) {
            $lineArray = str_getcsv($line);

            var_dump($lineArray);
            $booking = new Booking($lineArray);
            $bookings[] = $booking;
        }

        // var_dump($bookings);

        self::sortBookings();
    }
    
    /**
     * sortBookings
     *
     * @return void
     */
    private static function sortBookings()
    {
        echo("sort bookings");
        return "";
    }
}

?>