document.addEventListener('DOMContentLoaded', () => {
  const modal = document.getElementById('introModal');
  const closeBtn = document.getElementById('closeIntro');

  if (!modal) return;
  
  if (!localStorage.getItem('seen_intro')) {
    modal.classList.remove('hidden');
  }

  closeBtn?.addEventListener('click', () => {
    modal.classList.add('hidden');
    localStorage.setItem('seen_intro', 'true');
  });
});

console.log('intro jalan production');