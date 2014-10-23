<?php 
  if(isset($_GET['gif']) && filter_var($_GET['gif'], FILTER_VALIDATE_URL)){ 
    $gif = $_GET['gif']; 
  }
  else { 
    $gif = 'http://i.giphy.com/MJKDcGKXRB0UE.gif'; 
  }
  
  if(isset($_GET['track']) && filter_var($_GET['track'], FILTER_VALIDATE_URL)){ 
    $track = $_GET['track']; 
  }
  else { 
    $track = 'https://blend.io/project/54354ef053def5bd68001703'; 
  }
?><!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Dancing</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="autobass.css"/>
  <style type="text/css">
    #blackout { 
      background-color:#000; 
      width:100%; 
      height:100%; 
    }
    #loadContainer { 
      width:32px; 
      height:32px; 
      margin:240px auto 0 auto; 
    }
    #playContainer { 
      position:fixed; 
      bottom:0; 
      width:640px; 
      left:50%; 
      margin-left:-320px;  
    }
    #gifContainer { 
      width:640px; 
      height:480px; 
      position:absolute; 
      left:50%; 
      margin-left:-320px; 
      top:50%; 
      margin-top:-280px; 
    }
    x-gif { 
     height:480px;
    }
  </style>
  
  <script>
    if ('registerElement' in document
      && 'createShadowRoot' in HTMLElement.prototype
      && 'import' in document.createElement('link')
      && 'content' in document.createElement('template')) {
      // We're using a browser with native WC support!
    } else {
      document.write('<script src="\/\/cdnjs.cloudflare.com\/ajax\/libs\/polymer\/0.3.4\/platform.js"><\/script>')
    }
  </script>
  <link rel="import" href="x-gif/dist/x-gif.html">
  
  <script src="//cdnjs.cloudflare.com/ajax/libs/vue/0.10.6/vue.min.js"></script>
  <script src="v-plangular.js"></script>

</head>
<body id="vm" class="theme-blend">

<div id="dancer" class="table mb1 rounded" v-component="plangular" v-src="'<?php echo $track; ?>'">
  
  <div class="table-row" v-if="!track" id="loadContainer">
    <div class="table-cell full-width">
      <img src="spinner.gif" alt="Loading . . ." width="32" height="32" />
    </div>
  </div>
  
  <div id="gifContainer">
    <div id="blackout" v-if="player.playing != track">&nbsp;</div>
    <x-gif v-if="player.playing == track" src="<?php echo $gif; ?>" bpm="{{ bpm }}" fill></x-gif>
  </div>
  
  <div v-if="track" id="playContainer">
    <div class="table-row">
      <div class="table-cell p1">
        <button class="button-icon" v-on="click: playPause()">
          <svg class="vhs-pop-in" v-if="player.playing != track" v-plangular-icon="'play'"></svg>
          <svg class="vhs-pop-in" v-if="player.playing == track" v-plangular-icon="'pause'"></svg>
        </button>
      </div>
      <div class="table-cell px1 full-width">
        <div class="mt1">{{ user.username }}</div>
        <h3 class="m0">{{ title }} </h3>
        <progress class="full-width"
          v-on="click: player.seek($event)"
          value="{{ currentTime / duration || 0 }}">
            {{ currentTime / duration }}
        </progress>
      </div>
    </div>
  </div>
  
</div>
  
  
<script type="text/javascript" charset="utf-8">
  
  var vm = new Vue({ el: '#vm' }); 

</script>
</body>
</html>