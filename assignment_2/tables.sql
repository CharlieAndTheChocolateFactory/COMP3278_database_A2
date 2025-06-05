CREATE TABLE Member(
    member_ID INT PRIMARY KEY,
    name varchar(255) NOT NULL,
    email varchar(255) NOT NULL,
    contact_number varchar(255) NOT NULL -- I am not sure about this one
)ENGINE=InnoDB;

CREATE TABLE ServiceArea(
    service_area_ID INT PRIMARY KEY,
    name varchar(255) NOT NULL,
    parent_area_ID INT NULL,
    FOREIGN KEY (parent_area_ID) REFERENCES ServiceArea(service_area_ID)
)ENGINE=InnoDB;

CREATE TABLE ChargingStation(
    station_ID INT PRIMARY KEY,
    name varchar(255) NOT NULL,
    location_ID INT NOT NULL,
    available_pbs INT NOT NULL,
    FOREIGN KEY (location_ID) REFERENCES ServiceArea(service_area_ID)
)ENGINE=InnoDB;

CREATE TABLE PowerBank(
    pb_ID INT PRIMARY KEY,
    station_ID INT NULL,
    status TINYINT NOT NULL CHECK (status IN (0, 1)),
    FOREIGN KEY (station_ID) REFERENCES ChargingStation(station_ID)
)ENGINE=InnoDB;

CREATE TABLE Coupon(
    coupon_ID INT PRIMARY KEY,
    redemption TINYINT NOT NULL CHECK (redemption IN (0, 1)),
    expiration_date DATE NOT NULL,
    discount_value INT NOT NULL,
    member_ID INT NOT NULL,
    FOREIGN KEY (member_ID) REFERENCES Member(member_ID)
)ENGINE=InnoDB;

CREATE TABLE RentalTransaction(
    transaction_ID INT PRIMARY KEY,
    member_ID INT NOT NULL,
    pb_ID INT NOT NULL,
    station_ID INT NOT NULL,
    start_datetime DATETIME NOT NULL,
    end_datetime DATETIME NULL,
    payment_amount INT NULL,
    status TINYINT NOT NULL CHECK (status IN (0, 1)),
    coupon_ID INT NULL,
    FOREIGN KEY (member_ID) REFERENCES Member(member_ID),
    FOREIGN KEY (pb_ID) REFERENCES PowerBank(pb_ID),
    FOREIGN KEY (station_ID) REFERENCES ChargingStation(station_ID),
    FOREIGN KEY (coupon_ID) REFERENCES Coupon(coupon_ID)
)ENGINE=InnoDB;

CREATE TABLE Reservation(
    reservation_ID INT PRIMARY KEY,
    member_ID INT NOT NULL,
    station_ID INT NOT NULL,
    reservation_datetime DATETIME NOT NULL,
    collect_datetime DATETIME NULL CHECK (TIMESTAMPDIFF(MINUTE, reservation_datetime, collect_datetime) <= 30 OR collect_datetime IS NULL),
    status TINYINT NOT NULL CHECK (status IN (0, 1, 2)),
    FOREIGN KEY (member_ID) REFERENCES Member(member_ID),
    FOREIGN KEY (station_ID) REFERENCES ChargingStation(station_ID)
)ENGINE=InnoDB;

