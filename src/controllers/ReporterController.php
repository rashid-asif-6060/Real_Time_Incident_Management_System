<?php
// src/controllers/ReporterController.php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header("Content-Type: application/json");

require_once __DIR__ . "/../models/IncidentModel.php";
require_once __DIR__ . "/validation/incidentValidation.php";

/*
  ✅ Auth (supports cookies now, sessions later)

  Order:
  1) $_SESSION['user']['id']
  2) $_SESSION['user_id']
  3) $_COOKIE['user_id']
*/
$userId = null;

// Only start session if you want later; safe to call always
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['user']) && isset($_SESSION['user']['id'])) {
    $userId = (int)$_SESSION['user']['id'];
} elseif (isset($_SESSION['user_id'])) {
    $userId = (int)$_SESSION['user_id'];
} elseif (isset($_COOKIE['user_id'])) {
    $userId = (int)$_COOKIE['user_id'];
}

if (!$userId) {
    http_response_code(401);
    echo json_encode(["success" => false, "message" => "Unauthorized"]);
    exit;
}

$action = $_GET['action'] ?? '';

if ($action === 'create') {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        echo json_encode(["success" => false, "message" => "Method not allowed"]);
        exit;
    }

    $errors = validateIncident($_POST);
    if (!empty($errors)) {
        http_response_code(422);
        echo json_encode(["success" => false, "errors" => $errors]);
        exit;
    }

    $category = $_POST['category'];
    $room = $_POST['room'];
    $description = $_POST['description'];
    $reporterType = strtolower($_POST['reporterType']);

    $incidentId = createIncident($category, $room, $description, $reporterType, $userId);

    if (!$incidentId) {
        http_response_code(500);
        echo json_encode(["success" => false, "message" => "Failed to create incident"]);
        exit;
    }

    echo json_encode([
        "success" => true,
        "message" => "Issue submitted successfully",
        "incidentId" => $incidentId
    ]);
    exit;
}

if ($action === 'list') {
    if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
        http_response_code(405);
        echo json_encode(["success" => false, "message" => "Method not allowed"]);
        exit;
    }

    $data = getAllIncidents();
    echo json_encode(["success" => true, "data" => $data]);
    exit;
}

if ($action === 'my') {
    if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
        http_response_code(405);
        echo json_encode(["success" => false, "message" => "Method not allowed"]);
        exit;
    }

    $data = getMyIncidents($userId);
    echo json_encode(["success" => true, "data" => $data]);
    exit;
}

http_response_code(400);
echo json_encode(["success" => false, "message" => "Invalid action"]);
exit;

?>