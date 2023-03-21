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
        $obj->status = 200;

        $queryParams = $req->getQueryParams('code');

        if(isset($queryParams['code'])) {
            try {
                $token = $this->provider->getAccessToken('authorization_code', [
                    'code' => $queryParams['code']
                ]);
                $ownerDetails = $this->provider->getResourceOwner($token);
                $email = $ownerDetails->getEmail();

                $data = $this->users->read(['username', 'email', 'role_id'], $this->table, ['email = ' . "'" . $email . "'"]);

                $obj1 = new stdClass();

                $obj->message = $obj1;

                $obj2 = new stdClass();

                if(isset($data[0]->username)) {
                    //  User exists in database, provide JWT token.
                    $obj2->email = $data[0]->email;
                    $obj2->role = $data[0]->role_id;

                    $obj1->isRegistered = true;
                    $obj1->username = $data[0]->username;
                }
                else {
                    //  User is new, let client allow user to set username after creating user.
                    $columns = ['username', 'email', 'role_id', 'provider'];
                    // Generate random username, which can be modified afterwards.
                    $username = $this->generateUsername();
                    // Create new user row with email rerieved from oauth provider.
                    $this->users->create($this->table, $columns, [$username, $ownerDetails->getEmail(), 2, 'google']);

                    $obj2->email = $ownerDetails->getEmail();
                    $obj2->role = 2;

                    $obj1->isRegistered = false;
                    $obj1->username = $username;
                }

                $this->users->close();

                $jwt = JWT::encode([$obj2], "secret", 'HS256');
                setcookie( "token", $jwt, path:"/" ,httponly:true);

                $res->toJSON($obj);
            }
            catch (IdentityProviderException $e) {
                $obj->message = "Error getting access token: " . $e->getMessage();
                $res->toJSON($obj);
            }
        }
        else {
            $obj->message = "please relogin again.";
            $res->toJSON($obj);
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
