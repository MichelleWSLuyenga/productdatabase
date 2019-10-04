var arrayOfElements = document.getElementsByClassName('form-popup myForm');
var lengthOfArray = arrayOfElements.length;

$('li').on('click', function(){
    $('li').removeClass('active');
    $(this).addClass('active');
});
// function openForm() {
// 	for (var i=0; i<lengthOfArray;i++){
//     	arrayOfElements[i].style.display='block';
// 	}
//     // document.getElementsByClassName("form-popup myForm").style.display = "block";
//     // document.getElementById("myForm").style.display = "block";
// }

function closeForm() {
    for (var i=0; i<lengthOfArray;i++){
    	arrayOfElements[i].style.display='none';
	}
}

$(function(){
    $(".open-button").click(function() {
      $(".myForm").toggle("slow");
    });

    $(".open-buttonmore").click(function() {
      $(".formpop").toggle("slow");
    });
});



// ========================================================
// var arrayOfElements1 = document.getElementsByClassName('form-popup myForm1');
// var lengthOfArray1 = arrayOfElements1.length;

// function closeForm1() {
//     for (var i=0; i<lengthOfArray;i++){
//     	arrayOfElements1[i].style.display='none';
// 	}
// }