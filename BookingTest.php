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
    public function testIsValidBookingReturnsFalseForInvalidDate()
    {
        $booking = new Booking("25", "Jeannine", "Parfitt", "jparfitto@squidoo.com", "559-211-8333", "30/09/2021", "11:00", "29");
        $this->assertFalse($booking->isValidBooking());
    }
    
    /**
     * testIsValidBookingReturnsTrueForValidDate
     *
     * @return void
     */
    public function testIsValidBookingReturnsTrueForValidDate()
    {
        $booking = new Booking("25", "Jeannine", "Parfitt", "jparfitto@squidoo.com", "559-211-8333", "13/09/2021", "11:00", "29");
        $this->assertTrue($booking->isValidBooking());
    }
}

?>