<?phpsession_start();require_once  __DIR__ . '/facebook-php-sdk-v4-master/src/Facebook/autoload.php';define('FACEBOOK_SDK_V4_SRC_DIR', __DIR__ . '/facebook-php-sdk-v4-master/src/Facebook');require_once __DIR__ . '/facebook-php-sdk-v4-master/src/Facebook/autoload.php';$fb = new Facebook\Facebook([    'app_id' => '1728440314074706', // Replace {app-id} with your app id    'app_secret' => '76a139a9c1c1f7b22ed2c0a2f7853caa',    'default_graph_version' => 'v2.7',    'persistent_data_handler'=>'session',]);$helper = $fb->getRedirectLoginHelper();try {    $accessToken = $helper->getAccessToken();	} catch(Facebook\Exceptions\FacebookResponseException $e) {    // When Graph returns an error    echo 'Graph returned an error: ' . $e->getMessage();    exit;} catch(Facebook\Exceptions\FacebookSDKException $e) {    // When validation fails or other local issues    echo 'Facebook SDK returned an error: ' . $e->getMessage();    exit;}if (isset($accessToken)) {    	    $_SESSION['facebook_access_token'] = (string) $accessToken;	    // Now you can redirect to another page and use the	header('location:logado.php');		    }