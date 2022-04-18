-- Create and select.
CREATE DATABASE JobsPlanner;
USE JobsPlanner;

-- Category table.
CREATE TABLE Category (
    CategoryID int NOT NULL AUTO_INCREMENT,
    CategoryName varchar(50) NOT NULL,
    PRIMARY KEY (CategoryID)
);


-- Job table.
-- FK: CategoryID in Category.
CREATE TABLE Job (
    JobID int NOT NULL AUTO_INCREMENT,
    Description varchar(120) NOT NULL,
    FKCategoryID int NOT NULL,
    PRIMARY KEY (JobID),
    CONSTRAINT FK_Job_FKCategoryID FOREIGN KEY (FKCategoryID) REFERENCES Category(CategoryID)
);