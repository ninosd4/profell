    const typedHome = new Typed('#home-typed', {
            strings: ['web Developer', 'Freelancer','Designer'],
            typeSpeed:80,
            backSpeed:40,
            backDelay:2000,
            loop:true,
            cursorChar: '_',
        })

        
const scrollRevealOption = {
  distance: "50px",
  origin: "bottom",
  duration: 1000,
};

ScrollReveal().reveal(".formtwo img", {
  ...scrollRevealOption,
  origin: "right",
});
ScrollReveal().reveal(".formone h3 .typed-curso", {
  ...scrollRevealOption,
  delay: 500,
});
ScrollReveal().reveal(".formone h1", {
  ...scrollRevealOption,
  delay: 1000,
});
ScrollReveal().reveal(".formone p", {
  ...scrollRevealOption,
  delay: 1500,
});
ScrollReveal().reveal(".btn_cv", {
  ...scrollRevealOption,
  delay: 2000,
});
ScrollReveal().reveal(".links__icon a", {
  ...scrollRevealOption,
  delay: 2500,
  interval: 500,
});

let menu = document.getElementById('menu');
let links = document.querySelector('.nav__links');
let icon = document.querySelector('#menu i');

menu.addEventListener('click', () => {
  links.classList.toggle('active');

  // تبديل الأيقونة
  if (links.classList.contains('active')) {
    icon.classList.remove('fa-list');
    icon.classList.add('fa-xmark');
  } else {
    icon.classList.remove('fa-xmark');
    icon.classList.add('fa-list');
  }
});
