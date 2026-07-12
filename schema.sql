-- Heritage Reservoir Archive — database schema
-- Import this via phpMyAdmin (or `mysql -u root -p < schema.sql`) before using the app.

CREATE DATABASE IF NOT EXISTS heritage_archive CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE heritage_archive;

CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) UNIQUE NOT NULL,
  password_hash VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS reservoirs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(120) NOT NULL,
  sinhala_name VARCHAR(120),
  region VARCHAR(120),
  era VARCHAR(120),
  builder VARCHAR(120),
  description TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Seed data: a handful of well-known ancient Sri Lankan reservoirs (tanks).
-- Dates and attributions below reflect commonly cited tradition and are
-- simplified for demo purposes — treat as a starting point, not a citation.
INSERT INTO reservoirs (name, sinhala_name, region, era, builder, description) VALUES
('Kalawewa', 'කලා වැව', 'Anuradhapura District', '5th century CE', 'King Dhatusena',
 'Feeds Anuradhapura via the Jaya Ganga, an 87 km canal engineered with a gradient of roughly six inches per mile — precise enough that sections still function today.'),
('Tissa Wewa', 'තිස්ස වැව', 'Anuradhapura', '3rd century BCE', 'King Devanampiya Tissa',
 'One of the oldest reservoirs in Anuradhapura, traditionally dated to the introduction of Buddhism to the island.'),
('Nuwara Wewa', 'නුවර වැව', 'Anuradhapura', '4th century BCE (expanded later)', 'King Pandukabhaya',
 'One of the largest tanks in the ancient capital, expanded and repaired across several later reigns.'),
('Parakrama Samudra', 'පරාක්‍රම සමුද්‍රය', 'Polonnaruwa', '12th century CE', 'King Parakramabahu I',
 'A vast reservoir complex associated with the king''s stated principle that no drop of rain should reach the ocean without first serving people.'),
('Minneriya', 'මින්නේරිය වැව', 'Polonnaruwa District', '3rd century CE', 'King Mahasena',
 'An early large-scale tank whose shoreline is now part of Minneriya National Park, famous for its dry-season elephant gatherings.'),
('Kaudulla', 'කවුඩුල්ල වැව', 'Polonnaruwa District', 'Ancient, restored several times', 'Unattributed / multiple restorations',
 'Part of the historic tank cascade system linking several reservoirs across the region, restored and expanded in the 20th century.');
