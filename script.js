
let currentSlide = 0;
const slider = document.querySelector('.slider');
const slides = document.querySelectorAll('.slide');
const totalSlides = slides.length;

function showSlide(index) {
  if (index >= totalSlides) currentSlide = 0;
  if (index < 0) currentSlide = totalSlides - 1;
  slider.style.transform = `translateX(-${currentSlide * 100}%)`;
}

document.querySelector('.next-btn').addEventListener('click', () => {
  currentSlide++;
  showSlide(currentSlide);
});

document.querySelector('.prev-btn').addEventListener('click', () => {
  currentSlide--;
  showSlide(currentSlide);
});

setInterval(() => {
  currentSlide++;
  showSlide(currentSlide);
}, 3000);
