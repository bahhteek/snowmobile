<?php
/**
 * Статический контент. Используется, пока в соответствующем типе записей нет публикаций
 * или конкретное поле SCF не заполнено.
 */

function nordline_demo_models_raw() {
	return array(
		array(
			'slug' => 'summit', 'brand' => 'Ski-Doo', 'brand_slug' => 'ski-doo', 'name' => 'Summit', 'year' => 2027,
			'type' => 'mountain', 'type_label' => 'Горный', 'price' => 2450000, 'price_label' => 'от 2 450 000 ₽',
			'stock' => 'in', 'stock_label' => 'В наличии', 'hit' => true, 'image' => 'hero-sled.png',
			'gallery' => array( 'hero-sled.png', 'hero.jpg', 'mountain.jpg' ),
			'engine' => '850 E-TEC / Turbo R', 'hp' => '165–180 л.с.', 'track' => 'PowderMax 165″',
			'payload' => 'для глубокого снега', 'seats' => '1',
			'desc' => 'Горный снегоход для глубокого снега: лёгкая база, длинная гусеница и моторы Rotax. Атака склона, чаши и техничный рельеф.',
			'configs' => array( 'Adrenaline', 'X', 'X Expert', 'Freeride package' ), 'use' => 'Горы, целина, фрирайд',
		),
		array(
			'slug' => 'mxz', 'brand' => 'Ski-Doo', 'brand_slug' => 'ski-doo', 'name' => 'MXZ', 'year' => 2027,
			'type' => 'trail', 'type_label' => 'Трасса', 'price' => 1980000, 'price_label' => 'от 1 980 000 ₽',
			'stock' => 'in', 'stock_label' => 'В наличии', 'hit' => false, 'image' => 'mountain.jpg',
			'gallery' => array( 'mountain.jpg', 'hero.jpg', 'hero-sled.png' ),
			'engine' => '600RR / 850 E-TEC', 'hp' => 'до 165 л.с.', 'track' => 'Ripsaw 129″',
			'payload' => 'трасса', 'seats' => '1',
			'desc' => 'Трассовый снегоход с гоночной подвеской и острым рулением. Для тех, кто едет быстро и точно по подготовленной колее.',
			'configs' => array( 'Sport', 'Adrenaline', 'X-RS 20th' ), 'use' => 'Трасса, слалом',
		),
		array(
			'slug' => 'expedition', 'brand' => 'Ski-Doo', 'brand_slug' => 'ski-doo', 'name' => 'Expedition', 'year' => 2027,
			'type' => 'crossover', 'type_label' => 'Кроссовер', 'price' => 2180000, 'price_label' => 'от 2 180 000 ₽',
			'stock' => 'soon', 'stock_label' => 'В пути', 'hit' => false, 'image' => 'product.jpg',
			'gallery' => array( 'product.jpg', 'touring.jpg', 'hero-sled.png' ),
			'engine' => '900 ACE Turbo R', 'hp' => '180 л.с.', 'track' => 'Cobra WT 600 мм',
			'payload' => 'до 125 кг LinQ', 'seats' => '1+1',
			'desc' => 'Универсальный кроссовер: утром трасса, днём целина. Багажная платформа LinQ, пассажирское место и запас хода.',
			'configs' => array( 'Sport', 'LE', 'SE', 'Xtreme' ), 'use' => 'Трасса + экспедиции',
		),
		array(
			'slug' => 'commander', 'brand' => 'Lynx', 'brand_slug' => 'lynx', 'name' => 'Commander RE', 'year' => 2026,
			'type' => 'crossover', 'type_label' => 'Кроссовер', 'price' => 2649000, 'price_label' => 'от 2 649 000 ₽',
			'stock' => 'in', 'stock_label' => 'В наличии · ПСМ', 'hit' => true, 'image' => 'trail.jpg',
			'gallery' => array( 'trail.jpg', 'product.jpg', 'hero-sled.png' ),
			'engine' => '900 ACE Turbo R', 'hp' => '180 л.с.', 'track' => 'PowderMax 44 мм',
			'payload' => 'широкая база', 'seats' => '1+1',
			'desc' => 'Европейский кроссовер: спортивная трасса и широкая гусеница для целины. Одна из самых универсальных машин линейки Lynx.',
			'configs' => array( 'Core', 'Limited', 'RE' ), 'use' => 'Трасса + целина',
		),
		array(
			'slug' => 'vector', 'brand' => 'Русская механика', 'brand_slug' => 'rm', 'name' => 'Vector 551i', 'year' => 2026,
			'type' => 'touring', 'type_label' => 'Туризм', 'price' => 890000, 'price_label' => 'от 890 000 ₽',
			'stock' => 'in', 'stock_label' => 'В наличии', 'hit' => false, 'image' => 'touring.jpg',
			'gallery' => array( 'touring.jpg', 'peaks.jpg', 'product.jpg' ),
			'engine' => '2T, 551 см³', 'hp' => '67 л.с.', 'track' => '500 мм',
			'payload' => 'туристический багаж', 'seats' => '1+1',
			'desc' => 'Туристический снегоход на алюминиевой платформе: лесные маршруты, комфорт второго места и понятная цена относительно импорта.',
			'configs' => array( '551', '551i' ), 'use' => 'Лес, маршруты, 1+1',
		),
		array(
			'slug' => 'buran', 'brand' => 'Русская механика', 'brand_slug' => 'rm', 'name' => 'Буран Лидер', 'year' => 2026,
			'type' => 'utility', 'type_label' => 'Утилитарный', 'price' => 520000, 'price_label' => 'от 520 000 ₽',
			'stock' => 'in', 'stock_label' => 'В наличии', 'hit' => false, 'image' => 'utility.jpg',
			'gallery' => array( 'utility.jpg', 'peaks.jpg', 'parts.jpg' ),
			'engine' => '2T РМЗ', 'hp' => '34 л.с.', 'track' => '2 × 380 мм',
			'payload' => 'до 500 кг на сцепке', 'seats' => '1+1',
			'desc' => 'Классика хозяйства, охоты и рыбалки. Две гусеницы, простая конструкция, запчасти всегда под рукой.',
			'configs' => array( 'Лидер', 'АЕ', '4Т' ), 'use' => 'Охота, рыбалка, хозяйство',
		),
		array(
			'slug' => 'skandic', 'brand' => 'Ski-Doo', 'brand_slug' => 'ski-doo', 'name' => 'Skandic', 'year' => 2027,
			'type' => 'utility', 'type_label' => 'Утилитарный', 'price' => 1870000, 'price_label' => 'от 1 870 000 ₽',
			'stock' => 'order', 'stock_label' => 'Под заказ', 'hit' => false, 'image' => 'peaks.jpg',
			'gallery' => array( 'peaks.jpg', 'product.jpg', 'touring.jpg' ),
			'engine' => '600 EFI / 900 ACE', 'hp' => 'до 130 л.с.', 'track' => 'SWT 600 мм',
			'payload' => 'экспедиции и работа', 'seats' => '1+1',
			'desc' => 'Рабочая лошадка на REV Gen5: широкая гусеница, грузоподъёмность и ресурс для удалённых маршрутов.',
			'configs' => array( 'Sport', 'LE', 'SE', 'SWT' ), 'use' => 'Работа, экспедиции',
		),
		array(
			'slug' => 'dingo', 'brand' => 'Irbis', 'brand_slug' => 'irbis', 'name' => 'Dingo T200', 'year' => 2026,
			'type' => 'light', 'type_label' => 'Лёгкий', 'price' => 269900, 'price_label' => '269 900 ₽',
			'stock' => 'in', 'stock_label' => 'В наличии', 'hit' => false, 'image' => 'trail.jpg',
			'gallery' => array( 'trail.jpg', 'utility.jpg', 'touring.jpg' ),
			'engine' => '200 см³', 'hp' => '12 л.с.', 'track' => '380 мм',
			'payload' => 'лёгкий класс', 'seats' => '1',
			'desc' => 'Вход в класс: дачный участок, короткие выезды, обучение. Компактный, дешёвый в содержании.',
			'configs' => array( 'T200', 'Long' ), 'use' => 'Дача, обучение',
		),
	);
}

function nordline_demo_brands() {
	return array(
		'ski-doo' => array( 'name' => 'Ski-Doo', 'text' => 'Горные, трассовые, кроссоверные и утилитарные модели BRP. Креатив линейки и подбор по типу езды.' ),
		'lynx'    => array( 'name' => 'Lynx', 'text' => 'Европейские кроссоверы и утилитарки BRP. Commander, Brutal, Xterrain — широкая гусеница и трассовый характер.' ),
		'rm'      => array( 'name' => 'Русская механика', 'text' => 'Буран, Тайга, Vector, Frontier. Понятные цены, запчасти и сервис для охоты, рыбалки и хозяйства.' ),
		'irbis'   => array( 'name' => 'Irbis', 'text' => 'Лёгкие снегоходы для входа в класс и коротких зимних выездов.' ),
	);
}

function nordline_demo_types() {
	return array(
		'mountain'  => array( 'name' => 'Горные', 'label' => 'Deep snow', 'text' => 'Глубокий снег, склоны, лёгкая база и длинная гусеница.', 'image' => 'hero.jpg' ),
		'trail'     => array( 'name' => 'Трасса', 'label' => 'Trail', 'text' => 'Скорость, управляемость и гоночная подвеска.', 'image' => 'mountain.jpg' ),
		'touring'   => array( 'name' => 'Туризм', 'label' => 'Touring', 'text' => 'Комфорт 1+1, обогрев, багаж и дальние маршруты.', 'image' => 'touring.jpg' ),
		'utility'   => array( 'name' => 'Утилитарные', 'label' => 'Utility', 'text' => 'Хозяйство, охота, рыбалка, высокая грузоподъёмность.', 'image' => 'utility.jpg' ),
		'crossover' => array( 'name' => 'Кроссоверы', 'label' => 'Crossover', 'text' => 'Трасса утром, целина после обеда — одна машина.', 'image' => 'product.jpg' ),
		'light'     => array( 'name' => 'Лёгкие', 'label' => 'Light', 'text' => 'Вход в класс и короткие выезды.', 'image' => 'trail.jpg' ),
	);
}

function nordline_demo_parts() {
	return array(
		array( 'name' => 'Гусеница 500 мм', 'fit' => 'Vector / Тайга', 'price_label' => 'от 48 000 ₽' ),
		array( 'name' => 'Масло 2T Rotax', 'fit' => 'Ski-Doo / Lynx', 'price_label' => '2 400 ₽' ),
		array( 'name' => 'Свечи зажигания', 'fit' => 'большинство моделей', 'price_label' => 'от 890 ₽' ),
		array( 'name' => 'Кофр LinQ 40 л', 'fit' => 'Expedition / Commander', 'price_label' => 'от 36 000 ₽' ),
		array( 'name' => 'Подогрев ручек', 'fit' => 'RM / Irbis', 'price_label' => 'от 6 500 ₽' ),
		array( 'name' => 'Сани 500 кг', 'fit' => 'Буран / Skandic', 'price_label' => 'от 29 000 ₽' ),
	);
}

function nordline_demo_accessories() {
	return array(
		array( 'name' => 'Шлем с визором', 'price_label' => 'от 18 900 ₽', 'image' => 'trail.jpg' ),
		array( 'name' => 'Кофр и багажная платформа', 'price_label' => 'от 24 000 ₽', 'image' => 'product.jpg' ),
		array( 'name' => 'Экипировка 1+1', 'price_label' => 'от 32 000 ₽', 'image' => 'touring.jpg' ),
		array( 'name' => 'Подогрев и ручки', 'price_label' => 'от 6 500 ₽', 'image' => 'parts.jpg' ),
	);
}

function nordline_demo_news() {
	return array(
		array( 'slug' => 'lineup-2027', 'title' => 'Линейка Ski-Doo 2027 в салоне', 'date' => '12 сентября 2026', 'image' => 'hero-sled.png', 'lead' => 'Горные Summit и трассовые MXZ уже можно смотреть вживую и бронировать.' ),
		array( 'slug' => 'service-season', 'title' => 'Открыли запись на сезонное ТО', 'date' => '4 сентября 2026', 'image' => 'parts.jpg', 'lead' => 'Диагностика, хранение и подготовка к сезону. Слоты на октябрь ещё есть.' ),
		array( 'slug' => 'installment', 'title' => 'Рассрочка 0% до конца ноября', 'date' => '28 августа 2026', 'image' => 'product.jpg', 'lead' => 'На утилитарные RM и лёгкий класс. Решение по заявке в день обращения.' ),
	);
}
