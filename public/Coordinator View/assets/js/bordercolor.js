// Assuming you have some JavaScript code to determine which icon is being displayed
// and then add the appropriate class to the circle element.

// Example:
const circleElement = document.querySelector('.circle');
const checkIconElement = document.querySelector('.check-icon');
const xIconElement = document.querySelector('.x-icon');
const exclamationIconElement = document.querySelector('.exclamation-icon');

if (checkIconElement.style.display !== 'none') {
  circleElement.classList.add('green-border');
} else if (xIconElement.style.display !== 'none') {
  circleElement.classList.add('red-border');
} else if (exclamationIconElement.style.display !== 'none') {
  circleElement.classList.add('orange-border');
}
