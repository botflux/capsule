/*
  search for all capsule in the page thanks to data-capsule-redirect attribute
  and set a on click listener so when the user click on a capsule he is redirect
  to the capsule page
*/
document.querySelectorAll('[data-capsule-redirect]').forEach((el) => {
  el.addEventListener('click', () => {
    window.location = `/capsule/${el.getAttribute('data-capsule-redirect')}`
  });
});