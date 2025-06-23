import Popover from 'bootstrap/js/dist/popover';
import debounce from 'lodash/debounce';

[...document.querySelectorAll('[data-bs-toggle="popover"]')].map(popoverTriggerEl => new Popover(popoverTriggerEl));

// This code is identical to code in silverstripe/login-forms client/src/bundle.js
// If you update this code then also update that code
const levelMap = {
  // very low
  0: 'danger',
  // low
  1: 'danger',
  // medium
  2: 'warning',
  // strong
  3: 'info',
  // very strong
  4: 'success',
};

async function evaulatePassword(event) {
  const passwordEl = event.target;
  const url = passwordEl.getAttribute('data-strength-url');
  if (!url) {
    return;
  }
  const minStrength = passwordEl.getAttribute('data-min-strength');
  const containerEl = passwordEl.closest('.confirmedpassword');
  const strengthEl = containerEl.querySelector('.passwordstrength');
  if (!strengthEl) {
    return;
  }
  const response = await fetch(url, {
    method: 'POST',
    body: JSON.stringify({
      password: passwordEl.value,
    }),
  });
  if (!response.ok) {
    strengthEl.innerHTML = '';
    return;
  }
  const json = await response.json();
  if (!json) {
    strengthEl.innerHTML = '';
    return;
  }  
  const valid = json.strength >= minStrength;
  let level = 'danger'
  if (valid && levelMap.hasOwnProperty(json.strength)) {
    level = levelMap[json.strength];
  }
  let message = json.message;
  if (!valid) {
    message += `<br/>${json.tooLow}`;
  }
  strengthEl.innerHTML = `<p class="alert alert-${level}" role="alert">${message}</p>`;
}

const debouncedEvaulatePassword = debounce((event) => evaulatePassword(event), 300, {
  'leading': true,
  'trailing': true,
  'maxWait': 300,
});

// Use event delegation so that this still works as the user navigates around using pjax
document.addEventListener('input', (event) => {
  if (event.target.matches('.confirmedpassword [data-strength-url]')) {
    debouncedEvaulatePassword(event);
  }
});
