document.addEventListener("DOMContentLoaded",function(){
    const btnkomen = document.querySelectorAll(".comment-icon")
    btnkomen.forEach(button => {button.addEventListener("click",function(){

        const postid = this.getAttribute("data-id")
        const commentseccion = document.getElementById(`commentSection-${postid}`)

        commentseccion.style.display = commentseccion.style.display === "block" ? "none" : "block";
    });
    })
});

// edit komen
function openeditkomen() {
    document.getElementById("editblog").classList.add("show");
    document.getElementById("modalOverlay").classList.add("show");
}

function closeeditkomen() {
    document.getElementById("editblog").classList.remove("show");
    document.getElementById("modalOverlay").classList.remove("show");
}
