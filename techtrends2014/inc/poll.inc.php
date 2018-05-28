<?php
    function get_social_share($tid, $color = ''){
        global $language;
        
        $base_url = 'http://'.$_SERVER['HTTP_HOST'].'/techtrends2014';
        /*
         * Twitter - http://fro.gd/1drkmWA - http://www.frogdesign.com/techtrends2014?utm_campaign=Tech+Trends+2014&utm_medium=social&utm_source=TwitterIcon
         * Facebook - http://fro.gd/1f9CoDA - http://www.frogdesign.com/techtrends2014?utm_campaign=Tech+Trends+2014&utm_medium=social&utm_source=FacebookIcon
         * LinkedIn - http://fro.gd/1f9Cuee - http://www.frogdesign.com/techtrends2014?utm_campaign=Tech+Trends+2014&utm_medium=social&utm_source=LinkedInIcon
         * Sina Weibo - http://fro.gd/1g5TdzD - http://www.frogdesign.cn/techtrends2014/?utm_campaign=Tech+Trends+2014&utm_medium=social&utm_source=weiboIcon
        */
         
        $services = array(
            'en' => array(
                'twitter' => array(
                    'service'   => 'Tweet',
                    'link'      => 'https://twitter.com/intent/tweet',
                    'attributes' => array('url' => urlencode('http://fro.gd/1drkmWA'), 'text' => urlencode('Likely or Not Likely: Vote on @frogdesign\'s 15 Tech Trends for 2014 #frogTT2014')),
                ),
                'facebook' => array(
                    'service'   => 'Share',
                    'link'      => 'https://www.facebook.com/sharer/sharer.php',
                    'attributes' => array('s' => 100, 'p[url]' => urlencode('http://fro.gd/1f9CoDA'), 'p[images][0]' => $base_url.'/images/tech_trends_2012_fb.jpg', 'p[title]' => 'Tech Trends 2014', 'p[summary]' => urlencode("Likely or Not Likely: Vote on frog design's 15 Tech Trends for 2014 and use #frogTT2014 to track the conversation.")),
                ),
                'linkedin' => array(
                    'service'   => 'Share',
                    'link'      => 'http://www.linkedin.com/shareArticle',
                    'attributes' => array('mini' => 'true', 'url' => urlencode('http://fro.gd/1f9Cuee'), 'title' => 'Tech Trends 2014', 'summary' => urlencode("Likely or Not Likely: Vote on frog design's 15 Tech Trends for 2014"), 'source' => 'frog'),
                )
            ),
            'zh-hans' => array(
                'sinaweibo' => array(
                    'service'   => 'Weibo',
                    'link'       => 'http://service.weibo.com/share/share.php',
                    'attributes'    => array(
                        'url'       => urlencode('http://fro.gd/1g5TdzD'),
                        'appkey'    => NULL,
                        'title'     => urlencode('有没有可能：一起来参加@frogdesign #2014科技趋势# 投票活动。'),
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
        } else {
            $links[] = '<li class="contact">
            <span class="hs-cta-wrapper" id="hs-cta-wrapper-c2078408-5ec5-4c39-893f-6874f4710d11">
                <span class="hs-cta-node hs-cta-c2078408-5ec5-4c39-893f-6874f4710d11" id="hs-cta-c2078408-5ec5-4c39-893f-6874f4710d11">
                    <!--[if lte IE 8]><div id="hs-cta-ie-element"></div><![endif]-->
                    <a href="http://cta-redirect.hubspot.com/cta/redirect/262724/c2078408-5ec5-4c39-893f-6874f4710d11"><img class="hs-cta-img" id="hs-cta-img-c2078408-5ec5-4c39-893f-6874f4710d11" style="border-width:0px;" src="https://no-cache.hubspot.com/cta/default/262724/c2078408-5ec5-4c39-893f-6874f4710d11.png" /></a>
                </span>
            </span>
            ';
        }
        if(!isset($_SESSION['voting'][$tid])){
            return '<ul class="social disabled '.$color.'">'.implode('',$links).'</ul>';
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
            
            $total = $yes+$no;
            
            return array('yes' => ($yes != 0 ? intval((($yes/$total)*100)) : 0), 'no' => ($no != 0 ? intval((($no/$total)*100)) : 0));
        }
    }
    
    function get_poll($tid){

        $poll = new Poll($tid);
        $data = $poll->get_results();
        
        if(!isset($_SESSION['voting'][$tid])){
            return '
                <ul class="vote">
                    <li class="yes"><a class="btn" data-vote="1">'.t('Likely').'</a><div class="row"><span></span></div><div class="label"></div></li>
                    <li class="no"><a class="btn" data-vote="0">'.t('Not Likely').'</a><div class="row"><span></span></div><div class="label"></div></li>
                </ul>';
        } else {
            //23
            $yes = (($data['yes']-1) <=0 ? "0%; border-right:0px !important;" : ($data['yes']-1)."%;");
            $no = (($data['no']-1) <=0 ? "0%; border-right:0px !important;" : ($data['no']-1)."%;");
            return '
                <ul class="vote disabled">
                    <li class="yes"><a class="btn" data-vote="1">'.t('Likely').'</a><div class="row"><span style="width:'.$yes.'"></span></div><div class="label">'.$data['yes'].'%</div></li>
                    <li class="no"><a class="btn" data-vote="0">'.t('Not Likely').'</a><div class="row"><span style="width:'.$no.'"></span></div><div class="label">'.$data['no'].'%</div></li>
                </ul>';
        }
    }
    
?>