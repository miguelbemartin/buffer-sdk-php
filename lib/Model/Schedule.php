<?php

namespace BufferSDK\Model;

use InvalidArgumentException;

class Schedule
{

    /**
     * The update ID.
     *
     * @var string
     */
    public $id = null;

    /**
     * Array of scheduled days.
     *
     * @var array
     */
    protected $days = [];

    /**
     * Array of scheduled times.
     *
     * @var array
     */
    protected $times = [];

    /**
     * Create a new Schedule instance.
     *
     * @param array $days
     * @param array $times
     * @return void
     */
    public function __construct($days = [], $times = [])
    {
        if (!empty($days)) {
            $this->addDay($days);
        }

        if (!empty($times)) {
            $this->addTime($times);
        }
    }

    /**
     * Schedule a new day.
     *
     * @param string|array $day
     * @return Schedule
     */
    public function addDay($day): self
    {
        $available = ['mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun'];

        foreach ((array)$day as $value) {
            // only accept valid values
            if (!in_array($value, $available)) {
                throw new InvalidArgumentException('Day must be a valid value: ' . implode(', ', $available));
            }

            $this->days[] = $value;
        }

        return $this;
    }

    /**
     * Schedule a time.
     *
     * @param string|array $time
     * @return Schedule
     */
    public function addTime($time): self
    {
        foreach ((array)$time as $value) {
            // only accept valid times (HH:mm)
            if (!preg_match('#([01][0-9]|2[0-3]):[0-5][0-9]#', $value)) {
                throw new InvalidArgumentException('Time must be valid: HH:mm.');
            }

            $this->times[] = $value;
        }

        return $this;
    }

    /**
     * Get the scheduled days.
     *
     * @return array
     */
    public function getDays(): array
    {
        return $this->days;
    }

    /**
     * Get the scheduled times.
     *
     * @return array
     */
    public function getTimes(): array
    {
        return $this->times;
    }
}
