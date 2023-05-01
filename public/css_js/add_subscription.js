'use strict';

document.getElementById('subscription-form').addEventListener('submit', function (event) {
  event.preventDefault();

  const checkboxes = document.querySelectorAll('input[type=checkbox]');
  const selectedSubscriptions = [];

  checkboxes.forEach(function (checkbox) {
    if (checkbox.checked) {
      selectedSubscriptions.push(checkbox.value);
    }
  });

  document.getElementById('subscriptions').value = JSON.stringify(selectedSubscriptions);
  event.target.submit();
});