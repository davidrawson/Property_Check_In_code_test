<?php
use PHPUnit\Framework\TestCase;
require "./BookingList.php";
require "./Booking.php";

/**
 * BookingListTest
 */
final class BookingListTest extends TestCase
{    
    /**
     * testCreateCsvFileCreatesCsvFile
     *
     * @return void
     */
    public function testCreateCsvFileCreatesCsvFile(): void
    {
        $booking1 = new Booking("25", "Jeannine", "Parfitt", "jparfitto@squidoo.com", "559-211-8333", "30/09/2021", "11:00", "29");
        $booking2 = new Booking("26", "Peannine", "Jarfitt", "pjarfitto@squidoo.com", "559-8333-211", "30/09/2021", "12:00", "2");
        $bookingArray = [$booking1, $booking2];
        $filename = "test.csv";
        $bookingList = new BookingList($bookingArray, $filename);
        $bookingList->createCsvFile();

        $this->assertFileExists('test.csv');
    }
}
