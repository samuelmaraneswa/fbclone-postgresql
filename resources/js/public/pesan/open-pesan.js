document.addEventListener('click', (e) => {
  const chatBox = document.getElementById('chatBox');

  // buka
  if (e.target.closest('#btnOpenChat')) {
    chatBox.classList.toggle('hidden');
    return;
  }

  // close via tombol
  const closeBtn = e.target.closest('[data-close]');
  if (closeBtn) {
    const targetId = closeBtn.dataset.close;
    const el = document.getElementById(targetId);
    if (el) el.classList.add('hidden');
    return;
  }

  // klik di luar chatbox → close
  if (chatBox && !chatBox.classList.contains('hidden') && !e.target.closest('#chatBox')) {
    chatBox.classList.add('hidden');
  }
});

// ESC → close
document.addEventListener('keydown', function (e) {
  if (e.key === 'Escape') {
    const chatBox = document.getElementById('chatBox');
    if (chatBox) chatBox.classList.add('hidden');
  }
});