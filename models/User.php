<?php
// models/User.php

class User {
    private mysqli $conn;

    public function __construct(mysqli $conn) {
        $this->conn = $conn;
    }

    public function getUserById(int $id): ?array {
        $stmt = $this->conn->prepare("SELECT id, username, email FROM users WHERE id = ?");
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $this->conn->error);
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();

        return $user ?: null;
    }


    public function getUserByEmail(string $email): ?array {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $this->conn->error);
        }
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();

        return $user ?: null;
    }


    public function createUser(string $username, string $email, string $password_hash): bool {
        $stmt = $this->conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $this->conn->error);
        }
        $stmt->bind_param("sss", $username, $email, $password_hash);
        $success = $stmt->execute();
        $stmt->close();

        return $success;
    }

/
    public function updateUser(int $id, string $username, string $email): bool {
        $stmt = $this->conn->prepare("UPDATE users SET username = ?, email = ? WHERE id = ?");
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $this->conn->error);
        }
        $stmt->bind_param("ssi", $username, $email, $id);
        $success = $stmt->execute();
        $stmt->close();

        return $success;
    }

    public function updatePassword(int $id, string $password_hash): bool {
        $stmt = $this->conn->prepare("UPDATE users SET password = ? WHERE id = ?");
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $this->conn->error);
        }
        $stmt->bind_param("si", $password_hash, $id);
        $success = $stmt->execute();
        $stmt->close();

        return $success;
    }
}
?>
