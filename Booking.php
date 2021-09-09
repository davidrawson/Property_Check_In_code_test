<?php
// namespace lyles;

class Booking {
  
    protected int $tenant_id;
    protected string $first_name;
    protected string $last_name;
    protected string $email;
    protected string $phone_no;
    protected DateTime $dateTime;
    protected int $property_id;

    protected int $y;
    
    /**
     * __construct
     *
     * @param  mixed $booking
     * @return void
     */
    public function __construct(array $booking) 
    {
        $this->tenant_id = $booking[0];
        $this->first_name = $booking[1];
        $this->last_name = $booking[2];
        $this->email = $booking[3];
        $this->phone_no = $booking[4];
        $date = DateTime::createFromFormat('d/m/Y H:i', $booking[5] . " " . $booking[6]);  // these do need to be converted to DateTime here
        $this->dateTime = $date;
        $this->property_id = $booking[7];

        var_dump($this->dateTime);
    }

    protected function isValidBooking()
    {
        // need to use checkdate, which meadns they need to be valid DateTime objects
    }
}

?>