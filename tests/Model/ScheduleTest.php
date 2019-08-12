<?php

namespace BufferSDK\Tests\Model;

use BufferSDK\Model\Schedule;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class ScheduleTest extends TestCase
{
    public function testAddDaysAndAddTime()
    {
        $schedule = new Schedule();
        $schedule->addDay('mon');
        $schedule->addDay(array('tue', 'wed'));
        $schedule->addtime('00:01');
        $schedule->addTime(array('00:02', '00:03'));
        $this->assertEquals(array('mon', 'tue', 'wed'), $schedule->getDays());
        $this->assertEquals(array('00:01', '00:02', '00:03'), $schedule->getTimes());
    }

    public function testAddDaysAndAddTimeInConstructor()
    {
        $schedule = new Schedule('mon', '00:01');
        $this->assertEquals(array('mon'), $schedule->getDays());
        $this->assertEquals(array('00:01'), $schedule->getTimes());
    }

    public function testInvalidDayNameThrowsException()
    {
        $this->expectException(InvalidArgumentException::class);
        $schedule = new Schedule();
        $schedule->addDay('test');
    }

    public function testInvalidTimeFormatThrowsException()
    {
        $this->expectException(InvalidArgumentException::class);

        $schedule = new Schedule();
        $schedule->addTime('test');
    }
}
