<?php

use PHPUnit\Framework\TestCase;
require "./Booking.php";

/**
 * BookingTest
 */
final class BookingTest extends TestCase
{    
    /**
     * testIsValidBookingReturnsFalseForInvalidDate
     *
     * @return void
     */
    public function testIsInvalidBookingReturnsFalseForValidDate()
    {
        $booking = new Booking("25", "Jeannine", "Parfitt", "jparfitto@squidoo.com", "559-211-8333", "13/09/2021", "11:00", "29");
        $this->assertFalse($booking->isInvalidBooking());
    }
    
    /**
     * testIsValidBookingReturnsTrueForValidDate
     *
     * @return void
     */
    public function testIsInvalidBookingReturnsTrueForInvalidDate()
    {
        $booking = new Booking("25", "Jeannine", "Parfitt", "jparfitto@squidoo.com", "559-211-8333", "30/09/2021", "11:00", "29");
        $this->assertTrue($booking->isInvalidBooking());
    }
}

?>