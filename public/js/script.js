// $(document).ready(function(){
//     $(".search").submit(function(e) { //устанавливаем событие отправки для формы с id=form
//         e.preventDefault();
//             let form_data = $(this).serialize(); //собераем все данные из формы
//             console.log(form_data);
//             $.ajax({
//             type: "post", //Метод отправки
//             url: "profile/", //путь до php фаила отправителя
//             data: form_data,
//             success: function(response) {
//                    //код в этом блоке выполняется при успешной отправке сообщения
//                 //    result = JSON.stringify(response);
//                    console.log(response);
//             }
//             });
//     });

// });


