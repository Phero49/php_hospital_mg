const table = document.querySelector("#dataTable")
const reportgenerate = document.querySelector("#reportgenerate")


reportgenerate.addEventListener('click',()=>{
  const nav = document.querySelector('nav')
  nav.style.display = 'none'
  reportgenerate.style.display = "none"
  print()
  nav.style.display = ''
  reportgenerate.style.display = ""

})


