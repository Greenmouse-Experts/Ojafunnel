
// Header//
const nav = document.querySelector('.header')
  fetch('/Header.html')
  .then(res=>res.text())
  .then(data=>{
      nav.innerHTML=data
      const parser = new DOMParser()
      const doc = parser.parseFromString(data, 'text/html')
      eval(doc.querySelector('script').textContent)
  })
// Header Ends//


// Footer//
// const footer = document.querySelector('.footer')
//   fetch('/footer.html')
//   .then(res=>res.text())
//   .then(data=>{
//     footer.innerHTML=data
//       const parser = new DOMParser()
//       const doc = parser.parseFromString(data, 'text/html')
//       eval(doc.querySelector('script').textContent)
//   })
  // Footer Ends//

///

const header = document.querySelector("header");
const sectionOne = document.querySelector("");

const sectionOneOptions = {
  rootMargin: "-200px 0px 0px 0px"
};

const sectionOneObserver = new IntersectionObserver(function(
  entries,
  sectionOneObserver
) {
  entries.forEach(entry => {
    if (!entry.isIntersecting) {
      header.classList.add("");
    } else {
      header.classList.remove("funtion");
    }
  });
},
sectionOneOptions);

sectionOneObserver.observe(sectionOne);

//// Scroll Functions/
 
//// Scroll Functions/



