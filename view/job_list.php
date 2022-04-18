<?php include('view/header.php'); ?>

<section id="list" class="list">
    <header class="list__row list__head">
        <h1>Jobs</h1>
        <form action="." method="get" id="list__header_select" class="list__header_select">
            <input type="hidden" name="action" value="list_jobs">

            <select name="category_id" required>
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
</section>

<?php include('view/footer.php'); ?>