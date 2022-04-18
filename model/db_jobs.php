<?php

function getJobsByCategory($categoryId)
{
    global $db;
    if ($categoryId) {
        $query = 'SELECT j.JobID, j.Description, c.CategoryName FROM job j 
            LEFT JOIN category c ON j.FKCategoryID = c.CategoryID 
            WHERE j.JobID = :categoryId 
            ORDER BY j.JobID';
        $stmt = $db->prepare($query);
        $stmt->bindValue(':categoryId', $categoryId);
        $stmt->execute();
        $jobs = $stmt->fetchAll();
        $stmt->closeCursor();
        return $jobs;
    } else {
        $query = 'SELECT j.JobID, j.Description, c.CategoryName FROM job j 
            LEFT JOIN category c ON j.FKCategoryID = c.CategoryID 
            ORDER BY c.categoryID';
        $stmt = $db->prepare($query);
        $stmt->execute();
        $jobs = $stmt->fetchAll();
        $stmt->closeCursor();
        return $jobs;
    }
}


function deleteJob($jobId)
{
    global $db;
    $query = 'DELETE FROM job WHERE job.JobID = :jobId';
    $stmt = $db->prepare($query);
    $stmt->bindValue(':jobId', $jobId);
    $stmt->execute();
    $stmt->closeCursor();
}

function addJob($categoryId, $description)
{
    global $db;
    $query = 'INSERT INTO job (Description, FKCategoryID) VALUES (:description, :categoryId)';
    $stmt = $db->prepare($query);
    $stmt->bindValue(':description', $description);
    $stmt->bindValue(':categoryId', $categoryId);
    $stmt->execute();
    $stmt->closeCursor();
}
