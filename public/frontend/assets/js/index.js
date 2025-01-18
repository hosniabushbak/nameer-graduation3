AOS.init();

//Loaded
// document.addEventListener("DOMContentLoaded", () => {
//   const [leftHalf, rightHalf, content, logo, curtain] = ['.left-half', '.right-half', '.content', '.logo','.curtain'].map(selector => document.querySelector(selector));
//   setTimeout(() => { 
//     leftHalf.style.transform = 'translateX(-100%)'; 
//     rightHalf.style.transform = 'translateX(100%)'; 
//     logo.classList.add('active'); 
//     content.style.opacity = '1'; 
//     setTimeout(() => {
//       curtain.style.display = 'none';
//     }, 1000);
//   }, 1000);
// });


// header
let prevScrollpos = window.pageYOffset;
window.onscroll = function() {
  const currentScrollPos = window.pageYOffset;
  const navbar = document.getElementById("navbar");
  if (prevScrollpos > currentScrollPos) {
    navbar.classList.remove("hide");
  } else {
    navbar.classList.add("hide");
  }
  prevScrollpos = currentScrollPos;
}



//Swiper
new Swiper(".newCoursesTech .mySwipernewCoursesTech", {
  navigation: {
      nextEl: ".newCoursesTech .swiper-button-prev",
      prevEl: ".newCoursesTech .swiper-button-next",
  },
  pagination: {
      el: ".newCoursesTech .swiper-pagination",
  },
  slidesPerView: 1,
  spaceBetween: 20,
  slidesPerGroup: 1,
  centeredSlides: false,
  slidesPerView: "auto",
  loop:false,
  breakpoints: {
      320: {
          slidesPerView: 1,
          spaceBetween: 20,
      },
      767: {
          slidesPerView: 2,
          spaceBetween: 15,
      },
      992: {
          slidesPerView: 3,
          spaceBetween: 20,
      },
  },
});




//Swiper
new Swiper(".secInstructors .swiperInstructors", {
  navigation: {
      nextEl: ".swiperInstructors .swiper-button-next",
      prevEl: ".swiperInstructors .swiper-button-prev",
  },
  slidesPerView: 1,
  spaceBetween: 20,
  slidesPerGroup: 1,
  centeredSlides: false,
  slidesPerView: "auto",
  loop:false,
  breakpoints: {
      320: {
          slidesPerView: 1,
          spaceBetween: 20,
      },
      767: {
          slidesPerView: 2,
          spaceBetween: 30,
      },
      992: {
          slidesPerView: 3,
          spaceBetween: 40,
      },
  },
});


//Swiper
var swiper = new Swiper(".swiper-container.swiperFAQ", {
    loop: true,
    speed: 1000,
    autoplay: {
        delay: 3000,
    },
    effect: 'coverflow',
    grabCursor: true,
    centeredSlides: true,
    slidesPerView: 'auto',
    coverflowEffect: {
        rotate: 0,
        stretch: 80,
        depth: 200,
        modifier: 1,
        slideShadows: false,
    },
    slidesPerView: 1.5,

//   slidesPerView: 1,
//   spaceBetween: 20,
//   centeredSlides: false,
//   slidesPerView: "auto",
//   loop:false,
//   breakpoints: {
//       320: {
//           slidesPerView: 1,
//           spaceBetween: 20,
//       },
//       767: {
//           slidesPerView: 2,
//           spaceBetween: 30,
//       },
//       992: {
//           slidesPerView: 3,
//           spaceBetween: 40,
//       },
//   },


});


const colors = ['#abc84a','#fbc407','#66cafc','#833a8d','#87CEEB', '#32CD32', '#E6E6FA', '#D3D3D3', '#FFA07A', '#00BFFF'];

const cards = document.querySelectorAll('.single-courses-category a');

cards.forEach((card, index) => {
  const color = colors[index % colors.length];
  card.style.setProperty('--primary', color);
});

