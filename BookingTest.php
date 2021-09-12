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
    public function testIsInvalidBookingReturnsFalseForValidDate(): void
    {
        $booking = new Booking("25", "Jeannine", "Parfitt", "jparfitto@squidoo.com", "559-211-8333", "13/09/2021", "11:00", "29");
        $this->assertFalse($booking->isLastDayOfMonth());
    }
    
    /**
     * testIsValidBookingReturnsTrueForValidDate
     *
     * @return void
     */
    public function testIsInvalidBookingReturnsTrueForInvalidDate(): void
    {
        $booking = new Booking("25", "Jeannine", "Parfitt", "jparfitto@squidoo.com", "559-211-8333", "30/09/2021", "11:00", "29");
        $this->assertTrue($booking->isLastDayOfMonth());
    }
    
    /**
     * testIsBookingConflictReturnsFalseForSamePropertyAndDateTime
     *
     * @return void
     */
    public function testIsBookingConflictReturnsFalseForSamePropertyAndDateTime(): void
    {
        $booking = new Booking("25", "Jeannine", "Parfitt", "jparfitto@squidoo.com", "559-211-8333", "30/09/2021", "11:00", "29");
        $prevBooking = new Booking("26", "Peannine", "Jarfitt", "pjarfitto@squidoo.com", "559-8333-211", "30/09/2021", "11:00", "29");

        $this->assertFalse(($booking->isBookingConflict($prevBooking)));
    }
    
    /**
     * testIsBookingConflictReturnsFalseForSufficientTravelTime
     *
     * @return void
     */
    public function testIsBookingConflictReturnsFalseForSufficientTravelTime(): void
    {
        $booking = new Booking("25", "Jeannine", "Parfitt", "jparfitto@squidoo.com", "559-211-8333", "30/09/2021", "11:00", "29");
        $prevBooking = new Booking("26", "Peannine", "Jarfitt", "pjarfitto@squidoo.com", "559-8333-211", "30/09/2021", "12:00", "2");

        $this->assertFalse(($booking->isBookingConflict($prevBooking)));
    }
    
    /**
     * testIsBookingConflictReturnsTrueForTimeConflict
     *
     * @return void
     */
    public function testIsBookingConflictReturnsTrueForTimeConflict(): void
    {
        $booking = new Booking("25", "Jeannine", "Parfitt", "jparfitto@squidoo.com", "559-211-8333", "30/09/2021", "11:00", "29");
        $prevBooking = new Booking("26", "Peannine", "Jarfitt", "pjarfitto@squidoo.com", "559-8333-211", "30/09/2021", "11:30", "2");

        $this->assertTrue(($booking->isBookingConflict($prevBooking)));
    }
}
