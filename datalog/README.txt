** Setting up database **

create table emotions( id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, x DECIMAL(3,3), y DECIMAL(3,3), company VARCHAR(100), data VARCHAR(900), created TIMESTAMP DEFAULT NOW() );
