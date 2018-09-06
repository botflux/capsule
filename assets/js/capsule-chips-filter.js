/**
 * Represents all the chips used for sorting capsules
 * @type {NodeListOf<Element>}
 */
let orderChipsSet = document.querySelectorAll('[data-chips-capsule-order]');

/* If there is sorting chips in this page then */
if (orderChipsSet !== undefined) {
  // for each of them
  orderChipsSet.forEach((el) => {
    // we add an click listener, this way when the user click on the chips he will be redirect with order passed through get method
    el.addEventListener('click', () => {
      window.location = `/dashboard?order=${el.getAttribute('data-chips-capsule-order')}`;
    });
  });
}