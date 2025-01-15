import Popover from 'bootstrap/js/dist/popover';

[...document.querySelectorAll('[data-bs-toggle="popover"]')].map(popoverTriggerEl => new Popover(popoverTriggerEl));
