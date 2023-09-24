console.log("F.W Meier by ReachNext GmbH - (C) Hasaan Latif");

var Theme = {};

//Init Theme and Modules
Theme.init = function () {
  Theme.initMenu();
  Theme.registerSections();
  Theme.initMobileSliders();
  Theme.setGlobals();
  Theme.initHeader();
  setTimeout(() => {
    Theme.animate();
  }, "600");

};

Theme.initMenu = function () {
    let mobileMenuParent = document.querySelector("[data-mobile-parent]");
    let mobileButton = mobileMenuParent.querySelector("[data-menu-button]");
    let mobileMenuSlide = mobileMenuParent.querySelector("[data-mobile-menu]");
    let mobileMenuItems = mobileMenuSlide.querySelectorAll("[data-animate]");
    let _this = this;
  
    mobileButton.addEventListener("click", function () {
      mobileButton.classList.toggle("opened");
      mobileButton.setAttribute("aria-expanded", mobileButton.classList.contains("opened"));
  
      let screenHeight = window.innerHeight;
      let menuHeight = mobileMenuParent.clientHeight;
  
      if (screenHeight - menuHeight === 0) {
        mobileMenuItems.forEach((item, index) => {
          item.classList.add('hidden-menu');
          item.classList.remove('menu-item');
        });
      } else {
        mobileMenuItems.forEach((item, index) => {
          setTimeout(() => {
            item.classList.remove('hidden-menu');
            item.classList.add('menu-item');
          }, index * 300);
        });
      }
  
      mobileMenuSlide.style.height = screenHeight - menuHeight + "px";
    });
  };


Theme.initHeader = function(){
  var header = document.getElementById('header');
  var height = header.scrollHeight;
  this.addedClass = false;
  window.addEventListener('scroll',function(){
    if(!this.addedClass){
      if((height + 200) < window.scrollY){
        header.classList.add('header-visible');
        this.addedClass = true;
      }
    }
    if(this.addedClass){
      if(window.scrollY < 0 || window.scrollY === 0){
        header.classList.remove('header-visible');
        this.addedClass = false;
      }
    }

  }, true);
}

Theme.initMobileSliders = function(){
  var mobileSliders = document.querySelectorAll('[data-flickity-mobile]');
  mobileSliders.forEach((slider) => {
    var options = JSON.parse(slider.getAttribute('data-flickity-mobile'));
    Theme.slider(slider,options,true);
  })
}
  

Theme.registerSections = function () {
  let sections = document.querySelectorAll("[data-section-type]");
  sections.forEach((section) => {
    let sectionType = section.getAttribute("data-section-type");
    if (!Theme.sections[sectionType]) {
      console.log(sectionType + " does not exist as dynamic Section");
      return;
    }
    Theme.sections[sectionType].init(section);
  });
};

Theme.getScreenwidth = function(){
    const breakpoints = {
        sm: 640,
        md: 768,
        lg: 1024,
        xl: 1280,
        '2xl': 1536,
      };
    
      const screenWidth = window.innerWidth;
    
      let screenSize = 'sm';
    
      // Check the breakpoints in ascending order
      for (const key in breakpoints) {
        const breakpointWidth = breakpoints[key];
        if (screenWidth >= breakpointWidth) {
          screenSize = key;
        } else {
          break;
        }
      }
    
      return screenSize;
}



Theme.minScreenSize = function(screenSizes){
    const screenSize = Theme.getScreenwidth();
    return screenSizes.includes(screenSize);
  }

Theme.setGlobals = function () {
  var navHeight = document.querySelector("[data-nav]").clientHeight;
  if (navHeight) {
    let root = document.documentElement;
    root.style.setProperty("--NavHeight", navHeight + "px");
  }
};

Theme.sections = {
  herologos: {
    init: function (section) {
        this.options = {
            cellAlign: "left",
            wrapAround: true,
            autoPlay: 2500,
            imagesLoaded: true,
            pageDots: false,
            prevNextButtons: false
        }
        let slider = new Theme.slider(section.querySelector(".slider"),this.options);
       
    },
  },
  whatwedo: {
    init: function (section) {
    this.options = {
        cellAlign: "left",
        wrapAround: true,
        imagesLoaded: true,
        prevNextButtons: false
    }
    const breakpointsToCompare = ['md', 'lg', 'xl', '2xl'];
    if(!Theme.minScreenSize(breakpointsToCompare)){
       this.slider = new Theme.slider(section.querySelector(".slider"),this.options);
    }
    }, 
  },
  services:{
    init: function (section) {
        this.options = {
            cellAlign: "left",
            wrapAround: true,
            imagesLoaded: true,
            prevNextButtons: false
        }
        const breakpointsToCompare = ['md', 'lg', 'xl', '2xl'];
        if(!Theme.minScreenSize(breakpointsToCompare)){
           this.slider = new Theme.slider(section.querySelector(".slider"),this.options);
        }
    }
  },
  review: {
    init: function (section) {
      let that = this;
      var triggerButton = section.querySelector("[data-trigger-invitation]");
      triggerButton.addEventListener("click", function () {
        that.sendInvite();
      });
    },
    sendInvite: function () {
      console.log("Sending Invite");
      if (tp) {
        const trustpilot_invitation = {
          recipientEmail: "create@timihne.com",
          recipientName: "Tim Ihne",
          referenceId: "Tim Ihne Test",
          source: "InvitationScript",
        };
        tp("createInvitation", trustpilot_invitation);
      }
    },
  },
  leistungen: {
    init: function (section) {
      let that = this;
      that.sliderparent = section.querySelector('[data-flickity-config]');
      that.options = JSON.parse(that.sliderparent.getAttribute('data-flickity-config'));

      that.options.on = {
        ready: function(){
          setTimeout(function(){
            var icons = section.querySelectorAll('.leistungsicon[data-desktop]');

            if(window.innerWidth < 768){
            var icons = section.querySelectorAll('.leistungsicon[data-mobile]');
            }

            icons.forEach((icon) =>{
              if(window.innerWidth < 768){
                icon.classList.add('absolute');
              }
              icon.style.display = 'flex';

          });
        }, 1000);
        window.dispatchEvent(new Event('resize'));

        }
      }
      that.slider = new Flickity(that.sliderparent,that.options);

      var prevButtons = section.querySelectorAll('[data-slide-prev]');
      prevButtons.forEach((button) => {
        button.addEventListener('click', function(){
          that.slider.previous();
        });
      });

      var nextButtons = section.querySelectorAll('[data-slide-next]');
      nextButtons.forEach((button) => {
        button.addEventListener('click', function(){
          that.slider.next();
        });
      })
    },
  },
  projects:{
    init: function(section){
      var loadmoreButton = section.querySelector('[data-showmore]');

      if(loadmoreButton){
        loadmoreButton.addEventListener('click', function(){
          console.log('clicked');
          
          var show = section.querySelectorAll('a.hidden');
          console.log(show);

          show.forEach((element,index) => {
              if (index > 2){
                return
              }
              element.style.display = 'flex';
          });
          
      });
      }

    }
  },
  countup:{
    init:function(section){
      var counters = section.querySelectorAll('[data-counter]');
      function inViewport( element ){   
        var bb = element.getBoundingClientRect(); 
        return !(bb.top > (innerHeight/1.5) || bb.bottom < 0);   
      }

      window.addEventListener('scroll', function(){
        if(inViewport(section)){
          console.log('IS in wievprot');
          animateSection(counters,section);
        }
      },true);

      function animateSection(counterItems,section){
        if (section.getAttribute('done')){
          return
        }
        section.setAttribute('done',true);
        counterItems.forEach((element)=>{
          element.textContent = "0+";

          var goal = parseInt(element.getAttribute('data-counter'));
          for (var i=1;i<=10; i++) {
            (function(index) {
              setTimeout(function() { 
                element.textContent = parseInt(goal/(11-index)) + '+';
              }, i * 50);
          })(i);
          }

        });



      }
    }
  }
};

//Slider Constructor
Theme.slider = function (element,options, isOnlyMobile) {
  if(isOnlyMobile){
    console.log('only mobile');
    console.log(window.innerWidth);
    if(window.innerWidth < 768){

    console.log('only mobile slider');
    var flkty = new Flickity(element, options);
    window.addEventListener('resize', function(){
        if(window.innerWidth > 768){
        flkty.destroy();
      }
    })
    return flkty;
  }
  }else{
    var flkty = new Flickity(element, options);
    return flkty;
  }
};


Theme.animate = function(){
  var classes = "svg-100";
  classes.split(',').forEach((classString) => {
    document.querySelectorAll('.'.concat(classString)).forEach((element) => {
      element.classList.add('animated');
    }
    )
  })
}


window.addEventListener("DOMContentLoaded", function () {
    Theme.init();
});
