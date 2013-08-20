<?php
/**
 * Created by JetBrains PhpStorm.
 * User: root
 * Date: 8/20/13
 * Time: 3:40 PM
 * To change this template use File | Settings | File Templates.
 */
JLoader::registerPrefix('Red', JPATH_ADMINISTRATOR . '/components/com_redtwitter/libraries');

class TwitterStatuses
{
    public function getUserTimeline($username, $accessToken, $limit = 20)
    {
        $url = "https://api.twitter.com/1.1/statuses/user_timeline.json?include_rts=1&screen_name=" . $username . "&count=" . $limit;
        $header = array('Authorization' => $accessToken,);

        $http = RedHttpFactory::getHttp();
        $response = $http->get($url, $header);

        return json_decode($response->body);
    }
}