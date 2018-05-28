<?php
    define('DRUPAL_ROOT', '../');
    define('COUNT_TABLE', 'techtrends_2015_hits');
    require_once DRUPAL_ROOT . '/includes/bootstrap.inc';
    drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);
    
    global $language;
    if($language->language=='de'){
        include('inc/password_protect.php');
    }
    
    include('inc/counter.php');
    include('inc/poll.inc.php');
    

    if($_GET['showcount']=='yes'){
        $page_count_now = get_page_count();
        echo $page_count_now;
    }
    

    drupal_session_start();
    $session_id = session_id();

    //make the language to en by default
    //$language->language='en';
    
    //begin to handle ajax request
    if($_POST || isset($_GET['trend'])){ 
        if($_POST){
            $trend_id = $_POST['trend'];
            $v = $_POST['vote'];
        } else if($_GET){
            $trend_id = $_GET['trend'];
            $v = $_GET['vote'];
        }

        $vote = new Poll($trend_id);
        $vote->vote($v, $session_id);
        
        $data = $vote->get_results();

        print json_encode($data);
    } else {
        
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><? print t('Tech Trends 2015');?> | frog</title>
    
    <meta property="og:image" content="http://www.frogdesign.com/techtrends2015/images/tech_trends_2012_fb.png"/>
    <meta property="og:title" content="Tech Trends 2015"/>
    <meta property="og:description" content="Likely or Longshot: Vote on frog&rsquo;s 15 Tech Trends for 2015" />
    <meta property="og:url" content="http://www.frogdesign.com/techtrends2015" />
    <meta property="og:site_name" content="frog"/>
    <link type="text/css" rel="stylesheet" href="style.css?v=3" />
<!-- <link type="text/css" rel="stylesheet" href="//cloud.webtype.com/css/6ac4425b-a6b9-43b0-80e6-faf389d0c49d.css" media="all" />
    <script type="text/javascript" src="//use.typekit.net/jgf1lpt.js"></script>
    <script type="text/javascript">try{Typekit.load();}catch(e){}</script>
 -->

    
    <script type="text/javascript" src="/sites/all/themes/bootstrap/frogweb6/js/modernizr.js"></script>
    <script type="text/javascript" src="scripts/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="/sites/all/themes/bootstrap/frogweb6/js/jquery.inview.js"></script>
    <script type="text/javascript" src="scripts/script.js"></script>
    
    <!--[if lt IE 9]>
        <script src="/sites/all/themes/bootstrap/frogweb6/js/respond.min.js"></script>
    <![endif]-->
    
    <script charset="utf-8" src="https://js.hscta.net/cta/current.js"></script>
    <?php if($language->language == 'en'){
        $companies_to_watch = 'Companies to watch';
    ?>
        <script type="text/javascript">
            hbspt.cta.load(262724, '685cb887-c678-4396-8762-56946f24f49d');
        </script>
        <link type="text/css" rel="stylesheet" href="style/frogfont.css" />
    <?php } else if($language->language == 'de'){
        $companies_to_watch = 'Interessante Unternehmen';
    ?>
        <script type="text/javascript">
            hbspt.cta.load(262724, '685cb887-c678-4396-8762-56946f24f49d');
        </script>
        <link type="text/css" rel="stylesheet" href="style/frogfont.css" />
    <?php
    }else {
        $companies_to_watch = '公司';
    ?>
    <!--
        <script type="text/javascript">
            hbspt.cta.load(262724, 'c2078408-5ec5-4c39-893f-6874f4710d11');
        </script>
        -->
    <?php } ?>
</head>

<body class="<?php print $language->language;?>">
<?php
if($_GET['createdb']=='yes'){
    //create_column();
}

if($_GET['deletedb']=='yes'){
    //db_drop_table(COUNT_TABLE);
}
addinfo();
?>
    <header>
        <div class="container">
            <a class="logo" href="/"></a>
        </div>
    </header>

    <section id="mast">
        <div class="container">
            <?php if($language->language == 'en'){?>
                <div class="text-wrapper">
                    <h1>Tech Trends <span class="year">2015</span></h1>
                    <p class="white content">It’s our favorite time of year – when <a target="_blank" href="http://frogdesign.com" style="color:white;" >frogs</a> from around the world examine the state of technology’s future. Below you’ll find 15 declarations and projections from experts whose work continually advances the human experience. This compilation forecasts a few of our expectations for the future, and we look forward to your feedback as we collectively consider what is to come. </p>
                </div>
                <?php } else if($language->language == 'de'){
                ?>
                <div class="text-wrapper">
                    <h1>TECHNIK-TRENDS<span class="year">2015</span></h1>
                    <p class="white content">Die schönste Zeit des Jahres ist für uns, wenn <a target="_blank" href="http://frogdesign.com" style="color:white;" >frogs</a> überall in der Welt nach den neuesten Trends der Technik sucht. Im Folgenden finden Sie 15 Erklärungen und Projektionen von Experten, die mit ihrer Arbeit das Leben der Menschen verbessern möchten. Die Zusammenstellung zeigt einen Ausschnitt dessen, was wir von der Zukunft erwarten. Wir sind sehr gespannt auf Ihr Feedback. Lassen Sie uns gemeinsam überlegen, was noch kommen wird. </p>
                </div>
                <?php
                    }else { ?>
                        <div class="text-wrapper">
                        <h1>2015年科技新趋势</h1>
                        <p class="white content" >一年中最令人期待的时刻到来了，全球各地的“青蛙”为大家奉上一场对于未来科技的预测盛宴。您将看到15位设计大拿的宣言和规划，他们长期以来一直致力于提升人类的体验。这篇预测合辑集中呈现了我们对未来的一些期待，同样的，我们也十分期待您的反馈。</p>
                        </div>
            <?php } ?>
        </div>
    </section>
    
    <section id="trend-1" data-trend="16" class="trend-block">
        <div class="container">
            <div class="row-fluid">
                <div class="span6">
                    <?php if($language->language == 'en'){?>
                        <h2>Move Over "Step Counters"</h2>
                        <h3>by Allison Green Schoop</h3>
                        <p>Fitness technology startups are primed to shake up the health and fitness wearable industry, offering true insights and recommendations for athletic training.  3D, pressure, and motion sensors are being integrated to assess form, movement quality, and muscular exertion to automatically log your workouts and provide real-time recommendations to prevent injury and improve training.</p>
                    <?php } else if($language->language == 'de'){
                    ?>
                        <h2>WEIT MEHR ALS SCHRITTZÄHLER</h2>
                        <h3>by Allison Green Schoop</h3>
                        <p>Fitness-Technologie-Startups sind dabei, die Branche der tragbaren Gesundheits- und Finessgeräte mit neuen Erkenntnissen und Trainingsempfehlungen durchzuschütteln. Sie integrieren immer neue Funktionen wie zum Beispiel 3D, Druck- und Bewegungssensoren, um die Art und Intensität des Trainings, die Bewegungsqualität oder die Muskelanstrengung besser beurteilen zu können. Die Workouts werden automatisch erfasst und bieten Echtzeit-Empfehlungen, etwa zur Vermeidung von Verletzungen oder zur Verbesserung des Trainingseffekts.</p>
                    <?php
                        }else { ?>
                        <h2>"计步器"已落伍</h2>
                        <h3>Allison Green Schoop</h3>
                        <p>健身科技创业公司蓄势待发，即将撼动健康和健身业，并为运动训练提供及时反馈和专业建议。通过整合3D、压力和运动传感器技术，未来的“计步器”不但能评估运动形式、动作质量和肌肉施力状况，还可自动记录锻炼日志，并提供实时建议，避免使用者运动损伤的同时，还能进一步提升其训练效果。</p>
                    <?php } ?>
                    <p class="innovators"><?php echo $companies_to_watch;?>: <a href="http://www.sensoriafitness.com">Sensoria</a>, <a href="http://preorder.moov.cc/">Moov</a>, <a href="http://leohelps.com/">LEO</a>, <a href="https://www.gymwatch.com/">GYMWatch</a></p>
                </div>
                <div class="span6 voteBlock">
                    <h4><?php print t('What do you think?');?></h4>
                    <?php print get_poll(16); ?>
                    <?php print get_social_share(16);?>
                </div>
                <div class="clearfloat"></div>
            </div>
        </div>
    </section>
    
    <section id="trend-2" data-trend="17" class="background">
        <div class="container">
            <div class="row-fluid">
                <div class="span6 offset6">
                    <?php if($language->language == 'en'){?>
                        <h2>Ambient Intelligence Knows What’s Up</h2>
                        <h3>by Patrick Kalaher</h3>
                        <p>The introduction of Amazon Echo is just one of many examples of ambient intelligence. We’ll see a surge in products and services that quietly pay attention to what’s happening around them — learning what people do, how they sound, and what they’re interested in — all in the service of making better guesses as to what people might need or want. Prepare for a very smart, ambient world. </p>
                    <?php } else if($language->language == 'de'){
                        ?>
                        <h2>AMBIENT INTELLIGENCE WEISS, WAS LOS IST</h2>
                        <h3>by Patrick Kalaher</h3>
                        <p>Das unlängst vorgestellte Amazon Echo ist nur eines von vielen Beispielen für Ambient Intelligence (Umgebungsintelligenz). Schon bald werden immer mehr Produkte und Services auf den Markt kommen, die wahrnehmen können, was um sie herum geschieht, und daraus Schlüsse ziehen. Die Geräte werden lernen, was die Menschen tun, wie sie klingen oder was sie interessiert. Diese Erkenntnisse werden sie nutzen, um die Bedürfnisse und Wünsche ihrer Nutzer noch besser zu verstehen. Machen Sie sich bereit für eine intelligente Umgebung. </p>
                        <?php
                        }else { ?>
                        <h2>环境智能体贴入微</h2>
                        <h3>by Patrick Kalaher</h3>
                        <p>今年众多环境智能产品横空出世，亚马逊Echo只不过是沧海之一粟。关注周边事物——人们的行为、声音和兴趣——的产品和服务如雨后春笋般涌现。所有的一切都旨在更精确地了解人的需求。准备好迎接智能世界的到来吧。</p>
                    <?php } ?>
                    <p class="innovators"><?php echo $companies_to_watch;?>: <a href="http://www.amazon.com/oc/echo">Amazon Echo</a>, <a href="https://www.google.com/landing/now/">Google Now</a>, <a href="http://www.windowsphone.com/en-us/how-to/wp8/cortana/meet-cortana">Microsoft Cortana</a></p>
                </div>
                <div class="span6 voteBlock">
                    <h4><?php print t('What do you think?');?></h4>
                    <?php print get_poll(17); ?>
                    <?php print get_social_share(17);?>
                </div>
                <div class="clearfloat"></div>
            </div>
        </div>
    </section>
    
    <section id="trend-3" data-trend="18" class="trend-block">
        <div class="container">
            <div class="row-fluid">
                <div class="span6">
                    <?php if($language->language == 'en'){?>
                        <h2>Nano Particles Diagnose from the Inside Out</h2>
                        <h3>by Cobie Everdell</h3>
                        <p>What if our bodies could tell us we were sick, even before we felt symptoms? Nano particles, designed to live within the human body, are opening up opportunities to monitor the health of a person in real time with extreme accuracy. This emerging technology, along with other advanced diagnostics techniques, will enable instant disease detection, enabling much faster treatments and better outcomes. </p>
                    <?php } else if($language->language == 'de') {
                    ?>
                        <h2>NANOPARTIKEL DIAGNOSTIZIEREN AUS DEM INNEREN DES KÖRPERS</h2>
                        <h3>by Cobie Everdell</h3>
                        <p>Was wäre, wenn unser Körper uns mitteilen könnte, dass etwas mit ihm nicht stimmt, bevor wir überhaupt die ersten Symptome bemerken? Nanopartikel, die dafür entwickelt wurden, im Inneren des menschlichen Körpers zu existieren, eröffnen ganz neue Möglichkeiten der Gesundheitsüberwachung. Die neue Technik liefert extrem genaue Daten in Echtzeit. Zusammen mit anderen fortschrittlichen Diagnosetechniken ermöglicht sie die sofortige Erkennung von Krankheiten, eine schnellere Behandlung und bessere Heilungs-Chancen. </p>
                    <?php
                        }else { ?>
                        <h2>纳米粒由内而外进行诊断</h2>
                        <h3>by Cobie Everdell</h3>
                        <p>如果在毫无征兆时，身体就能提前警告我们生病了，那会怎样？植入体内的纳米粒就能实时精准监控健康状况。这一新兴科技，以及其他先进诊断技术，能即时诊断疾病，帮助病人获得更快的治疗和更好的治疗效果。</p>
                    <?php } ?>
                    <p class="innovators"><?php echo $companies_to_watch;?>: <a href="http://research.google.com/">Google[x]</a>, <a href="http://longnow.org/people/board/danny0/">Danny Hillis</a></p>
                </div>
                <div class="span6 voteBlock">
                    <h4><?php print t('What do you think?');?></h4>
                    <?php print get_poll(18); ?>
                    <?php print get_social_share(18);?>
                </div>
                <div class="clearfloat"></div>
            </div>
        </div>
    </section>
    
    <section id="trend-4" data-trend="19" class="background trend-block">
        <div class="container">
            <div class="row-fluid">
                <div class="span6 offset6">
                    <?php if($language->language == 'en'){?>
                        <h2>The Emergence of the Casual Programmer</h2>
                        <h3>by Robert Tuttle</h3>
                        <p>“Ubiquitous (or pervasive) computing” has become the norm as microprocessors, sensors, and cloud services made their way into almost everything in our homes, cars, offices, and beyond. It is becoming too burdensome for many connected product and service companies to deliver software that can anticipate use cases and integration points of thousands of new connected products coming to market. A shift is underway in software and service design where the command and control of this complex connected world around us will rely on “casual programming” experiences — giving every day, non-programming people the tools, services, and APIs usually reserved for the hackers and technology elite in friendly and accessible forms.</p>
                    <?php } else if($language->language == 'de'){
                    ?>
                        <h2>AUFSTIEG DER LAIEN-PROGRAMMIERER</h2>
                        <h3>by Robert Tuttle</h3>
<p>Mikroprozessoren, Sensoren und Cloud-Services haben mittlerweile Eingang gefunden in nahe zu alle Lebensbereiche – vom Zuhause über das Auto, den Arbeitsplatz und darüber hinaus. Ubiquitous Computing, also die allesdurchdringende Vernetzung des Alltags durch den Einsatz „intelligenter“ Gegenstände, wird Normalität. Allerdings wird es für die Anbieter solcher Produkte immer schwieriger, Software zu entwickeln, die alle künftigen Anwendungsmöglichkeiten und möglichen Verknüpfungen mit den abertausend neuen Produkten berücksichtigt, die derzeit entstehen. Die Folge davon ist ein Paradigmenwechsel in Software und Service Design. Gelegenheits-Programmierer übernehmen zunehmend die Steuerung und Kontrolle der komplexen vernetzen Welt um uns herum. Die dafür notwendigen Werkzeuge, Services und APIs, die in der Vergangenheit nur Hackern und der Technologie-Elite zugänglich waren, sind mittlerweile in nutzerfreundlichen Versionen verfügbar und können auch von Laien-Programmierern für eigene Entwicklungen problemlos verwendet werden. </p>                    
                        <?php
                        }else { ?>
                        <h2>黑客无孔不入</h2>
                        <h3>by Robert Tuttle</h3>
                        <p>从浴室磅秤到汽车钥匙，微处理器无处不在，“普适计算”的理念已深入人心。然而，真正的里程碑式的改变得仰赖“普适计算”——向不会编程的人们提供工具、服务和API（应用程序编程接口） ，配置其周围的世界，以满足其需求和生活方式。我们周遭世界的API会越来越多，也变得更易受攻击，并且用户需要更多地基于以用户为中心设计的程序模式与设备、系统对话。</p>
                    <?php } ?>
                    <p class="innovators"><?php echo $companies_to_watch;?>: <a href="https://ifttt.com/wtf">IFTTT</a>, <a href="http://www.wink.com/">Wink</a>, <a href="https://zapier.com/how-it-works/">Zapier</a></p>
                </div>
                <div class="span6 voteBlock">
                    <h4><?php print t('What do you think?');?></h4>
                    <?php print get_poll(19); ?>
                    <?php print get_social_share(19);?>
                </div>
                <div class="clearfloat"></div>
            </div>
        </div>
    </section>
    
    <section id="trend-5" data-trend="20" class="trend-block">
        <div class="container">
            <div class="row-fluid">
                <div class="span6">
                    <?php if($language->language == 'en'){?>
                        <h2>Eat Your Technologies</h2>
                        <h3>by Eric Boam</h3>
                        <p>Recently, cutting edge technology has been pushing its way into the food chain. In 2015 it will finally make its way to the dinner table. From 3D printed meals to data-derived diets to efficient home farming, technology is poised to revolutionize the dinner options in a 21st century home. </p>

                    <?php }else if($language->language == 'de'){
                    ?>
                        <h2>TECHNIK ZUM ESSEN</h2>
                        <h3>by Eric Boam</h3>
                        <p>Seit Neuesten finden Technlogien auch den Weg in die Nahrungskette. 2015 werden sie erstmals auf dem Esstisch zu finden sein. Mahlzeiten aus dem 3D-Drucker, datengesteuerte Diäten oder effizienter Anbau von Nahrungsmitteln im eigenen Zuhause – vieles ist denkbar. Eines ist gewiss: Moderne Technologie wird die Essgewohnheiten des 21. Jahrhunderts grundlegend revolutionieren. </p>

                    <?php
                        } else { ?>
                        <h2>餐桌上的科技</h2>
                        <h3>by Eric Boam</h3>
                        <p>最近，领先科技进军食品业。到2015年，科技将更多地走上我们的餐桌。从3D打印食物，以数据为导向的饮食，再到家庭农场，科技正在改变着21世纪家庭的用餐选择。</p>
                    <?php } ?>
                    <p class="innovators"><?php echo $companies_to_watch;?>: <a href="http://the-sugar-lab.com/ChefJet">ChefJet</a>, <a href="http://cookmellow.com/meet-mellow/">Mellow</a>, <a href="http://3drobotics.com/">3D Robotics</a></p>
                </div>
                <div class="span6 voteBlock">
                    <h4><?php print t('What do you think?');?></h4>
                    <?php print get_poll(20); ?>
                    <?php print get_social_share(20);?>
                </div>
                <div class="clearfloat"></div>
            </div>
        </div>
    </section>
    
    <section id="trend-6" data-trend="21" class="background">
        <div class="container">
            <div class="row-fluid">
                <div class="span6 offset6">
                    <?php if($language->language == 'en'){?>
                        <h2>The Internet of Food Goes Online</h2>
                        <h3>by Matteo Penzo</h3>
                        <p>2015 will see a new roster of connected kitchen devices that will profoundly change the way we produce, consume, and interact with food. Don’t be surprised to come home to a robot cooking pizza from original Italian recipes available on the Internet, or by making coffee (almost) out of your smartphone.</p>
                    <?php } else if($language->language == 'de'){
                        ?>
                        <h2>DAS INTERNET DES ESSENS GEHT ONLINE</h2>
                        <h3>by Matteo Penzo</h3>
                        <p>2015 erscheint eine Reihe neuer vernetzter Küchengeräte, die die Art und Weise, wie wir unsere Nahrung produzieren und konsumieren, grundlegend verändern. Wundern Sie sich nicht, wenn Ihr Küchenroboter Ihnen demnächst eine Pizza nach einem italinischen Originalrezept zubereitet, das er selbst im Internet gefunden hat, oder wenn Sie ihren Kaffee (überwiegend) mit dem Smartphone zubereiten.</p>
                        <?php
                        }else { ?>
                        <h2>“（食）物联网”时代即将到来</h2>
                        <h3>by Matteo Penzo</h3>
                        <p>2015年，联网厨房设施的新秀们将颠覆我们与食物间的关系。如果回到家，看见机器人正遵照网上配方，制作正宗的意大利披萨，或是（借助）智能手机就能泡咖啡，请千万不要惊讶。</p>
                    <?php } ?>
                    <p class="innovators"><?php echo $companies_to_watch;?>: <a href="https://www.myvessyl.com/">My Vessyl</a>, <a href="http://www.lg.com/us/discover/smartthinq/thinq">LG</a></p>
                </div>
                <div class="span6 voteBlock">
                    <h4><?php print t('What do you think?');?></h4>
                    <?php print get_poll(21); ?>
                    <?php print get_social_share(21);?>
                </div>
                <div class="clearfloat"></div>
            </div>
        </div>
    </section>
    
    <section id="trend-7" data-trend="22" class="trend-block">
        <div class="container">
            <div class="row-fluid">
                <div class="span6">
                    <?php if($language->language == 'en'){?>
                        <h2>Mobilizing the Next 4 Billion</h2>
                        <h3>by Daniel McCallum</h3>
                        <p>Mobile is transforming developing markets; opening access to critical services like education and healthcare, improving financial inclusion and improving the efficiency of trade. frog is at the forefront of this transformation, researching and designing mobile solutions for the underserved in a diverse range of markets. With over four billion people yet to connect to the internet, the opportunity to create meaningful impact is immense.</p>
                    <?php } else if($language->language == 'de'){
                        ?>
                        <h2>MOBILISIERUNG DER NÄCHSTEN VIER MILLIARDEN MENSCHEN</h2>
                        <h3>by Daniel McCallum</h3>
                        <p>Die mobilen Technologien verändern die Märkte in Entwicklungsländern grundlegend. Sie eröffnen den Menschen neue Zugangsmöglichkeiten zu wichtigen Dienstleistungen wie Gesundheitsversorgung und Bildung, ermöglichen Bankgeschäfte und verbessern die Effizienz des Handels. frog unterstützt diese Entwicklung an vorderster Front. Wir erforschen und entwickeln mobile Lösungen für die Unterversorgten in einem breiten Marktspektrum. Über vier Milliarden Menschen sind noch immer nicht mit dem Internet verbunden. Die Möglichkeiten für sinnvolle Lösungen sind also immens.</p>
                        <?php
                        }else { ?>
                        <h2>移动技术，为了“线下”的40亿人</h2>
                        <h3>by Daniel McCallum</h3>
                        <p>移动技术正改变着飞速发展中的市场。通过开放关键性领域的服务，例如教育和医疗保健，移动技术正走在增进金融包容性、提升贸易效率的路上。作为这场改革的弄潮儿，青蛙设计为各大市场暂时还享受不到此项服务的用户研究并设计了移动解决方案。目前，仍有逾40亿人没有接入互联网，影响未来的机遇无穷。</p>
                    <?php } ?>
                    <p class="innovators"><?php echo $companies_to_watch;?>:  <a href="http://internet.org/">Internet.org</a>, <a href="http://www.google.com/loon/">Google project Loon</a>, <a href="http://www.gsma.com/mobilefordevelopment/programmes/magri">GSMA mAgri</a>,</p>
                </div>
                <div class="span6 voteBlock">
                    <h4><?php print t('What do you think?');?></h4>
                    <?php print get_poll(22); ?>
                    <?php print get_social_share(22);?>
                </div>
                <div class="clearfloat"></div>
            </div>
        </div>
    </section>
        
    <section id="trend-8" data-trend="23" class="background">
        <div class="container">
            <div class="row-fluid">
                <div class="span6 offset6">
                    <?php if($language->language == 'en'){?>
                        <h2>Personal Darknets in the Spotlight</h2>
                        <h3>by Patrick Kalaher</h3>
                        <p>Secure messaging had the reputation of being for shady people. But ever since a series of high-profile hacks in 2014 laid bare the private lives of several celebrities —  as well as thousands of civilians — there has been massive interest in messaging (voice, text, photo, and video) that is meant to be fundamentally secure from snooping.  A new set of products emerged to take up this challenge, including everything from personal data vaults, to secure encrypted calls, to video chats. Expect to see even more platforms that make it easier for you to live anonymously online. </p>
                    <?php } else if($language->language == 'de'){
                    ?>
                        <h2>PERSÖNLICHE DAKRNETS IM BLICKPUNKT</h2>
                        <h3>by Patrick Kalaher</h3>
                        <p>Spätestens nach den diversen Hacker- und Spionageskandalen von 2014 ist 
das Interesse an sicherer Kommunikation sprunghaft gestiegen. Seitdem sind viele neue Produkte auf den Markt gekommen, die sich dieser Herausforderung annehmen. Sie umfassen die Sicherung von persönlichen Daten ebenso wie abhörsichere Telefonate oder verschlüsselte Video-Chats. Erwarten Sie in Zukunft noch mehr Plattformen, die es einfacher für Sie machen, anonym in der Online-Welt zu leben.
</p>
                    <?php
                        }else { ?>
                        <h2>个人隐私暴露在光天化日之下</h2>
                        <h3>by Patrick Kalaher</h3>
                        <p>曾经，世人普遍认为加密通信是专供那些鬼鬼祟祟的人所用的。但是，2014年发生了一系列高调入侵多位名人和上万普通民众隐私的事件，一夜之间，通信信息（语音、短信、照片和视频）里蕴含着的巨大利益被暴露在阳光下，从根本上防止他人窥探成为了人人关心的话题。为应对这一挑战，一系列新产品涌现，从个人数据仓库到加密电话和视频通信，一应俱全。未来，会有更多平台让您轻松享受匿名的网络生活。</p>
                    <?php } ?>
                    <p class="innovators"><?php echo $companies_to_watch;?>: <a href="https://silentcircle.com/">Silent Circle’s Blackphone</a>, <a href="https://spideroak.com/">SpiderOak Cloud Storage</a>, <a href="http://www.geeksphone.com/">Geeksphone</a>, <a href="http://darkmail.info/">DarkMail Alliance</a></p>
                </div>
                <div class="span6 voteBlock">
                    <h4><?php print t('What do you think?');?></h4>
                    <?php print get_poll(23); ?>
                    <?php print get_social_share(23);?>
                </div>
                <div class="clearfloat"></div>
            </div>
        </div>
    </section>
    
    <section id="trend-9" data-trend="24" class="trend-block">
        <div class="container">
            <div class="row-fluid">
                <div class="span6">
                    <?php if($language->language == 'en'){?>
                        <h2>4D Printing Assembles Itself</h2>
                        <h3>by Phil Salesses</h3>
                        <p>Imagine a factory in the future where the parts of a product assemble themselves, or where physical objects can adapt to a user over time. For instance, a 4D-printed chair could become more comfortable over time, or become stronger at stress points, instead of breaking. What if? This is the aim of 4D printing, a field popularized by MIT’s  Skylar Tibbits and his self-assembly lab. We’re on the verge of seeing explosive progress in the world of 4D printing. Expect to read about advancements in the field in the near future. </p>
                    <?php } else if($language->language == 'de'){
                        ?>
                        <h2>4D-DRUCK MONTIERT SICH SELBST</h2>
                        <h3>by Phil Salesses</h3>
                        <p>Stellen Sie sich eine Fabrik vor, in der sich die Einzelteile von selbst zusammenbauen. Oder denken Sie an physische Objekte, die sich nach und nach an ihren Benutzer anpassen. Beispielsweise könnte ein 4D-gedruckter Stuhl über die Zeit immer bequemer werden. Anstatt zu brechen, würden seine kritischen Stellen widerstandsfähiger werden. Was wäre wenn? Genau das ist der Ansatz von 4D-Druck, einer Idee, die vom Skylar Tibbits des MIT und dessen Selbstorganisationslabor vorangetrieben wird. Wir stehen kurz vor dem Durchbruch und werden explosive Fortschritte in der Welt des 4D-Drucks sehen. Schon bald werden Sie mehr über die Fortschritte in diesem Gebiet lesen können. </p>
                        <?php
                        }else { ?>
                        <h2>4D打印可自行组装</h2>
                        <h3>by Phil Salesses</h3>
                        <p>试想在未来工厂，产品可自行组装，物体能慢慢适应其使用者。举个例子，随着时间推移，4D打印的椅子会越来越舒适，或是椅子变得越来越结实，不会断裂。如果这就是4D打印的目的呢？麻省理工学院专家Skylar Tibbits和他的自组装实验室正在引领这场风潮。我们即将见证4D打印技术的迅猛发展。在不久的将来，会有更多关于该领域发展的信息。</p>
                    <?php } ?>
                    <p class="innovators"><?php echo $companies_to_watch;?>: <a href="http://n-e-r-v-o-u-s.com/blog/?p=4467">Nervous</a>, <a href="http://www.stratasys.com/industries/education/4d-printing-project">Stratysys</a></p>
                </div>
                <div class="span6 voteBlock">
                    <h4><?php print t('What do you think?');?></h4>
                    <?php print get_poll(24); ?>
                    <?php print get_social_share(24);?>
                </div>
                <div class="clearfloat"></div>
            </div>
        </div>
    </section>
    
    <section id="trend-10" data-trend="25" class="background">
        <div class="container">
            <div class="row-fluid">
                <div class="span6 offset6">
                    <?php if($language->language == 'en'){?>
                        <h2>Digital Currency Replaces Legal Tender</h2>
                        <h3>by Venetia Tay</h3>
                        <p>Digital currencies, including crypto-currencies, will thrive. Governments are exploring frameworks and systems to regulate and manage digital currencies, which will make their ubiquity in our everyday financial vernacular more profound.  Ecuador’s Congress recently approved a reform to create a digital currency, and the New York State Department of Financial Services is considering establishing virtual currency exchanges. The UK government is calling for information about the benefits and risks of digital currencies. We can expect digital currencies to be used interchangeably with legal tender, giving birth to a frictionless, agile, universal payment system that will expand beyond the current banking ecosystem.</p>
                    <?php } else if($language->language == 'de'){
                        ?>
                        <h2>DIGITALE WÄHRUNGEN ERSETZEN GESETZLICHE ZAHLUNGSMITTEL</h2>
                        <h3>by Venetia Tay</h3>
                        <p>Digitale Währungen und Krypto-Währungen werden gedeihen und bald allgegenwärtig sein. Schon jetzt arbeiten die Regierungen an Rahmenbedingungen und Systemen, mit deren Hilfe digitale Zahlungsmittel reguliert und gesteuert werden können. So hat das Parlament von Equador erst kürzlich eine Reform zur Schaffung einer digitalen Landeswährung verabschiedet. Das New York State Department of Financial Services erwägt bereits die Einrichtung virtueller Wechselstuben. Und die Regierung Großbritanniens informiert sich zur Zeit über die Chancen und Risiken digitaler Währungen. Wir rechnen damit, dass digitale Währungen schon bald als gesetzliche Zahlungsmittel verwendet und untereinander tauschbar sein werden. Das wäre die Geburt eines reibungslosen, wendigen und universellen Zahlungssystems, das über das gegenwärtige Bankensystem weit hinaus geht.</p>
                        <?php
                        }else { ?>
                        <h2>数字货币替代法定货币</h2>
                        <h3>by Venetia Tay</h3>
                        <p>数字货币——包括加密电子货币——正在繁荣发展。政府正开发新的框架和系统，以规范和管理数字货币。数字货币将更加深入我们的日常金融生活。厄瓜多尔国会最近批准发行数字货币，而纽约州金融服务管理局正在考虑建立虚拟货币交易所。英国政府则呼吁慎重评估数字货币优势与风险。可以预想，数字货币被允许与法定货币兑换，一个没有摩擦、机动灵活的全球支付系统应运而生，该系统必将全面超越现有的银行生态系统。</p>
                    <?php } ?>
                    <p class="innovators"><?php echo $companies_to_watch;?>: <a href="http://panampost.com/belen-marty/2014/07/23/top-down-digital-currency-coming-to-ecuador-with-competition-banned/">Government of Ecuador</a>, <a href="https://www.gov.uk/government/news/digital-currencies-5-reasons-were-calling-for-information">The UK Government</a>, <a href="http://www.dfs.ny.gov/about/po_vc_03112014.pdf">New York State Department of Financial Services</a></p>
                </div>
                <div class="span6 voteBlock">
                    <h4><?php print t('What do you think?');?></h4>
                    <?php print get_poll(25); ?>
                    <?php print get_social_share(25);?>
                </div>
                <div class="clearfloat"></div>
            </div>
        </div>
    </section>
    
    <section id="trend-11" data-trend="26" class="trend-block">
        <div class="container">
            <div class="row-fluid">
                <div class="span6">
                    <?php if($language->language == 'en'){?>
                        <h2>The Rise of Cognitive Behavioral Therapy</h2>
                        <h3>by Steve Selzer</h3>
                        <p>What if your app and wearable device could not only diagnose your sleep apnea, stress, and anxiety, but also provide clinically proven treatments?
While wearable health activity trackers were all the rage in 2014, the future will see the rise of therapeutic solutions: data-tracking hardware paired with clinically proven software that simulates cognitive behavioral therapy. These new solutions will address chronic behavioral conditions, from sleep disorders to stress and anxiety. 
</p>
                    <?php } else if($language->language == 'de'){
                        ?>
                        <h2>DER AUFSTIEG DER KONGNITIVEN VERHALTENSTHERAPIE</h2>
                        <h3>by Steve Selzer</h3>
                        <p>Was wäre, wenn Ihr Mobilgerät mi Hilfe einer App nicht nur Ihre Schlafstörungen, Stress oder Angst diagnostizieren könnte, sondern Ihnen auch klinisch bewährte Behandlungen anbieten würde? Waren tragbare Aktivitäts- und Gesundheitstracker im letzten Jahr noch der neueste Schrei, werden in Zukunft therapeutische Lösungen den Markt erobern: Daten-Tracking-Hardware wird mit klinisch bewährter Software gepaart, die kognitive Verhaltenstherapien simuliert. Die neuen Lösungen werden gezielt chronische Verhaltensstörungen wie Schlafstörungen, Stress oder Angst zu korrigieren helfen. </p>
                        <?php
                        }else { ?>
                        <h2>认知行为疗法兴起</h2>
                        <h3>by Steve Selzer</h3>
                        <p>要是应用程序和可穿戴设备不仅能诊断出睡眠中止症、压力和焦虑情绪，还能提供临床证实的疗法呢？2014年，可穿戴健康追踪器火速风靡。未来，治疗解决方案将兴起，也就是说，数据追踪硬件与临床证实的软件相结合，模拟认知行为疗法。这些新的解决方案针对的是长期困扰现代人类的慢性疾病，包括睡眠障碍、压力和焦虑。
</p>
                    <?php } ?>
                    <p class="innovators"><?php echo $companies_to_watch;?>: <a href="https://www.bighealth.com/">Big Health</a>, <a href="https://golantern.com/">Lantern</a>, <a href="https://www.indiegogo.com/projects/olive-a-wearable-to-manage-stress">Olive</a></p>
                </div>
                <div class="span6 voteBlock">
                    <h4><?php print t('What do you think?');?></h4>
                    <?php print get_poll(26); ?>
                    <?php print get_social_share(26);?>
                </div>
                <div class="clearfloat"></div>
            </div>
        </div>
    </section>
    
    <section id="trend-12" data-trend="27" class="background">
        <div class="container">
            <div class="row-fluid">
                <div class="span6 offset6">
                    <?php if($language->language == 'en'){?>
                        <h2>Textiles Get Techy</h2>
                        <h3>by Adam Pruden</h3>
                        <p>Your everyday items will be getting an upgrade. More and more companies and designers will create innovative smart textiles embedded with new technologies and sensors, which will impact everyday lives by monitoring health, behavior, and the environment. This year the hottest wearable device might just be the shirt on your back.</p>
                    <?php } else if($language->language == 'de'){
                        ?>
                        <h2>KLEIDUNG WIRD INTELLIGENT</h2>
                        <h3>by Adam Pruden</h3>
                        <p>Alltagsgegenstände wie zum Beispiel Kleidungsstücke werden aufgewertet. Immer mehr Unternehmen und Designer entwickeln innovative intelligente Textilien. Indem sie neue Technologien und Sensoren in die Kleidung integrieren, die zum Beispiel die Gesundheit ihres Trägers, sein Verhalten oder seine Umgebung erfassen, werden sie unser Leben stark verändern. Machen Sie sich auf eine Überraschung gefasst: Das heißeste Gadget des Jahres könnte dieses Mal ein T-Shirt sein.</p>
                        <?php
                        }else { ?>
                        <h2>服装面料高科技化</h2>
                        <h3>by Adam Pruden</h3>
                        <p>日常用品也将升级。越来越多的公司和设计师融入新技术和传感器，创新智能布料。该布料可检测健康、行为和周围环境，影响人们的日常生活。明年，炙手可热的可穿戴设备可能就藏在您衣服后面某个不起眼的角落中。</p>
                    <?php } ?>
                    <p class="innovators"><?php echo $companies_to_watch;?>: <a href="http://www.rochester.edu/newscenter/watch-rochester-cloak-uses-ordinary-lenses-to-hide-objects-across-continuous-range-of-angles-70592/">Rochester Cloak (Invisibility Cloak)</a>, <a href="http://www.cityzensciences.fr/en/">Cityzen Sciences (Smart Sensing Fabric)</a>, <a href="http://www.gradozero.eu/gzenew/index.php?lang=en">Grado Zero Espace</a></p>
                </div>
                <div class="span6 voteBlock">
                    <h4><?php print t('What do you think?');?></h4>
                    <?php print get_poll(27); ?>
                    <?php print get_social_share(27);?>
                </div>
                <div class="clearfloat"></div>
            </div>
        </div>
    </section>
    
    <section id="trend-13" data-trend="28" class="trend-block">
        <div class="container">
            <div class="row-fluid">
                <div class="span6">
                    <?php if($language->language == 'en'){?>
                        <h2>Adaptive Education Personalizes Learning</h2>
                        <h3>by Caroline Bone</h3>
                        <p>Adaptive technologies will become omnipresent both in and out of the classroom, providing students with the ability to learn content at their own pace and potentially test out of areas when they are ready. Real-time data will lead to more actionable items for students and teachers—allowing for a personalized path to success.</p>
                    <?php } else if($language->language == 'de'){
                        ?>
                        <h2>ADAPTIVE BILDUNG PERSONALISIERT DAS LERNEN</h2>
                        <h3>by Caroline Bone</h3>
                        <p>Anpassungsfähige Technologien werden schon bald allgegenwärtig sein – sowohl innerhalb als auch außerhalb des Klassenzimmers. Sie ermöglichen es den Schülern, den Stoff in ihrem eigenen Tempo zu lernen. Wenn die Schüler bereit sind, könnten damit sogar Prüfungen durchgeführt werden. Echtzeitdaten liefern Schülern und Lehrern neue, umsetzbare Übungen und unterstützen sie auf ihrem persönlichen Weg zum Lernerfolg. </p>
                        <?php
                        }else { ?>
                        <h2>动态适配教育，定制个性化学习</h2>
                        <h3>by Caroline Bone</h3>
                        <p>动态适配技术将成为课内外不可或缺的部分。通过它，学生可按自己的节奏学习知识，并在某些领域出类拔萃。实时数据给予师生更多更行的方案，让其可为自己定制成功之路。</p>
                    <?php } ?>
                    <p class="innovators"><?php echo $companies_to_watch;?>: <a href="http://www.knewton.com/">Knewton</a>, <a href="http://www.aleks.com/">Aleks</a>, <a href="http://info.altschool.com/signup/">Alt School</a>, <a href="http://www.dreambox.com/">Dreambox</a>, <a href="https://itunes.apple.com/app/id932869530?mt=8" >Kidaptive</a></p>
                </div>
                <div class="span6 voteBlock">
                    <h4><?php print t('What do you think?');?></h4>
                    <?php print get_poll(28); ?>
                    <?php print get_social_share(28);?>
                </div>
                <div class="clearfloat"></div>
            </div>
        </div>
    </section>
    <section id="trend-14" data-trend="29" class="background">
        <div class="container">
            <div class="row-fluid">
                <div class="span6 offset6">
                    <?php if($language->language == 'en'){?>
                        <h2>Achievement Unlocked: You’re Hired!</h2>
                        <h3>by Sheryl Cababa</h3>
                        <p>Hiring is time-consuming. To save time during the hiring process in 2015, more companies will turn to video games to evaluate job candidate nuances such as creativity, problem solving, and collaboration. Candidates’ game scores will be measured against scores of successful employees, making hard data — alongside subjective opinions from hiring managers — an asset to predict success.</p>                        
                    <?php } else if($language->language == 'de'){
                        ?>
                        <h2>LEISTUNG FREIGESETZT: IHR SEID EINGESTELLT</h2>
                        <h3>by Sheryl Cababa</h3>
                        <p>Neue Mitarbeiter einzustellen, kostet viel Zeit. Um den Aufwand zu reduzieren, testen immer mehr Unternehmen ihre Bewerber mit Hilfe von Videospielen. Diese messen Eigenschaften wie Kreativität, Problemlösungskapazität oder die Bereitschaft zur Zusammenarbeit und vergleichen die Ergebnisse der Bewerber dann mit denen erfolgreicher Mitarbeiter. Auf diese Weise gewinnt das Unternehmen wertvolle Erkenntnisse über den voraussichtlichen späteren Erfolg des Bewerbers, die den subjektiven Eindruck des einstellenden Managers ergänzen.</p>
                        <?php
                        }else { ?>
                        <h2>开启成功之门: 你被录用了!</h2>
                        <h3>by Sheryl Cababa</h3>
                        <p>招聘是一项费时费力的工作。为了在2015年招聘季节省更多的时间，越来越多的公司开始利用电子游戏评估应聘者能力，例如创造力、解决问题和合作能力。对比应聘者与现役员工的游戏得分、硬性数据和主观评价一道成为评估员工的方式。</p>
                    <?php } ?>
                    <p class="innovators"><?php echo $companies_to_watch;?>: <a href="https://www.knack.it/">Knack</a></p>
                </div>
                <div class="span6 voteBlock">
                    <h4><?php print t('What do you think?');?></h4>
                    <?php print get_poll(29); ?>
                    <?php print get_social_share(29);?>
                </div>
                <div class="clearfloat"></div>
            </div>
        </div>
    </section>

    <section id="trend-15" data-trend="30" class="trend-block">
        <div class="container">
            <div class="row-fluid">
                <div class="span6">
                    <?php if($language->language == 'en'){?>
                        <h2>Micro-farming Networks go Mainstream</h2>
                        <h3>by Jason Severs</h3>
                        <p>Everyone will grow their own organic lettuce and trade it on a local social network for other types of vegetables. Our habits around food production and consumption are undergoing a radical shift, from wider adoption of CSAs to the prevalence of organic food, consumers are taking control of how and what they eat with new smart food technologies. Several companies are designing easy-to-use and aesthetically pleasing hydroponics and aquaponics systems for the home, which will allow anyone to manage a mini-farm with a smartphone. Greater food autonomy is on the horizon. </p>
                    <?php } else if($language->language == 'de'){
                        ?>
                        <h2>MICRO-LANDWIRTSCHAFT VOR DEM DURCHBRUCH</h2>
                        <h3>by Jason Severs</h3>
                        <p>Unsere Gewohnheiten rund um die Produktion und den Konsum von Nahrungsmitteln befinden sich in einem radikalen Wandel. Schon bald wird jeder seinen eigenen Bio-Salat anbauen können und ihn über ein lokales soziales Netzwerk gegen anderes Gemüse tauschen. Die Gemeinschaftlich Getragene Landwirtschaft (Community Supported Agriculture, CSA) wird an Bedeutung gewinnen, ebenso der Konsum von Bio-Lebensmitteln. Die Verbraucher übernehmen zunehmend wieder die Kontrolle darüber, was sie essen und wie ihre Nahrung mit Hilfe neuer, intelligenter Lebensmitteltechnologien produziert wird. Mehrere Unternehmen entwickeln einfach zu bedienende und ästhetisch ansprechende Hydrokulturen und Aquaponik-Systeme für zu Hause, die es jedem gestatten, seinen Mini-Bauernhof ganz einfach mit einem Smartphone zu verwalten. Die Menschen können über ihre Nahrung wieder selbst bestimmen.</p>
                        <?php
                        }else { ?>
                        <h2>微农作成为主流</h2>
                        <h3>by Jason Severs</h3>
                        <p>每个人都能吃上自家种的生菜，并可以通过当地社交网络与他人交换蔬菜。从CSA（社区支持农业）的推广到有机食品的流行，食品的生产和消费方式正经历一场巨变。有了最新的智能食品技术，吃什么？怎么吃？消费者自己说了算。多家公司正在为家庭研发简单易用、美观大方的水耕栽培和鱼菜共生设备，用智能手机即可管理一块微型农场。吃什么自己决定，不再遥远。</p>
                    <?php } ?>
                    <p class="innovators"><?php echo $companies_to_watch;?>: <a href="http://getniwa.com/">Niwa</a>, <a href="http://www.pantrylabs.com/">Pantry Labs</a>, <a href="http://www-03.ibm.com/ibm/history/ibm100/us/en/icons/deepthunder/">IBM Deep Thunder</a></p>
                </div>
                <div class="span6 voteBlock">
                    <h4><?php print t('What do you think?');?></h4>
                    <?php print get_poll(30); ?>
                    <?php print get_social_share(30);?>
                </div>
                <div class="clearfloat"></div>
            </div>
        </div>
    </section>
    <div class="container related-bottom"> 
    <div class="row-fluid">
        <section class="block ">
         <div class="span12 section related">
                <div class="header"><h2>Related Case Studies</h2></div>
                <div class="span3"><div class="square"><article id="node-2923" class="node node-work skirt txt-clr-black txt-ln-lm" data-terms="95,99,101,115,117,172">
                                                <div class="content">
                    <div class="type"><span>NEW MATTER</span></div>
                    <div class="image">
                        <a href="http://www.frogdesign.com/work/new-matter-3d-printing-ecoystem.html"><img src="images/f1.jpg" width="600" height="600" alt="START BUILDING"></a>                    </div>
                                    <div class="info" style="display: none;">
                        <div class="cont">
                            <h3><a href="http://www.frogdesign.com/work/new-matter-3d-printing-ecoystem.html">START BUILDING</a></h3>
                            <p>A whole new way to make, connect, and collect.</p>
                                                    </div>
                    </div>
                </div>
                                
</article> </div></div><div class="span3"><div class="square"><article id="node-2817" class="node node-work skirt txt-clr-white txt-ln-rb" data-terms="95,115,117,118,119,136,137,138">
                                                <div class="content">
                    <div class="type"><span>HONEYWELL</span></div>
                    <div class="image">
                        <a href="http://www.frogdesign.com/work/honeywell-case-study.html"><img src="images/f2.png" width="600" height="600" alt="HONEYWELL CONNECTED HOME"></a>                    </div>
                                    <div class="info" style="display: none;">
                        <div class="cont">
                            <h3><a href="http://www.frogdesign.com/work/honeywell-case-study.html">CONNECTED HOME</a></h3>
                            <p>Leveraging Honeywell’s technologies to delight consumers.</p>
                                                    </div>
                    </div>
                </div>
                                
</article> </div></div><div class="span3"><div class="square"><article id="node-2833" class="node node-work skirt txt-clr-white txt-ln-lm" data-terms="127,110,117,172">
                                                <div class="content">
                    <div class="type"><span>KIDAPTIVE</span></div>
                    <div class="image">
                        <a href="http://www.frogdesign.com/work/kidaptive-learner-mosaic.html"><img src="images/f3.png" width="600" height="600" alt="KIDAPTIVE LEARNER MOSAIC"></a>                    </div>
                                    <div class="info" style="display: none;">
                        <div class="cont">
                            <h3><a href="http://www.frogdesign.com/work/kidaptive-learner-mosaic.html">LEARNER MOSAIC</a></h3>
                            <p>Activating parents to engage in their child’s development.</p>
                                                    </div>
                    </div>
                </div>
                                
</article> </div></div><div class="span3"><div class="square"><article id="node-2843" class="node node-work skirt txt-clr-black txt-ln-lt" data-terms="95,109,110,128,119,175">
                                                <div class="content">
                    <div class="type"><span>TECH TRENDS</span></div>
                    <div class="image">
                        <a href="http://www.frogdesign.com/techtrends2014/"><img src="images/f4.png" width="600" height="600" alt="techtrend2015"></a>                    </div>
                                    <div class="info" style="display: none;">
                        <div class="cont">
                            <h3><a href="http://www.frogdesign.com/techtrends2014/">Tech Trends 2014</a></h3>
                            <p>Last year's 15 technology predictions</p>
                                                    </div>
                    </div>
                </div>
                                
</article> </div></div>
            </div>
    </section>
    </div><!-- row-fluid -->
    </div><!-- container -->
    
    <div class="clearfloat"></div>
    <footer>
        <div class="container">
            <div class="row-fluid">
                <div class="span4">
                    <p><span class="logo">frog</span></p>
                    <p><?php print t('Design and innovation that advances the human experience.');?></p>
                    <ul class="studios clearfix">
                        <li><a href="/contact/new-business.html"><?php print t('New Business')?></a></li>
                        <li><a href="/careers/jobs.html"><?php print t('Careers');?></a></li>
                        <li><a href="/contact/media.html"><?php print t('Media');?></a></li>
                        <li><a href="/careers/internships.html"><?php print t('Internships');?></a></li>
                    </ul>
                </div>
                <div class="span3 offset1">
                    <h3><?php print t('Studios');?></h3>
                    <ul class="studios clearfix"><li class="first"><a href="/contact/amsterdam.html"><? print t('Amsterdam');?></a></li>
                        <li><a href="/contact/austin.html"><? print t('Austin');?></a></li>
                        <li><a href="/contact/boston.html"><? print t('Boston');?></a></li>
                        <li><a href="/contact/london.html"><? print t('London');?></a></li>
                        <li><a href="/contact/milan.html"><? print t('Milan');?></a></li>
                        <li><a href="/contact/munich.html"><? print t('Munich');?></a></li>
                        <li><a href="/contact/new-york.html"><? print t('New York');?></a></li>
                        <li><a href="/contact/san-francisco.html"><? print t('San Francisco');?></a></li>
                        <li><a href="/contact/seattle.html"><? print t('Seattle');?></a></li>
                        <li class="last"><a href="/contact/shanghai.html"><? print t('Shanghai');?></a></li>
                    </ul>
                </div>
                <div class="span3 offset1">
                    <h3><?php print t('Elsewhere');?></h3>
                    <ul class="studios clearfix">
                        
                        <li class="first"><a href="/contact#additional"><?php print t('Dubai');?></a></li>
                        <li><a href="/contact#additional"><?php print t('Seoul');?></a></li>
                        <li><a href="/contact#additional"><?php print t('Singapore');?></a></li>
                        <li><a href="/contact#additional"><?php print t('Tokyo');?></a></li>
                        <li class="last"><a href="/contact#additional"><?php print t('Tel Aviv');?></a></li>
                    </ul>
                    <ul class="social visible white">
                        <?php if($language->language == 'zh-hans'){ ?>
                            <li class="sinaweibo"><a href="http://www.weibo.com/frogchina/">Sina Weibo</a></li>
                            <li class="youku"><a href="http://i.youku.com/frogdesign">Youku</a></li>
                            <li class="linkedin"><a href="http://www.linkedin.com/company/163904">LinkedIn</a></li>
                            <li class="flickr"><a href="http://www.flickr.com/frogdesign">Flickr</a></li>
                            <li class="instagram"><a href="http://instagram.com/frog_design">Instagram</a></li>
                        <?php } else { ?>
                            <li class="twitter"><a href="https://twitter.com/frogdesign">Twitter</a></li>
                            <li class="facebook"><a href="https://www.facebook.com/pages/frog-design/5612622846">Facebook</a></li>
                            <li class="linkedin"><a href="http://www.linkedin.com/company/163904">LinkedIn</a></li>
                            <li class="vimeo"><a href="http://vimeo.com/frog">Vimeo</a></li>
                            <li class="instagram"><a href="http://instagram.com/frog_design">Instagram</a></li>
                        <?php } ?>
                    </ul>
                </div>
                <p class="legal">© 2015 frog design inc. <?php print t('All Rights Reserved');?>. <a href="/privacy-policy.html"><?php print t('Privacy Policy');?></a> | <a href="/terms-of-use.html"><?php print t('Terms of Use');?></a></p>
            </div>
            
        </div>
    </footer>
    <?php if($language->language == 'en') { ?>
        <script type="text/javascript">
            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-592165-1']);
            _gaq.push(['_trackPageview']);
            
            (function() {
              var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
              ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
              var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
            })();

            (function(d,s,i,r) {
                  if (d.getElementById(i)){return;}
                  var n=d.createElement(s),e=d.getElementsByTagName(s)[0];
                  n.id=i;n.src='//js.hubspot.com/analytics/'+(Math.ceil(new Date()/r)*r)+'/262724.js';
                  e.parentNode.insertBefore(n, e);
              })(document,"script","hs-analytics",300000);
        </script>
    <?php } else {?>
        <script type="text/javascript">
            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-592165-9']);
            _gaq.push(['_trackPageview']);
            
            (function() {
              var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
              ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
              var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
            })();
        </script>
    
    <?php } ?>
    
</body>
</html>
<? } ?>
