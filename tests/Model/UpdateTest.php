<?php

namespace BufferSDK\Tests\Model;

use BufferSDK\Model\Update;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class UpdateTest extends TestCase
{
    public function testAddProfile()
    {
        $update = new Update();
        $update->addProfile('test');
        $this->assertEquals(array('test'), $update->profiles);
    }

    public function testAddMedia()
    {
        $update = new Update();
        $update->addMedia('link', 'https://buffer.com/');
        $this->assertEquals(array('link' => 'https://buffer.com/'), $update->media);
    }

    public function testInvalidMediaTypeThrowsException()
    {
        $update = new Update();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Media type must be a valid value: link, description, picture");

        $update->addMedia('one-test', 'another-test');
    }
    public function testSchedule()
    {
        $now = time();
        $dt1 = new \DateTime();
        $dt1->setTimestamp($now);
        $dt1 = $dt1->format(\DateTime::ISO8601);
        $update1 = new Update();
        $update1->schedule($now);

        $string = '2013-12-23 02:00:00';
        $dt2 = new \DateTime($string);
        $dt2 = $dt2->format(\DateTime::ISO8601);
        $update2 = new Update();
        $update2->schedule($string);
        $this->assertEquals($dt1, $update1->scheduled_at);
        $this->assertEquals($dt2, $update2->scheduled_at);
    }
}
