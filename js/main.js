(function () {
  var filters = document.getElementById("filters");
  var catalog = document.getElementById("catalog");
  var api = window.nordline;

  function renderCards(type) {
    if (!catalog || !api) return;
    var models = api.getModels().filter(function (model) {
      return type === "all" || !type || model.type === type;
    });
    catalog.innerHTML = models.map(api.cardHtml).join("");
  }

  if (catalog && api) renderCards("all");

  if (filters) {
    filters.addEventListener("click", function (event) {
      var chip = event.target.closest(".chip");
      if (!chip) return;
      var type = chip.getAttribute("data-filter");
      document.querySelectorAll(".chip").forEach(function (item) {
        item.classList.toggle("active", item === chip);
      });
      renderCards(type);
    });
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

  function recommend() {
    var terrain = answers[0] || "";
    var rider = answers[1] || "";
    var map = {
      "Горы и глубокий снег": "Ski-Doo Summit",
      "Трасса": "Ski-Doo MXZ",
      "Лес и туризм": "RM Vector 551i",
      "Охота, рыбалка, хозяйство": "RM Буран Лидер"
    };
    var extra = (rider.indexOf("лёгкая") >= 0) ? " и Irbis Dingo T200" : "";
    if (terrain.indexOf("Горы") >= 0 && rider.indexOf("1+1") >= 0) {
      return "Lynx Commander RE — кроссовер, который тянет и целину, и дальнюю поездку.";
    }
    return (map[terrain] || "Ski-Doo Expedition") + extra + ". Оставьте заявку — соберём комплектацию и наличие.";
  }

  if (quizBack && quizNext) {
    quizBack.addEventListener("click", function () {
      if (step > 0) {
        step -= 1;
        renderQuiz();
      }
    });
    quizNext.addEventListener("click", function () {
      if (!answers[step]) {
        if (api) api.toast("Выберите вариант");
        return;
      }
      if (step < quizData.length - 1) {
        step += 1;
        renderQuiz();
        return;
      }
      quizStep.style.display = "none";
      quizResult.classList.add("show");
      quizResult.innerHTML = "<h3>Вам подойдёт</h3><p>" + recommend() + '</p><a class="btn btn-primary js-lead" href="#" style="margin-top:18px">Оставить заявку</a>';
      var filterMap = {
        "Горы и глубокий снег": "mountain",
        "Трасса": "trail",
        "Лес и туризм": "touring",
        "Охота, рыбалка, хозяйство": "utility"
      };
      var type = filterMap[answers[0] || ""] || "all";
      document.querySelectorAll(".chip").forEach(function (chip) {
        chip.classList.toggle("active", chip.getAttribute("data-filter") === type);
      });
      renderCards(type);
    });
    renderQuiz();
  }

  var leadForm = document.getElementById("leadForm");
  if (leadForm) {
    leadForm.addEventListener("submit", function (event) {
      event.preventDefault();
      leadForm.reset();
      if (api) api.toast("Заявка принята. Онлайн-оплаты нет — перезвоним.");
    });
  }
})();
