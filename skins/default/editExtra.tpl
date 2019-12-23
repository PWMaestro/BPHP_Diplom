<?php
    $thisPage = new PageEdit();
    $thisPage->loadTask($_POST['guid']);
?>

<form class="create_new" action="formActions/editTask.php" method="post">
    <input name="guid" value="<?= $thisPage->getGuid(); ?>" hidden>
    <div class="wrap_view">
        <?=$thisPage->loadContent()?>
    </div>

    <div class="control_bar">
        <div class="bar_module">
            <a class="btn" id="btn_close" href="index.php">Закрыть</a>
        </div>

        <div class="bar_module">
            <label for="deadline">Крайний срок:</label>
            <?=$thisPage->loadDeadline()?>
        </div>

        <div class="bar_module">
            <fieldset>
                <legend>Язык оригинала</legend>
                <?= $thisPage->loadLangOrig(); ?>
            </fieldset>

            <fieldset>
                <legend>Языки перевода</legend>
                <?= $thisPage->loadLangTarget(); ?>
            </fieldset>
        </div>

        <div class="bar_module">
            <?=$thisPage->loadButtonsMain()?>
            <?=$thisPage->loadButtonReject()?>
        </div>
    </div>
</form>