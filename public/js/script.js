//navbar
let lastScrollTop = 0;
navbar= document.getElementById('navbare');

window.addEventListener('scroll', function (){
    const scrollTop = window.pageYOffset || 
    this.document.documentElement.scrollTop;

    if (scrollTop > lastScrollTop){
        navbar.style.top="-78px";
        
    }else{
        navbar.style.top="0";
    }
    lastScrollTop = scrollTop;
})

// feedback
const feedbackItems = document.querySelectorAll('.feedback-item');
const feedbackBtns = document.querySelectorAll('.feedback-btn');
const feedbackDisplay = document.querySelector('#feedback-display');

let activeId = 1;
changeFeedback(activeId);
function changeFeedback(id){
    feedbackItems.forEach((item) => {
             
        if(id == item.dataset.id){
            // swapping data id
            [feedbackDisplay.dataset.id, item.dataset.id] = [item.dataset.id, feedbackDisplay.dataset.id];
            // swapping the innder content
            [feedbackDisplay.innerHTML, item.innerHTML] = [item.innerHTML, feedbackDisplay.innerHTML];
            // swapping quote image
            [feedbackDisplay.querySelector('img').src, item.querySelector('img').src] = [item.querySelector('img').src, feedbackDisplay.querySelector('img').src];
        }
    });
}

feedbackBtns.forEach((btn, index) =>{
    btn.addEventListener('click', () => {
        activeId = index + 1;
        feedbackBtnReset();
        btn.classList.add('feedback-active-btn');
        changeFeedback(activeId);
       
    });
     
});
// feedbackBtns.addEventListener('click', ()=>{
//     console.log('hello');
// })
function feedbackBtnReset(){
    feedbackBtns.forEach((btn) => {
        btn.classList.remove('feedback-active-btn');
    });
}

// init Isotope
var $grid = $('.collection-list').isotope({
    // options
  });
  // filter items on button click
  $('.filter-button-group').on( 'click', 'button', function() {
    var filterValue = $(this).attr('data-filter');
    resetFilterBtns();
    $(this).addClass('active-filter-btn');
    $grid.isotope({ filter: filterValue });
  });
  
  var filterBtns = $('.filter-button-group').find('button');
  function resetFilterBtns(){
    filterBtns.each(function(){
      $(this).removeClass('active-filter-btn');
    });
  }

//typed
var typed = new Typed('.typed', {
    strings: [
        'Bonjour à toutes et à tous, je me presente je m\'apelle Omar, aprés une carière m\'ayant fait découvrir plusieurs milieux professionels et exercer plus de 4 metiers différentes . j\ai décidé de me reconvertir en développement web'

    //   'My strings are: <i>strings</i> with',
    //   'My strings are: <strong>HTML</strong>',
    //   'My strings are: Chars &times; &copy;'
    ],
    typeSpeed: 30,
    
  });

  //compteur live
//   let compteur =0;
//   $(window).scroll(function(){
//       const top =$('.counter').offset().top - window.innerHeight;

//       if (compteur==0 && $(window).scrollTop()> top){
//           $('.data-value').each(function(){
//               let $this = $(this),
//               countTo= $this.attr('data-count');
//               $({
//                   countNum:$this.text()
//               }).animate({
//                   countNum: countTo
//               },
//               {
//                   duration:10000,
//                   easing:'swing',
//                   step: function(){
//                       $this.text(Math.floor(this.countNum));
//                   },
//                   complete:function(){
//                       $this.text(this.countNum)
//                   }
//               });
//           });
//           compteur = 0;
//       }
//   });


  //AOS
  AOS.init();