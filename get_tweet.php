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
    $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
    $requestMethod = 'GET';

    //screen_name = your_twitter_name
    //count = tweets
    $getFields = '?screen_name=SantaeugeniaJ&count=1';

    // communication and API call and setting up method
    $twitter = new TwitterAPIExchange( $settings );
    $twitter->setGetfield( $getFields );
    $twitter->buildOauth( $url, $requestMethod );

    //response
    $response = $twitter->performRequest( true, array( CURLOPT_SSL_VERIFYHOST => 0, CURLOPT_SSL_VERIFYPEER => 0 ) );
    //jsdecode response
    $tweets = json_decode( $response, true );

?>
<h2>Last tweets:</h2>
    <?php foreach ($tweets as $tweet) : ?>
        <p>Twitter user is @<?php echo $tweet['user']['screen_name']; ?> created at: <?php echo $tweet['created_at']; ?><br>
        <?php echo $tweet['text']; ?></p>
    <?php endforeach; ?>