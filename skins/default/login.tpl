<header>
	<h1>Информационная система «Бюро переводов»</h1>
</header>

<div class="container_form">
	<h2 class="form_header">Авторизация</h2>
	<?='<h2 class="wrong_input">' . Authentication::init()->loginFail . '</h2>'?>
	<form class="form" method="post">
		<div class="form_element">
			<label for="login" hidden>Логин</label>
			<input class="form_active_elem" type="text" id="login" name="login" placeholder="Логин" autocomplete required>
		</div>
		<div class="form_element">
			<label for="password" hidden>Пароль</label>
			<input class="form_active_elem" type="password" id="password" name="password" placeholder="Пароль" autocomplete="current-password" required>
		</div>
		<div class="form_element">
			<button class="form_active_elem" type="submit" name="submit">Войти</button>
		</div>
	</form>
</div>

<footer class="copyright">
	<p>© Ситько Артём, BPHP-3, 2019</p>
</footer>
