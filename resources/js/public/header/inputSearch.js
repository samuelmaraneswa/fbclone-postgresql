document.addEventListener("DOMContentLoaded", () => {
  const inputSearchHeaderWrapper = document.getElementById("inputSearchHeaderWrapper")
  const iconSearchHeader = document.getElementById("iconSearchHeader")
  const inputSearchHeader = document.getElementById("inputSearchHeader")
  const fbLogo = document.getElementById("fbLogo")
  const arrowLeftHeader = document.getElementById("arrowLeftHeader")
  const kotakDialogSearch = document.getElementById("kotakDialogSearch")

  // mobile
  const mobileSearch = document.getElementById("mobileSearch")
  const mobileSearchContent = document.getElementById("mobileSearchContent")
  const cancelSearhMobile = document.getElementById("cancelSearchMobile")


  if (
    !inputSearchHeaderWrapper ||
    !iconSearchHeader ||
    !inputSearchHeader ||
    !fbLogo ||
    !arrowLeftHeader ||
    !kotakDialogSearch ||
    !mobileSearch ||
    !mobileSearchContent ||
    !cancelSearhMobile
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
    if(e.key === "Escape"){
      toggleSearchHeader(false)
    }
  })

  arrowLeftHeader.addEventListener("click", () => {
    toggleSearchHeader(false)
  })

  document.addEventListener("click", (e) => {
    if(!inputSearchHeaderWrapper.contains(e.target)){
      toggleSearchHeader(false)
    }
  })

  inputSearchHeader.addEventListener("input", () => {
    toggleSearchHeader(true)
  })

  mobileSearch.addEventListener("click", () => {
    mobileSearchContent.classList.remove('hidden')
  })

  cancelSearhMobile.addEventListener("click", () => {
    mobileSearchContent.classList.add("hidden")
  })

})