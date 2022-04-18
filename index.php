<?php
require('model/database.php');
require('model/db_jobs.php');
require('model/db_categories.php');

$jobId = filter_input(INPUT_POST, 'jobId', FILTER_VALIDATE_INT);
$description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$categoryName = filter_input(INPUT_POST, 'categoryName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

$categoryId = filter_input(INPUT_POST, 'categoryId', FILTER_VALIDATE_INT);
if (!$categoryId) {
    $categoryId = filter_input(INPUT_GET, 'categoryId', FILTER_VALIDATE_INT);
}


$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if (!$action) {
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if (!$action) {
        $action = 'listJobs';
    }
}


switch ($action) {
    default:
        $categoryName = getCategoryName($categoryId);
        $categories = getCategories();
        $jobs = getJobsByCategory($categoryId);
        include('view/job_list.php');
}
