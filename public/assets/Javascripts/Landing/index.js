(function () {
    const slides = document.querySelectorAll(".carousel-slide");
    const dots = document.querySelectorAll(".carousel-dots span");
    const toggleBtn = document.getElementById("carouselToggle");
    const toggleIcon = document.getElementById("toggleIcon");
    const heroBg = document.getElementById("heroBg");
    let current = 0;
    let interval;
    let isPlaying = true;
    const DELAY = 5000;

    // Get images from data-image attributes instead of hardcoded array
    function getSlideImages() {
        const images = [];
        slides.forEach((slide) => {
            const img = slide.getAttribute("data-image");
            if (img) {
                images.push(img);
            }
        });
        return images;
    }

    const bgImages = getSlideImages();

    // Fallback images if no data-image attributes found
    const fallbackImages = [
        "https://images.unsplash.com/photo-1580587771525-78b9dba3b914?w=1200&h=600&fit=crop&crop=center",
        "https://images.unsplash.com/photo-1519501025264-65ba15a82390?w=1200&h=600&fit=crop&crop=center",
        "https://images.unsplash.com/photo-1500382017468-9049fed747ef?w=1200&h=600&fit=crop&crop=center",
    ];

    // Use fallback if no data-image attributes found
    const finalImages = bgImages.length > 0 ? bgImages : fallbackImages;

    function updateBackground(index) {
        const imageUrl = finalImages[index] || finalImages[0];
        heroBg.style.backgroundImage = `
            linear-gradient(135deg, rgba(11, 59, 60, 0.75) 0%, rgba(11, 59, 60, 0.35) 60%, rgba(0, 0, 0, 0.20) 100%),
            url('${imageUrl}')
        `;
    }

    function goTo(index) {
        slides.forEach((s) => s.classList.remove("active"));
        dots.forEach((d) => d.classList.remove("active"));
        slides[index].classList.add("active");
        dots[index].classList.add("active");
        current = index;
        updateBackground(index);
    }

    function nextSlide() {
        const next = (current + 1) % slides.length;
        goTo(next);
    }

    function startCarousel() {
        if (interval) clearInterval(interval);
        interval = setInterval(nextSlide, DELAY);
        isPlaying = true;
        toggleIcon.className = "fas fa-pause";
    }

    function stopCarousel() {
        if (interval) {
            clearInterval(interval);
            interval = null;
        }
        isPlaying = false;
        toggleIcon.className = "fas fa-play";
    }

    function togglePlay() {
        if (isPlaying) {
            stopCarousel();
        } else {
            startCarousel();
        }
    }

    dots.forEach((dot, idx) => {
        dot.addEventListener("click", function () {
            if (current === idx) return;
            goTo(idx);
            if (isPlaying) {
                clearInterval(interval);
                interval = setInterval(nextSlide, DELAY);
            }
        });
    });

    toggleBtn.addEventListener("click", togglePlay);

    const hero = document.querySelector(".hero");
    hero.addEventListener("mouseenter", function () {
        if (isPlaying) {
            clearInterval(interval);
        }
    });

    hero.addEventListener("mouseleave", function () {
        if (isPlaying) {
            interval = setInterval(nextSlide, DELAY);
        }
    });

    // Initialize with first slide
    goTo(0);
    startCarousel();
})();
