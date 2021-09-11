<?php

include "./Booking.php";
include "./BookingList.php";

class CreateCheckInsLists
{
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

        // should this be in a try/catch
        $inputFile = "./" . $filename;

        $csvFile = file($inputFile);

        foreach ($csvFile as $line) {
            $lineArray = str_getcsv($line);

            $tenant_id = $lineArray[0];
            $first_name = $lineArray[1];
            $last_name = $lineArray[2];
            $email = $lineArray[3];
            $phone_no = $lineArray[4];
            $date = $lineArray[5];
            $time = $lineArray[6];
            $property_id = $lineArray[7];

            $booking = new Booking($tenant_id, $first_name, $last_name, $email, $phone_no, $date, $time, $property_id);
            $bookings[] = $booking;
        }
        
        $sortedBookings = self::sortBookings($bookings);

        self::allocateBookings($sortedBookings);
    }

    private static function sortBookings($bookings)
    {
        usort($bookings, array(self::class, "dateComparator"));
        return $bookings;
    }

    private static function dateComparator($object1, $object2)
    {
        return $object1->getDateTime() > $object2->getDateTime();
    }

    private static function allocateBookings($sortedBookings)
    {
        $invalidBookingList = [];
        $sortedList1 = [];
        $sortedList2 = [];
        $sortedList3 = [];
        $rebookList = [];

        foreach($sortedBookings as $booking) {
            if($booking->isInvalidBooking()) {
                $invalidBookingList[] = $booking;
                continue;
            }

            if(empty($sortedList1)) {
                $sortedList1[] = $booking;
                continue;
            }

            if(!$booking->isBookingConflict(end($sortedList1))) {
                $sortedList1[] = $booking;
                continue; 
            } else {
                if(empty($sortedList2)) {
                    $sortedList2[] = $booking;
                    continue;
                } else {
                    if(!$booking->isBookingConflict(end($sortedList2))) {
                        $sortedList2[] = $booking;
                        continue;
                    } else {
                        if(empty($sortedList3)) {
                            $sortedList3[] = $booking;
                            continue;
                        } else {
                            if(!$booking->isBookingConflict(end($sortedList3))) {
                                $sortedList3[] = $booking;
                                continue;
                            } else {
                                $rebookList[] = $booking;
                                continue;
                            }
                        }
                    }
                }
                $sortedList1[] = $booking;
            }

        }

        self::createListFiles($sortedList1, "_BookingList1.csv");
        self::createListFiles($sortedList2, "_BookingList2.csv");
        self::createListFiles($sortedList3, "_BookingList3.csv");
        self::createListFiles($invalidBookingList, "_InvalidBookingList1.csv");
        self::createListFiles($rebookList, "_RebookList1.csv");
    }

    private static function createListFiles($list, $fileSuffix)
    {
        if(!empty($list)) {
            $filename = date("d-m-Y") . $fileSuffix;
            $bookingList = new BookingList($list, $filename);
            $bookingList->createCsvFile();  
        }
    }
}
