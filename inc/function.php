
<?php 

function check($page , $numberOfPages){

    if($page > $numberOfPages || $page < 1){
      return false ; 
    }else{
      return true ;
    }
  
  
  }