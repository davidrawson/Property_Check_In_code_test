<?php

// namespace lyles;

include "./Booking.php";

class CreateCheckInsLists
{
    /**
     * bookings
     *
     * @var array
     */
    // private $bookings = [];
       
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

        // echo $inputFile;
        $csvFile = file($inputFile);

        foreach ($csvFile as $line) {
            $lineArray = str_getcsv($line);

            // var_dump($lineArray);
            // printf($lineArray);

            $tenant_id = $lineArray[0];
            $first_name = $lineArray[1];
            $last_name = $lineArray[2];
            $email = $lineArray[3];
            $phone_no = $lineArray[4];
            $date = $lineArray[5];
            $time = $lineArray[6];
            // $date = DateTime::createFromFormat('d/m/Y H:i', $lineArray[5] . " " . $lineArray[6]);  // these do need to be converted to DateTime here
            // $dateTime = $date;
            $property_id = $lineArray[7];

            $booking = new Booking($tenant_id, $first_name, $last_name, $email, $phone_no, $date, $time, $property_id);
            $bookings[] = $booking;
        }

        
        // self::sortBookings($bookings);
        usort($bookings, array(self::class, "dateComparator"));
        // var_dump($bookings);
    }
    
    // /**
    //  * sortBookings
    //  *
    //  * @return void
    //  */
    // private static function sortBookings($bookings)
    // {
    //     var_dump($bookings);
        
 
    // }

    private static function dateComparator($object1, $object2)
    {
        // var_dump($object1);

        return $object1->getDateTime() > $object2->getDateTime();
    }

}

?>