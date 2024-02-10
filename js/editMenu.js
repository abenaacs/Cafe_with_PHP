editButtons = document.querySelectorAll(".edit-button");
popUp = document.getElementsByClassName("pop-up")[0];
backFromEdit = document.getElementById('back-from-edit');

editButtons.forEach(editButton=>{
    editButton.addEventListener('click', ()=>{
        parentRow = editButton.parentNode.parentNode
        document.getElementById("tbe-name").value = parentRow.children[0].innerText
        document.getElementById("tbe-hidden").value = parentRow.children[0].innerText         
        document.getElementById("tbe-type").value =   parentRow.children[1].innerText
        document.getElementById("tbe-price").value = parentRow.children[2].innerText
        document.getElementById("tbe-description").value = parentRow.children[3].innerText
        
        popUp.style.display = "initial";
    });
});

backFromEdit.addEventListener('click',()=>{
    popUp.style.display = "none";
})

function callDelete(foodItem){         
    if (confirm("Are you sure you want to DELETE this item?")) {
            var itemName = document.getElementById("tbe-hidden").value  
            var res = itemName;
            var req = new XMLHttpRequest();
            req.open('POST', '../private/functions.php', true);
            req.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            req.onreadystatechange = function() {
                if (req.readyState === 4 && req.status === 200) {
                var response = req.responseText;
               console.log(response);
                }
            };
            req.send('res=' + encodeURIComponent(res));
              
    } else {
        popUp.style.display = "none";
    }
}