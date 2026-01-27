document.addEventListener('DOMContentLoaded', () => {
  new Swiper('.first__slider', {
    speed: 800,
    effect: 'fade',
    fadeEffect: {
      crossFade: true,
    },
    navigation: {
      nextEl: '.next',
      prevEl: '.prev',
    },
  });

  new Swiper('.third__wrap', {
    slidesPerView: 2,
    spaceBetween: 30,
    speed: 800,
    navigation: {
      nextEl: '.third__arrow__next',
      prevEl: '.third__arrow__prev',
    },
    breakpoints: {
      320: {
        slidesPerView: 1,
      },
      640: {
        slidesPerView: 1,
        spaceBetween: 20,
      },
      1024: {
        slidesPerView: 2,
        spaceBetween: 30,
      },
    }
  });

  new Swiper('.eighteth__wrap', {
    slidesPerView: 6,
    spaceBetween: 30,
    speed: 800,
    navigation: {
      nextEl: '.eighteth__arrow__next',
      prevEl: '.eighteth__arrow__prev',
    },
    breakpoints: {
      320: {
        slidesPerView: 2,
        grid: {
          rows: 2,
        },
      },
      640: {
        slidesPerView: 2,
        spaceBetween: 20,
        grid: {
          rows: 2,
        },
      },
      1024: {
        slidesPerView: 6,
        spaceBetween: 30,
      },
    }
  });
});

document.querySelectorAll('.ten__accordion-header').forEach(header => {
  header.addEventListener('click', () => {
    const item = header.parentElement;
    const content = header.nextElementSibling;

    item.classList.toggle('active');

    // авто-высота
    if (item.classList.contains('active')) {
      content.style.maxHeight = content.scrollHeight + 'px';
      header.querySelector('.icon').textContent = '−';
    } else {
      content.style.maxHeight = null;
      header.querySelector('.icon').textContent = '+';
    }
  });
});