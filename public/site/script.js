
    document.querySelectorAll('.nav-link').forEach(link => {
        link.addEventListener('click', function () {
            document.querySelectorAll('.nav-link').forEach(nav => {
                nav.classList.remove('active-link');
            });
            this.classList.add('active-link');
        });
    });


    
//
// Bootstrap Carousel Effect Ken Burns
// =============================================================================



function ready(fn) {
  if (document.readyState != "loading") {
    fn();
  } else {
    document.addEventListener("DOMContentLoaded", fn);
  }
}

ready(() => {
  // --- Function to add and remove CSS animation classes
  function doAnimations(elems) {
    const animEndEv = "animationend";

    elems.forEach((elem) => {
      elem.classList.add("animate__animated", "animate__flipInX");
      elem.addEventListener(animEndEv, () => {
        elem.classList.remove("animate__animated", "animate__flipInX");
      });
    });
  }

  // --- Variables on page load
  const carouselKenBurns = document.querySelector("#carouselKenBurns");
  const firstAnimatingElems = Array.from(
    carouselKenBurns
      .querySelector(".carousel-item:first-child")
      .querySelectorAll("[data-animation^='animated']")
  );

  // --- Animate captions in the first slide on page load
  doAnimations(firstAnimatingElems);

  // --- Other slides to be animated on carousel slide event
  carouselKenBurns.addEventListener("slid.bs.carousel", (e) => {
    const animatingElems = Array.from(
      e.relatedTarget.querySelectorAll("[data-animation^='animated']")
    );
    doAnimations(animatingElems);
  });
});



// Function to make the navbar fixed on scroll
function stickyNavbar() {
    const navbar = document.querySelector(".targetimge"); // Select your navbar
    const navbar1 = document.querySelector(".about-right"); // Select your navbar

    // Get the navbar's offset position
    const specificLength = 320;
    // const specificLength1 = 320;

    // Add the "fixed-navbar" class to the navbar when you reach its scroll position
    // Remove the class when you leave the scroll position
    window.onscroll = function () {
        if (window.pageYOffset > specificLength) {
            navbar.classList.add("left-about");
            navbar1.classList.add("about-right-animation");
            console.log(window.pageYOffset);
            
        }
    };

    

}


// Run the function after the DOM is loaded
document.addEventListener("DOMContentLoaded", stickyNavbar); 


var currentValue = 0;
var CounterLimit =1030;

document.addEventListener("DOMContentLoaded", function () {
    var counterElement = document.getElementById("counter");

    if (counterElement) {
        var intervalId = setInterval(updateCounter, 1);
        function updateCounter() {
            if (currentValue < CounterLimit) {
                currentValue++;
                counterElement.innerText = currentValue;
            } else {
                clearInterval(intervalId);
            }
        }
    }
        else{
            console.error("Element with ID 'counter' not found.");
        }
   
})



var currentValue = 0;
var CounterLimit1 =1230;

document.addEventListener("DOMContentLoaded", function () {
    var counterElement = document.getElementById("counter1");

    if (counterElement) {
        var intervalId = setInterval(updateCounter, 1);
        function updateCounter() {
            if (currentValue < CounterLimit1) {
                currentValue++;
                counterElement.innerText = currentValue;
            } else {
                clearInterval(intervalId);
            }
        }
    }
        else{
            console.error("Element with ID 'counter' not found.");
        }
   
})


var currentValue = 0;
var CounterLimit2 =1230;

document.addEventListener("DOMContentLoaded", function () {
    var counterElement = document.getElementById("counter2");

    if (counterElement) {
        var intervalId = setInterval(updateCounter, 1);
        function updateCounter() {
            if (currentValue < CounterLimit2) {
                currentValue++;
                counterElement.innerText = currentValue;
            } else {
                clearInterval(intervalId);
            }
        }
    }
        else{
            console.error("Element with ID 'counter' not found.");
        }
   
})

 
const reviewWrap = document.getElementById("reviewWrap");
const leftArrow = document.getElementById("leftArrow");
const rightArrow = document.getElementById("rightArrow");
const imgDiv = document.getElementById("imgDiv");
const personName = document.getElementById("personName");
const profession = document.getElementById("profession");
const description = document.getElementById("description"); 
const chicken = document.querySelector(".chicken");

let isChickenVisible;

let people = [
    {
        photo:
            'url("./img/t1.jpg")',
        name: "Susan Smith",
        profession: "WEB DEVELOPER",
        description:
            "Cheese and biscuits chalk and cheese fromage frais. Cheeseburger caerphilly cheese slices chalk and cheese cheeseburger mascarpone danish fontina rubber cheese. Squirty cheese say cheese manchego jarlsberg lancashire taleggio cheese and wine squirty cheese. Babybel pecorino feta macaroni cheese brie queso everyone loves gouda. Cheese and biscuits camembert de normandie fromage fromage macaroni cheese"
    },

    {
        photo:
            "url('./img/t2.jpg')",
        name: "Anna Grey",
        profession: "UFC FIGHTER",
        description:
            "I'm baby migas cornhole hell of etsy tofu, pickled af cardigan pabst. Man braid deep v pour-over, blue bottle art party thundercats vape. Yr waistcoat whatever yuccie, farm-to-table next level PBR&B. Banh mi pinterest palo santo, aesthetic chambray leggings activated charcoal cred hammock kitsch humblebrag typewriter neutra knausgaard. Pabst succulents lo-fi microdosing portland gastropub Banh mi pinterest palo santo"
    },

    {
        photo:
            "url('./img/t3.jpg')",
        name: "Branson Cook",
        profession: "ACTOR",
        description:
            "Radio telescope something incredible is waiting to be known billions upon billions Jean-François Champollion hearts of the stars tingling of the spine. Encyclopaedia galactica not a sunrise but a galaxyrise concept of the number one encyclopaedia galactica from which we spring bits of moving fluff. Vastness is bearable only through love paroxysm of global death concept"
    },

    {
        photo:
            "url('./img/t4.jpg')",
        name: "Julius Grohn",
        profession: "PROFESSIONAL CHILD",
        description:
            "Biscuit chocolate pastry topping lollipop pie. Sugar plum brownie halvah dessert tiramisu tiramisu gummi bears icing cookie. Gummies gummi bears pie apple pie sugar plum jujubes. Oat cake croissant bear claw tootsie roll caramels. Powder ice cream caramels candy tiramisu shortbread macaroon chocolate bar. Sugar plum jelly-o chocolate dragée tart chocolate marzipan cupcake gingerbread."
    }
];

imgDiv.style.backgroundImage = people[0].photo;
personName.innerText = people[0].name;
profession.innerText = people[0].profession;
description.innerText = people[0].description;
let currentPerson = 0;

//Select the side where you want to slide
function slide(whichSide, personNumber) {
    let reviewWrapWidth = reviewWrap.offsetWidth + "px";
    let descriptionHeight = description.offsetHeight + "px";
    //(+ or -)
    let side1symbol = whichSide === "left" ? "" : "-";
    let side2symbol = whichSide === "left" ? "-" : "";

    let tl = gsap.timeline();

    if (isChickenVisible) {
        tl.to(chicken, {
            duration: 0.4,
            opacity: 0
        });
    }

    tl.to(reviewWrap, {
        duration: 0.4,
        opacity: 0,
        translateX: `${side1symbol + reviewWrapWidth}`
    });

    tl.to(reviewWrap, {
        duration: 0,
        translateX: `${side2symbol + reviewWrapWidth}`
    });

    setTimeout(() => {
        imgDiv.style.backgroundImage = people[personNumber].photo;
    }, 400);
    setTimeout(() => {
        description.style.height = descriptionHeight;
    }, 400);
    setTimeout(() => {
        personName.innerText = people[personNumber].name;
    }, 400);
    setTimeout(() => {
        profession.innerText = people[personNumber].profession;
    }, 400);
    setTimeout(() => {
        description.innerText = people[personNumber].description;
    }, 400);

    tl.to(reviewWrap, {
        duration: 0.4,
        opacity: 1,
        translateX: 0
    });

    if (isChickenVisible) {
        tl.to(chicken, {
            duration: 0.4,
            opacity: 1
        });
    }
}

function setNextCardLeft() {
    if (currentPerson === 3) {
        currentPerson = 0;
        slide("left", currentPerson);
    } else {
        currentPerson++;
    }

    slide("left", currentPerson);
}

function setNextCardRight() {
    if (currentPerson === 0) {
        currentPerson = 3;
        slide("right", currentPerson);
    } else {
        currentPerson--;
    }

    slide("right", currentPerson);
}

leftArrow.addEventListener("click", setNextCardLeft);
rightArrow.addEventListener("click", setNextCardRight);



window.addEventListener("resize", () => {
    description.style.height = "100%";
});

document.addEventListener("DOMContentLoaded", function() {
  const navBar = document.querySelector('.headerfixed');
  const threshold = 68; // Adjust this value based on when you want the fixed navigation to appear

  window.addEventListener('scroll', function() {
    if (window.scrollY > threshold) {
      navBar.classList.add('fixed');
    } else {
      navBar.classList.remove('fixed');
    }
  });
})