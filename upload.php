<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Set your Google Sheets API credentials
    $clientSecretFile = 'https://drive.google.com/drive/folders/1mwLbitQfxM433GPz9ODNPKITlFLL4zMG'; // Replace with your actual path
    $spreadsheetId = 'https://script.google.com/macros/s/AKfycby4HeZT8zj2mbf61LGOvqlfjsNo0uxVR8evtG4DS-xIOiH77dLu_Xl0in3ZD5rbxvOA/exec'; // Replace with your actual spreadsheet ID

    // Load the Google API PHP Client Library
    require_once 'vendor/autoload.php';

    // Create a Google_Client object
    $client = new Google_Client();
    $client->setApplicationName('Student Registration Form');
    $client->setScopes([Google_Service_Sheets::SPREADSHEETS]);
    $client->setAuthConfig($clientSecretFile);

    // Create a Google_Service_Sheets object
    $service = new Google_Service_Sheets($client);

    // Get form data
    $data = [
        $_POST['name'],
        $_POST['fatherName'],
        $_POST['postalAddress'],
        $_POST['gender'],
        $_POST['course'],
        $_POST['email'],
        $_POST['dob'],
        $_POST['mobile'],
        "License Uploaded", // You may add a confirmation message for the license
    ];

    // Add a new row to the Google Sheet
    $range = 'Sheet1'; // Replace with your actual sheet name
    $body = new Google_Service_Sheets_ValueRange([
        'values' => [$data],
    ]);
    $params = [
        'valueInputOption' => 'RAW',
    ];
    $insert = [
        'insertDataOption' => 'INSERT_ROWS',
    ];

    $service->spreadsheets_values->append($spreadsheetId, $range, $body, $params, $insert);
} else {
    echo "Invalid request.";
}
?>
