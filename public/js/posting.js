document.addEventListener("DOMContentLoaded",function(){
    const btnkomen = document.querySelectorAll(".comment-icon")
    btnkomen.forEach(button => {button.addEventListener("click",function(){

        const postid = this.getAttribute("data-id")
        const commentseccion = document.getElementById(`commentSection-${postid}`)

        commentseccion.style.display = commentseccion.style.display === "block" ? "none" : "block";
    });
    })
});

function toggleDropdown(id) {
    let dropdown = document.getElementById("dropdown-" + id);

    // Tutup semua dropdown sebelum membuka yang diklik
    document.querySelectorAll(".dropdown-menu").forEach(menu => {
        if (menu !== dropdown) {
            menu.style.display = "none";
        }
    });

    // Tampilkan atau sembunyikan dropdown yang diklik
    dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
}

// Menutup dropdown jika klik di luar
document.addEventListener("click", function (event) {
    if (!event.target.closest(".header2")) {
        document.querySelectorAll(".dropdown-menu").forEach(menu => {
            menu.style.display = "none";
        });
    }
});

// tambah blog// Fungsi untuk membuka modal tambah blog
function opentambahblog() {
    document.getElementById("tambahblog").classList.add("show");
    document.getElementById("modalOverlay").classList.add("show");
}

// Fungsi untuk menutup modal
function closetambahblog() {
    document.getElementById("tambahblog").classList.remove("show");
    document.getElementById("modalOverlay").classList.remove("show");
}


// edit blog
function openeditblog(id) {
    document.getElementById("editModal-" + id).classList.add("show");
    document.getElementById("modalOverlay").classList.add("show");
}

function closeeditblog() {
    document.querySelectorAll(".edit-modal").forEach(modal => modal.classList.remove("show"));
    document.getElementById("modalOverlay").classList.remove("show");
}

