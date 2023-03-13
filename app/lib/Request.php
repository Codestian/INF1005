<?php namespace App\Lib;

class Request
{
    public $params;
    public $reqMethod;
    public $contentType;

    public function __construct($params = [])
    {
        $this->params = $params;
        $this->reqMethod = trim($_SERVER['REQUEST_METHOD']);
        $this->contentType = !empty($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
    }

    public function getBody(): array
    {
        $body = [];

        if ($this->reqMethod !== 'POST') {
            $body[] = "not a POST request";
            return $body;
        }

        foreach ($_POST as $key => $value) {
            $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
        }

        return $body;
    }

    //    It is deprecated and not wished to access super globals directly.
    //    For POST requests, data is received as raw JSON body.
    //    Pass in specified attributes needed.
    //    All attributes are sanitized. Only email is checked for validity in addition as well.
    public function getJSON(array $attribute_names): array {
        // Get the JSON data from the request body
        $json_data = file_get_contents('php://input');

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
                exit('Missing attributes: ' . implode(', ', $missing_attributes));
            }

            // Validate and sanitize the POST data
            $filtered_data = [];
            foreach ($attribute_names as $attribute_name) {
                $filtered_data[$attribute_name] = filter_var(trim($data[$attribute_name]), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                if ($attribute_name == 'email' && !filter_var($filtered_data[$attribute_name], FILTER_VALIDATE_EMAIL)) {
                    // Handle invalid email address error
                    exit('Invalid email address');
                }
            }

            return $filtered_data;
        } catch (\JsonException $e) {
            $data[] = "error, no json";
            return $data;
        }
    }
}