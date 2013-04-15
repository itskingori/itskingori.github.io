/* FOR THE PEEPING TOMS */
debug.debug('You like peeking under the hood don\'t you?',
			'... twitter\'s @itsmrwave',
			'... email\'s j@kingori.co');

/* SYNTAX HIGHLIGHTER */
function path()
{
  var args = arguments,
      result = []
      ;
       
  for(var i = 0; i < args.length; i++)
      result.push(args[i].replace('@', 'plugins/syntax-highlighter/js/'));
       
  return result
};
 
SyntaxHighlighter.autoloader.apply(null, path(
  'applescript            @shBrushAppleScript.js',
  'actionscript3 as3      @shBrushAS3.js',
  'bash shell             @shBrushBash.js',
  'coldfusion cf          @shBrushColdFusion.js',
  'cpp c                  @shBrushCpp.js',
  'c# c-sharp csharp      @shBrushCSharp.js',
  'css                    @shBrushCss.js',
  'delphi pascal          @shBrushDelphi.js',
  'diff patch pas         @shBrushDiff.js',
  'erl erlang             @shBrushErlang.js',
  'groovy                 @shBrushGroovy.js',
  'java                   @shBrushJava.js',
  'jfx javafx             @shBrushJavaFX.js',
  'js jscript javascript  @shBrushJScript.js',
  'perl pl                @shBrushPerl.js',
  'php                    @shBrushPhp.js',
  'text plain             @shBrushPlain.js',
  'py python              @shBrushPython.js',
  'ruby rails ror rb      @shBrushRuby.js',
  'sass scss              @shBrushSass.js',
  'scala                  @shBrushScala.js',
  'sql                    @shBrushSql.js',
  'vb vbnet               @shBrushVb.js',
  'xml xhtml xslt html    @shBrushXml.js'
));
SyntaxHighlighter.defaults['toolbar'] = false;
SyntaxHighlighter.all();

/* SHIFTING COLORS ~ Chameleon */

// Initialize object
var Chameleon = {};

Chameleon.noOfColors = 10; // should be in CSS, with the transitions
Chameleon.duration = 5; // should match the transition duration in css

Chameleon.init = function() {

  // Check if we support CSS transitions on the browser
  if ( Modernizr.csstransitions ) {

    // Grab the elements, we will be using it a lot
    Chameleon.bodyElement = $("body");
    Chameleon.logoElement = $("header a.logo");

    // ~~ faster than Math.floor() -> http://rocha.la/JavaScript-bitwise-operators-in-practice
    Chameleon.colorT = ~~(Math.random()*Chameleon.noOfColors);
    Chameleon.changeColor();
  }
  else {
    // Defaults to @orange and @skyblue on hover if we aren't doing this/done
    // also to prevent orange flash ... set it here instead
    $("header a.logo").css("background-color","#F77C0F");
  }
  
}

// Switch colors
Chameleon.changeColor = function() {
  Chameleon.bodyElement.removeClass( 'color' + Chameleon.colorT % Chameleon.noOfColors );
  Chameleon.logoElement.removeClass( 'bkgcolor' + Chameleon.colorT % Chameleon.noOfColors );
  Chameleon.colorT++;
  Chameleon.bodyElement.addClass( 'color' + Chameleon.colorT % Chameleon.noOfColors );
  Chameleon.logoElement.addClass( 'bkgcolor' + Chameleon.colorT % Chameleon.noOfColors );
  setTimeout( Chameleon.changeColor, Chameleon.duration * 1000 );
};

// Get ready, set ... GO!
Chameleon.init();