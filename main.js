// 1. Анимация для заголовка
// 2. Событие для функции отправки
//   а) Взять значение input'а
//   б) если input не пуст то добавить его в li, а li  c соответствующими классами и значением в ul
//   в) Вывести alert если путой input


$(function(){
  $("h1").animate({
    "margin-left": "600px"
  }, "slow");

  $("#btn").click(function() {
    var newTask = $("#input").val();

    if(newTask !== '') {

    var count = $("#my_ul").children().length;

    $("#my_ul").append('<li class="list-group-item deletetask bg-success">' + count + '.' + newTask + '</li>');
    deleteTask();
  }else {
    alert("Write something in field");
  }

});
});

function deleteTask() {
  $('.deletetask').click(function(){
    $(this).remove();
  });
}
