(function () {
  var cfg = window.nordlineTheme || {};
  var header = document.getElementById("header");
  var burger = document.getElementById("burger");
  var mobileNav = document.getElementById("mobileNav");
  var toast = document.getElementById("toast");
  var modal = document.getElementById("leadModal");

  function showToast(text) {
    if (!toast) return;
    toast.textContent = text;
    toast.classList.add("show");
    setTimeout(function () { toast.classList.remove("show"); }, 2400);
  }

  if (header) {
    window.addEventListener("scroll", function () {
      header.classList.toggle("scrolled", window.scrollY > 8);
    });
  }
  if (burger && mobileNav) {
    burger.addEventListener("click", function () { mobileNav.classList.toggle("open"); });
    mobileNav.addEventListener("click", function (event) {
      if (event.target.tagName === "A") mobileNav.classList.remove("open");
    });
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
    if (event.target.id === "leadClose" || event.target === modal) modal.classList.remove("open");
  });

  function sendLead(form) {
    var data = new FormData(form);
    data.append("action", "nordline_lead");
    data.append("nonce", cfg.nonce || "");
    return fetch(cfg.ajaxUrl, { method: "POST", body: data, credentials: "same-origin" })
      .then(function (response) { return response.json(); });
  }

  document.querySelectorAll(".js-lead-form").forEach(function (form) {
    form.addEventListener("submit", function (event) {
      event.preventDefault();
      sendLead(form).then(function (payload) {
        if (payload && payload.success) {
          form.reset();
          if (modal) modal.classList.remove("open");
          showToast(payload.data.message);
        } else {
          showToast((payload && payload.data && payload.data.message) || "Не удалось отправить заявку");
        }
      }).catch(function () {
        showToast("Не удалось отправить заявку");
      });
    });
  });

  var categoryFilters = document.getElementById("categoryFilters");
  var catalog = document.getElementById("catalog");
  var currentCategory = "all";
  var currentSub = "all";

  function subcategoryRows() {
    return document.querySelectorAll(".subcategory-filters");
  }

  function updateCatalogEmpty() {
    var empty = document.getElementById("catalogEmpty");
    if (!empty || !catalog) return;
    empty.classList.toggle("is-visible", catalog.querySelectorAll(".card:not(.hidden)").length === 0);
  }

  function applyLineupFilter() {
    if (!catalog) return;
    catalog.querySelectorAll(".card").forEach(function (card) {
      var cardCategory = card.getAttribute("data-category") || "";
      var cardParent = card.getAttribute("data-category-parent") || "";
      var categoryOk = currentCategory === "all" || cardCategory === currentCategory || cardParent === currentCategory;
      var subOk = currentSub === "all" || cardCategory === currentSub;
      card.classList.toggle("hidden", !(categoryOk && subOk));
    });
    subcategoryRows().forEach(function (row) {
      row.hidden = row.getAttribute("data-parent") !== currentCategory;
    });
    updateCatalogEmpty();
  }

  if (categoryFilters) {
    categoryFilters.addEventListener("click", function (event) {
      var chip = event.target.closest(".chip");
      if (!chip || !chip.hasAttribute("data-category")) return;
      currentCategory = chip.getAttribute("data-category");
      currentSub = "all";
      categoryFilters.querySelectorAll(".chip").forEach(function (item) {
        item.classList.toggle("active", item === chip);
      });
      subcategoryRows().forEach(function (row) {
        row.querySelectorAll(".chip").forEach(function (item) {
          item.classList.toggle("active", item.getAttribute("data-sub") === "all");
        });
      });
      applyLineupFilter();
    });
  }

  document.addEventListener("click", function (event) {
    var row = event.target.closest(".subcategory-filters");
    if (!row) return;
    var chip = event.target.closest(".chip");
    if (!chip || !chip.hasAttribute("data-sub")) return;
    currentSub = chip.getAttribute("data-sub");
    row.querySelectorAll(".chip").forEach(function (item) {
      item.classList.toggle("active", item === chip);
    });
    applyLineupFilter();
  });

  if (catalog && categoryFilters) {
    applyLineupFilter();
  }

  var quizData = [
    { title: "Где будете ездить?", options: ["Горы и глубокий снег", "Трасса", "Лес и туризм", "Охота, рыбалка, хозяйство"] },
    { title: "Кто едет?", options: ["Только я", "1+1", "Нужен багаж и сани", "Пока учусь / лёгкая техника"] },
    { title: "Какой бюджет?", options: ["До 600 000 ₽", "600 000 – 1 500 000 ₽", "1.5 – 2.5 млн ₽", "Без верхней границы"] }
  ];
  var answers = [];
  var step = 0;
  var quizTitle = document.getElementById("quizTitle");
  var quizOptions = document.getElementById("quizOptions");
  var quizProgress = document.getElementById("quizProgress");
  var quizResult = document.getElementById("quizResult");
  var quizStep = document.getElementById("quizStep");
  var quizBack = document.getElementById("quizBack");
  var quizNext = document.getElementById("quizNext");

  function renderQuiz() {
    if (!quizTitle) return;
    var current = quizData[step];
    quizTitle.textContent = current.title;
    quizOptions.innerHTML = "";
    current.options.forEach(function (option) {
      var button = document.createElement("button");
      button.type = "button";
      button.className = "option" + (answers[step] === option ? " selected" : "");
      button.textContent = option;
      button.addEventListener("click", function () {
        answers[step] = option;
        renderQuiz();
      });
      quizOptions.appendChild(button);
    });
    Array.prototype.forEach.call(quizProgress.children, function (bar, index) {
      bar.classList.toggle("on", index <= step);
    });
    quizBack.style.visibility = step === 0 ? "hidden" : "visible";
    quizNext.textContent = step === quizData.length - 1 ? "Показать модели" : "Далее";
  }

  function quizModels() {
    return (window.nordlineQuiz && window.nordlineQuiz.models) || [];
  }

  function typeMatches(model, answer) {
    var label = (model.typeLabel || "").toLowerCase();
    var text = answer || "";
    if (text.indexOf("Гор") >= 0) return label.indexOf("гор") >= 0;
    if (text.indexOf("Трасс") >= 0) return label.indexOf("трасс") >= 0;
    if (text.indexOf("Лес") >= 0 || text.indexOf("туризм") >= 0) return label.indexOf("туризм") >= 0;
    if (text.indexOf("Охот") >= 0 || text.indexOf("хозяй") >= 0) return label.indexOf("утилит") >= 0;
    return true;
  }

  function riderMatches(model, answer) {
    var blob = ((model.use || "") + " " + (model.seats || "") + " " + (model.typeLabel || "")).toLowerCase();
    var text = answer || "";
    if (text.indexOf("1+1") >= 0) return blob.indexOf("1+1") >= 0;
    if (text.indexOf("багаж") >= 0 || text.indexOf("сани") >= 0) return /багаж|сан|груз/.test(blob);
    if (text.indexOf("лёгк") >= 0 || text.indexOf("легк") >= 0) return /лёгк|легк/.test(blob) || (model.price > 0 && model.price <= 600000);
    return true;
  }

  function budgetMatches(model, answer) {
    var text = answer || "";
    if (!model.price || text.indexOf("Без") >= 0) return true;
    if (text.indexOf("До 600") >= 0) return model.price <= 600000;
    if (text.indexOf("600") >= 0) return model.price >= 600000 && model.price <= 1500000;
    if (text.indexOf("1.5") >= 0 || text.indexOf("1,5") >= 0) return model.price >= 1500000 && model.price <= 2500000;
    return true;
  }

  function quizDiffs(model, picked) {
    var diffs = [];
    if (!typeMatches(model, picked[0])) {
      diffs.push("Подкатегория: вы выбрали «" + picked[0] + "», у модели — " + (model.typeLabel || "не указана") + ".");
    }
    if (!riderMatches(model, picked[1])) {
      diffs.push("Кто едет: «" + picked[1] + "»" + (model.use ? " не совпадает со сценарием «" + model.use + "»." : " не совпадает с характеристиками модели."));
    }
    if (!budgetMatches(model, picked[2])) {
      diffs.push("Бюджет: «" + picked[2] + "», цена модели — " + (model.priceLabel || "не указана") + ".");
    }
    return diffs;
  }

  function escapeHtml(value) {
    return String(value || "").replace(/[&<>"']/g, function (char) {
      return { "&": "&amp;", "<": "&lt;", ">": "&gt;", '"': "&quot;", "'": "&#39;" }[char];
    });
  }

  function recommend() {
    var list = quizModels();
    if (!list.length) {
      return { html: "<p>В каталоге пока нет снегоходов для подбора.</p>", type: "" };
    }
    var ranked = list.map(function (model) {
      var diffs = quizDiffs(model, answers);
      return { model: model, diffs: diffs };
    }).sort(function (a, b) {
      return a.diffs.length - b.diffs.length;
    });
    var best = ranked[0].diffs.length;
    var picks = ranked.filter(function (item) { return item.diffs.length === best; });
    var perfect = best === 0;
    var html = "<h3>" + (perfect ? "Вам подойдёт" : "Полного совпадения нет") + "</h3>";
    if (perfect) {
      html += picks.map(function (item) {
        var model = item.model;
        return "<p><a href=\"" + escapeHtml(model.url) + "\">" + escapeHtml(model.name) + "</a>" +
          (model.priceLabel ? " — " + escapeHtml(model.priceLabel) : "") +
          (model.typeLabel ? ", " + escapeHtml(model.typeLabel) : "") + ".</p>";
      }).join("");
    } else {
      html += "<p>Ближе всего " + escapeHtml(picks[0].model.name) + ". Отличия:</p><ul>" +
        picks[0].diffs.map(function (line) { return "<li>" + escapeHtml(line) + "</li>"; }).join("") +
        "</ul>";
    }
    html += '<button class="btn btn-primary js-lead" type="button" style="margin-top:18px">Оставить заявку</button>';
    return { html: html, type: perfect ? picks[0].model.type : "" };
  }

  if (quizBack && quizNext) {
    quizBack.addEventListener("click", function () {
      if (step > 0) { step -= 1; renderQuiz(); }
    });
    quizNext.addEventListener("click", function () {
      if (!answers[step]) { showToast("Выберите вариант"); return; }
      if (step < quizData.length - 1) { step += 1; renderQuiz(); return; }
      quizStep.style.display = "none";
      var result = recommend();
      quizResult.classList.add("show");
      quizResult.innerHTML = result.html;
      var type = result.type || "";
      if (catalog && type) {
        catalog.querySelectorAll(".card").forEach(function (card) {
          card.classList.toggle("hidden", card.getAttribute("data-type") !== type);
        });
        updateCatalogEmpty();
      }
    });
    renderQuiz();
  }

  var pick = document.getElementById("comparePick");
  var tableWrap = document.getElementById("compareTable");
  if (pick && tableWrap && window.nordlineCompare) {
    var selected = window.nordlineCompare.selected.slice();
    function renderCompare() {
      pick.querySelectorAll(".chip").forEach(function (chip) {
        chip.classList.toggle("active", selected.indexOf(chip.getAttribute("data-slug")) >= 0);
      });
      var models = window.nordlineCompare.models.filter(function (model) {
        return selected.indexOf(model.slug) >= 0;
      });
      var heads = models.map(function (model) { return "<th>" + model.brand + " " + model.name + "</th>"; }).join("");
      function row(label, key) {
        return "<tr><td>" + label + "</td>" + models.map(function (model) { return "<td>" + (model[key] || "—") + "</td>"; }).join("") + "</tr>";
      }
      tableWrap.innerHTML = '<table class="compare-table"><thead><tr><th>Параметр</th>' + heads + "</tr></thead><tbody>" +
        row("Подкатегория", "type_label") + row("Цена", "price_label") + row("Наличие", "stock_label") +
        row("Двигатель", "engine") + row("Мощность", "hp") + row("Гусеница", "track") +
        row("Посадка", "seats") + row("Сценарий", "use") + "</tbody></table>";
    }
    pick.addEventListener("click", function (event) {
      var chip = event.target.closest(".chip");
      if (!chip) return;
      var slug = chip.getAttribute("data-slug");
      var index = selected.indexOf(slug);
      if (index >= 0) selected.splice(index, 1);
      else if (selected.length < 3) selected.push(slug);
      else { showToast("Можно сравнить не больше трёх моделей"); return; }
      renderCompare();
    });
    renderCompare();
  }

  var thumbs = document.getElementById("thumbs");
  if (thumbs) {
    thumbs.addEventListener("click", function (event) {
      var btn = event.target.closest("button");
      if (!btn) return;
      document.getElementById("mainPhoto").src = btn.getAttribute("data-src");
      thumbs.querySelectorAll("button").forEach(function (el) { el.classList.toggle("active", el === btn); });
    });
  }
  document.querySelectorAll("[data-tab]").forEach(function (chip) {
    chip.addEventListener("click", function () {
      document.querySelectorAll("[data-tab]").forEach(function (el) { el.classList.remove("active"); });
      chip.classList.add("active");
      document.querySelectorAll(".tab-panel").forEach(function (panel) { panel.classList.remove("show"); });
      document.getElementById(chip.getAttribute("data-tab")).classList.add("show");
    });
  });

  var sum = document.getElementById("sum");
  var months = document.getElementById("months");
  var pay = document.getElementById("pay");
  function calc() {
    if (!sum || !months || !pay) return;
    var value = Number(sum.value || 0);
    var term = Number(months.value || 1);
    pay.textContent = Math.round(value / term).toLocaleString("ru-RU");
  }
  if (sum && months) {
    sum.addEventListener("input", calc);
    months.addEventListener("change", calc);
    calc();
  }
})();
