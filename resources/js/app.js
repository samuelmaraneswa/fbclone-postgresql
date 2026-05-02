import './bootstrap';
import Swal from 'sweetalert2'
window.Swal = Swal

import './public/header/inputSearch'
import './public/header/menuKananHeader'
import './public/header/messengerHeader'
import './public/header/notifHeader'
import './public/header/notifHeaderMobile'
import './public/partials/tooltipPost'
import './auth/login'
import './auth/register'
import './public/profile/profile'
import './public/profile/updateProfile'
import './public/friend/friend'
import './public/post/createPost'
import './public/post/sliderPost'
import './public/post/like'
import './public/post/modalPost'
import './public/post/likePostModal'
import './public/post/commentPost'
import './public/pesan/open-pesan'
import './public/pesan/pesan-perorangan'
import './public/pesan/pesan'
import './public/header/messengerHeaderMobile'

// function
async function loadUnreadCount() {
  try {
    const res = await fetch('/messages/unread-count');
    const data = await res.json();

    const badges = document.querySelectorAll('.pesan-badge');
    if (!badges.length) return;

    badges.forEach(badge => {
      if (data.count > 0) {
        badge.textContent = data.count;
        badge.classList.remove('hidden');
      } else {
        badge.classList.add('hidden');
      }
    });

  } catch (err) {
    console.error(err);
  }
}

window.loadUnreadCount = loadUnreadCount;

document.addEventListener("DOMContentLoaded", () => {
  const userId = document.querySelector('meta[name="user-id"]')?.content;

  if (!userId) return; 

  loadUnreadCount();
});

setInterval(() => {
  const userId = document.querySelector('meta[name="user-id"]')?.content;

  if (!userId) return; 

  loadUnreadCount();
  if (window.loadConversations) {
    loadConversations();
  }
}, 5000);