document.addEventListener("DOMContentLoaded", () => {
  const lainnyaProfile = document.getElementById("lainnyaProfile")
  const lainnyaProfileMenu = document.getElementById("lainnyaProfileMenu")
  const tabsContainer = document.getElementById("profileTabs")
  const content = document.getElementById("profileContent")
  const btnHamburger = document.getElementById("btnHamburger")
  const contentHamburger = document.getElementById("menuHamburgerContent")

  if(lainnyaProfile && lainnyaProfileMenu){
    lainnyaProfile.addEventListener("click", () => {
      lainnyaProfileMenu.classList.toggle("hidden")
    })
  }

  if(tabsContainer && content){
    tabsContainer.addEventListener("click", async (e) => {
      const tab = e.target.closest(".profile-tab");
      if(!tab) return;
      
      e.preventDefault();

      const url = tab.href;

      const response = await fetch(url);
      const html = await response.text();

      const parser = new DOMParser()
      const doc = parser.parseFromString(html, 'text/html');

      const newContent = doc.querySelector("#profileContent")
      if (!newContent) return;

      content.innerHTML = newContent.innerHTML;

      history.pushState(null, '', url);

      tabsContainer.querySelectorAll(".profile-tab").forEach(t => {
        t.classList.remove('text-blue-600', 'border-b-2', 'border-blue-600', 'bg-blue-100')
      });

      tab.classList.add('text-blue-600', 'border-b-2', 'border-blue-600', 'bg-blue-100')
    })

    content.addEventListener("click", async (e) => {
      const btn = e.target.closest(".lihat-semua-post");
      if (!btn) return;

      e.preventDefault();

      const url = btn.href;

      const response = await fetch(url);
      const html = await response.text();

      const parser = new DOMParser();
      const doc = parser.parseFromString(html, "text/html");

      const newContent = doc.querySelector("#profileContent");
      if (!newContent) return;

      content.innerHTML = newContent.innerHTML;

      history.pushState(null, "", url);

      tabsContainer.querySelectorAll(".profile-tab").forEach(t => {
        t.classList.remove(
          "text-blue-600",
          "border-b-2",
          "border-blue-600",
          "bg-blue-100"
        );

        if (t.href === url) {
          t.classList.add(
            "text-blue-600",
            "border-b-2",
            "border-blue-600",
            "bg-blue-100"
          );
        }
      });
    });

    content.addEventListener("click", async (e) => {
      const btnPost = e.target.closest(".lihat-semua-post");
      const btnTeman = e.target.closest(".lihat-semua-teman");

      if (!btnPost && !btnTeman) return;

      e.preventDefault();

      const btn = btnPost || btnTeman;
      const url = btn.href;

      const response = await fetch(url);
      const html = await response.text();

      const parser = new DOMParser();
      const doc = parser.parseFromString(html, "text/html");

      const newContent = doc.querySelector("#profileContent");
      if (!newContent) return;

      content.innerHTML = newContent.innerHTML;

      history.pushState(null, "", url);

      tabsContainer.querySelectorAll(".profile-tab").forEach(t => {
        t.classList.remove(
          "text-blue-600",
          "border-b-2",
          "border-blue-600",
          "bg-blue-100"
        );

        if (t.href === url) {
          t.classList.add(
            "text-blue-600",
            "border-b-2",
            "border-blue-600",
            "bg-blue-100"
          );
        }
      });
    });

    content.addEventListener("click", async (e) => {
      const btnPost = e.target.closest(".lihat-semua-post");
      const btnTeman = e.target.closest(".lihat-semua-teman");
      const btnFoto = e.target.closest(".lihat-semua-foto");

      if (!btnPost && !btnTeman && !btnFoto) return;

      e.preventDefault();

      const btn = btnPost || btnTeman || btnFoto;
      const url = btn.href;

      const response = await fetch(url);
      const html = await response.text();

      const parser = new DOMParser();
      const doc = parser.parseFromString(html, "text/html");

      const newContent = doc.querySelector("#profileContent");
      if (!newContent) return;

      content.innerHTML = newContent.innerHTML;

      history.pushState(null, "", url);

      tabsContainer.querySelectorAll(".profile-tab").forEach(t => {
        t.classList.remove(
          "text-blue-600",
          "border-b-2",
          "border-blue-600",
          "bg-blue-100"
        );

        if (t.href === url) {
          t.classList.add(
            "text-blue-600",
            "border-b-2",
            "border-blue-600",
            "bg-blue-100"
          );
        }
      });
    });
  }

  window.addEventListener("popstate", async () => {
    const url = window.location.href;

    const response = await fetch(url)
    const html = await response.text()

    const parser = new DOMParser()
    const doc = parser.parseFromString(html, 'text/html')

    const newContent = doc.querySelector("#profileContent")
    if(!newContent) return

    content.innerHTML = newContent.innerHTML

    tabsContainer.querySelectorAll(".profile-tab").forEach(t => {
      t.classList.remove('text-blue-600', 'border-b-2', 'border-blue-600', 'bg-blue-100');

      if (t.href === url) {
        t.classList.add('text-blue-600', 'border-b-2', 'border-blue-600', 'bg-blue-100');
      }
    })
  })

  if(btnHamburger && contentHamburger){
    btnHamburger.addEventListener("click", () => {
      contentHamburger.classList.toggle("hidden")
    })
  }
})