<?php
// namespace lyles;

class Booking {
    protected int $tenent_id;
    protected string $first_name;
    protected string $last_name;
    protected string $email;
    protected string $phone_no;
    // protected DateTime $date;
    protected string $date;
    // protected DateTime $time;
    protected string $time;
    protected int $property_id;

    protected int $y;

    public function __construct(array $booking) {
        $this->tenent_id = $booking[0];
        $this->first_name = $booking[1];
        $this->last_name = $booking[2];
        $this->email = $booking[3];
        $this->phone_no = $booking[4];
        $this->date = $booking[5];  // these do need to be converted to DateTime here
        $this->time = $booking[6];  // ...
        $this->property_id = $booking[7];
    }
}

?>