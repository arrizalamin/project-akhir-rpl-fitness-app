-- UP
CREATE TABLE IF NOT EXISTS activities (
  id INT PRIMARY KEY AUTO_INCREMENT,
  member_username VARCHAR(255) NOT NULL,
  FOREIGN KEY (member_username) REFERENCES members (username) ON DELETE CASCADE,
  type VARCHAR(255) NOT NULL,
  time INT NOT NULL,
  calories INT NOT NULL
);
-- DOWN
DROP TABLE IF EXISTS activities;