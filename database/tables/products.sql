-- Products Table
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    price VARCHAR(200) DEFAULT '"$00.00"',
    category_id INT,

    FOREIGN KEY (category_id) REFERENCES categories(id)
);