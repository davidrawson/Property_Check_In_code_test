<?php

class Booking 
{
  
    protected int $tenant_id;
    protected string $first_name;
    protected string $last_name;
    protected string $email;
    protected string $phone_no;
    protected DateTime $dateTime;
    protected int $property_id;

    // protected int $y;
    
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
        $this->dateTime = $dateTime;
        $this->property_id = $property_id;
    }

    public function getTenantId()
    {
        return $this->tenant_id;
    }
    
    public function getFirstName()
    {
        return $this->first_name;
    }
    
    public function getLastName()
    {
        return $this->last_name;
    }
    
    public function getEmail()
    {
        return $this->email;
    }
    
    public function getPhoneNo()
    {
        return $this->phone_no;
    }

    public function getDateTime()
    {
        return $this->dateTime;
    }
    
    public function getPropertyId()
    {
        return $this->property_id;
    }

    public function isInvalidBooking()
    {
        if($this->dateTime->format('d') == $this->dateTime->format('t'))
        {
            return true;
        }

        return false;
    }

    public function isBookingConflict(Booking $prevBooking)
    {
        var_dump($prevBooking->getPropertyId(), "next");
        var_dump($this->property_id, "this");
        
        if($prevBooking->getDateTime() == $this->dateTime && $prevBooking->getPropertyId() == $this->property_id)
        {
            return false;
        }

        // $minutesDiff=0;
        // This assumes up to half and hour to do the check-in, and half an hour travelling time to next appointment.
        $diff = date_diff($this->dateTime, $prevBooking->getDateTime());
        $minutesDiff = ($diff->h * 60) + $diff->m;
        echo($minutesDiff);

        if($minutesDiff >= 60)
        {
            echo($this->first_name);

            return false;
        }
        // think, is there no other circumstance?
        return true;
    }
}
