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
            <label for="executor">Ответственный:</label>
            <select class="input_field" id="executor" name="executor">
                <?= $thisPage->loadUsersList(); ?>
            </select>

            <label for="client">Клиент:</label>
            <input class="input_field" id="client" type="text" name="client" value="<?= $thisPage->loadClient(); ?>">

            <label for="deadline">Крайний срок:</label>
            <input class="input_field" id="deadline" type="date" name="deadline" value="<?= $thisPage->loadDeadline(); ?>">

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
            <button class="btn" id="btn_done" name="done">Готово</button>
            <button class="btn" id="btn_refactor" name="refactor">Доработать</button>
            <button class="btn" id="btn_save" name="save">Сохранить</button>
        </div>
    </div>
</form>