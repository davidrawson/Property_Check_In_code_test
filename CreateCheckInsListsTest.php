<?php

use PHPUnit\Framework\TestCase;
require "./CreateCheckInsLists.php";

/**
 * CreateCheckInsListsTest
 */
final class CreateCheckInsListsTest extends TestCase
{        
    /**
     * testSortBookingsSortsBookings
     *
     * @return void
     */
    public function testSortBookingsSortsBookings(): void
    {
        $booking1 = new Booking("25", "Jeannine", "Parfitt", "jparfitto@squidoo.com", "559-211-8333", "30/09/2021", "11:00", "29");
        $booking2 = new Booking("26", "Peannine", "Jarfitt", "pjarfitto@squidoo.com", "559-8333-211", "20/09/2021", "11:00", "29");
        $bookings = [$booking1, $booking2];

        $sortedBookings = CreateCheckInsLists::sortBookings($bookings);

        $this->assertEquals($sortedBookings, [$booking2, $booking1]);
    }
}
