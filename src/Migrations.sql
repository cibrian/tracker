CREATE TABLE domains (
    id INT AUTO_INCREMENT PRIMARY KEY,
    domain VARCHAR(255) NOT NULL UNIQUE
);

INSERT INTO domains (domain) VALUES ('localhost:8081'), ('localhost:8082');

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    domain_id INT NOT NULL,
    FOREIGN KEY (domain_id) REFERENCES domains(id) ON DELETE CASCADE
);

INSERT INTO users (username, password, domain_id) VALUES ('admin_8081', '$2y$10$K1HCv9Q5N1ux5RjPzHh8u.N1KAmS5/8C4BhsJ5PSWROK8LhA6CtG.', 1);#password:secret
INSERT INTO users (username, password, domain_id) VALUES ('admin_8082', '$2y$10$7OZcM9Hgpkh6L3wO9GzNs.5cF3ObLmAhdA9xlN.BxYJStktJYX5C2', 2);#password:secret

CREATE TABLE visits (
    id INT AUTO_INCREMENT PRIMARY KEY,
    domain_id INT NOT NULL,
    url VARCHAR(255) NOT NULL,
    ip VARCHAR(45) NOT NULL,
    user_agent TEXT NOT NULL,
    visit_date DATE NOT NULL,
    UNIQUE KEY unique_visit (domain_id, url, ip, visit_date),
    FOREIGN KEY (domain_id) REFERENCES domains(id) ON DELETE CASCADE
);

INSERT INTO visits (domain_id, url, ip, user_agent, visit_date) VALUES
(1, '/blog.php', '192.168.1.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)', DATE_SUB(CURDATE(), INTERVAL 4 DAY)),
(1, '/about.php', '192.168.1.2', 'Chrome/110.0 (Macintosh; Intel Mac OS X)', DATE_SUB(CURDATE(), INTERVAL 4 DAY)),
(2, '/blog.php', '203.0.113.5', 'Safari/537.36 (iPhone; iOS 15.1)', DATE_SUB(CURDATE(), INTERVAL 4 DAY)),
(2, '/about.php', '198.51.100.8', 'Edge/99.0 (Windows 10)', DATE_SUB(CURDATE(), INTERVAL 4 DAY)),
(1, '/blog.php', '203.0.113.9', 'Firefox/110.0 (Macintosh; Intel Mac OS X)', DATE_SUB(CURDATE(), INTERVAL 4 DAY)),

(1, '/blog.php', '192.168.1.3', 'Mozilla/5.0 (Linux; Android 11)', DATE_SUB(CURDATE(), INTERVAL 3 DAY)),
(2, '/about.php', '203.0.113.10', 'Chrome/120.0 (Windows 10)', DATE_SUB(CURDATE(), INTERVAL 3 DAY)),
(1, '/blog.php', '198.51.100.2', 'Safari/537.36 (Macintosh)', DATE_SUB(CURDATE(), INTERVAL 3 DAY)),
(2, '/about.php', '198.51.100.3', 'Edge/101.0 (Windows 11)', DATE_SUB(CURDATE(), INTERVAL 3 DAY)),
(1, '/about.php', '203.0.113.6', 'Mozilla/5.0 (Windows NT 10.0)', DATE_SUB(CURDATE(), INTERVAL 3 DAY)),

(1, '/about.php', '192.168.1.4', 'Mozilla/5.0 (Android 12; Mobile)', DATE_SUB(CURDATE(), INTERVAL 2 DAY)),
(2, '/blog.php', '203.0.113.7', 'Chrome/105.0 (Linux)', DATE_SUB(CURDATE(), INTERVAL 2 DAY)),
(1, '/blog.php', '198.51.100.5', 'Edge/104.0 (Macintosh)', DATE_SUB(CURDATE(), INTERVAL 2 DAY)),
(2, '/about.php', '198.51.100.6', 'Safari/604.1 (iPhone; iOS 14)', DATE_SUB(CURDATE(), INTERVAL 2 DAY)),
(1, '/about.php', '203.0.113.11', 'Firefox/111.0 (Windows 10)', DATE_SUB(CURDATE(), INTERVAL 2 DAY)),

(2, '/blog.php', '192.168.1.5', 'Mozilla/5.0 (Windows NT 11.0)', DATE_SUB(CURDATE(), INTERVAL 1 DAY)),
(1, '/about.php', '203.0.113.12', 'Chrome/115.0 (Mac OS X)', DATE_SUB(CURDATE(), INTERVAL 1 DAY)),
(2, '/about.php', '198.51.100.7', 'Edge/102.0 (Windows 10)', DATE_SUB(CURDATE(), INTERVAL 1 DAY)),
(1, '/blog.php', '203.0.113.8', 'Safari/600.1 (Android 10)', DATE_SUB(CURDATE(), INTERVAL 1 DAY)),
(2, '/about.php', '203.0.113.13', 'Firefox/120.0 (Linux)', DATE_SUB(CURDATE(), INTERVAL 1 DAY));


