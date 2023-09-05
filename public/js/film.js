$(document).ready(function(){
    $(".time-drop").click(function(){
        $(".dates").toggle();
        document.querySelector('.time-arrow').classList.toggle("rotate");
    });
});


$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});

//

// $(document).ready(function (){
//     var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
//     $('.like').on('click', function(){
//         let film_id = Number($(this).attr('data-filmId'));
//         let action = "like";
//         let clicked = $(this);
//         if (clicked.hasClass("active-like")){
//             action = "unlike";
//             $(".like").attr('src', '../images/like.png');
//             $(".like").removeClass("active-like");
//         } else {
//             $(".like").attr('src', '../images/like-active.png');
//             $(".like").addClass("active-like");
//         }
//         $(".dislike").attr('src', '../images/dislike.png');
//         $(".dislike").removeClass("active-dislike");
//
//         $.ajax({
//             type: "POST",
//             method: "POST",
//             // dataType : 'json',
//             url: "{{ route('ratingUpdate') }}",
//             data: {
//                 _token:"{{csrf_token()}}",
//                 action: action,
//                 film_id: film_id
//             }
//         }).done( function(data){
//             console.log('Ajax was Successful!')
//             console.log(data)
//         }).fail(function(){
//             console.log('Ajax Failed')
//         });
//     });
//
//     $('.dislike').on('click', function(){
//         let film_id = Number($(this).attr('data-filmId'));
//         let action = "dislike";
//         let clicked = $(this);
//         if (clicked.hasClass("active-dislike")){
//             action = "undislike";
//             $(".dislike").attr('src', '../images/dislike.png');
//             $(".dislike").removeClass("active-dislike");
//         } else{
//             $(".dislike").attr('src', '../images/dislike-active.png');
//             $(".dislike").addClass("active-dislike");
//         }
//         $(".like").attr('src', '../images/like.png');
//         $(".like").removeClass("active-like");
//
//         $.ajax({
//             type: "POST",
//             method: "POST",
//             // dataType : 'json',
//             url: "{{ route('ratingUpdate') }}",
//             data: {
//                 _token:"{{csrf_token()}}",
//                 action: action,
//                 film_id: film_id
//             }
//         }).done( function(data){
//             console.log('Ajax was Successful!')
//             console.log(data)
//         }).fail(function(){
//             console.log('Ajax Failed')
//         });
//         // .done(function(data) {
//         //     console.log("done");
//         //     let res = JSON.parse(data);
//         //     $("p.like-num").text(res.likes);
//         //     $("p.dislike-num").text(res.dislikes);
//         // });
//     });
// })
