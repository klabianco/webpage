<?php
$category = addslashes($_GET["q"]);
$jquery = '<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>';
?>
<?php if ($category == "") :
?>
  <div id="result">
    
    Enter something this page should be about:<br />
    <form><input name="q"><input type="submit"> </form><button id="random">Show Me a Random Page</button>

    <?php echo $jquery; ?>
    <script>
      $(document).ready(function() {
        $("input[name=q]").focus();
      });

      $("#random").click(function() {
        window.location.href = "/?q=random";
      });
    </script>
  </div>
<?php else : ?>
  <div id="result">
    <?php echo $jquery; ?>
    <script>
      var category = "<?php echo $category; ?>";
      $("#result").html("Loading...Please wait up to 30 seconds...");

      var prompt = "Generate a webpage about " + category + ".";
      if(category == "random") prompt = "Generate a webpage about a topic you choose.";
      
      prompt +=
        " Do not include the year. Return code only. Do not include any form tags or images. Do not include any intro or conclusion GPT text.";

      $.post(
        "http://localgpt.o9p.net/api/webpage", {
          prompt: prompt
        },
        function(data) {
          $("#result").html(data);
        }
      );
    </script>
  </div>
<?php endif; ?>