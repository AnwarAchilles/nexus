<?php $query = (!empty($_GET)) ? "?".$_SERVER["QUERY_STRING"] : ""; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <style>
    * { box-sizing: border-box; }
    body {
      margin: 0;
      padding: 0;
    }
    #iframe {
      z-index: 500;
      position: fixed;
      top: 0;
      padding: 0;
      width: 100%;
      height: 100%;
      display: flex;
      justify-content: center;
    }
    #iframe>iframe {
      opacity: 0;
      transition: opacity 0.3s ease-out;
      width: 100%;
      height: 100%;
    }
    @keyframes loader {
      0% { width:30px; height:30px; }
      50% { width:70px; height:70px; opacity:0; }
    }
    #loader {
      opacity: 0.5;
      animation: loader 1s ease-out infinite;
      align-self:center;
      width: 30px;
      height: 30px;
      background-color: red;
      border-radius: 100%;
      display: inline-block;
      position: fixed;
    }
    #monitor {
      z-index: 900;
      position: fixed;
      top: 0;
      font-family: 'Arial';
      font-size: 0.8rem;
      background-color: rgba(200,200,200,0.2);
      width: 100%;
      padding: 2px 10px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    #monitor #title {
      margin: 0;
    }
    #monitor #play,
    #monitor #stop {
      border: 0;
      padding: 5px 10px;
      background: transparent;
      cursor: pointer;
    }
    #monitor #stop { color:red; }
    #monitor #play {
      color: green;
      display: none;
    }
  </style>

</head>
<body>

  <div id="iframe">
    <div id="loader"></div>
    <div id="monitor">
      <span id="title">📦 Nexus 1.0 - Viewer</span>
      <div>
        <button id="play">▶</button>
        <button id="stop">◼</button>
      </div>
    </div>
    <iframe frameborder="0"></iframe>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const MAIN = "<?=self::$main['url']?>?NEXUS_WATCH";
      const DIST = "<?=self::$dist['url']?>";
      const MONITOR = {
        play: document.querySelector("#play"),
        stop: document.querySelector("#stop"),
      };
      const IFRAME = document.querySelector("#iframe>iframe");
      
      IFRAME.setAttribute("src", DIST);
      IFRAME.addEventListener('load', function() {
        const SSE = new EventSource(MAIN);

        SSE.onmessage = (event) => {
          window.location.reload(true);
        };

        MONITOR.play.addEventListener("click", ()=> {
          window.location.reload(true);
        });

        MONITOR.stop.addEventListener("click", ()=> {
          MONITOR.play.style.display = "inline-block";
          MONITOR.stop.style.display = "none";
          SSE.close();
        });

        IFRAME.style.opacity = 1;

        document.querySelector("#loader").style.display = "none";
      });
    });
  </script>
</body>
</html>