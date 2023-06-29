<?php 
try {
//	session_start();
 //carrega o autoload do facebook
        require_once  __DIR__ . '/facebook-php-sdk-v4-master/src/Facebook/autoload.php';
        define('FACEBOOK_SDK_V4_SRC_DIR', __DIR__ . '/facebook-php-sdk-v4-master/src/Facebook');
        require_once __DIR__ . '/facebook-php-sdk-v4-master/src/Facebook/autoload.php';
        $fb = new Facebook\Facebook([
            'app_id' => '1728440314074706', // Replace {app-id} with your app id
            'app_secret' => '76a139a9c1c1f7b22ed2c0a2f7853caa',
            'default_graph_version' => 'v2.7',
            'persistent_data_handler'=>'session',]);
        $helper = $fb->getRedirectLoginHelper();
        $permissions = ['email']; // optional
        $loginUrl = $helper->getLoginUrl('http://www2.crianca.df.gov.br/boravencer1/return.php', $permissions);} 
catch (Exception $e) {
echo '1';
}	
