$(document).ready(function(){
    $('.promo').slick({
      slidesToShow: 4,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 2000,
    });
  });

  document.getElementById('modoDark').addEventListener('click', function(event){
    event.preventDefault() //prevenção do documento padrão do item 
    document.body.classList.toggle ('dark')//Acresentar a class dark
})

document.querySelector(".abrirMenu").onclick = function(){
  document.documentElement.classList.add("menuAtivo");

};

document.querySelector(".fecharMenu").onclick = function(){
  document.documentElement.classList.remove("menuAtivo");
  
};


document.getElementById('estado_select').addEventListener('change', function() {
  document.getElementById('estado_texto').value = this.value;
});



 




