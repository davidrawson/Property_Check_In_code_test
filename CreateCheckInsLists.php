<?php

include "./Booking.php";
include "./BookingList.php";

/**
 * CreateCheckInsLists
 */
class CreateCheckInsLists
{
    /**
     * execute
     *
     * @param  string $filename
     * @return void
     */
    public static function execute(string $filename): void
    {
        // This would normally be logging an error rather than dying.
        if (!isset($filename)) {
            die("Error, no csv filename provided.");
        }

        $inputFile = "./" . $filename;

        try {
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
        } catch (Exception $e) {
            echo $e->getMessage();
        } finally {
            if (is_resource($csvFile)) {
                fclose($csvFile);
            }
        }

        $sortedBookings = self::sortBookings($bookings);

        $lists = self::allocateBookings($sortedBookings);

        self::createListFiles($lists['sortedList1'], "_BookingList1.csv");
        self::createListFiles($lists['sortedList2'], "_BookingList2.csv");
        self::createListFiles($lists['sortedList3'], "_BookingList3.csv");
        self::createListFiles($lists['invalidBookingList'], "_InvalidBookingList1.csv");
        self::createListFiles($lists['rebookList'], "_RebookList1.csv");
    }
        
    /**
     * sortBookings
     *
     * @param  Booking[] $bookings
     * @return Booking[]
     */
    public static function sortBookings($bookings): array
    {
        usort($bookings, array(self::class, "dateComparator"));
        return $bookings;
    }
      
    /**
     * dateComparator
     *
     * @param  Booking $object1
     * @param  Booking $object2
     * @return bool
     */
    private static function dateComparator($object1, $object2): bool
    {
        return $object1->getDateTime() > $object2->getDateTime();
    }
        
    /**
     * allocateBookings
     *
     * @param  Booking[] $sortedBookings
     * @return array
     */
    public static function allocateBookings($sortedBookings): array
    {
        $invalidBookingList = [];
        $sortedList1 = [];
        $sortedList2 = [];
        $sortedList3 = [];
        $rebookList = [];

        foreach ($sortedBookings as $booking) {
            if ($booking->isLastDayOfMonth()) {
                $invalidBookingList[] = $booking;
                continue;
            }

            if (empty($sortedList1)) {
                $sortedList1[] = $booking;
                continue;
            }

            if (!$booking->isBookingConflict(end($sortedList1))) {
                $sortedList1[] = $booking;
                continue; 
            } else {
                if (empty($sortedList2)) {
                    $sortedList2[] = $booking;
                    continue;
                } else {
                    if (!$booking->isBookingConflict(end($sortedList2))) {
                        $sortedList2[] = $booking;
                        continue;
                    } else {
                        if (empty($sortedList3)) {
                            $sortedList3[] = $booking;
                            continue;
                        } else {
                            if (!$booking->isBookingConflict(end($sortedList3))) {
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

        $lists = [
            'sortedList1' => $sortedList1,
            'sortedList2' => $sortedList2,
            'sortedList3' => $sortedList3,
            'invalidBookingList' => $invalidBookingList,
            'rebookList' => $rebookList
        ];

        return $lists;
    }
    
    /**
     * createListFiles
     *
     * @param  Booking[] $list
     * @param  string $fileSuffix
     * @return void
     */
    private static function createListFiles($list, $fileSuffix): void
    {
        if (!empty($list)) {
            $filename = date("d-m-Y") . $fileSuffix;
            $bookingList = new BookingList($list, $filename);
            $bookingList->createCsvFile();  
        }
    }
}
