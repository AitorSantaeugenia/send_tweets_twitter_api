<?php
    //include config.php and php wrapper for twitter
    require_once( 'config.php' );
    require_once( 'TwitterAPIExchange.php' );

    //settings for the connection
    $settings = array(
        'oauth_access_token' => TWITTER_ACCESS_TOKEN,
        'oauth_access_token_secret' => TWITTER_ACCESS_TOKEN_SECRET,
        'consumer_key' => TWITTER_CONSUMER_KEY,
        'consumer_secret' => TWITTER_CONSUMER_SECRET,
    );

    // URL and request method
    $url = 'https://api.twitter.com/1.1/statuses/update.json';
    $requestMethod = 'POST';

    $apiData = array(
        'status' => "Testing with tweets using PHP and twitter API. Let's see if this works",
    );

    // communication and API call
    $twitter = new TwitterAPIExchange( $settings );
    $twitter->buildOauth( $url, $requestMethod );
    $twitter->setPostfields( $apiData );
    $response = $twitter->performRequest( true, array( CURLOPT_SSL_VERIFYHOST => 0, CURLOPT_SSL_VERIFYPEER => 0 ) );

    echo '<pre>';
    print_r( json_decode( $response, true ) );

?>