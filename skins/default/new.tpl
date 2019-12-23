<?php
    $thisPage = new PageNew();
?>

<form class="create_new" action="formActions/createTask.php" method="post">
    <div class="wrap_view">
        <label for="original_text"></label>
        <textarea id="original_text" name="original_text">Введите текст...</textarea>
    </div>

    <div class="control_bar">
        <div class="bar_module">
            <a class="btn" id="btn_close" href="index.php">Закрыть</a>
        </div>

        <div class="bar_module">
            <label for="executor">Ответственный:</label>
            <select class="input_field" id="executor" name="executor">
                <option value="none" selected>Не назначать</option>
                <?= $thisPage->loadUsersList(); ?>
            </select>

            <label for="client">Клиент:</label>
            <input class="input_field" id="client" type="text" name="client" value="Клиент">

            <label for="deadline">Крайний срок:</label>
            <input class="input_field" id="deadline" type="date" name="deadline" value="">

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
            <button class="btn" id="btn_save" name="save">Сохранить</button>
        </div>
    </div>
</form>