<?php

class BookingList
{
    private $bookings = [];
    private string $filename;

    public function __construct(array $bookings, $filename) 
    {
        $this->bookings = $bookings;
        $this->filename = $filename;
    }

    public function createCsvFile()
    {
        try {
            $file = fopen($this->filename, 'w');
            
            foreach($this->bookings as $booking) {
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
            if(is_resource($file)) {
              fclose($file);
            }
        }
    }

}
