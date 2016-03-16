<?php

namespace TwitterHistogram\Tests;

use stdClass;
use TwitterHistogram\TweetIteratorService;

class TweetIteratorServiceTest extends \PHPUnit_Framework_TestCase
{
    public function testPagination()
    {
        $userName = "emaillenin";
        $tweetIteratorService = new TweetIteratorService($userName, $this->getMockConnection($userName));
        $allTweets = $tweetIteratorService->getAllTweets();
        $this->assertSame(5, sizeof($allTweets));
    }

    private function getMockConnection($userName)
    {
        $mockConnection = $this->getMockBuilder('Abraham\TwitterOAuth\TwitterOAuth')
            ->setConstructorArgs(array(TWITTER_CONSUMER_KEY, TWITTER_CONSUMER_SECRET, TWITTER_ACCESS_TOKEN, TWITTER_ACCESS_TOKEN_SECRET))
            ->getMock();

        $map = array(
            array("statuses/user_timeline",
                ["screen_name" => $userName, "count" => 200,
                    "include_rts" => true, "exclude_replies" => false], $this->getMockTweetsPage1()),
            array("statuses/user_timeline", ["screen_name" => $userName, "count" => 200,
                "include_rts" => true, "exclude_replies" => false, "max_id" => 3], $this->getMockTweetsPage2()),
            array("statuses/user_timeline", ["screen_name" => $userName, "count" => 200,
                "include_rts" => true, "exclude_replies" => false, "max_id" => 1], $this->getMockTweetsPage3())
        );

        $mockConnection->expects($this->exactly(3))
            ->method('get')
            ->will($this->returnValueMap($map));

        return $mockConnection;
    }

    private function getMockTweetsPage1()
    {
        $tweet6 = new StdClass;
        $tweet5 = new StdClass;
        $tweet4 = new StdClass;
        $tweet6->id = 6;
        $tweet5->id = 5;
        $tweet4->id = 4;
        return array($tweet6, $tweet5, $tweet4);
    }

    private function getMockTweetsPage2()
    {
        $tweet3 = new StdClass;
        $tweet2 = new StdClass;
        $tweet3->id = 3;
        $tweet2->id = 2;
        return array($tweet3, $tweet2);
    }

    private function getMockTweetsPage3()
    {
        return array();
    }

}
