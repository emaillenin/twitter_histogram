<?php

namespace TwitterHistogram\Tests;

use stdClass;
use TwitterHistogram\TwitterTimelineService;

class TwitterTimelineServiceTest extends \PHPUnit_Framework_TestCase
{
    public function testGroupingByHour()
    {
        $userName = "emaillenin";
        $twitterTimelineService = new TwitterTimelineService($userName, $this->getMockConnection($userName));
        $by_hour = $twitterTimelineService->getTweetsByHour();

        $this->assertSame(array(17 => 2,
            14 => 1,
            7 => 1,
            2 => 2),
            $by_hour);
    }

    private function getMockConnection($userName)
    {
        $mockConnection = $this->getMockBuilder('TwitterHistogram\TweetIteratorService')
            ->setConstructorArgs(array($userName))
            ->getMock();

        $mockConnection->expects($this->exactly(1))
            ->method('getAllTweets')
            ->willReturn($this->getMockTweets());

        return $mockConnection;
    }

    private function getMockTweets()
    {
        $tweet6 = new StdClass;
        $tweet5 = new StdClass;
        $tweet4 = new StdClass;
        $tweet3 = new StdClass;
        $tweet2 = new StdClass;
        $tweet1 = new StdClass;
        $tweet6->id = 6;
        $tweet5->id = 5;
        $tweet4->id = 4;
        $tweet3->id = 3;
        $tweet2->id = 2;
        $tweet1->id = 1;
        $tweet6->created_at = 'Wed Aug 29 17:12:58 +0000 2012';
        $tweet5->created_at = 'Wed Aug 30 17:12:58 +0000 2012';
        $tweet4->created_at = 'Wed Aug 29 14:12:58 +0000 2012';
        $tweet3->created_at = 'Wed Aug 29 07:12:58 +0000 2012';
        $tweet2->created_at = 'Wed Aug 29 02:12:58 +0000 2012';
        $tweet1->created_at = 'Wed Aug 29 02:12:58 +0000 2012';

        return array($tweet6, $tweet5, $tweet4, $tweet3, $tweet2, $tweet1);
    }

}
