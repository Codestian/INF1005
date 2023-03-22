<?php namespace App\Controller\Api\Providers;

use App\Lib\Request;
use App\Lib\Response;
use App\Lib\Token;
use App\Model\Users;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\SignatureInvalidException;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Provider\Google;
use mysqli;
use stdClass;
class GoogleAuthController {
    private Google $provider;
    private Users $users;
    private string $table ='user';
    public function __construct(mysqli $mysqli) {
        $this->users = new Users($mysqli);
        $this->provider = new Google([
            'clientId'     => '299285997302-ek5etp823hdmpg9erqhltacfrei9uqr4.apps.googleusercontent.com',
            'clientSecret' => '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',
            'redirectUri'  => 'http://localhost/auth/redirect/google',
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

        $obj = new stdClass();

        $queryParams = $req->getQueryParams('code');

        if(isset($queryParams['code'])) {
            try {
                $token = $this->provider->getAccessToken('authorization_code', [
                    'code' => $queryParams['code']
                ]);
                $ownerDetails = $this->provider->getResourceOwner($token);
                $email = $ownerDetails->getEmail();

                $data = $this->users->read(['username', 'email', 'role_id', 'provider_id'], $this->table, ['email = ' . "'" . $email . "'"]);

                if(isset($data[0]->username)) {
                    //  User exists in database, provide JWT token.
                    $obj->email = $data[0]->email;
                    $obj->role = $data[0]->role_id;

                    $obj->isRegistered = true;
                    $obj->username = $data[0]->username;
                }
                else {
                    //  User is new, let client allow user to set username after creating user.
                    $columns = ['username', 'email', 'role_id', 'provider_id'];
                    // Generate random username, which can be modified afterwards.
                    $username = $this->generateUsername();
                    // Create new user row with email retrieved from oauth provider.
                    $this->users->create($this->table, $columns, [$username, $ownerDetails->getEmail(), 2, 2]);

                    $obj->email = $ownerDetails->getEmail();
                    $obj->role = 2;

                    $obj->isRegistered = false;
                    $obj->username = $username;
                }

                $this->users->close();

                $jwt = JWT::encode([$obj], "secret", 'HS256');
                setcookie( "token", $jwt, path:"/" ,httponly:true);

                $res->toJSON($obj);
            }
            catch (IdentityProviderException $e) {
                $res->toJSON("Error getting access token: " . $e->getMessage(), 400);
            }
        }
        else {
            $res->toJSON("please login again", 400);
        }

//        $test = Token::generateToken("test","secret");
//
//        $test1 = Token::decodeToken("mkfememiefw","secret");

//        echo $test;

//        printf('Hello %s!', $ownerDetails->getEmail());
//        header("Location: http://www.localhost/");
//        exit();

    }

    function generateUsername(): string
    {
        $adjectives = array('red', 'green', 'blue', 'purple', 'yellow', 'orange', 'pink', 'black', 'white', 'gray');
        $nouns = array('fox', 'dog', 'cat', 'bird', 'lion', 'tiger', 'bear', 'fish', 'snake', 'horse');

        $adjective = $adjectives[rand(0, count($adjectives) - 1)];
        $noun = $nouns[rand(0, count($nouns) - 1)];

        $username = $adjective . $noun . rand(100, 999);

        return $username;
    }
}
