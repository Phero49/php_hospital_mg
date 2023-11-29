window.onload = (evt)=>{
     if(location.search.includes('error')){
        
        const el = document.querySelector("#error")
        const href = location.href
        const url  =  new URL(href)
       const error  = url.searchParams.get('error')
       el.textContent =  error
    
     }
}