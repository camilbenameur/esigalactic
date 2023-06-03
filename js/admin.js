const images = document.querySelectorAll("img");
const meme = document.querySelector(".meme");
const txt = document.querySelector(".texte");

for (let i = 0; i < images.length; i++) {
  images[i].addEventListener("click", function() {
    console.log("hello world");
  });
}

meme.addEventListener("mouseover", function() {
    txt.style.opacity = "1";
});

meme.addEventListener("mouseout", function() {
    txt.style.opacity = "0";
});


