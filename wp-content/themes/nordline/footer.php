<?php
$footer = nordline_field( 'подвал', array(
	'текст_под_логотипов' => "",
	'текст_снизу' => "",
), 4 );
?>

<footer class="footer">
	<div class="container">
		<div class="footer-grid">
			<div>
				<a class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>"><span class="logo-mark">N</span> NORDLINE</a>
				<p><?php echo $footer['текст_под_логотипов'] ?? ""; ?></p>
			</div>
			<div>
				<h4>Каталог</h4>
				<a href="<?php echo esc_url( nordline_page_url( 'katalog' ) ); ?>">Все снегоходы</a>
				<a href="<?php echo esc_url( nordline_type_url( 'mountain' ) ); ?>">Горные</a>
				<a href="<?php echo esc_url( nordline_type_url( 'utility' ) ); ?>">Утилитарные</a>
				<a href="<?php echo esc_url( nordline_page_url( 'sravnenie' ) ); ?>">Сравнение</a>
				<a href="<?php echo esc_url( nordline_page_url( 'podbor' ) ); ?>">Подбор</a>
			</div>
			<div>
				<h4>Владельцу</h4>
				<a href="<?php echo esc_url( nordline_page_url( 'servis' ) ); ?>">Сервис</a>
				<a href="<?php echo esc_url( nordline_page_url( 'garantiya' ) ); ?>">Гарантия</a>
				<a href="<?php echo esc_url( nordline_page_url( 'zapchasti' ) ); ?>">Запчасти</a>
				<a href="<?php echo esc_url( nordline_page_url( 'aksessuary' ) ); ?>">Аксессуары</a>
				<a href="<?php echo esc_url( nordline_page_url( 'test-drayv' ) ); ?>">Тест-драйв</a>
				<a href="<?php echo esc_url( nordline_page_url( 'vladeltsu' ) ); ?>">Полезное</a>
			</div>
			<div>
				<h4>Компания</h4>
				<a href="<?php echo esc_url( nordline_page_url( 'o-kompanii' ) ); ?>">О нас</a>
				<a href="<?php echo esc_url( nordline_page_url( 'kontakty' ) ); ?>">Контакты</a>
				<a href="<?php echo esc_url( nordline_page_url( 'rassrochka' ) ); ?>">Рассрочка</a>
				<a href="<?php echo esc_url( nordline_page_url( 'treyd-in' ) ); ?>">Трейд-ин</a>
				<a href="<?php echo esc_url( nordline_page_url( 'novosti' ) ); ?>">Новости</a>
				<a href="<?php echo esc_url( nordline_page_url( 'yurlicam' ) ); ?>">Юрлицам</a>
				<a href="<?php echo esc_url( nordline_page_url( 'politika' ) ); ?>">Политика конфиденциальности</a>
				<a href="<?php echo esc_url( nordline_page_url( 'karta-sayta' ) ); ?>">Карта сайта</a>
			</div>
		</div>
		<div class="copy">
			<span>© <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php echo $footer['текст_снизу'] ?? ""; ?></span>
			<a class="footer-made" href="https://imnstandard.kz/" target="_blank" rel="noopener noreferrer">
				<span>Сделано в</span>
				<span class="footer-made-name">imn<span>standard</span></span>
			</a>
		</div>
	</div>
</footer>

<div class="modal" id="leadModal">
	<div class="modal-card">
		<button class="modal-close" type="button" id="leadClose">×</button>
		<p class="eyebrow">Заявка</p>
		<h3>Оставим предложение без оплаты онлайн</h3>
		<p class="muted">Менеджер подтвердит наличие, комплектацию и цену. Счёт и договор — после звонка.</p>
		<form class="form js-lead-form">
			<input name="name" type="text" placeholder="Имя" required>
			<input name="phone" type="tel" placeholder="Телефон" required>
			<select name="task">
				<option value="">Задача</option>
				<option>Купить снегоход</option>
				<option>Сервис / ТО</option>
				<option>Запчасти</option>
				<option>Рассрочка</option>
				<option>Трейд-ин</option>
				<option>Тест-драйв</option>
			</select>
			<textarea name="comment" placeholder="Модель или вопрос"></textarea>
			<button class="btn btn-primary" type="submit">Отправить заявку</button>
		</form>
	</div>
</div>
<div class="toast" id="toast">Заявка принята</div>
<?php wp_footer(); ?>
</body>
</html>
