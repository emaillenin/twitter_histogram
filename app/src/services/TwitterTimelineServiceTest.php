<?php
require 'TwitterTimelineService.php';

class TwitterTimelineServiceTest extends PHPUnit_Framework_TestCase
{
    public function testSample()
    {
        $twitterTimelineService = new TwitterTimelineService("emaillenin");
        $twitterTimelineService->getTweetsByHour();
        $this->assertSame(true, true);
    }
}
