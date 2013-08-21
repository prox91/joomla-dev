<?php
/**
 * Created by JetBrains PhpStorm.
 * User: root
 * Date: 8/20/13
 * Time: 3:40 PM
 * To change this template use File | Settings | File Templates.
 */
JLoader::registerPrefix('Red', JPATH_ADMINISTRATOR . '/components/com_redtwitter/libraries');

class FacebookUser
{
    public function getFeeds($username, $accessToken, $limit = 20)
    {
        $url = "https://graph.facebook.com/" . $username . "/feed?access_token=" . $accessToken;

        try
        {
            $http = RedHttpFactory::getHttp();
            $response = $http->get($url);

            $feedData = json_decode($response->body);

            if(isset($feedData->error))
            {
                return "";
            }

            return $feedData;
        }
        catch(Exception $e)
        {
            return "";
        }
    }
}