<?php

/**
 * Booking
 */
class Booking 
{
    /** @var int $tenant_id */
    protected int $tenant_id;
    /** @var int $first_name */
    protected string $first_name;
    /** @var int $last_name */
    protected string $last_name;
    /** @var int $email */
    protected string $email;
    /** @var int $phone_no */
    protected string $phone_no;
    /** @var int $dateTime */
    protected DateTime $dateTime;
    /** @var int $iproperty_id */
    protected int $property_id;
    /** @var int MINUTES_IN_HOUR */
    protected const MINUTES_IN_HOUR = 60;
        
    /**
     * __construct
     *
     * @param  string $tenant_id
     * @param  string $first_name
     * @param  string $last_name
     * @param  string $email
     * @param  string $phone_no
     * @param  string $date
     * @param  string $time
     * @param  string $property_id
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
        
    /**
     * getTenantId
     *
     * @return string
     */
    public function getTenantId(): string
    {
        return $this->tenant_id;
    }
            
    /**
     * getFirstName
     *
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->first_name;
    }
            
    /**
     * getLastName
     *
     * @return string
     */
    public function getLastName(): string
    {
        return $this->last_name;
    }
            
    /**
     * getEmail
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }
        
    /**
     * getPhoneNo
     *
     * @return string
     */
    public function getPhoneNo(): string
    {
        return $this->phone_no;
    }
    
    /**
     * getDateTime
     *
     * @return DateTime
     */
    public function getDateTime(): DateTime
    {
        return $this->dateTime;
    }
        
    /**
     * getPropertyId
     *
     * @return string
     */
    public function getPropertyId(): string
    {
        return $this->property_id;
    }
        
    /**
     * isLastDayOfMonth
     *
     * @return bool
     */
    public function isLastDayOfMonth(): bool
    {
        if ($this->dateTime->format('d') == $this->dateTime->format('t'))
        {
            return true;
        }

        return false;
    }
    
    /**
     * isBookingConflict
     *
     * @param  Booking $prevBooking
     * @return bool
     */
    public function isBookingConflict(Booking $prevBooking): bool
    {
        if ($prevBooking->getDateTime() == $this->dateTime && $prevBooking->getPropertyId() == $this->property_id)
        {
            return false;
        }

        // This assumes up to half and hour to do the check-in, and half an hour travelling time to next appointment.
        $diff = date_diff($this->dateTime, $prevBooking->getDateTime());
        $minutesDiff = ($diff->h * self::MINUTES_IN_HOUR) + $diff->m;

        if ($minutesDiff >= self::MINUTES_IN_HOUR)
        {
            return false;
        }

        return true;
    }
}
