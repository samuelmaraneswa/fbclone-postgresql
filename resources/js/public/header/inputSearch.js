document.addEventListener("DOMContentLoaded", () => {
  const inputSearchHeaderWrapper = document.getElementById("inputSearchHeaderWrapper")
  const iconSearchHeader = document.getElementById("iconSearchHeader")
  const inputSearchHeader = document.getElementById("inputSearchHeader")
  const fbLogo = document.getElementById("fbLogo")
  const arrowLeftHeader = document.getElementById("arrowLeftHeader")
  const kotakDialogSearch = document.getElementById("kotakDialogSearch")
  if (!kotakDialogSearch) return
  const listContainer = kotakDialogSearch.querySelector("ul")

  // mobile
  const inputSearchMobile = document.getElementById("inputSearchMobile")
  const kotakDialogSearchMobile = document.getElementById("kotakDialogSearchMobile")
  if (!kotakDialogSearchMobile) return
  const listContainerMobile = kotakDialogSearchMobile.querySelector("ul")
  const mobileSearch = document.getElementById("mobileSearch")
  const mobileSearchContent = document.getElementById("mobileSearchContent")
  const cancelSearhMobile = document.getElementById("cancelSearchMobile")

  let currentIndex = -1

  if (
    !inputSearchHeaderWrapper ||
    !iconSearchHeader ||
    !inputSearchHeader ||
    !fbLogo ||
    !arrowLeftHeader ||
    !mobileSearch ||
    !mobileSearchContent ||
    !cancelSearhMobile ||
    !inputSearchMobile ||
    !listContainerMobile ||
    !listContainer
  ) return;

  function toggleSearchHeader(isActive){
    if(isActive){
      fbLogo.classList.add("hidden")
      iconSearchHeader.classList.add("hidden!")
      inputSearchHeader.style.paddingLeft = "1rem"
      arrowLeftHeader.classList.remove("hidden")
      kotakDialogSearch.classList.remove("hidden")
    }else{
      arrowLeftHeader.classList.add("hidden")
      iconSearchHeader.classList.remove("hidden!")
      inputSearchHeader.style.paddingLeft = "2rem"
      fbLogo.classList.remove("hidden")
      kotakDialogSearch.classList.add("hidden")
    }
  }

  inputSearchHeader.addEventListener("focus", () => {
    toggleSearchHeader(true)
  })

  inputSearchHeader.addEventListener("keydown", (e) => {
    console.log("keydown:", e.key)
    const items = listContainer.querySelectorAll("li")
    console.log("items:", items.length)

    if(e.key === "Escape"){
      toggleSearchHeader(false)
    }

    if (!items.length) return

    if (e.key === "ArrowDown") {
      e.preventDefault()
      currentIndex = (currentIndex + 1) % items.length
    }

    if (e.key === "ArrowUp") {
      e.preventDefault()
      currentIndex = (currentIndex - 1 + items.length) % items.length
    }

    if (e.key === "Enter" && currentIndex >= 0) {
      const link = items[currentIndex].querySelector("a")
      if (link) window.location.href = link.href
    }

    items.forEach((item, i) => {
      const link = item.querySelector("a")

      if (!link) return

      if (i === currentIndex) {
        link.classList.add("bg-gray-200")
        link.classList.remove("bg-white")
      } else {
        link.classList.remove("bg-gray-200")
        link.classList.add("bg-white")
      }
    })
  })

  arrowLeftHeader.addEventListener("click", () => {
    toggleSearchHeader(false)
  })

  document.addEventListener("click", (e) => {
    if(!inputSearchHeaderWrapper.contains(e.target)){
      toggleSearchHeader(false)
    }
  })

  inputSearchHeader.addEventListener("input", async () => {
    toggleSearchHeader(true)

    const keyword = inputSearchHeader.value.trim()
    console.log(keyword)

    if(!keyword){
      listContainer.innerHTML = ""
      kotakDialogSearch.classList.add("hidden")
      return
    } 

    const response = await fetch(`/search/users?q=${keyword}`)
    const data = await response.json()

    if(data.length === 0){
      listContainer.innerHTML = `
        <li class="p-2 text-gray-700 italic text-sm">Data tidak ditemukan</li>
      `
      return
    }

    listContainer.innerHTML = ""
    
    data.forEach(user => {
      const fullName = `${user.first_name} ${user.last_name}`

      const li = document.createElement("li")

      li.innerHTML = `
        <a href=/profile/user/${user.id} class="flex items-center gap-4 cursor-pointer bg-white hover:bg-gray-100 mb-1 p-2 rounded">
          <button class="rounded-full bg-gray-100 hover:bg-gray-200 px-2 py-1.5 cursor-pointer">
            <i class="fa-solid fa-magnifying-glass text-gray-500"></i>
          </button>
          <p>${fullName}</p>
        </a>
      `

      listContainer.append(li)
    });
  })

  

  mobileSearch.addEventListener("click", () => {
    mobileSearchContent.classList.remove('hidden')
    inputSearchMobile.focus()
  })

  cancelSearhMobile.addEventListener("click", () => {
    mobileSearchContent.classList.add("hidden")
  })

  inputSearchMobile.addEventListener("input", async () => {
    const keyword = inputSearchMobile.value.trim()
    console.log(keyword)

    if(!keyword){
      listContainerMobile.innerHTML = ""
      return
    }

    const currentKeyword = keyword

    const response = await fetch(`/search/users?q=${keyword}`)
    const data = await response.json()

    if (currentKeyword !== inputSearchMobile.value.trim()) return

    if(data.length === 0){
      listContainerMobile.innerHTML = `<li class="p-2 text-gray-700 italic text-sm">Data tidak ditemukan</li>`
      return
    }

    listContainerMobile.innerHTML = ""
    data.forEach(user => {
      const fullName = `${user.first_name} ${user.last_name}`

      const li = document.createElement("li")
      li.innerHTML = `
        <a href="/profile/user/${user.id}" class="flex items-center gap-4 cursor-pointer bg-white hover:bg-gray-100 mb-1 p-2 rounded">
          <button class="rounded-full bg-gray-100 hover:bg-gray-200 px-2 py-1.5 cursor-pointer">
            <i class="fa-solid fa-magnifying-glass left-2 text-gray-500"></i>
          </button>
          <p>${fullName}</p>
        </a>
      `
      listContainerMobile.appendChild(li)
    })
  })
})