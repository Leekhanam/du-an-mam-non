let nodeList = document.querySelectorAll(".name-field");
const listField = [];
nodeList.forEach((element) => {
    listField.push(element.getAttribute("name"));
});
const rule = {
    number: true,
    digits: true,
    min: 0
};
listField.forEach(function (value) {
    rules[value] = rule;
});

const mess = {
    number: "Vui lòng nhập liệu hợp lệ",
    digits: "Vui lòng nhập số nguyên",
    min: "Số liệu nhỏ nhất là 0",
};
listField.forEach(function (value) {
    messages[value] = mess;
});
$("#validate-form-add").validate({
    rules: rules,
    messages: messages,
});