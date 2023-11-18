window.onload = (evt) => {
    
    const el = document.querySelector("#reg_num")
   
    const query = window.location.search
    const urlParams = new URLSearchParams(query);

    
    el.value = urlParams.get('reg_num')
  
}