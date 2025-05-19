<?php
// models/Assignment.php

class Assignment {
    private mysqli $conn;

    public function __construct(mysqli $conn) {
        $this->conn = $conn;
    }


    public function getAssignments(int $course_id = 0): array {
        if ($course_id > 0) {
            $stmt = $this->conn->prepare("SELECT * FROM assignments WHERE course_id = ? ORDER BY created_at DESC");
            if (!$stmt) {
                throw new Exception("Prepare failed: " . $this->conn->error);
            }
            $stmt->bind_param("i", $course_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $assignments = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
        } else {
            $result = $this->conn->query("SELECT * FROM assignments ORDER BY created_at DESC");
            $assignments = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
        }

        return $assignments;
    }

    public function getAssignmentById(int $id): ?array {
        $stmt = $this->conn->prepare("SELECT * FROM assignments WHERE id = ?");
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $this->conn->error);
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();
        $assignment = $res->fetch_assoc();
        $stmt->close();

        return $assignment ?: null;
    }


    public function addAssignment(int $course_id, string $title, string $description): bool {
        $stmt = $this->conn->prepare("INSERT INTO assignments (course_id, title, description, created_at) VALUES (?, ?, ?, NOW())");
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $this->conn->error);
        }
        $stmt->bind_param("iss", $course_id, $title, $description);
        $success = $stmt->execute();
        $stmt->close();

        return $success;
    }


    public function updateAssignment(int $id, string $title, string $description): bool {
        $stmt = $this->conn->prepare("UPDATE assignments SET title = ?, description = ? WHERE id = ?");
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $this->conn->error);
        }
        $stmt->bind_param("ssi", $title, $description, $id);
        $success = $stmt->execute();
        $stmt->close();

        return $success;
    }

  
    public function deleteAssignment(int $id): bool {
        $stmt = $this->conn->prepare("DELETE FROM assignments WHERE id = ?");
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $this->conn->error);
        }
        $stmt->bind_param("i", $id);
        $success = $stmt->execute();
        $stmt->close();

        return $success;
    }
}
?>
