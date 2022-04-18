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
    case "list_categories":
        $categories = getCategories();
        include('view/category_list.php');
        break;
    case "add_category":
        addCategory($categoryName);
        header("Location: .?action=list_categories");
        break;
    case "add_job":
        if ($categoryId && $description) {
            addJob($categoryId, $description);
            header("Location: .?category_id=$categoryId");
        } else {
            $error = "Invalid job data.";
            include('view/error.php');
            exit();
        }
        break;
    case "delete_category":
        if ($categoryId) {
            try {
                deleteCategory($categoryId);
            } catch (PDOException $e) {
                $error = "Error deleting category. Ensure this category has no jobs attached to it.";
                include('view/error.php');
                exit();
            }
            header("Location: .?action=list_categories");
        }
        break;
    case "delete_job":
        if ($jobId) {
            deleteJob($jobId);
            header("Location: .?category_id=$categoryId");
        } else {
            $error = "None, or non existent job ID.";
            include('view/error.php');
        }
        break;
    default:
        $categoryName = getCategoryName($categoryId);
        $categories = getCategories();
        $jobs = getJobsByCategory($categoryId);
        include('view/job_list.php');
}
