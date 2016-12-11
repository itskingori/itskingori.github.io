// +++ SHIFTING COLORS ~ Chameleon
var Chameleon = {};
Chameleon.noOfColors = 10; // should be in CSS, with the transitions
Chameleon.duration = 5;    // should match the transition duration in css

Chameleon.init = function() {

  // Check if we support CSS transitions on the browser
  if ( Modernizr.csstransitions ) {

    // Grab the elements, we will be using it a lot
    Chameleon.bodyElement = $('body');
    Chameleon.logoElement = $('header a#logo');

    // ~~ faster than Math.floor() -> http://rocha.la/JavaScript-bitwise-operators-in-practice
    Chameleon.colorT = ~~(Math.random()*Chameleon.noOfColors);
    Chameleon.changeColor();
  }
}

Chameleon.changeColor = function() {
  Chameleon.bodyElement.removeClass( 'color' + Chameleon.colorT % Chameleon.noOfColors );
  Chameleon.logoElement.removeClass( 'bkgcolor' + Chameleon.colorT % Chameleon.noOfColors );
  Chameleon.colorT++;
  Chameleon.bodyElement.addClass( 'color' + Chameleon.colorT % Chameleon.noOfColors );
  Chameleon.logoElement.addClass( 'bkgcolor' + Chameleon.colorT % Chameleon.noOfColors );
  setTimeout( Chameleon.changeColor, Chameleon.duration * 1000 );
};

// +++ SYNTAX HIGHLIGHTER
var SyntaxHighlighter = {};
SyntaxHighlighter.init = function() {
  $('div.p-content > div.highlighter-rouge').each(function(i, e) {hljs.highlightBlock(e)});
}

// +++ NProgress
$(document).on('page:fetch',   function() {
  NProgress.start();
});
$(document).on('page:change',  function() {
  NProgress.done();
  Chameleon.init();
  SyntaxHighlighter.init();
});
$(document).on('page:restore', function() {
  NProgress.remove();
  Chameleon.init();
  SyntaxHighlighter.init();
});
