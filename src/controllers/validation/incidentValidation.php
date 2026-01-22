<?php
// src/controllers/validation/incidentValidation.php

function validateIncident($data)
{
    $errors = [];

    $allowedCategories = ['Electrical', 'Device', 'Network', 'Plumbing', 'Others'];
    $allowedReporterTypes = ['student', 'faculty'];

    $category = trim($data['category'] ?? '');
    $room = trim($data['room'] ?? '');
    $description = trim($data['description'] ?? '');
    $reporterType = strtolower(trim($data['reporterType'] ?? ''));

    if ($category === '' || !in_array($category, $allowedCategories)) {
        $errors[] = "Invalid category.";
    }

    if ($room === '' || strlen($room) > 50) {
        $errors[] = "Room is required (max 50 chars).";
    }

    if ($description === '' || strlen($description) < 5) {
        $errors[] = "Description must be at least 5 characters.";
    }

    if ($reporterType === '' || !in_array($reporterType, $allowedReporterTypes)) {
        $errors[] = "Invalid reporter type.";
    }

    return $errors;
}

?>