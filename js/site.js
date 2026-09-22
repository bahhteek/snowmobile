(function () {
  var page = document.body.getAttribute("data-page") || "";

  function navClass(id) {
    return page === id ? ' class="active"' : "";
  }

  var headerMount = document.getElementById("site-header");
  if (headerMount) {
    headerMount.innerHTML =
      '<div class="ticker"><div class="ticker-track">' +
      "<span>Официальный ввоз</span><span>В наличии с ПСМ</span><span>Гарантия 12 месяцев</span><span>Еженедельные поставки</span><span>Рассрочка и трейд-ин</span><span>Сервис и оригинальные запчасти</span>" +
      "<span>Официальный ввоз</span><span>В наличии с ПСМ</span><span>Гарантия 12 месяцев</span><span>Еженедельные поставки</span><span>Рассрочка и трейд-ин</span><span>Сервис и оригинальные запчасти</span>" +
      '</div></div>' +
      '<header class="header" id="header"><div class="container">' +
      '<a class="logo" href="index.html"><span class="logo-mark">N</span> NORDLINE</a>' +
      '<nav class="nav">' +
      "<a href=\"catalog.html\"" + navClass("catalog") + ">Каталог</a>" +
      "<a href=\"quiz.html\"" + navClass("quiz") + ">Подбор</a>" +
      "<a href=\"compare.html\"" + navClass("compare") + ">Сравнение</a>" +
      "<a href=\"service.html\"" + navClass("service") + ">Сервис</a>" +
      "<a href=\"contacts.html\"" + navClass("contacts") + ">Контакты</a>" +
      "</nav>" +
      '<div class="header-actions">' +
      '<a class="phone" href="tel:+78005550127">+7 800 555-01-27</a>' +
      '<button class="btn btn-primary js-lead" type="button">Получить предложение</button>' +
      '<button class="burger" id="burger" aria-label="Меню"><span></span></button>' +
      "</div></div></header>" +
      '<nav class="mobile-nav" id="mobileNav">' +
      '<a href="catalog.html">Каталог</a><a href="quiz.html">Подбор</a><a href="compare.html">Сравнение</a>' +
      '<a href="service.html">Сервис</a><a href="parts.html">Запчасти</a><a href="contacts.html">Контакты</a>' +
      '<a href="tel:+78005550127">+7 800 555-01-27</a>' +
      "</nav>";
  }

  var footerMount = document.getElementById("site-footer");
  if (footerMount) {
    footerMount.innerHTML =
      '<footer class="footer"><div class="container"><div class="footer-grid">' +
      '<div><a class="logo" href="index.html"><span class="logo-mark">N</span> NORDLINE</a>' +
      "<p>Мультибрендовый дилерский центр: Ski-Doo, Lynx, Русская механика. Подбор, наличие с ПСМ, гарантия и сервис.</p></div>" +
      '<div><h4>Каталог</h4>' +
      '<a href="catalog.html">Все снегоходы</a><a href="catalog.html?type=mountain">Горные</a>' +
      '<a href="catalog.html?type=utility">Утилитарные</a><a href="compare.html">Сравнение</a><a href="quiz.html">Подбор</a></div>' +
      '<div><h4>Владельцу</h4>' +
      '<a href="service.html">Сервис</a><a href="warranty.html">Гарантия</a><a href="parts.html">Запчасти</a>' +
      '<a href="accessories.html">Аксессуары</a><a href="testdrive.html">Тест-драйв</a><a href="owner.html">Полезное</a></div>' +
      '<div><h4>Компания</h4>' +
      '<a href="about.html">О нас</a><a href="contacts.html">Контакты</a><a href="finance.html">Рассрочка</a>' +
      '<a href="trade-in.html">Трейд-ин</a><a href="news.html">Новости</a><a href="corporate.html">Юрлицам</a></div>' +
      '</div><div class="copy"><span>© 2026 NORDLINE. Официальные поставки, гарантия 12 месяцев.</span>' +
      '<a href="privacy.html">Политика конфиденциальности</a><a href="sitemap.html">Карта сайта</a></div></div></footer>' +
      '<div class="modal" id="leadModal"><div class="modal-card">' +
      '<button class="modal-close" type="button" id="leadClose">×</button>' +
      '<p class="eyebrow">Заявка</p><h3>Оставим предложение без оплаты онлайн</h3>' +
      '<p class="muted">Менеджер подтвердит наличие, комплектацию и цену. Счёт и договор — после звонка.</p>' +
      '<form class="form" id="globalLead">' +
      '<input name="name" type="text" placeholder="Имя" required>' +
      '<input name="phone" type="tel" placeholder="Телефон" required>' +
      '<select name="task"><option value="">Задача</option><option>Купить снегоход</option><option>Сервис / ТО</option><option>Запчасти</option><option>Рассрочка</option><option>Трейд-ин</option><option>Тест-драйв</option></select>' +
      '<textarea name="comment" placeholder="Модель или вопрос"></textarea>' +
      '<button class="btn btn-primary" type="submit">Отправить заявку</button>' +
      "</form></div></div>" +
      '<div class="toast" id="toast">Заявка принята</div>';
  }

  var header = document.getElementById("header");
  var burger = document.getElementById("burger");
  var mobileNav = document.getElementById("mobileNav");
  var toast = document.getElementById("toast");
  var modal = document.getElementById("leadModal");

  if (header) {
    window.addEventListener("scroll", function () {
      header.classList.toggle("scrolled", window.scrollY > 8);
    });
  }
  if (burger && mobileNav) {
    burger.addEventListener("click", function () {
      mobileNav.classList.toggle("open");
    });
    mobileNav.addEventListener("click", function (event) {
      if (event.target.tagName === "A") mobileNav.classList.remove("open");
    });
  }

  function showToast(text) {
    if (!toast) return;
    toast.textContent = text;
    toast.classList.add("show");
    setTimeout(function () {
      toast.classList.remove("show");
    }, 2400);
  }

  function openLead(comment) {
    if (!modal) return;
    var area = modal.querySelector("textarea");
    if (area && comment) area.value = comment;
    modal.classList.add("open");
  }

  document.addEventListener("click", function (event) {
    var leadBtn = event.target.closest(".js-lead");
    if (leadBtn) {
      event.preventDefault();
      openLead(leadBtn.getAttribute("data-model") || "");
    }
    if (event.target.id === "leadClose" || event.target === modal) {
      modal.classList.remove("open");
    }
  });

  var globalLead = document.getElementById("globalLead");
  if (globalLead) {
    globalLead.addEventListener("submit", function (event) {
      event.preventDefault();
      globalLead.reset();
      modal.classList.remove("open");
      showToast("Заявка принята. Онлайн-оплаты нет — перезвоним.");
    });
  }

  function qs(name) {
    var params = new URLSearchParams(window.location.search);
    return params.get(name);
  }

  function getModels() {
    return (window.NORDLINE_DATA && window.NORDLINE_DATA.models) || [];
  }

  function getModel(id) {
    return getModels().filter(function (item) { return item.id === id; })[0];
  }

  function compareList() {
    try {
      return JSON.parse(localStorage.getItem("nordline-compare") || "[]");
    } catch (e) {
      return [];
    }
  }

  function saveCompare(list) {
    localStorage.setItem("nordline-compare", JSON.stringify(list));
  }

  function toggleCompare(id) {
    var list = compareList();
    var index = list.indexOf(id);
    if (index >= 0) list.splice(index, 1);
    else {
      if (list.length >= 3) {
        showToast("Можно сравнить не больше трёх моделей");
        return list;
      }
      list.push(id);
    }
    saveCompare(list);
    return list;
  }

  function cardHtml(model) {
    return (
      '<article class="card" data-type="' + model.type + '" data-id="' + model.id + '">' +
      '<a class="card-media" href="model.html?id=' + model.id + '">' +
      '<img src="' + model.image + '" alt="' + model.brand + " " + model.name + '">' +
      '<div class="badges">' +
      (model.hit ? '<span class="badge hit">Хит</span>' : "") +
      '<span class="badge ' + (model.stock === "in" ? "in" : "soon") + '">' + model.stockLabel + "</span>" +
      "</div></a>" +
      '<div class="card-body"><div class="card-top"><div>' +
      '<div class="brand">' + model.brand + " · " + model.year + "</div>" +
      "<h3>" + model.name + "</h3></div>" +
      '<div class="price">' + model.priceLabel + "<small>" + model.typeLabel + "</small></div></div>" +
      '<dl class="specs"><div><dt>Двигатель</dt><dd>' + model.engine + "</dd></div>" +
      "<div><dt>Мощность</dt><dd>" + model.hp + "</dd></div>" +
      "<div><dt>Гусеница</dt><dd>" + model.track + "</dd></div>" +
      "<div><dt>Сценарий</dt><dd>" + model.use + "</dd></div></dl>" +
      '<div class="card-actions">' +
      '<a class="btn btn-primary" href="model.html?id=' + model.id + '">Подробнее</a>' +
      '<button class="btn btn-ghost js-lead" type="button" data-model="' + model.brand + " " + model.name + '">Заявка</button>' +
      "</div></div></article>"
    );
  }

  window.nordline = {
    page: page,
    qs: qs,
    toast: showToast,
    openLead: openLead,
    getModels: getModels,
    getModel: getModel,
    compareList: compareList,
    toggleCompare: toggleCompare,
    cardHtml: cardHtml
  };
})();
