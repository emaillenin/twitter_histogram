<?php
namespace TwitterHistogram;
use Abraham\TwitterOAuth\TwitterOAuth;

class TwitterTimelineService
{
    private $userName;
    private $connection;

    public function __construct($userName)
    {
        $this->userName = $userName;
        $this->connection = new TwitterOAuth("oQM83XT6kIcaBoVM1wBmP0bib", "udVq8Vx603JW3fmxoxwbleaRcAObUDmSPAz5rOnuwzVVGp9t4t",
            "3355714197-wO1FXugi6jX8i9vhWYzG1MnpjuaE3xH1k575ruA", "xcqv0ErFRAPPmDij5D30BI4sSsT9iHiGcfxLWtiA2cKOI");
        $this->connection->setTimeouts(60, 30);
        $this->twitterIteratorService = new TwitterIteratorService($this->connection, $this->userName);
    }

    public function getTweetsByHour()
    {
        $tweets = $this->twitterIteratorService->getAllTweets();
        $get_hour = function ($tweet) {
            return date_parse($tweet->created_at)['hour'];
        };

        return array_count_values(array_map($get_hour, $tweets));
    }
}