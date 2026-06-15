CREATE DATABASE IF NOT EXISTS magera_golf_club CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE magera_golf_club;

CREATE TABLE IF NOT EXISTS users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(120) NOT NULL,
    email VARCHAR(190) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS tournaments (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(180) NOT NULL,
    tournament_date DATE NOT NULL,
    location VARCHAR(180) NOT NULL,
    description TEXT,
    max_players INT UNSIGNED NULL,
    entry_fee DECIMAL(10,2) NULL,
    status ENUM('planned', 'open', 'closed', 'finished') NOT NULL DEFAULT 'planned',
    image_path VARCHAR(255) NOT NULL DEFAULT 'images/professional-golf-player.jpg',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

INSERT INTO users (name, email, password_hash)
VALUES ('Administrator', 'admin@magera.sk', '$2y$10$M7cvX6oSNNjnInbegAwMRe0Ia/8HWecxNhlcMUyCj1sZuBPb56Dra')
ON DUPLICATE KEY UPDATE email = email;

INSERT INTO tournaments (title, tournament_date, location, description, max_players, entry_fee, status, image_path) VALUES
('Magera Open Cup', '2026-07-12', 'Magera Golf Club', 'Otvaraci letny turnaj pre clenov aj hosti klubu. Hra sa systemom stableford.', 72, 35.00, 'open', 'images/professional-golf-player.jpg'),
('Junior Golf Challenge', '2026-08-03', 'Treningove ihrisko Magera', 'Turnaj pre mladych hracov so sprievodnym programom a vyhodnotenim najlepsich vykonov.', 40, 15.00, 'planned', 'images/girl-taking-selfie-with-friends-golf-field.jpg'),
('Autumn Masters', '2026-09-20', 'Magera Golf Club', 'Jesenny klubovy turnaj s vecernym odovzdavanim cien.', 64, 45.00, 'planned', 'images/anna-rosar-ew-olGvgCCs-unsplash.jpg');
