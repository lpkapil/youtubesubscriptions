<?php
/**
 * Sample PHP code for youtube.subscriptions.list
 * See instructions for running these code samples locally:
 * https://developers.google.com/explorer-help/guides/code_samples#php
 */

if (!file_exists(__DIR__ . '/vendor/autoload.php')) {
    throw new Exception(sprintf('Please run "composer require google/apiclient:~2.0" in "%s"', __DIR__));
  }
  require_once __DIR__ . '/vendor/autoload.php';
  
  //session_start();

  $client = new Google_Client();
  $client->setApplicationName('API code samples');
  $client->setScopes([
      'https://www.googleapis.com/auth/youtube.readonly',
      'https://www.googleapis.com/auth/youtube.force-ssl'
  ]);
  
  // TODO: For this request to work, you must replace
  //       "YOUR_CLIENT_SECRET_FILE.json" with a pointer to your
  //       client_secret.json file. For more information, see
  //       https://cloud.google.com/iam/docs/creating-managing-service-account-keys
  $client->setAuthConfig('secrets/client_secret_1041055349024-qhomtsnp7b8470kodd89drt6rod7jl9c.apps.googleusercontent.com.json');
  $client->setAccessType('offline');

  if (empty($_GET['code'])) {
    $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
    $client->setRedirectUri($redirect_uri);
    
    // Request authorization from the user.
    $authUrl = $client->createAuthUrl();
    header("Location: ".$authUrl);
    //printf("Open this link in your browser: <a href='%s'>Open Link</a>", $authUrl);
  }
  
  $authCode = trim($_GET['code']);
  
  // Exchange authorization code for an access token.
  $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
  $client->setAccessToken($accessToken);
  
  //List subscriptions
  $subscriptions = listSubscribers($client);
  echo "<pre>";
  print_r($subscriptions->pageInfo->totalResults);
  echo "</pre>";

  //Insert subscription
  //insertSubscription($client);
 
  //Delete subscription
  //deleteSubscription($client, 'Oi8OkosBHMnGUCMPptubaQU841-8ZL0Q-HSx8wHHMXA');

  function listSubscribers($client) {
    // Define service object for making API requests.
    $service = new Google_Service_YouTube($client);
    $queryParams = [
        'mySubscribers' => true,
        'maxResults' => 10
    ];
    $response = $service->subscriptions->listSubscriptions('snippet', $queryParams);
    return $response;
  }

  function insertSubscription($client, $channelIdToSubscribe = 'UCAuUUnT6oDeKwE6v1NGQxug') {
    // Define service object for making API requests.
    $service = new Google_Service_YouTube($client);
    // Define the $subscription object, which will be uploaded as the request body.
    $subscription = new Google_Service_YouTube_Subscription();
    // Add 'snippet' object to the $subscription object.
    $subscriptionSnippet = new Google_Service_YouTube_SubscriptionSnippet();
    $resourceId = new Google_Service_YouTube_ResourceId();
    $resourceId->setChannelId($channelIdToSubscribe);
    $resourceId->setKind('youtube#channel');
    $subscriptionSnippet->setResourceId($resourceId);
    $subscription->setSnippet($subscriptionSnippet);
    $response = $service->subscriptions->insert('snippet', $subscription);
    return $response;
  }

  function deleteSubscription($client, $id) {
    // Define service object for making API requests.
    $service = new Google_Service_YouTube($client);
    $resposne = $service->subscriptions->delete($id);
    return $response;
  }

