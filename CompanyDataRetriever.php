<?php
/**
 * CompanyDataRetriever: A simple PHP library to retrieve company data from the Czech company register.
 */
class CompanyDataRetriever {
    /**
     * Retrieve company data from the Czech company register by ICO.
     *
     * @param string $ico The Identification Number (ICO) of the company.
     * @return array|false An associative array containing company data if successful, false otherwise.
     */
    public static function retrieveCompanyData($ico) {
        // Validate input
        if (!is_string($ico) || !preg_match('/^\d{8}$/', $ico)) {
            echo "Invalid ICO. Please provide a valid 8-digit ICO.\n";
            return false;
        }

        // Build the API endpoint URL
        $url = "https://ares.gov.cz/ekonomicke-subjekty-v-be/rest/ekonomicke-subjekty/{$ico}";

        // Initialize curl session
        $curl = curl_init($url);

        // Set options for curl
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        // Execute curl request
        $response = curl_exec($curl);

        // Check for errors
        if ($response === false) {
            echo "Failed to retrieve data from the API.\n";
            return false;
        }

        // Decode the JSON response
        $data = json_decode($response, true);

        // Check if the response contains valid data
        if ($data === null || isset($data['Error'])) {
            echo "No data found for the provided ICO.\n";
            return false;
        }

        // Close curl session
        curl_close($curl);

        // Return the company data
        return $data;
    }
}

// Prompt user to enter ICO
echo "Enter the ICO (8-digit Identification Number) of the company: ";
$ico = trim(fgets(STDIN));

// Retrieve company data
$companyData = CompanyDataRetriever::retrieveCompanyData($ico);

// Output company data if retrieval was successful
if ($companyData !== false) {
    echo "\nCompany Data:\n";
    // Loop through the data and print each key-value pair
    foreach ($companyData as $key => $value) {
        // If the value is an array, print it recursively
        if (is_array($value)) {
            echo $key . ":\n";
            foreach ($value as $subKey => $subValue) {
                echo "  " . $subKey . ": " . $subValue . "\n";
            }
        } else {
            echo $key . ": " . $value . "\n";
        }
    }
}
?>
