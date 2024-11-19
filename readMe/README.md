# FoodFlash



-- I Added category column to restaurant table. Not sure if it's required for the code to work
ALTER TABLE restaurant
ADD COLUMN category VARCHAR(100),
ADD COLUMN restaurantLocation VARCHAR(100);


