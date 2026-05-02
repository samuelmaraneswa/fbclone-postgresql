document.addEventListener("DOMContentLoaded", () => {

  // klik teman → buka chat
  document.addEventListener('click', (e) => {
    const item = e.target.closest('[data-open-chat="user"]');
    if (!item) return;

    const chatBox = document.getElementById('chatBox');
    const chatUserBox = document.getElementById('chatUserBox');

    const name = item.dataset.userName;
    const avatar = item.dataset.userAvatar;

    document.getElementById('chatUserName').textContent = name;
    document.getElementById('chatUserAvatar').src = avatar;

    if (chatBox) chatBox.classList.add('hidden');
    if (chatUserBox) chatUserBox.classList.remove('hidden');
  });

  // klik luar → close
  document.addEventListener('click', (e) => {
    const chatUserBox = document.getElementById('chatUserBox');
    const input = document.getElementById('chatInput').focus()

    if (
      chatUserBox &&
      !chatUserBox.classList.contains('hidden') &&
      !e.target.closest('#chatUserBox') &&
      !e.target.closest('[data-open-chat="user"]')
    ) {
      chatUserBox.classList.add('hidden');
    }
  });

  // ESC → close
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
      const chatUserBox = document.getElementById('chatUserBox');
      if (chatUserBox) chatUserBox.classList.add('hidden');
    }
  });

});