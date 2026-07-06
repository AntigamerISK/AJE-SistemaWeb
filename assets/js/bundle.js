(function ($) {
  "use strict";

  const GROGIN_SITE = {
    init() {
      this.dom();
      this.themeCategoriesMenu();
      this.themeHeaderCategoriesHolder();
      this.themeSearchOverlay();
      this.themeModalSelector();
      this.themeDrawerAnimation();
      this.themeMobileMenu();
      this.themeMyAccountMenu();
      this.minicartmobile();
	  this.themeCategoriesDrawer();
    },
    dom() {
      this.body = document.body;
      this.drawerMenu = document.querySelector('.site-menu-drawer');
      // Header selectors
      const header = document.querySelector('.site-header');
      const gliobalNotification = document.querySelector('.global-notification');
      // Mobile navbar selector
      const mobileNavbar = document.querySelector('.site-mobile-navbar');

      // Controls the scrollbar
      $.fn.hasScrollBar = function() {
        return this.get(0).scrollHeight > this.height();
      }

      // Set header height
      const setHeaderHeight = () => {
        if (gliobalNotification !== null) {
          return header.clientHeight + gliobalNotification.clientHeight;
        }
        return header.clientHeight;
      }
      window.addEventListener("load", setHeaderHeight);
      window.addEventListener("resize", setHeaderHeight);
      
      // Get header height
      const getHeaderHeight = () => {
        const getHeagederHeightItem = document.querySelectorAll('.get-header-height');
        if (getHeagederHeightItem !== null || header !== null) {
          for( var i = 0; i < getHeagederHeightItem.length; i++ ) {
            getHeagederHeightItem[i].style.cssText = `--header-height: ${setHeaderHeight()}px`;
          }
        }
      }
      window.addEventListener("load", getHeaderHeight);
      window.addEventListener("resize", getHeaderHeight);

      // Site on scroll 
      const onScroll = () => {
        const scroll = document.documentElement.scrollTop;

        if (scroll > setHeaderHeight()) {
          this.body.classList.add('site-has-scroll');
        } else {
          this.body.classList.remove('site-has-scroll');
        }
      }

      window.addEventListener('scroll', onScroll)

      // Set mobile navbar height
      const setMobileNavbar = () => {
        if (mobileNavbar !== null) {
          return mobileNavbar.clientHeight;
        }
      }
      window.addEventListener("load", setMobileNavbar);
      window.addEventListener("resize", setMobileNavbar);

      // Get mobile navbar height
      const getMobileNavHeight = () => {
        const getMobileNavHeightItem = document.querySelectorAll('.get-mobile-nav-height');
        if (getMobileNavHeightItem !== null || mobileNavbar !== null) {
          for( var i = 0; i < getMobileNavHeightItem.length; i++ ) {
            if (getMobileNavHeightItem[i].getAttribute("style")) {
              getMobileNavHeightItem[i].style.cssText = `${getMobileNavHeightItem[i].getAttribute("style")} --mobile-nav-height: ${setMobileNavbar()}px`;
            } else {
              getMobileNavHeightItem[i].style.cssText = `--mobile-nav-height: ${setMobileNavbar()}px`;
            }
          }
        }
      }
      window.addEventListener("load", getMobileNavHeight);
      window.addEventListener("resize", getMobileNavHeight);
    },
    themeCategoriesMenu() {
      const header = document.querySelector('.site-header');
      const container = header.querySelectorAll('.categories-menu');

      if (container !== null) {
        for ( var i = 0; i < container.length; i++ ) {
          const self = container[i];
          const menu = self.querySelector('#category-menu');

          if (menu !== null) {
            const hasChildMenu = menu.querySelectorAll( '.menu-item-has-children' );
            for (var i = 0; i < hasChildMenu.length; i++) {
              const hasItem = hasChildMenu[i];
              const subMenu = hasItem.lastElementChild;

              if (subMenu.classList.contains('sub-menu')) {
                const subParent = subMenu.parentNode;

                if ( subParent.classList.contains( 'has-image' ) ) {
                  const menuWidth = subMenu.offsetWidth;

                  subMenu.style.width = menuWidth + ( menuWidth / 1.5 ) + 'px';
                }

                hasItem.addEventListener('mouseover', (e) => {
                  header.classList.add('category-menu-hover');
                })
        
                hasItem.addEventListener('mouseleave', (e) => {
                  header.classList.remove('category-menu-hover');
                })
              }
            }
          }
        }
      }
    },
    themeHeaderCategoriesHolder() {
      const header = document.querySelector('.site-header');
      const container = header.querySelector('.header-categories-holder');

      if (container !== null) {
        const categoriesMenu = container.querySelector('.site-categories');
        const button = document.querySelector('.categories-button');
        const categoriesClose = container.querySelector('.close-button');
        const categoriesOverlay = container.querySelector('.categories-holder-overlay');
        const hasChild = categoriesMenu.querySelectorAll('.menu-item-has-children');


        if (hasChild.length !== 0) {

          hasChild[0].classList.add('focus');

          for ( var i = 0; i < hasChild.length; i++ ) {
            const self = hasChild[i];

            self.addEventListener('mouseover', (e) => {
              self.classList.add('active');
            })
    
            self.addEventListener('mouseleave', (e) => {
              self.classList.remove('active');
            })
          }
        }

        if (button !== null) {
          button.addEventListener('click', (e) => {
            e.preventDefault();
            container.classList.add('active');
          })
        }

        if (categoriesClose !== null || categoriesOverlay !== null) {
          [categoriesClose, categoriesOverlay].forEach((element) => {
            element.addEventListener('click', (e) => {
              e.preventDefault();
              container.classList.remove('active');
            })
         });
        }
      }
    },
    themeSearchOverlay() {
      const header = document.querySelector('.site-header');
      const container = header.querySelectorAll('.search-overlay');

      if (container !== null) {
        for( var i = 0; i < container.length; i++ ) {
          const self = container[i];
          const input = self.querySelector( '.search-input' );

          input.addEventListener('focus', () => {
            self.classList.add( 'is-searchable' );
            header.classList.add( 'search-overlay-focus' );
          })

          input.addEventListener('blur', () => {
            setTimeout(() => {
              self.classList.remove( 'is-searchable' );
              header.classList.remove( 'search-overlay-focus' );
            }, 100);
          })
        }
      }
    },
    themeModalSelector() {
      const modalButton = document.querySelectorAll('.modal-button');

      if (modalButton !== null) {
        for( var i = 0; i < modalButton.length; i++ ) {
          const self = modalButton[i];
          const modalName = self.dataset.modal;
          const currentModal = document.getElementById(modalName);
          const closeModal = currentModal.querySelector('.close-button');
          const modalOverlay = currentModal.querySelector('.site-modal-overlay');

          self.addEventListener('click', (e) => {
            e.preventDefault();
            currentModal.classList.add('active');
          })

          if (closeModal !== null || modalOverlay !== null) {
            [closeModal, modalOverlay].forEach((element) => {
              element.addEventListener('click', (e) => {
                e.preventDefault();
                currentModal.classList.remove('active');
              })
           });
          }
        }
      }
    },

    themeDrawerAnimation() {
      // Drawer selectors
      this.drawerButton = document.querySelectorAll('.menu-drawer-toggle');
      this.drawerClose = this.drawerMenu.querySelector('.close-button');
      this.drawerActiveAnimation = gsap.to({}, {});

      // Drawer animation
      const drawerButtonClicked = (e, anim) => {
        e.preventDefault();
        this.body.classList.remove('site-menu-drawer-active', 'site-categories-drawer-active', 'site-search-drawer-active');
        this.drawerButton.forEach((button) => {
          button.classList.remove('active');
        });
        if (anim != this.drawerActiveAnimation) {
          this.drawerActiveAnimation.reverse();
          this.drawerActiveAnimation = anim;
          this.drawerActiveAnimation.play();
          e.target.closest('.menu-drawer-toggle').classList.add('active');
          this.body.classList.add(`${e.target.closest('.menu-drawer-toggle').dataset.drawer}-active`);
        } else {
          this.drawerActiveAnimation.reversed() ? this.drawerActiveAnimation.play() : this.drawerActiveAnimation.reverse();
          this.drawerActiveAnimation = gsap.to({}, {});
        }
      }

      this.drawerButton.forEach((button) => {
        let item = document.querySelector(`.${button.dataset.drawer}`);
		if (item !== null) {
	        const drawerInner = item.querySelector('.site-drawer-inner');
	        const drawerOverlay = item.querySelector('.site-drawer-overlay');
	        let tl = gsap.timeline({ paused: true, reversed: true });
	
	        tl.to(item, .1, {
	          autoAlpha: 1
	        }).to(drawerInner, .5, {
	          x:0,
	          ease: 'power4.inOut'
	        }, "-=.1").to(drawerOverlay, .5, {
	          autoAlpha: 1
	        }, "-=.5")
	
	        button.anim = tl;
	        button.addEventListener('click', (e) => {
	          drawerButtonClicked(e, button.anim)
	        });
		}
      });

      this.drawerClose.addEventListener('click', (e) => {
        e.preventDefault();
        this.body.classList.remove('site-menu-drawer-active', 'site-categories-drawer-active', 'site-search-drawer-active');
        this.drawerActiveAnimation.reverse();
        this.drawerActiveAnimation = gsap.to({}, {});
      });
    },
    themeMobileMenu() {
      if (this.drawerMenu !== null) {
        const hasChildren = this.drawerMenu.querySelectorAll( '.menu-item-has-children' );
        const subMenu = ( e ) => {
          let subUl;
          if ( e.target.tagName === 'A' ) {
            e.preventDefault();
            subUl = e.target.nextElementSibling;
          } else {
            subUl = e.target.previousElementSibling;
          }
          let parentUl = e.target.closest( 'ul' );
          let parentLi = e.target.closest( 'li' );
          let activeLi = parentUl.querySelectorAll( '.menu-item-has-children.active' );

          const closeSubs = () => {
            for ( var i = 0; i < activeLi.length; i++ ) {
              const activeSub = activeLi[i].children[1];
              const childSubs = activeSub.querySelectorAll( '.sub-menu' );
              for ( var i = 0; i < childSubs.length; i++ ) {
                if ( childSubs[i] != null ) {
                  gsap.set( childSubs[i], { height: 0 } );
                }
              }
            }
          }

          const subAnimation = ( element, event ) => {
            gsap.to( element, { duration: .4, height: event, ease: 'power4.inOut', onComplete: closeSubs } );
          }

          if ( !parentLi.classList.contains( 'active' ) ) {
            for ( var i = 0; i < activeLi.length; i++ ) {
              activeLi[i].classList.remove( 'active' );
              const sub = activeLi[i].children[1];
              subAnimation( sub, 0 );
            }
            parentLi.classList.add( 'active' );
            subAnimation( subUl, 'auto' );
          } else {
            parentLi.classList.remove( 'active' );
            subAnimation( subUl, 0 );
          }

        }

        for( var i = 0; i < hasChildren.length; i++ ) {
          const dropdown = document.createElement( 'span' );
          dropdown.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>';
          dropdown.className = 'menu-dropdown';
          hasChildren[i].appendChild( dropdown );

          const link = hasChildren[i].querySelector( 'a[href*="#"]' );
          const sub = hasChildren[i].children[1];
          gsap.set( sub, { height: 0 } );
          dropdown.addEventListener( 'click', subMenu );
		  if (link !== null) {
          link.addEventListener( 'click', subMenu );
		  }
        }
      }
    },
    themeMyAccountMenu() {
      const button = document.querySelector('.user-menu-toggle a');
      const accountMenu = document.querySelector('.my-account-navigation');

      if (button !== null || accountMenu !== null) {
        button.addEventListener('click', (e) => {
          e.preventDefault();
          accountMenu.classList.toggle('active');
        })
      }
    },

    minicartmobile() {
	  if($(window).width() < 601){
		  var button = $( '.site-header .mini-cart-button > a.action-link' );

		  button.on( 'click', function(e) {
			e.preventDefault();
			if($( '.site-header .mini-cart-button .mini-cart-holder' ).hasClass('hide')){
				$( '.site-header .mini-cart-button .mini-cart-holder' ).removeClass( 'hide' );
			} else {
				$( '.site-header .mini-cart-button .mini-cart-holder' ).addClass( 'hide' );
			}
		  });
	  }
    },

    themeCategoriesDrawer() {
      const container = document.querySelector('.site-categories-drawer');

      if (container !== null) {
        const subMenu = container.querySelectorAll(".menu-item-has-children");
        if (subMenu !== null) {
          for ( var i = 0; i < subMenu.length; i++ ) {
            const self = subMenu[i];

			const subMenuLink = self.querySelector(':scope > a');
            subMenuLink.addEventListener('click', (event) => {
              event.preventDefault();
              if (event.target.closest('LI').classList.contains('active')) {
                event.target.closest('LI').classList.remove("active");
              } else {
                (container.querySelector('.menu-item-has-children.active')) ? container.querySelector('.menu-item-has-children.active').classList.remove('active') : '';
                event.target.closest('LI').classList.toggle("active");
              }
            });
          }
        }
      }
    }

  }

  GROGIN_SITE.init();
  
	$(document).ready(function() {
		$('.categories-menu a.categories-toggle').on('click', function (e) {
			e.preventDefault();
			$(".site-categories").collapse('toggle');
		});
	});
	
	$(window).load(function(){
		$('.site-loading').fadeOut('slow',function(){$(this).remove();});
	});
	
	$(window).scroll(function() {
        $(this).scrollTop() > 135 ? $("header.site-header").addClass("sticky-header") : $("header.site-header").removeClass("sticky-header")
    });
	
}(jQuery));