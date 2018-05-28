<?php
define('DRUPAL_ROOT', '../');
    define('COUNT_TABLE', 'techtrends_2015_hits');
    require_once DRUPAL_ROOT . '/includes/bootstrap.inc';
    drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);
    include('inc/counter.php');
    include('inc/poll.inc.php');
  include('inc/password_protect.php');
  
  $vote_name = array("Move Over 'Step Counters'","Ambient Intelligence Knows What's Up","Nano Particles Diagnose from the Inside Out",
    "The Emergence of the Casual Programmer","Eat Your Technologies","The Internet of Food Goes Online","Mobilizing the Next 4 Billion",
    "Personal Darknets in the Spotlight","4D Printing Assembles Itself","Digital Currency Replaces Legal Tender","The Rise of Cognitive Behavioral Therapy",
    "Textiles Get Techy","Adaptive Education Personalizes Learning","Achievement Unlocked: You're Hired!","Micro-farming Networks go Mainstream");
  $vote_array = range(16,30);
  $vote_result = array();
  //sum of each item
  $yes_sum = 0;
  $no_sum = 0;
  $total_sum = 0; 

  foreach ($vote_array as $key => $value) {
    
    $yes = db_query("SELECT count(:tid) as yes FROM en_trends_poll WHERE trend_".$value." = 1", array(':tid' => $value))->fetchField();
    $no = db_query("SELECT count(:tid) as no FROM en_trends_poll WHERE trend_".$value." = 0", array(':tid' => $value))->fetchField();
    $total = $yes+$no;
    $yes_rate = $yes != 0 ? round((($yes/$total)*100)) : 0;
    $no_rate = $no != 0 ? round((($no/$total)*100)) : 0;
    $vote_result[$key]['yes'] = $yes;
    $vote_result[$key]['no'] = $no;
    $vote_result[$key]['yes_rate'] = $yes_rate.'%';
    $vote_result[$key]['no_rate'] = $no_rate.'%';
    $vote_result[$key]['total'] = $total;
    $vote_result[$key]['name'] = $vote_name[$key];

    $yes_sum+=$yes;
    $no_sum+=$no;
    $total_sum+=$total;
  }
  $all_visit = get_page_count();
  
?>
<html>
  <head>
    <link type="text/css" rel="stylesheet" href="style_view.css" />
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col row-name"></div>
        <div class="col">1</div>
        <div class="col">2</div>
        <div class="col">3</div>
        <div class="col">4</div>
        <div class="col">5</div>
        <div class="col">6</div>
        <div class="col">7</div>
        <div class="col">8</div>
        <div class="col">9</div>
        <div class="col">10</div>
        <div class="col">11</div>
        <div class="col">12</div>
        <div class="col">13</div>
        <div class="col">14</div>
        <div class="col">15</div>
        <div class="col">total</div>
        
      </div><!-- row -->

      <div class="row even">
        <div class="col row-name">Likely</div>
        <?php          
          foreach ($vote_result as $key => $value) {            
        ?>
          <div class="col"><?php echo $value['yes'];?></div>
        <?php
          }
        ?>
        <div class="col"><?php echo $yes_sum; ?></div>
      </div><!-- row -->

      <div class="row">
        <div class="col row-name">Not Likely</div>
        <?php          
          foreach ($vote_result as $key => $value) {            
        ?>
          <div class="col"><?php echo $value['no'];?></div>
        <?php
          }
        ?>
        <div class="col"><?php echo $no_sum; ?></div>
      </div><!-- row -->

      <div class="row even">
        <div class="col row-name">Skipped</div>
        <?php 
          $skipped_num_sum = 0;         
          foreach ($vote_result as $key => $value) {
          $skipped_num = $all_visit-$value['yes']-$value['no'];
          $skipped_num_sum+=$skipped_num;            
        ?>
          <div class="col"><?php echo $skipped_num;?></div>
        <?php
          }
        ?>
        <div class="col"><?php echo $skipped_num_sum; ?></div>
      </div><!-- row -->

      <div class="row ">
        <div class="col row-name">Likely%</div>
        <?php          
          foreach ($vote_result as $key => $value) {            
        ?>
          <div class="col"><?php echo $value['yes_rate'];?></div>
        <?php
          }
        ?>
        <div class="col"></div>
      </div><!-- row -->

      <div class="row even">
        <div class="col row-name">Not Likely%</div>
        <?php          
          foreach ($vote_result as $key => $value) {            
        ?>
          <div class="col"><?php echo $value['no_rate'];?></div>
        <?php
          }
        ?>
        <div class="col"></div>
      </div><!-- row -->

      <div class="row ">
        <div class="col row-name">Voted %</div>
        <?php                   
          foreach ($vote_result as $key => $value) {
          $vote_num_rate = 100-round(($all_visit-$value['yes']-$value['no'])/$all_visit,4)*100;
        ?>
          <div class="col"><?php echo $vote_num_rate;?>%</div>
        <?php
          }
        ?>
        <div class="col"></div>
      </div><!-- row -->

      <div class="row even">
        <div class="col row-name">Skipped %</div>
        <?php                   
          foreach ($vote_result as $key => $value) {
          $skipped_num_rate = round(($all_visit-$value['yes']-$value['no'])/$all_visit,4)*100;
        ?>
          <div class="col"><?php echo $skipped_num_rate;?>%</div>
        <?php
          }
        ?>
        <div class="col"></div>
      </div><!-- row -->
      <div class="clearfix"></div>
      <hr/>
      Total visit: <?php echo $all_visit; ?>
      <div class="clearfix"></div>
      <hr/>
      <?php 
        foreach ($vote_name as $key => $value) {
      ?>
        <div class="name-row"><span class="num"><?php echo $key+1; ?> :</span> <span class="name"><?php echo $value; ?></span></div>
      <?php
        }
      ?>




    </div><!-- container -->
    <div class="clearfix"></div>
  </body>
</html>
























