
// slide
let slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
    showSlides(slideIndex += n);
}

function currentSlide(n) {
    showSlides(slideIndex = n);
}

function showSlides(n) {
    let i;
    let slides = document.getElementsByClassName("mySlides");
    let dots = document.getElementsByClassName("demo");
    let captionText = document.getElementById("caption");
    if (n > slides.length) { slideIndex = 1 }
    if (n < 1) { slideIndex = slides.length }
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex - 1].style.display = "block";
    dots[slideIndex - 1].className += " active";
    captionText.innerHTML = dots[slideIndex - 1].alt;
}
//input 
$(document).ready(function(){
    $('.input').click(function(){
        var text = "";
        $('.input:checked').each(function(){
            text +=document.getElementById('value-label').innerHTML +',';
        });
        text=text.substring(0,text.length-1);
        document.getElementById("selectedtext").innerHTML = text;

$('input[type="checkbox"]').on("change", function() {
   count = 0;
    if($(this).hasClass('check_all')){
      
      $('input[type="checkbox"][class="checkbox1"]').prop('checked',true);
       $('input[type="checkbox"][class="checkbox1"]').each(function(){
      
          count += parseInt($(this).val());
         
        });
      
      }else{
        $('input[type="checkbox"]:checked').each(function(){
      
          count += parseInt($(this).val());
        });
      }
  
      document.getElementById("total-price").innerHTML = count;
});

    })
})