<?php

/**
 * Gets all the categories from the database.
 * 
 * @return \Something
 */
function getCategories()
{
    global $db;
    $query = 'SELECT * FROM category ORDER BY CategoryID';
    $stmt = $db->prepare($query);
    $stmt->execute();
    $categories = $stmt->fetchAll();
    $stmt->closeCursor();
    return $categories;
}


function getCategoryName($categoryId)
{
    if (!$categoryId) {
        return 'No Category ID specified.';
    }

    global $db;
    $query = 'SELECT * FROM category WHERE CategoryID = :categoryId';
    $stmt = $db->prepare($query);
    $stmt->bindValue(':categoryId', $categoryId);
    $stmt->execute();
    $category = $stmt->fetch();
    $stmt->closeCursor();
    $categoryName = $category['CategoryName'];
    return $categoryName;
}

function deleteCategory($categoryId)
{
    global $db;
    $query = 'DELETE FROM category WHERE CategoryID = :categoryId';
    $stmt = $db->prepare($query);
    $stmt->bindValue(':categoryId', $categoryId);
    $stmt->execute();
    $stmt->closeCursor();
}

function addCategory($categoryName)
{
    global $db;
    $query = 'INSERT INTO category (CategoryName) VALUES (:categoryName)';
    $stmt = $db->prepare($query);
    $stmt->bindValue(':categoryName', $categoryName);
    $stmt->execute();
    $stmt->closeCursor();
}
