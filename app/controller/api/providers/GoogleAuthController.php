<?php namespace App\Controller\Api\Providers;

use App\Lib\Request;
use App\Lib\Response;
use League\OAuth2\Client\Provider\Google;
use mysqli;
use stdClass;
class GoogleAuthController {
    private Google $provider;
    public function __construct(mysqli $mysqli) {
        $this->provider = new Google([
            'clientId'     => '299285997302-ek5etp823hdmpg9erqhltacfrei9uqr4.apps.googleusercontent.com',
            'clientSecret' => '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',
            'redirectUri'  => 'http://localhost/api/v1/auth/google/redirect',
        ]);
    }
    public function getAuthUrl(Request $req, Response $res) : void {
        // Redirect the user to the Google authentication page
        $authUrl = $this->provider->getAuthorizationUrl([
            'scope' => ['email', 'profile']
        ]);

        $obj = new stdClass();
        $obj->url = $authUrl;

        $res->toJSON($obj);
    }

    public function login(Request $req, Response $res) : void {
        $queryParams = $req->getQueryParams('code');

        $token = $this->provider->getAccessToken('authorization_code', [
            'code' => $queryParams['code']
        ]);

        $ownerDetails = $this->provider->getResourceOwner($token);

//        printf('Hello %s!', $ownerDetails->getEmail());
        header("Location: http://www.localhost/");
        exit();
    }

}
