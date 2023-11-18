window.onunload = (evt)=>{
    const  a  =  document.createElement('a')
    a.href = "./php/ logout.php"
    a.click()
}