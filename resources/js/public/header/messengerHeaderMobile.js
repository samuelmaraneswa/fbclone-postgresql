const btn = document.getElementById('btnMessengerMobile');
const card = document.getElementById('messengerMobileCard');

btn?.addEventListener('click', () => {
  card.classList.toggle('hidden');
});
