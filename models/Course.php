<?php
// models/Course.php

class Course {
    private mysqli $conn;

    public function __construct(mysqli $conn) {
        $this->conn = $conn;
    }

    public function getAllCourses(int $limit = 100, int $offset = 0): array {
        $stmt = $this->conn->prepare("SELECT * FROM courses ORDER BY name ASC LIMIT ? OFFSET ?");
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $this->conn->error);
        }
        $stmt->bind_param("ii", $limit, $offset);
        $stmt->execute();
        $result = $stmt->get_result();
        $courses = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();

        return $courses;
    }


    public function getCourseById(int $id): ?array {
        $stmt = $this->conn->prepare("SELECT * FROM courses WHERE id = ?");
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $this->conn->error);
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $course = $result->fetch_assoc();
        $stmt->close();

        return $course ?: null;
    }


    public function createCourse(string $name, string $description): bool {
        $stmt = $this->conn->prepare("INSERT INTO courses (name, description) VALUES (?, ?)");
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $this->conn->error);
        }
        $stmt->bind_param("ss", $name, $description);
        $success = $stmt->execute();
        $stmt->close();

        return $success;
    }

 
    public function updateCourse(int $id, string $name, string $description): bool {
        $stmt = $this->conn->prepare("UPDATE courses SET name = ?, description = ? WHERE id = ?");
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $this->conn->error);
        }
        $stmt->bind_param("ssi", $name, $description, $id);
        $success = $stmt->execute();
        $stmt->close();

        return $success;
    }

    public function deleteCourse(int $id): bool {
        $stmt = $this->conn->prepare("DELETE FROM courses WHERE id = ?");
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
