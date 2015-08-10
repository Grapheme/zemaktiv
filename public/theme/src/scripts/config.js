jQuery.extend(jQuery.validator.messages, {
    required: "Это поле необходимо заполнить.",
    remote: "Пожалуйста, введите правильное значение.",
    email: "Пожалуйста, введите корретный адрес электронной почты.",
    url: "Пожалуйста, введите корректный URL.",
    date: "Пожалуйста, введите корректную дату.",
    dateISO: "Пожалуйста, введите корректную дату в формате ISO.",
    number: "Пожалуйста, введите число.",
    digits: "Пожалуйста, вводите только цифры.",
    creditcard: "Пожалуйста, введите правильный номер кредитной карты.",
    equalTo: "Пароли не совпадают",
    accept: "Пожалуйста, выберите файл с правильным расширением.",
    maxlength: jQuery.validator.format("Пожалуйста, введите не больше {0} символов."),
    minlength: jQuery.validator.format("Пожалуйста, введите не меньше {0} символов."),
    rangelength: jQuery.validator.format("Пожалуйста, введите значение длиной от {0} до {1} символов."),
    range: jQuery.validator.format("Пожалуйста, введите число от {0} до {1}."),
    max: jQuery.validator.format("Пожалуйста, введите число, меньшее или равное {0}."),
    min: jQuery.validator.format("Пожалуйста, введите число, большее или равное {0}."),
    extension: jQuery.validator.format("Вы можете загрузить изображение только со следующими расширениями: jpeg, jpg, png, gif.")
});

Number.prototype.formatMoney = function(c, d, t){
var n = this, 
    c = isNaN(c = Math.abs(c)) ? 2 : c, 
    d = d == undefined ? " " : d, 
    t = t == undefined ? " " : t, 
    s = n < 0 ? "-" : "", 
    i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", 
    j = (j = i.length) > 3 ? j % 3 : 0;
    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t);
};

function numToContract(num) {
    switch (num) {
        case 0:
            return "Без подряда";
        case 1:
            return "С подрядом";
        case 2:
            return "С готовым домом";
        default:
            return "Без подряда";
    }
}

function bookSubmitEvent() {
    (function (h)
    {function k() {
     var a = function (d,b) {
      if (this instanceof AdriverCounter) d = a.items.length || 1,
       a.items[d] = this, b.ph = d,
       b.custom && (b.custom = a.toQueryString(b.custom,";")),
       a.request(a.toQueryString(b));
      else return a.items[d]};
     a.httplize = function (a) {return (/^\/\//.test(a)?location.protocol:"")+a};
     a.loadScript = function (a) {
      try {
       var b = g.getElementsByTagName("head")[0],
       c = g.createElement("script");
       c.setAttribute("type", "text/javascript");
       c.setAttribute("charset", "windows-1251");
       c.setAttribute("src",a.split("![rnd]").join(Math.round(1E6*Math.random())));
       c.onreadystatechange = function () {
        /loaded|complete/.test(this.readyState)&&(c.onload=null,b.removeChild(c))};
       c.onload = function () {b.removeChild(c)};
       b.insertBefore(c,b.firstChild)} catch (f) {}};
     a.toQueryString = function (a,b,c) {
     b = b || "&";c = c || "=";var f = [],e;
      for (e in a) a.hasOwnProperty(e) && f.push(e+c+escape(a[e]));
      return f.join(b)};
     a.request = function (d) {var b = a.toQueryString(a.defaults);
     a.loadScript(a.redirectHost+"/cgi-bin/erle.cgi?"+d+"&rnd=![rnd]"+(b?"&"+b:""))};
     a.items = [];
     a.defaults = { tail256: document.referrer || "unknown" };
     a.redirectHost = a.httplize("//ad.adriver.ru");return a}
    var g = document;
    "undefined" === typeof AdriverCounter && (AdriverCounter = k());
    new AdriverCounter(0, h)})
    ({"sid":209020,"sz":"zajavka","bt":62,"custom":{"150":"lead_id","153":"user_id"}});
}

/*ymaps.modules.define('MultiRouteCustomView', [
    'util.defineClass'
], function (provide, defineClass) {
    // Класс простого текстового отображения модели мультимаршрута.
    function CustomView (multiRouteModel) {
        this.multiRouteModel = multiRouteModel;
        // Объявляем начальное состояние.
        this.state = "init";
        this.stateChangeEvent = null;
        // Элемент, в который будет выводиться текст.
        this.outputElement = $('<div></div>').appendTo('#viewContainer');

        this.rebuildOutput();

        // Подписываемся на события модели, чтобы
        // обновлять текстовое описание мультимаршрута.
        multiRouteModel.events
            .add(["requestsuccess", "requestfail", "requestsend"], this.onModelStateChange, this);
    }

    // Таблица соответствия идентификатора состояния имени его обработчика.
    CustomView.stateProcessors = {
        init: "processInit",
        requestsend: "processRequestSend",
        requestsuccess: "processSuccessRequest",
        requestfail: "processFailRequest"
    };

    // Таблица соответствия типа маршрута имени его обработчика.
    CustomView.routeProcessors = {
        "driving": "processDrivingRoute",
        "masstransit": "processMasstransitRoute"
    };

    defineClass(CustomView, {
        // Обработчик событий модели.
        onModelStateChange: function (e) {
            // Запоминаем состояние модели и перестраиваем текстовое описание.
            this.state = e.get("type");
            this.stateChangeEvent = e;
            this.rebuildOutput();
        },

        rebuildOutput: function () {
            // Берем из таблицы обработчик для текущего состояния и исполняем его.
            var processorName = CustomView.stateProcessors[this.state];
            this.outputElement.html(
                this[processorName](this.multiRouteModel, this.stateChangeEvent)
            );
        },

        processInit: function () {
            return "Инициализация ...";
        },

        processRequestSend: function () {
            return "Запрос данных ...";
        },

        processSuccessRequest: function (multiRouteModel, e) {
            var routes = multiRouteModel.getRoutes(),
                result = ["Данные успешно получены."];
            if (routes.length) {
                result.push("Всего маршрутов: " + routes.length + ".");
                for (var i = 0, l = routes.length; i < l; i++) {
                    result.push(this.processRoute(i, routes[i]));
                }
            } else {
                result.push("Нет маршрутов.");
            }
            return result.join("<br/>");
        },

        processFailRequest: function (multiRouteModel, e) {
            return e.get("error").message;
        },

        processRoute: function (index, route) {
            // Берем из таблицы обработчик для данного типа маршрута и применяем его.
            var processorName = CustomView.routeProcessors[route.properties.get("type")];
            return (index + 1) + ". " + this[processorName](route);
        },

        processDrivingRoute: function (route) {
            var result = ["Автомобильный маршрут."];
            result.push(this.createCommonRouteOutput(route));
            return result.join("<br/>");
        },

        processMasstransitRoute: function (route) {
            var result = ["Маршрут на общественном транспорте."];
            result.push(this.createCommonRouteOutput(route));
            result.push("Описание маршута: <ul>" + this.createMasstransitRouteOutput(route) + "</ul>");
            return result.join("<br/>");
        },

        // Метод формирующий общую часть описания для обоих типов маршрутов.
        createCommonRouteOutput: function (route) {
            return "Протяженность маршрута: " + route.properties.get("distance").text + "<br/>" +
                "Время в пути: " + route.properties.get("duration").text;
        },

        // Метод строящий список текстовых описаний для
        // всех сегментов маршрута на общественном транспорте.
        createMasstransitRouteOutput: function (route) {
            var result = [];
            for (var i = 0, l = route.getPaths().length; i < l; i++) {
                var path = route.getPaths()[i];
                for (var j = 0, k = path.getSegments().length; j < k; j++) {
                    result.push("<li>" + path.getSegments()[j].properties.get("text") + "</li>");
                }
            }
            return result.join("");
        },

        destroy: function () {
            this.outputElement.remove();
            this.multiRouteModel.events
                .remove(["requestsuccess", "requestfail", "requestsend"], this.onModelStateChange, this);
        }
    });

    provide(CustomView);
});*/
