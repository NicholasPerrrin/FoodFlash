
--Add bookmark table to phpmyadmin 

CREATE TABLE bookmarks (
    bookmarkID INT AUTO_INCREMENT PRIMARY KEY,
    customerID INT,
    restaurantID INT,
    bookmarkedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (customerID) REFERENCES users(customerID),
    FOREIGN KEY (restaurantID) REFERENCES restaurant(restaurantID),
    UNIQUE (customerID, restaurantID)
);
