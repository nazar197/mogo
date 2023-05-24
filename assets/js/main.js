jQuery(document).ready(function($){
  // Fix issue on mob
  function menuUp() {
    let heightMenu = $('#header').outerHeight();
    $('#slider_banner').css('margin-top', `-${heightMenu}px`);
  }

  // Burger menu
  $('.menu_active button').click(function(){
    $(this).toggleClass('active');
    $('.block_header').toggleClass('active');
    $('body').toggleClass('overflow_hidden');
    $('.button_item_search').removeClass('active');
  });

  $('.close_button button').click(function(){
    $('.menu_active button').removeClass('active');
    $('.block_header').removeClass('active');
    $('body').removeClass('overflow_hidden');
  });

  // Search
  $('.active_search').click(function(){
    $('.button_item_search').toggleClass('active');
  });

  // Slider
  function setNameBullet () {
    const titleBullet = document.querySelectorAll('.banner_item span');
    const numBullet   = document.querySelectorAll('#slider_banner .swiper-pagination span');
    let namesArr = [];
    
    titleBullet.forEach(element => {
      namesArr.push(element.textContent);
    });

    numBullet.forEach((element, i) => {
      element.innerHTML = i >= 10 
      ? `<span style="font-size: 18px;">${i += 1}</span> ${namesArr[i]}` 
      : `<span style="font-size: 18px;">0${i += 1}</span> ${ namesArr[i] }`;
    });
  }

  new Swiper(".swiper_hero_banner", {
    loop: true,
    autoplay: {
      delay: 9900,
      disableOnInteraction: false,
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
      renderBullet: function (index, className) {
        return '<span class="' + className + '">' + (index + 1) + "</span>";
      },
    },
  });


  setNameBullet();
  menuUp();
});