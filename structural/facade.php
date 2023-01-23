<?php
class ApiFacade
{
    public Config $config;
    public Api $api;

    public function __construct()
    {
        $this->config = new Config();
        $this->api = new Api();
    }

    public function getUsernameByEmail(string $email): string
    {
        $request = new Request();
        $request->apiToken = $this->config->getApiToken();
        $request->jsonBody = json_encode(["email"=>"annamuratov@gmail.com"]);
        $response = $this->api->get($request);

        if ($response->status == Response::STATUS_OK){
            $result = json_decode($response->jsonBody, true);
            return $result["username"];
        }
        return "";
    }
}

// Subsystem config
class Config
{
    public function getApiToken(): string
    {
        return "DFdfdfghdi55#dfhgd84UHUIO654654#";
    }
}

// Subsystem API
class Api
{
    private $apiToken = "DFdfdfghdi55#dfhgd84UHUIO654654#";

    public function get(Request $request): Response
    {
        $response = new Response();
        if($request->apiToken = $this->apiToken){
            $data = json_decode($request->jsonBody, true);
            if (isset($data['email']) && $data['email']=="annamuratov@gmail.com"){
                $response->status = Response::STATUS_OK;
                $response->jsonBody = '{"username":"Javlon"}';
            }
        }
        return $response;
    }
}

class Request
{
    public string $apiToken;
    public string $jsonBody;
}

class Response
{
    const STATUS_ERR = "error";
    const STATUS_OK = "ok";

    public string $status = Response::STATUS_ERR;
    public string $jsonBody = '';
}

// Client part
function clientCode(ApiFacade $facade)
{
    $username = $facade->getUsernameByEmail("annamuratov@gmail.com");

    if ($username != ""){
        echo "Username: " . $username . "\n";
    }else{
        echo "User not found!\n";
    }
}

$facade = new ApiFacade();
clientCode($facade);