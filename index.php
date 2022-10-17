<?php
    // GENERATING A DIRECTORY RANDOM ID FOLDER ---> USER_XXXXXXX 
    $folderid = (rand(10000,99999999999));             

    //CREATING A .txt FILE FOR EXPORTING THE DIRECTORY NAME FOR TEMPORARY USE ONLY.
            $myfile = fopen("folderID.txt", "w") or die("Unable to open file!");
            $txt = $folderid;
            fwrite($myfile, $txt);
            fclose($myfile);

?>
<script>
  let folderIDlink = <?php echo $folderid ?>;
</script>

<!DOCTYYPE html>
<html>
  <head>
    <title>Chunking Upload Demo</title>
    
      <!-- UPLOADING PROCESS WITH PLUPLOAD JS - << CHUNKING PROCESS >> -->
    
    <script src="plupload/js/plupload.full.min.js"></script>
    <script>
      let count = 0;
      window.addEventListener("load", function () {
        var path = "plupload/js/`";
        var uploader = new plupload.Uploader({
          browse_button: 'pickfiles',
          container: document.getElementById('container'),
          url: 'upload.php',
          chunk_size: '10000kb',
          max_retries: 2,
          filters: {
            max_file_size: '250gb',
            mime_types: [{title: "File", extensions: "zip,mov,pdf,mp4,mp3,png,jpeg,rar,txt"}]
          },
          init: {
            PostInit: function () {
              var header = document.getElementById("header");    // -> getting the div element by id
              header.innerHTML = '<strong>Your Files</strong>';
              header.style.fontSize = '25px'
              document.getElementById('filelist').innerHTML = '<br>';
              document.getElementById('filelist').style.fontSize = '16px'
              document.getElementById("appear").style.display = "none";    //THIS WILL DISABLE THE DISPLAY UNTIL FILE IS LOADADE
              document.getElementById("link").style.display = "none";      //THIS WILL DISABLE THE DISPLAY UNTIL FILE IS LOADADE
            },
            FilesAdded: function (up, files) {
              plupload.each(files, function (file) {
                
                document.getElementById('filelist').innerHTML += '<br><div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
                
              });
              uploader.start();
              document.getElementById("appear").style.display = "block";      //THIS WILL ABLE TO DISPLAY A DIV
              
              // DISPLAY THE "APOLLO 11 ROCKET" ONLY 1x TIME WHILE THE 1st FILE IS UPLOADING
              if (count == 0) {
              let lastelement = document.getElementById("gifafterlink");
              let img = document.createElement("img");          
              img.src = "/image_files/apollo11.gif";                            
              img.style.marginTop = "70px";                                                                                                                                                                                                                                    
              img.style.marginBottom = "20px";
              img.style.width = "220";
              document.body.appendChild(img);                    
              lastelement.appendChild(img);
              }
              
              
            },
            
            UploadProgress: function (up, file) {
              document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + (file.percent-1) + "%</span>" + '<br></b> Uploading...';
              
              
            },
            
            FileUploaded: function (up, file) {       // OR USE  -- >  FileUploaded // UploadComplete
              
              count += 1;
              javascript:document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML='100%<br>Completed!';   // REPLACING THE % SPAN ABOVE FROM 99% TO 100%
              document.getElementById("link").style.display = "block";
              //if (count == 1) {
                /*
                var element = document.getElementById("new");    // -> getting the div element by id
                
                let btn = document.createElement("button");      //  creating
                btn.innerHTML = "Share link";                    //  new
                document.body.appendChild(btn);                  //  button
                element.appendChild(btn);                        //  inside the div element
                
                btn.onclick = function() {                      //function for opening the new tab
                  window.open(
                  'linkshare.php',
                  '_blank' // <- This is what makes it open in a new window.
                  );
                }
                */
                //var span = document.getElementById('pickfiles');   //removing the button for uploading more files
                //span.remove();
                
                

                // GETTING THE VARIABLE FROM THE .TXT FILE
                //$name = file_get_contents('D:/XAMPP/htdocs/folderID.txt');

                
                
                let urlLINK = `linkshare.php?folderid=${folderIDlink}`;
                let elem = document.getElementById("link");
                document.getElementById("link").innerHTML = `http://localhost/${urlLINK}`;
                    
                elem.href = `linkshare.php?folderid=${folderIDlink}`;
                elem.target = '_blank';
                if (count == 1) {
                //document.getElementById('filelist').innerHTML += '<strong>Done!</strong>';
                let newelement = document.getElementById("linkshare");    // -> getting the div element by id
                
                let btn = document.createElement("button");          //  creating
                btn.innerHTML = "Copy Link";                            //  new
                btn.style.marginTop = "20px";
                btn.style.width = "150px";
                btn.className = "btn btn-success";
                document.body.appendChild(btn);                    //  button
                newelement.appendChild(btn);                          //  inside the div element
                btn.onclick = function() {            //function for copy the link
                  navigator.clipboard.writeText(`http://localhost/${urlLINK}`);
                }
                
                let lastelement2 = document.getElementById("gifafterlink");
                
                let gif = document.getElementById("gif");
                gif.src = "/image_files/astro.gif";
                gif.src = "/image_files/astro.gif";                            
                gif.style.marginTop = "50px";                                                                                                                                                                                                                                    
                gif.style.marginBottom = "20px";
                gif.style.width = "160";
                lastelement2.replaceChildren(gif);
                
                /*
                let gif = document.createElement("img");
                         
                gif.src = "/image_files/astro.gif";                            
                gif.style.marginTop = "50px";                                                                                                                                                                                                                                    
                gif.style.marginBottom = "20px";
                gif.style.width = "160";
                
                document.body.appendChild(gif);                    
                lastelement.appendChild(gif);
                 */
                
               
              }
              var messageBody = document.getElementById("appear");
              messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight; // AUTOMATIC SCROLL DOWN
               
                //CloseEvent();
                
              //} else {
              //  window.alert('If you want to upload a DIRECTORY or MULTIPLE FILES, a folder must be COMPRESSED (ex: ZIP, RAR, etc')
              //  location.reload()
              }
              
            //}

            /*Error: function (up, err) {
              // DO YOUR ERROR HANDLING!
              
              console.log(err);
            }*/
            
          }
          
        });
         uploader.init();
         
      });
    
    </script>

    <!-- FAVICON -->
    <link rel="icon" type="image/x-icon" href="../image_files/favicon.png">
    <!------------->

  </head>
  <body>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/test/stylecopy.css">
    
    <!-- DIVS FOR THE BACKGROUND ANIMATION -->
    <div class="relative bg-black stars-container">
      <div id="stars"></div>
      <div id="stars2"></div>
      <div id="stars3"></div>
    </div>
    <!-- ---------------------------------- -->

    <!-- --------------  NAVBAR  ---------- -->
    <nav class="navbar navbar-expand-md navbar-dark" style="background-color: #212529; ">
    <a class="navbar-brand" href="http://localhost/" style="margin-left:40px;"><img style="width: 87px;"src="/image_files/rocketLINKlogo.png" alt=""></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse nav justify-content-end" style="padding-right:50px;" id="navbarNavAltMarkup">
            <div class="navbar-nav">
            <a class="nav-item nav-link" href="/log in/index.html">Log in</a>
            <a class="nav-item nav-link navbar-right" href="/contact/contact.html">Contact</a>
            </div>
        </div>
    </nav>
      <!-- ---------------------------------- -->

<div id="canvas-wrap">
  
  <canvas id="canvas">
    
  </canvas>
  
    <div id="overlay" style="left: 50px;"> 
      
 <div class="container col-md-12">
    <div class="card text-white bg-dark " style="width: 18rem; height:400px; float: left;">
        <div class="card-body ">
        <img src="/image_files/rocketpeople.gif" alt="" width="185" style="padding-bottom:50px;margin-top:25px; ">
        <!--<img src="/image_files/giphy.gif" alt="" width="200" style="padding-bottom:0px; ">-->
        <!--<img src="image_files/rocket (1).png" style=" width:auto; height: 110px; margin-top:20px; margin-bottom: 35px;">
    -->  
        <h5 class="card-title" style="padding-bottom:10px;">LAUNCH YOUR UPLOADS!</h5>
        
          <div id="container">
              <button type="button" class="btn btn-light" id="pickfiles" style="margin-bottom: 20px;">
                Upload Files
              </button>
              <p>250 Gb per JOURNEY</p>
        </div>
      </div>
    </div>
      <!--
            <div id="container">
              <button id="pickfiles">
                Upload File
              </button> -->
     <!-- 1st card ends-->

     <div id="overlay2" style="left: 850px;"> 
 <div id="appear" class="card text-light bg-dark" style="text-align: center; height: 657px; font-size:10pt; overflow-y: auto; width: 32rem;">
      
      <div style="padding-top: 45px; text-align:center;">
      <div id='header'></div>
      <div id="filelist">Your browser doesn't have Flash, Silverlight or HTML5 support.</div>
      <div style="font-size:12pt; text-align: left;" id="new"></div>
      <div style="font-size:12pt; text-align: center; padding-top:50px" id="linkshare">
      <a class="input" href="" id ="link"></a></div>
      </div>
      <div id ="gifafterlink"><img src="" id="gif" alt=""></div>
 </div>
    </div>
    </div>
    </div>
        </div>
</div>
<script>
     (function() {

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





