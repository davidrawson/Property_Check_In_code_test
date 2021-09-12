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
    
    /**
     * testAllocateBookingsConflictPutsBookingInSecondList
     *
     * @return void
     */
    public function testAllocateBookingsConflictPutsBookingInSecondList(): void
    {
        $booking1 = new Booking("25", "Jeannine", "Parfitt", "jparfitto@squidoo.com", "559-211-8333", "20/09/2021", "11:00", "29");
        $booking2 = new Booking("26", "Peannine", "Jarfitt", "pjarfitto@squidoo.com", "559-8333-211", "20/09/2021", "11:30", "27");
        $bookings = [$booking1, $booking2];

        $lists = CreateCheckInsLists::allocateBookings($bookings);

        $this->assertEquals($lists['sortedList2'][0], $booking2);
    }
    
    /**
     * testAllocateBookingsTwoConflictsPutsBookingInThirdList
     *
     * @return void
     */
    public function testAllocateBookingsTwoConflictsPutsBookingInThirdList(): void
    {
        $booking1 = new Booking("25", "Jeannine", "Parfitt", "jparfitto@squidoo.com", "559-211-8333", "20/09/2021", "11:00", "29");
        $booking2 = new Booking("26", "Peannine", "Jarfitt", "pjarfitto@squidoo.com", "559-8333-211", "20/09/2021", "11:30", "27");
        $booking3 = new Booking("27", "annine", "Jarf", "pjarf@squidoo.com", "559-8333-21", "20/09/2021", "11:30", "2");
        $bookings = [$booking1, $booking2, $booking3];

        $lists = CreateCheckInsLists::allocateBookings($bookings);

        $this->assertEquals($lists['sortedList3'][0], $booking3);
    }
    
    /**
     * testAllocateBookingsThreeConflictsPutsBookingInRebookList
     *
     * @return void
     */
    public function testAllocateBookingsThreeConflictsPutsBookingInRebookList(): void
    {
        $booking1 = new Booking("25", "Jeannine", "Parfitt", "jparfitto@squidoo.com", "559-211-8333", "20/09/2021", "11:00", "29");
        $booking2 = new Booking("26", "Peannine", "Jarfitt", "pjarfitto@squidoo.com", "559-8333-211", "20/09/2021", "11:30", "27");
        $booking3 = new Booking("27", "annine", "Jarf", "pjarf@squidoo.com", "559-8333-21", "20/09/2021", "11:30", "2");
        $booking4 = new Booking("27", "Tannine", "Jarfy", "pjarfy@squidoo.com", "559-8333-219", "20/09/2021", "11:30", "4");
        $bookings = [$booking1, $booking2, $booking3, $booking4];

        $lists = CreateCheckInsLists::allocateBookings($bookings);

        $this->assertEquals($lists['rebookList'][0], $booking4);
    }
    
    /**
     * testAllocateBookingsEndOfMonthPutsBookingInInvalidList
     *
     * @return void
     */
    public function testAllocateBookingsEndOfMonthPutsBookingInInvalidList(): void
    {
        $booking1 = new Booking("25", "Jeannine", "Parfitt", "jparfitto@squidoo.com", "559-211-8333", "30/09/2021", "11:00", "29");
        $bookings = [$booking1];

        $lists = CreateCheckInsLists::allocateBookings($bookings);

        $this->assertEquals($lists['invalidBookingList'][0], $booking1);
    }
}
