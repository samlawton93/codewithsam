<?php
error_reporting(0);
session_start();

require_once('database.php');
require_once('mail-send.php');

$return = [];

if (isset($_POST['honeypot']) && strlen($_POST['honeypot']) > 0) die();

if (isset($_POST) && strtoupper($_SERVER['REQUEST_METHOD']) === 'POST' && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtoupper($_SERVER['HTTP_X_REQUESTED_WITH']) === 'XMLHTTPREQUEST') {
    $name           = $_POST['name'];
    $company        = $_POST['company'];
    $phone          = $_POST['phone'];
    $email          = $_POST['email'];
    $budget         = $_POST['budget'];
    $services       = $_POST['service'];
    $checkedService = "";
    foreach($services as $service) {
        $checkedService .= $service.",";
    }
    $sendEmail = false;

    if (isset($name) && isset($company) && isset($phone) && isset($email) && isset($budget) && isset($checkedService)) {
        if (!preg_match('/[^0-9\+]/', $phone)) {
            $return['success'] = $sendEmail = true;
        } else {
            $return['error'] = 'Please enter a valid phone number.';
        }
    } else {
        $return['error'] = 'All fields are required.';
    }

    $fields = [
        'Name'             => $name,
        'Company'          => $company,
        'Phone'            => $phone,
        'Email'            => $email,
        'Service Required' => $checkedService,
        'Budget'           => $budget
    ];

    if ($sendEmail) {
        sendConfirmation('sam', $fields);
        sendConfirmation('customer', $fields);
    }
}

echo json_encode($return);
