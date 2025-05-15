CREATE TABLE judges (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE grades (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judge_id INT NOT NULL,
    group_members VARCHAR(255) NOT NULL,
    group_number VARCHAR(50) NOT NULL,
    project_title VARCHAR(255) NOT NULL,
    criteria_developing INT CHECK (criteria_developing BETWEEN 0 AND 10),
    criteria_accomplished INT CHECK (criteria_accomplished BETWEEN 10 AND 15),
    total_score INT,
    comments TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (judge_id) REFERENCES judges(id) ON DELETE CASCADE
);

CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);