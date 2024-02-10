toggleButton = document.getElementById("toggle-button");
hiddenBar = document.getElementById("more-nav");

toggleButton.addEventListener('click', (event)=>{
    if (hiddenBar.style.display == "none"){
        hiddenBar.style.display = "flex";
        hiddenBar.style.flexDirection = "column";

        hiddenBar.style.position = "fixed";
        hiddenBar.style.top = "60px";
        hiddenBar.style.right = "25px";
        hiddenBar.style.textAlign = "right";
        hiddenBar.style.backgroundColor = "rgba(9, 9, 21, 0.747)";
    }
    else{
        hiddenBar.style.display = "none";
        hiddenBar.style.position = "static";
        
    }  
})
window.addEventListener("resize", ()=>{
    const viewportWidth = window.innerWidth;
    if (viewportWidth <= 800){
        hiddenBar.style.position = "fixed";
        hiddenBar.style.top = "45px";
        hiddenBar.style.right = "25px";
        hiddenBar.style.textAlign = "right";
        hiddenBar.style.display = "none";      
        }
    else{
        hiddenBar.style.position = "flex";
        hiddenBar.style.display = "flex";
        hiddenBar.style.flexDirection = "row";
        hiddenBar.style.position = "static";
        hiddenBar.style.backgroundColor = "transparent";
    }    
});
