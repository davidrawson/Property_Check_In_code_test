<?php

/**
 * BookingList
 */
class BookingList
{    
    /** @var array $bookings */
    private $bookings = [];
    /** @var string $filename */
    private string $filename;
    
    /**
     * __construct
     *
     * @param  Booking[] $bookings
     * @param  string $filename
     * @return void
     */
    public function __construct(array $bookings, $filename)
    {
        $this->bookings = $bookings;
        $this->filename = $filename;
    }
    
    /**
     * createCsvFile
     *
     * @return void
     */
    public function createCsvFile(): void
    {
        try {
            $file = fopen($this->filename, 'w');
            
            foreach ($this->bookings as $booking) {
                $line = [
                    $booking->getTenantId(),
                    $booking->getFirstName(),
                    $booking->getLastName(),
                    $booking->getEmail(),
                    $booking->getPhoneNo(),
                    $booking->getDateTime()->format("d/m/Y"),
                    $booking->getDateTime()->format("H:i"),
                    $booking->getPropertyId()
                ];
                
                fputcsv($file, $line, ',', '"');
            }
            fclose($file);
        } catch (Exception $e) {
            echo $e->getMessage();
        } finally {
            if (is_resource($file)) {
                fclose($file);
            }
        }
    }

}
