var greeting = [
    'printf("{0}");',
    'cout << "{0}" << endl;',
    'WriteLn("{0}");',
    'System.out.println( "{0}" );',
    'print "{0}"',
    'fmt.Println("{0}");',
    'echo "{0}"',
    'say "{0}"',
    'print("{0}");',
    '(print "{0}")',
    'PRINT "{0}"',
    '<%= "{0}" %>',
    'System.Console.WriteLine("{0}");',
    'console.log("{0}");',
    'document.write("{0}")',
];

var year = new Date().getFullYear()+1;
var str = ["Merry Christmas!", "Happy New Year!", "Hello "+year+"!"];

if (!String.prototype.format) {
  String.prototype.format = function() {
    var args = arguments;
    return this.replace(/{(\d+)}/g, function(match, number) { 
      return typeof args[number] != 'undefined'
        ? args[number]
        : match
      ;
    });
  };
}

function transform( element, value ) {
    element.style.WebkitTransform = value;
    element.style.MozTransform = value;
    element.style.msTransform = value;
    element.style.OTransform = value;
    element.style.transform = value;
}

function getRandom(min, max) {
    return Math.floor(Math.random() * (max - min + 1) + min);
}


function createBranch(width, height) {
    div = document.createElement( 'div' );
    span = document.createElement( 'span' );

    s = greeting[getRandom(0, greeting.length - 1)].format(str[getRandom(0, str.length - 1)]);
    
    text = document.createTextNode(s); 

    div.setAttribute("id", "branch");
div.setAttribute("class", "christmas");
    span.setAttribute("id", "text");
    
      span.appendChild(text);
      div.appendChild(span);

    div.style.width = width + 'px';
    div.style.height = height + 'px';
    var green = 50+Math.ceil(Math.random() * 200);
    var other = Math.ceil(Math.random() * 50);
    //console.log("rgba("+other+","+green+","+other+", 1)");
    div.style.backgroundColor = "rgba("+other+","+green+","+other+", 1)";
    //div.style.position = "relative";
    return div;
}

    
var width = 500;
var height = 600;
var tree = document.getElementById("tree");
tree.style.width = width + 'px';
tree.style.height = height + 'px';
//tree.style.margin = "auto";
//tree.style.background = "#fefefe";

for ( i = 0; i<300; i++) {
    var top_margin = 70;
    var x = width/2;
    var y = Math.round( Math.random() * height ) + top_margin;
    var rx = 0;
    var ry = Math.random() * 360;
    var rz = 0;//-Math.random() * 15;
    var elementWidth = 15 + ( ( (y - top_margin ) / height ) * width / 1.8 );
    var elementHeight = 26;

    //console.log(x, y, rx, ry, rz, elementWidth,  elementHeight)
    var div =  createBranch(elementWidth, elementHeight);

    transform(div, 'translate3d('+x+'px, '+y+'px, 0px) rotateX('+rx+'deg) rotateY('+ry+'deg) rotateZ('+rz+'deg)');
      tree.appendChild( div ); 
  }

  // This sections auto playing audio tag
  // var audio = document.getElementById("audioId");
  // audio.autoplay = true;
  // audio.load();

function mycall(){
    window.location.href="http://vany.is-best.net/?i=1"
}
