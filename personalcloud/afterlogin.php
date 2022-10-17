
<!--<script>              COOKIES IF NECESSARY
 
let url = new URL(window.location.href);
let searchParams = new URLSearchParams(url.search);
let cookie = searchParams.get('folderid')

document.cookie = `folderid = ${cookie}`;

</script>-->
<?php
 
//$folderid =  $_COOKIE["folderid"];           //GETTING COOKIE VARIABLE IN PHP

//$folderIDvariable = $_GET['folderid'];
$folderIDvariable = "admin";
// GETTING THE VARIABLE FROM THE .TXT FILE
//$name = file_get_contents('D:/XAMPP/htdocs/folderID.txt');

// CALCULATING THE FILE SIZE FROM BYTES INTO KB/MB/GB
$size = filesize("D:/XAMPP/htdocs/cloud/$folderIDvariable.zip") + 500;

    if ($size > 1024) {
        $temporary = floor($size / 1024);
        $final = "$temporary Kb";     
    }
    if ($size > 1000000) {
        $temporary = floor($size / 1024 / 1024);
        $final = "$temporary Mb"; 
    }
    if ($size > 1073741824) {
        $temporary = floor($size / 1024 / 1024 / 1024);
        $final = "$temporary Gb"; 
    }

    // DELETING THE TEMPORARY .TXT FILE   ----- NEED TO UPGRADE THIS FOR COOKIE VERSION
    //$filename = 'folderID.txt';
    //unlink($filename);
?>

<html>
    <body>
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="stylecloud.css">

        <!-- BACKGROUND DIVS------------------------------------------------ -->
        <div class="relative bg-black stars-container">
          <div id="stars"></div>
          <div id="stars2"></div>
          <div id="stars3"></div>
        </div>
        <!-- -------------------------------------------------------- -->



        <!-- NAVBAR ------------------------------------------------ -->
        <nav class="navbar navbar-expand-md navbar-dark" style="background-color: #212529; ">
    <a class="navbar-brand" href="index.php" style="margin-left:10px;">Rocket Link</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse nav justify-content-end" style="padding-right:50px;" id="navbarNavAltMarkup">
            <div class="navbar-nav">
            <a class="nav-item nav-link" href="/log in/index.html">Log in</a>
            <a class="nav-item nav-link navbar-right" href="#">Contact</a>
            </div>
        </div>
    </nav>
      <!-- -------------------------------------------------------- -->
    
      <!-- CONTENT OF A PAGE --------------------------------------- -->
        <div id="canvas-wrap">

            <canvas id="canvas"></canvas>   

            <div class="container col-md-12">

            

            <div id="overlay" style="top: 15px; margin-left:425;"> <!--61px left    or margin-left:auto;margin-right:auto;-->
                <div class="card text-light bg-dark" style="text-align: center; height: 657px; font-size:10pt; overflow-y: auto; width: 32rem; display:flex; flex-direction:column-reverse;"> <!-- THIS KEEPS A PAGE ALWAYS SCROLLED DOWN  "display:flex; flex-direction:column-reverse; " -->
                  <div id="card-body" class="card-body ">

                <!--<h1>Hello, var is: < ?php echo $_GET['folderid'];?></h1>-->
                <div>
                  <img src="/image_files/astready.gif" alt="" width="185" style="margin-left:20px; padding-top:10px;">
                  <div style="padding-top:30px ;"><h3>ALL READY!</h3></div>
                </div>
                <div id="files" style="font-size:15px ;"><br><?php 
                  
                        //Showing a content from a directory
                        $za = new ZipArchive(); 

                        $za->open("uploads/USER_$folderIDvariable.zip"); 

                        for( $i = 1; $i < $za->numFiles; $i++ ){
                            $stat = $za->statIndex( $i ); 
                            echo( basename( $stat['name'] ) . PHP_EOL. '<br>' );
                            
                            echo "(".getSizeKbMbGb($za->statIndex($i)['size']).")<br>";
                            echo "<br>";
                            
                            
                           
                            //getSize($folderIDvariable,$stat['name']);
                            
                        }
                        /*
                        $zip = new ZipArchive;
                            $res = $zip->open("D:/XAMPP/htdocs/uploads/USER_$folderIDvariable.zip");
                            if ($res) {
                                $i=1;
                                while(!empty($zip->statIndex($i)['name']))
                                {
                                 // echo "| Size: ".$zip->statIndex($i)['size']." bytes<br>";

                                   echo "Filename: ".$zip->statIndex($i)['name']." | Size: ".$zip->statIndex($i)['size']." bytes<br>";
                                   $i++;
                                }
                            }
                        //"D:/XAMPP/htdocs/uploads/USER_$folderIDvariable.zip/USER_$folderIDvariable"
                        
                        /*echo get_dir_size("D:/XAMPP/htdocs/uploads/Nova pasta");
                        function get_dir_size($directory){
                          $size = 0;
                          $files = glob($directory.'/*');
                          foreach($files as $path){
                              is_file($path) && $size += filesize($path);
                              is_dir($path)  && $size += get_dir_size($path);
                          }
                          return $size;
                      } */
                        ?></div>

                            <div id="filesize" style="font-size:20px ;"><br><strong><?php echo "Total size: ". $final ?></strong></div>
                        
                          <button type="button" class="btn btn-primary" style="margin-top:30px;margin-bottom:30px; width:200px;"><a style="text-decoration: none;color:white;"href="/uploads/USER_<?php echo $folderIDvariable;?>.zip" download>DOWNLOAD</a></button>
                          <p style="padding-bottom: 40px;">This link will expire in 7 days</p> 
                        </div>  
                        </div>
                        </div>
                  </div>
                </div>
            </div>
        </div>
        <script>

          (function() {
      //CUSTOM MOUSE WEIRD THING MOVING
  var canvas, ctx, circ, nodes, mouse, SENSITIVITY, SIBLINGS_LIMIT, DENSITY, NODES_QTY, ANCHOR_LENGTH, MOUSE_RADIUS;
  
  // how close next node must be to activate connection (in px)
  // shorter distance == better connection (line width)
  SENSITIVITY = 90;
  // note that siblings limit is not 'accurate' as the node can actually have more connections than this value that's because the node accepts sibling nodes with no regard to their current connections this is acceptable because potential fix would not result in significant visual difference 
  // more siblings == bigger node
  SIBLINGS_LIMIT = 15;
  // default node margin
  DENSITY = 60;
  // total number of nodes used (incremented after creation)
  NODES_QTY = 0;
  // avoid nodes spreading
  ANCHOR_LENGTH = 20;
  // highlight radius
  MOUSE_RADIUS = 170;

  circ = 2 * Math.PI;
  nodes = [];

  canvas = document.querySelector('canvas');
  resizeWindow();
  mouse = {
    x: canvas.width / 2,
    y: canvas.height / 2
  };
  ctx = canvas.getContext('2d');
  if (!ctx) {
    alert("Ooops! Your browser does not support canvas :'(");
  }

  function Node(x, y) {
    this.anchorX = x;
    this.anchorY = y;
    this.x = Math.random() * (x - (x - ANCHOR_LENGTH)) + (x - ANCHOR_LENGTH);
    this.y = Math.random() * (y - (y - ANCHOR_LENGTH)) + (y - ANCHOR_LENGTH);
    this.vx = Math.random() * 2 - 1;
    this.vy = Math.random() * 2 - 1;
    this.energy = Math.random() * 100;
    this.radius = Math.random();
    this.siblings = [];
    this.brightness = 0;
  }

  Node.prototype.drawNode = function() {
    //COLOR
    var color = "rgba(255, 255, 255, " + this.brightness + ")";
    ctx.beginPath();
    ctx.arc(this.x, this.y, 2 * this.radius + 2 * this.siblings.length / SIBLINGS_LIMIT, 0, circ);
    ctx.fillStyle = color;
    ctx.fill();
  };

  Node.prototype.drawConnections = function() {
    for (var i = 0; i < this.siblings.length; i++) {
      var color = "rgba(255, 255, 255, " + this.brightness + ")";
      ctx.beginPath();
      ctx.moveTo(this.x, this.y);
      ctx.lineTo(this.siblings[i].x, this.siblings[i].y);
      ctx.lineWidth = 1 - calcDistance(this, this.siblings[i]) / SENSITIVITY;
      ctx.strokeStyle = color;
      ctx.stroke();
    }
  };

  Node.prototype.moveNode = function() {
    this.energy -= 2;
    if (this.energy < 1) {
      this.energy = Math.random() * 100;
      if (this.x - this.anchorX < -ANCHOR_LENGTH) {
        this.vx = Math.random() * 2;
      } else if (this.x - this.anchorX > ANCHOR_LENGTH) {
        this.vx = Math.random() * -2;
      } else {
        this.vx = Math.random() * 4 - 2;
      }
      if (this.y - this.anchorY < -ANCHOR_LENGTH) {
        this.vy = Math.random() * 2;
      } else if (this.y - this.anchorY > ANCHOR_LENGTH) {
        this.vy = Math.random() * -2;
      } else {
        this.vy = Math.random() * 4 - 2;
      }
    }
    this.x += this.vx * this.energy / 100;
    this.y += this.vy * this.energy / 100;
  };

  function initNodes() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    nodes = [];
    for (var i = DENSITY; i < canvas.width; i += DENSITY) {
      for (var j = DENSITY; j < canvas.height; j += DENSITY) {
        nodes.push(new Node(i, j));
        NODES_QTY++;
      }
    }
  }

  function calcDistance(node1, node2) {
    return Math.sqrt(Math.pow(node1.x - node2.x, 2) + (Math.pow(node1.y - node2.y, 2)));
  }

  function findSiblings() {
    var node1, node2, distance;
    for (var i = 0; i < NODES_QTY; i++) {
      node1 = nodes[i];
      node1.siblings = [];
      for (var j = 0; j < NODES_QTY; j++) {
        node2 = nodes[j];
        if (node1 !== node2) {
          distance = calcDistance(node1, node2);
          if (distance < SENSITIVITY) {
            if (node1.siblings.length < SIBLINGS_LIMIT) {
              node1.siblings.push(node2);
            } else {
              var node_sibling_distance = 0;
              var max_distance = 0;
              var s;
              for (var k = 0; k < SIBLINGS_LIMIT; k++) {
                node_sibling_distance = calcDistance(node1, node1.siblings[k]);
                if (node_sibling_distance > max_distance) {
                  max_distance = node_sibling_distance;
                  s = k;
                }
              }
              if (distance < max_distance) {
                node1.siblings.splice(s, 1);
                node1.siblings.push(node2);
              }
            }
          }
        }
      }
    }
  }

  function redrawScene() {
    resizeWindow();
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    findSiblings();
    var i, node, distance;
    for (i = 0; i < NODES_QTY; i++) {
      node = nodes[i];
      distance = calcDistance({
        x: mouse.x,
        y: mouse.y
      }, node);
      if (distance < MOUSE_RADIUS) {
        node.brightness = 1 - distance / MOUSE_RADIUS;
      } else {
        node.brightness = 0;
      }
    }
    for (i = 0; i < NODES_QTY; i++) {
      node = nodes[i];
      if (node.brightness) {
        node.drawNode();
        node.drawConnections();
      }
      node.moveNode();
    }
    requestAnimationFrame(redrawScene);
  }

  function initHandlers() {
    document.addEventListener('resize', resizeWindow, false);
    canvas.addEventListener('mousemove', mousemoveHandler, false);
  }

  function resizeWindow() {
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
  }

  function mousemoveHandler(e) {
    mouse.x = e.clientX;
    mouse.y = e.clientY;
  }


  initHandlers();
  initNodes();
  redrawScene();

})();


</script>
    </body>
</html>


<?php 


// FUNCTIOUN TO GET SIZE OF EACH FILE
function getSizeKbMbGb($bytes) {
  
                            if ($bytes > 1024) {
                                $temporary = floor($bytes / 1024);
                                $final = "$temporary Kb";     
                            }
                            if ($bytes > 1000000) {
                                $temporary = floor($bytes / 1024 / 1024);
                                $final = "$temporary Mb"; 
                            }
                            if ($bytes > 1073741824) {
                                $temporary = floor($bytes / 1024 / 1024 / 1024);
                                $final = "$temporary Gb"; 
                            } 
                            return $final;
                            
                        }
?>
