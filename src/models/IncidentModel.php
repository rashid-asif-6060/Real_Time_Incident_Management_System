<?php
// src/models/IncidentModel.php
require_once __DIR__ . "/Database.php";

function createIncident($category, $room, $description, $reporterType, $createdBy)
{
    $conn = getConnection();

    $category = trim($category);
    $room = trim($room);
    $description = trim($description);
    $reporterType = trim($reporterType);

    $stmt = $conn->prepare("
        INSERT INTO incidents (category, room, description, reporter_type, created_by)
        VALUES (?, ?, ?, ?, ?)
    ");

    if (!$stmt) return false;

    $stmt->bind_param("ssssi", $category, $room, $description, $reporterType, $createdBy);

    if (!$stmt->execute()) return false;

    return $conn->insert_id;
}

function getAllIncidents()
{
    $conn = getConnection();

    $sql = "
        SELECT i.id, i.category, i.room, i.description, i.reporter_type, i.status,
               i.created_at, i.updated_at,
               u.name AS reporter_name, u.role AS user_role
        FROM incidents i
        JOIN users u ON u.id = i.created_by
        ORDER BY i.id DESC
    ";

    $result = $conn->query($sql);
    if (!$result) return [];

    $rows = [];
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    return $rows;
}

function getMyIncidents($userId)
{
    $conn = getConnection();

    $stmt = $conn->prepare("
        SELECT id, category, room, description, reporter_type, status, created_at, updated_at
        FROM incidents
        WHERE created_by = ?
        ORDER BY id DESC
    ");

    if (!$stmt) return [];

    $stmt->bind_param("i", $userId);
    $stmt->execute();

    $result = $stmt->get_result();
    $rows = [];
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    return $rows;
}

?>