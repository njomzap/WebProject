function validateLogin() {
    var loginEmail = document.forms["loginForm"]["email"].value;
    var loginPassword = document.forms["loginForm"]["password"].value;
    if (!loginEmail || !loginPassword) {
        alert("Please fill all the fields");
        return false;
    }
    return true;
}
function validateRegister() {
    var registerFirstname = document.forms["registerForm"]["firstname"].value;
    var registerLastname = document.forms["registerForm"]["lastname"].value;
    var registerUsername = document.forms["registerForm"]["username"].value;
    var registerEmail = document.forms["registerForm"]["email"].value;
    var registerPassword = document.forms["registerForm"]["password"].value;
    if ( ! registerUsername || ! registerEmail || ! registerPassword || ! registerFirstname || ! registerLastname ) {
        alert("Please fill all the fields");
        return false;
    }
    if (registerPassword.length < 6) {
        alert("Password should contain at least 6 characters");
        return false;
    }

    return true;
}
function validateContactForm() {
    var name = document.forms["contactForm"]["name"].value;
    var email = document.forms["contactForm"]["email"].value;
    var message = document.forms["contactForm"]["message"].value;
    if ( ! name || ! email || ! message ) {
        alert("Please fill all the fields");
        return false;
    }

    return true;
}

document.addEventListener('DOMContentLoaded', function() {
    var slides = document.querySelectorAll('.slide');
    var currentIndex = 0;

    function showSlide(index) {
        if (index >= slides.length) currentIndex = 0;
        if (index < 0) currentIndex = slides.length - 1;

        slides.forEach(function(slide) {
            slide.classList.remove('active');
        });
        slides[currentIndex].classList.add('active');
    }

    var nextButton = document.querySelector('.next');
    var prevButton = document.querySelector('.prev');

    nextButton.addEventListener('click', function() {
        currentIndex++;
        showSlide(currentIndex);
    });

    prevButton.addEventListener('click', function() {
        currentIndex--;
        showSlide(currentIndex);
    });

    showSlide(currentIndex);
});

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('mobileMenuIcon').addEventListener('click', function() {
        var menu = document.querySelector('nav ul');
        if (menu.style.display === 'block') {
            menu.style.display = 'none';
        } else {
            menu.style.display = 'block';
        }
    });

    window.addEventListener('resize', function() {
        var menu = document.querySelector('nav ul');
        if (window.innerWidth > 768) {
            menu.style.display = '';
        } else if (window.innerWidth <= 768 && !menu.style.display) {
            menu.style.display = 'none';
        }
    });
});
