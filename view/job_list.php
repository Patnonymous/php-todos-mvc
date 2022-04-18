<?php include('view/header.php'); ?>

<section id="list" class="list">
    <header class="list__row list__head">
        <h1>Jobs</h1>
        <form action="." method="get" id="list__header_select" class="list__header_select">
            <input type="hidden" name="action" value="list_jobs">

            <select name="categoryId" required>
                <option value="0">View All </option>
                <?php foreach ($categories as $category) : ?>
                    <?php if ($categoryId == $category['CategoryID']) { ?>
                        <option value="<?= $category['CategoryID'] ?>" selected>
                        <?php } else { ?>
                        <option value="<?= $category['CategoryID'] ?>">
                        <?php } ?>
                        <?= $category['CategoryName'] ?>
                        </option>
                    <?php endforeach; ?>
            </select>
            <button class="add-button bold">View</button>
        </form>
    </header>

    <?php if ($jobs) { ?>
        <?php foreach ($jobs as $job) : ?>
            <div class="list__row">
                <div class="list__item">
                    <p class="bold"><?= $job['CategoryName'] ?></p>
                    <p><?= $job['Description'] ?></p>
                </div>
                <div class="list__remove_item">
                    <form action="." method="post">
                        <input type="hidden" name="action" value="delete_job">
                        <input type="hidden" name="jobId" value="<?= $job['JobID'] ?>">
                        <button class="remove-button">Del</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    <?php } else { ?>
        <br>

        <?php if ($categoryId) { ?>
            <p>No Jobs in this category.</p>
        <?php } else { ?>
            <p>No Jobs.</p>
        <?php } ?>

        <br>
    <?php } ?>
</section>


<section id="add" class="add">
    <h2>Add Job</h2>
    <form action="." method="post" id="add__form" class="add__form">
        <input type="hidden" name="action" value="add_job">
        <div class="add__inputs">
            <label>Category: </label>
            <select name="categoryId" required>
                <option value="">Select Category</option>
                <?php foreach ($categories as $category) : ?>
                    <option value="<?= $category['CategoryID']; ?>">
                        <?= $category['CategoryName']; ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label>Description:</label>
            <input type="text" name="description" maxlength="120" placeholder="Description/Job Name" required>
        </div>

        <div class="add__addItem">
            <button class="add-button bold">Add</button>
        </div>
    </form>
</section>

<br>
<p><a href=".?action=list_categories">View or Edit Categories</a></p>

<?php include('view/footer.php'); ?>