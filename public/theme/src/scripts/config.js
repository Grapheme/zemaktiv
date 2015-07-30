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
            return "Участок с домом";
        default:
            return "Без подряда";
    }
}