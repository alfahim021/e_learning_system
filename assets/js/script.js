document.addEventListener('DOMContentLoaded', () => {

    const forms = document.querySelectorAll('form');

    forms.forEach(form => {
        form.addEventListener('submit', (e) => {
            let valid = true;

            form.querySelectorAll('.error').forEach(el => el.remove());

            form.querySelectorAll('[required]').forEach(field => {
                if (!field.value.trim()) {
                    valid = false;

                    field.style.borderColor = '#e74c3c';

                    if (!field.nextElementSibling || !field.nextElementSibling.classList.contains('error')) {
                        const error = document.createElement('div');
                        error.classList.add('error');
                        error.textContent = 'This field is required';
                        field.insertAdjacentElement('afterend', error);
                    }
                } else {
                    field.style.borderColor = '#4364F7';
                }
            });

            if (!valid) {
                e.preventDefault();
            }
        });
    });


    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
});
