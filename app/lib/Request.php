<?php namespace App\Lib;

use stdClass;

class Request
{
    public $params;
    public string $reqMethod;
    public string $queryString;
    public string $contentType;

    public function __construct($params = [])
    {
        $this->params = $params;
        $this->reqMethod = trim($_SERVER['REQUEST_METHOD']);
        $this->queryString = $_SERVER['QUERY_STRING'];
        $this->contentType = !empty($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
    }

    /*
     * Retrieves the query params in the url.
     * Traditionally, this used to be the way to send data from the client to the server.
     * In this context, its used for other purposes, such as oauth provider authentication.
     */
    function getQueryParams(string ...$keys): array {
        // Parse the query string and store it in an array
        $queryParams = [];
        parse_str($this->queryString, $queryParams);

        // Return an array of query parameter values for the specified keys
        return array_intersect_key($queryParams, array_flip($keys));
    }

    /*
     * It is deprecated and not wished to access super globals directly.
     * For POST requests, data is received as raw JSON body.
     * Pass in specified attributes needed.
     * All attributes are sanitized. Only email is checked for validity in addition as well.
    */
    public function getJSON(array $attribute_names): array {
        // Get the JSON data from the request body
        $json_data = file_get_contents('php://input');
        $res = new Response();

        // Decode the JSON data
        try {
            $data = json_decode($json_data, true, 512, JSON_THROW_ON_ERROR);

            // Check for missing attributes
            $missing_attributes = [];
            foreach ($attribute_names as $attribute_name) {
                if (!isset($data[$attribute_name])) {
                    $missing_attributes[] = $attribute_name;
                }
            }
            if (!empty($missing_attributes)) {
                // Handle missing attributes error
                $data = new StdClass();
                $data->message = 'Missing attributes: ' . implode(', ', $missing_attributes);
                $res->toJSON($data, 400);
                exit();
            }

            // Validate and sanitize the POST data
            $filtered_data = [];
            foreach ($attribute_names as $attribute_name) {
                $filtered_data[$attribute_name] = filter_var(trim($data[$attribute_name]), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                if ($attribute_name == 'email' && !filter_var($filtered_data[$attribute_name], FILTER_VALIDATE_EMAIL)) {
                    // Handle invalid email address error
                    $data = new StdClass();
                    $data->message = 'Invalid email address';
                    $res->toJSON($data, 400);
                    exit();
                }
            }

            return $filtered_data;
        } catch (\JsonException $e) {
            $data = new StdClass();
            $data->message = 'JSON is not in the correct format';
            $res->toJSON($data, 400);
            exit();
        }
    }
}