<?php
// namespace lyles;
// use DateTime;

class Booking 
{
  
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
    public function __construct($tenant_id, $first_name, $last_name, $email, $phone_no, $date, $time, $property_id) 
    {
        $this->tenant_id = $tenant_id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->phone_no = $phone_no;
        $dateTime = DateTime::createFromFormat('d/m/Y H:i', $date . " " . $time);  // these do need to be converted to DateTime here
        // var_dump($dateTime);
        $this->dateTime = $dateTime;
        $this->property_id = $property_id;

        // var_dump($booking);
        // $this->tenant_id = $booking[0];
        // $this->first_name = $booking[1];
        // $this->last_name = $booking[2];
        // $this->email = $booking[3];
        // $this->phone_no = $booking[4];
        // $date = DateTime::createFromFormat('d/m/Y H:i', $booking[5] . " " . $booking[6]);  // these do need to be converted to DateTime here
        // $this->dateTime = $date;
        // $this->property_id = $booking[7];

        // var_dump($this->dateTime);
    }

    public function isInvalidBooking()
    {
        // echo $this->dateTime->format('d');
        // echo $this->dateTime->format('t'); 

        // need to use checkdate, which meadns they need to be valid DateTime objects
        if($this->dateTime->format('d') == $this->dateTime->format('t'))
        {
            return true;
        }

        return false;
    }

    public function getDateTime()
    {
        return $this->dateTime;
    }

    public function getPropertyId()
    {
        return $this->property_id;
    }

    public function isBookingConflict(Booking $nextBooking)
    {
        if($nextBooking->getPropertyId() == $this->property_id && $nextBooking->getDateTime() == $this->dateTime)
        {
            return false;
        }

        // This assumes up to half and hour to do the check-in, and half an hour travelling time to next appointment.

        // except this line is trash. It does not work
        if($this->dateTime->modify('+ 1 hour') >= $nextBooking->getDateTime())
        {
            return false;
        }
        // think, is there no other circumstance?
        return true;
    }
}

?>