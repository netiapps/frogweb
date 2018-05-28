<?php
    function get_social_share($tid, $color = ''){
        global $language;
        
        $base_url = 'http://'.$_SERVER['HTTP_HOST'].'/techtrends2015';
        /*
         * Twitter - http://fro.gd/1drkmWA - http://www.frogdesign.com/techtrends2015?utm_campaign=Tech+Trends+2015&utm_medium=social&utm_source=TwitterIcon
         * Facebook - http://fro.gd/1f9CoDA - http://www.frogdesign.com/techtrends2015?utm_campaign=Tech+Trends+2015&utm_medium=social&utm_source=FacebookIcon
         * LinkedIn - http://fro.gd/1f9Cuee - http://www.frogdesign.com/techtrends2015?utm_campaign=Tech+Trends+2015&utm_medium=social&utm_source=LinkedInIcon
         * Sina Weibo - http://fro.gd/1g5TdzD - http://www.frogdesign.cn/techtrends2015/?utm_campaign=Tech+Trends+2015&utm_medium=social&utm_source=weiboIcon
        */
         
        $services = array(
            'en' => array(
                'twitter' => array(
                    'service'   => 'Tweet',
                    'link'      => 'https://twitter.com/intent/tweet',
                    'attributes' => array('url' => urlencode('http://www.frogdesign.com/techtrends2015'), 'text' => urlencode("Likely or Longshot: Vote on @frogdesign's 15 Tech Trends for 2015 #frogTechTrends2015")),
                ),
                'facebook' => array(
                    'service'   => 'Share',
                    'link'      => 'https://www.facebook.com/sharer/sharer.php',
                    'attributes' => array('s' => 100, 'p[url]' => urlencode('http://www.frogdesign.com/techtrends2015'), 'p[images][0]' => $base_url.'/images/tech_trends_2012_fb.png', 'p[title]' => 'Tech Trends 2015', 'p[summary]' => urlencode("Likely or Longshot: Vote on @frogdesign's 15 Tech Trends for 2015 #frogTechTrends2015")),
                ),
                'linkedin' => array(
                    'service'   => 'Share',
                    'link'      => 'http://www.linkedin.com/shareArticle',
                    'attributes' => array('mini' => 'true', 'url' => urlencode('http://www.frogdesign.com/techtrends2015'), 'title' => 'Tech Trends 2015', 'summary' => urlencode("Likely or Longshot: Vote on @frogdesign's 15 Tech Trends for 2015 #frogTechTrends2015"), 'source' => 'frog'),
                )
            ),
            'de' => array(
                'twitter' => array(
                    'service'   => 'Tweet',
                    'link'      => 'https://twitter.com/intent/tweet',
                    'attributes' => array('url' => urlencode('http://www.frogdesign.com/techtrends2015'), 'text' => urlencode("Wahrscheinlich oder Nicht? Stimmt ab über die Tech Trends 2015 von @frogdesign #frogTechTrends2015")),
                ),
                'facebook' => array(
                    'service'   => 'Share',
                    'link'      => 'https://www.facebook.com/sharer/sharer.php',
                    'attributes' => array('s' => 100, 'p[url]' => urlencode('http://www.frogdesign.com/techtrends2015'), 'p[images][0]' => $base_url.'/images/tech_trends_2012_fb.png', 'p[title]' => 'Tech Trends 2015', 'p[summary]' => urlencode("Wahrscheinlich oder Nicht? Stimmt ab über die Tech Trends 2015 von @frogdesign #frogTechTrends2015")),
                ),
                'linkedin' => array(
                    'service'   => 'Share',
                    'link'      => 'http://www.linkedin.com/shareArticle',
                    'attributes' => array('mini' => 'true', 'url' => urlencode('http://www.frogdesign.com/techtrends2015'), 'title' => 'Tech Trends 2015', 'summary' => urlencode("Wahrscheinlich oder Nicht? Stimmt ab über die Tech Trends 2015 von @frogdesign #frogTechTrends2015"), 'source' => 'frog'),
                )
            ),
            'zh-hans' => array(
                'sinaweibo' => array(
                    'service'   => 'Weibo',
                    'link'       => 'http://service.weibo.com/share/share.php',
                    'attributes'    => array(
                        'url'       => urlencode('http://www.frogdesign.com/techtrends2015'),
                        'appkey'    => NULL,
                        'title'     => urlencode('有没有可能：一起来参加@frogdesign #2015科技趋势# 投票活动。'),
                        'pic'       => '',
                        'relateUid' => '',
                        'language'  => 'zh_cn',
                    ),
                ),
            ),
        );

        foreach($services[$language->language] as $id => $service){
            $attr = '';
            if(!empty($service['attributes'])){
                foreach($service['attributes'] as $key => $value){
                    $attr .="$key=$value&";    
                }
                
                $url = $service['link'].'?'.$attr;
            } else {
                $url = $service['link'];
            }
            $links[] = '<li class="'.$id.'"><a href="'.$url.'" target="_blank">'.$service['service'].'</a></li>';
        }
        
        if($language->language == 'en'){
            $links[] = '<li class="contact">
            <span class="hs-cta-wrapper" id="hs-cta-wrapper-685cb887-c678-4396-8762-56946f24f49d">
                <span class="hs-cta-node hs-cta-685cb887-c678-4396-8762-56946f24f49d" id="hs-cta-685cb887-c678-4396-8762-56946f24f49d">
                    <!--[if lte IE 8]><div id="hs-cta-ie-element"></div><![endif]-->
                    <a href="http://cta-redirect.hubspot.com/cta/redirect/262724/685cb887-c678-4396-8762-56946f24f49d"><img class="hs-cta-img" id="hs-cta-img-685cb887-c678-4396-8762-56946f24f49d" style="border-width:0px;" src="https://no-cache.hubspot.com/cta/default/262724/685cb887-c678-4396-8762-56946f24f49d.png" /></a>
                </span>
            </span>
            ';   
        } else if($language->language == 'de'){
            $links[] = '<li class="contact">
            <span >
                <span >
                    <!--[if lte IE 8]><div id="hs-cta-ie-element"></div><![endif]-->
                    <a href="http://www.frogdesign.de/contact/new-business.html" />Kontaktieren Sie uns</a>
                </span>
            </span>
            ';
        }else{
            $links[] = '<li class="contact">
            <span >
                <span >
                    <!--[if lte IE 8]><div id="hs-cta-ie-element"></div><![endif]-->
                    <a href="http://www.frogdesign.cn/contact/new-business.html" />联系我们</a>
                </span>
            </span>
            ';
        }
        if(!isset($_SESSION['voting'][$tid])){
            return '<ul class="social '.$color.'">'.implode('',$links).'</ul>';
        } else {
          return '<ul class="social '.$color.'">'.implode('', $links).'</ul>';
        }
    }

    class Poll {
        
        /**
         * construct Poll object
         */
        function __construct($trend_id) {
            $this->trend_id = $trend_id;
        }
        
        public function vote($vote, $session_id){
            if(!isset($_SESSION['voting'])){
                //first vote
                db_insert('trends_poll')
                    ->fields(array(
                        'session_id' => $session_id,
                        'trend_'.$this->trend_id => $vote,
                    ))
                    ->execute();
            } else {
                //update
                db_update('trends_poll')
                    ->fields(array(
                      'trend_'.$this->trend_id => $vote
                    ))
                    ->condition('session_id', $session_id)
                    ->execute();
            }
            
            $_SESSION['voting'][$this->trend_id] = $vote;
        }
        
        public function get_results(){
            $yes = db_query("SELECT count(:tid) as yes FROM en_trends_poll WHERE trend_".$this->trend_id." = 1", array(':tid' => $this->trend_id))->fetchField();
            $no = db_query("SELECT count(:tid) as no FROM en_trends_poll WHERE trend_".$this->trend_id." = 0", array(':tid' => $this->trend_id))->fetchField();
            //var_dump("SELECT count(:tid) as yes FROM en_trends_poll WHERE trend_".$this->trend_id." = 1");
            $total = $yes+$no;
            
            //return array('yes' => ($yes != 0 ? intval((($yes))) : 0), 'no' => ($no != 0 ? intval((($no)*100)) : 0));

            return array('yes' => ($yes != 0 ? round((($yes/$total)*100)) : 0), 'no' => ($no != 0 ? round((($no/$total)*100)) : 0));
        }
    }
    
    function get_poll($tid){

        $poll = new Poll($tid);
        $data = $poll->get_results();
        
        if(!isset($_SESSION['voting'][$tid])){
            return '
                <ul class="vote">
                    <li class="yes"><a class="btn" data-vote="1">'.t('Likely').'</a><div class="row"><span></span></div><div class="label"></div></li>
                    <li class="no"><a class="btn" data-vote="0">'.t('LONGSHOT').'</a><div class="row"><span></span></div><div class="label"></div></li>
                </ul>';
        } else {
            //23
            $yes = (($data['yes']-1) <=0 ? "0%; border-right:0px !important;" : ($data['yes']-1)."%;");
            $no = (($data['no']-1) <=0 ? "0%; border-right:0px !important;" : ($data['no']-1)."%;");
            return '
                <ul class="vote disabled '.$_SESSION['voting'][$tid].'">
                    <li class="yes"><a class="btn" data-vote="1">'.t('Likely').'</a><div class="row"><span style="width:'.$yes.'"></span></div><div class="label">'.$data['yes'].'%</div></li>
                    <li class="no"><a class="btn" data-vote="0">'.t('LONGSHOT').'</a><div class="row"><span style="width:'.$no.'"></span></div><div class="label">'.$data['no'].'%</div></li>
                </ul>';
        }
    }

    //create new database table column for en_trends_poll, the en_ is prefix
    /**
     * $name array the column names
     * @return nothing, just excute the code in the backend
     */
    function create_column($names){
        $names = $names?$names : range(16,30);
        foreach ($names as $key => $value) {
            $column_name = 'trend_'.$value;
            $table_test = db_field_exists('trends_poll',$column_name);
            if($table_test==false || !$table_test){
                db_add_field('trends_poll', $column_name,
                    array(
                        'type' => 'int',
                        'unsigned' => TRUE,
                        'description' => 'Example field desc',
                    ),
                    array(
                        'indexes' => array(
                            $column_name => array($column_name)
                        ),
                    )
                );
            }
        }

        
        $count_db_schema = array(
            'description' => 'Page hits number for techtrends2015',
            'fields' => array(
              'id'=> array('type' => 'serial', 'unsigned' => TRUE, 'not null' => TRUE),
              'count'=> array('type' => 'int', 'unsigned' => TRUE, 'not null' => TRUE),
              'ip_address'                        => array('type' => 'varchar', 'length' => 256, 'not null' => TRUE, 'default' => ''),
              'user_agent'                        => array('type' => 'varchar', 'length' => 256, 'not null' => TRUE, 'default' => ''),
              'datetime'                        => array('type' => 'varchar', 'length' => 256, 'not null' => TRUE, 'default' => ''),
            'page'                        => array('type' => 'varchar', 'length' => 256, 'not null' => TRUE, 'default' => ''),

              
            ),
            'primary key' => array('id'),
          );

        if (!db_table_exists(COUNT_TABLE)){
            db_create_table(COUNT_TABLE,$count_db_schema);
        }
        
        
    }

    function get_page_count(){
        $count_result = db_select(COUNT_TABLE,'n')
                ->fields('n',array('count'))
                ->condition('page', 'homepage','=')
                ->execute()
                ->fetchAssoc();
        return $count_result['count'];
    }






























    
?>