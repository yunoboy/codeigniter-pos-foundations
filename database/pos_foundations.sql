SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS customers;
DROP TABLE IF EXISTS users;

CREATE TABLE customers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    created_at DATETIME NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    full_name VARCHAR(100) NOT NULL,
    created_at DATETIME NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO customers (full_name, email, phone, created_at) VALUES
('Maria Santos', 'maria@example.com', '09171234567', '2026-09-01 09:00:00'),
('Juan Dela Cruz', 'juan@example.com', '09181234567', '2026-09-02 10:00:00'),
('Angela Reyes', 'angela@example.com', '09191234567', '2026-09-03 11:00:00'),
('Carlo Mendoza', 'carlo@example.com', '09201234567', '2026-09-04 12:00:00'),
('Sofia Garcia', 'sofia@example.com', '09211234567', '2026-09-05 13:00:00');

INSERT INTO users (username, full_name, created_at) VALUES
('admin', 'System Administrator', '2026-09-01 09:00:00'),
('maria', 'Maria Santos', '2026-09-02 10:00:00'),
('juan', 'Juan Dela Cruz', '2026-09-03 11:00:00'),
('angela', 'Angela Reyes', '2026-09-04 12:00:00'),
('carlo', 'Carlo Mendoza', '2026-09-05 13:00:00');

SET FOREIGN_KEY_CHECKS = 1;