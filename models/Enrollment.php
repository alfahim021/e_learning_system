<?php
// models/Enrollment.php

class Enrollment {
    private mysqli $conn;

    public function __construct(mysqli $conn) {
        $this->conn = $conn;
    }


    public function enrollUser(int $user_id, int $course_id): bool {
        $stmt = $this->conn->prepare("SELECT id FROM enrollments WHERE user_id = ? AND course_id = ?");
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $this->conn->error);
        }
        $stmt->bind_param("ii", $user_id, $course_id);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->close();
            return false; // already enrolled
        }
        $stmt->close();

        $stmt = $this->conn->prepare("INSERT INTO enrollments (user_id, course_id, enrolled_at) VALUES (?, ?, NOW())");
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $this->conn->error);
        }
        $stmt->bind_param("ii", $user_id, $course_id);
        $success = $stmt->execute();
        $stmt->close();

        return $success;
    }


    public function getUserCourses(int $user_id): array {
        $stmt = $this->conn->prepare("
            SELECT c.* FROM courses c
            JOIN enrollments e ON c.id = e.course_id
            WHERE e.user_id = ?
            ORDER BY c.name ASC
        ");
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $this->conn->error);
        }
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $courses = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();

        return $courses;
    }

    public function unenrollUser(int $user_id, int $course_id): bool {
        $stmt = $this->conn->prepare("DELETE FROM enrollments WHERE user_id = ? AND course_id = ?");
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $this->conn->error);
        }
        $stmt->bind_param("ii", $user_id, $course_id);
        $success = $stmt->execute();
        $stmt->close();

        return $success;
    }
}
?>
