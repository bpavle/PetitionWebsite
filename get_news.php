        


<?php

$link=mysqli_connect("localhost:3308", "root","","petition");

$upit="SELECT * FROM news;";

$rez=mysqli_query($link,$upit);

while($podaci=mysqli_fetch_assoc($rez)){

  $naslov=$podaci['title'];
  $vest=$podaci['content'];
    
    echo<<<EOT
    
  
    <dt>    
    <a href="#" ; class="links"
      ><b
        >$naslov
      >
    </a>
  </dt>
  <br />
  <dd>
    $vest
  </dd>
  <hr />
 
  EOT; 
}

mysqli_close($link);
?>
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        