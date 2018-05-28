<?php
    define('DRUPAL_ROOT', '../');
    require_once DRUPAL_ROOT . '/includes/bootstrap.inc';
    drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);
    
    global $language;

    include('inc/poll.inc.php');
    
    drupal_session_start();
    $session_id = session_id();
    
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
    <title><? print t('Tech Trends 2014');?> | frog</title>
    
    <meta property="og:image" content="http://www.frogdesign.com/techtrends2014/images/tech_trends_2012_fb.jpg"/>
    <meta property="og:title" content="<? print t('Tech Trends 2014');?>"/>
    <meta property="og:description" content="<?php print t(htmlspecialchars("Likely or Not Likely: Vote on frog&rsquo;s 15 Tech Trends for 2014")); ?>" />
    <meta property="og:url" content="http://www.frogdesign.com/techtrends2014/" />
    <meta property="og:site_name" content="frog"/>
    
    <link type="text/css" rel="stylesheet" href="style.css?v=3" />
    <link type="text/css" rel="stylesheet" href="//cloud.webtype.com/css/6ac4425b-a6b9-43b0-80e6-faf389d0c49d.css" media="all" />

    <script type="text/javascript" src="//use.typekit.net/jgf1lpt.js"></script>
    <script type="text/javascript">try{Typekit.load();}catch(e){}</script>

    
    <script type="text/javascript" src="/sites/all/themes/bootstrap/frogweb6/js/modernizr.js"></script>
    <script type="text/javascript" src="scripts/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="/sites/all/themes/bootstrap/frogweb6/js/jquery.inview.js"></script>
    <script type="text/javascript" src="scripts/script.js"></script>
    
    <!--[if lt IE 9]>
        <script src="/sites/all/themes/bootstrap/frogweb6/js/respond.min.js"></script>
    <![endif]-->
    
    <script charset="utf-8" src="https://js.hscta.net/cta/current.js"></script>
    <?php if($language->language == 'en'){?>
        <script type="text/javascript">
            hbspt.cta.load(262724, '685cb887-c678-4396-8762-56946f24f49d');
        </script>
    <?php } else {?>
        <script type="text/javascript">
            hbspt.cta.load(262724, 'c2078408-5ec5-4c39-893f-6874f4710d11');
        </script>
    <?php } ?>
</head>

<body class="<?php print $language->language;?>">
    <header>
        <div class="container">
            <a class="logo" href="/"></a>
        </div>
    </header>

    <section id="mast">
        <div class="container">
            <h1><?php print t('Tech Trends 2014');?></h1>
        </div>
    </section>
    
    <section id="trend-1" data-trend="1">
        <div class="container">
            <div class="row-fluid">
                <div class="span6">
                    <?php if($language->language == 'en'){?>
                        <h2>Anonymity Will Go Mainstream</h2>
                        <h3>by John Leonard, Adam Silver, and Carlos Elena-Lenz</h3>
                        <p>The age of indiscriminate sharing on social networks is rapidly changing. In 2013 we learned of NSA leaks, privacy debacles, and massive inquiries into our digital lives. Simultaneously, a social platform based on transmitting communications with minimal digital tracks was valued at $4 billion. This isn’t a coincidence; scrutiny is playing an important role in how we sculpt our digital personas. In 2014 we’ll see an influx of platforms catering to a digital experience grounded in anonymity. The rise of “The Snapchats” is going mainstream.</p>
                    <?php } else { ?>
                        <h2>匿名将成为主流</h2>
                        <h3>by John Leonard, Adam Silver, and Carlos Elena-Lenz </h3>
                        <p>那个不加选择地在社交网络上分享自己信息的时代已经过去。在已过去的2013年里，“棱镜门”让我们明白所谓的隐私保护是如何地不堪一击，而诸如美国国家安全局这样的机构又是如何大规模地获取我们的数字信息的。与此同时，一个在传输通信过程中几乎不留有数字痕迹的社交平台已近价值40亿美元。这并不是一个巧合：在我们如何塑造自己的数字角色这一点上，监视，将发挥越来越重要的作用。在2014年，我们将会看到大量基于匿名机制的数字体验平台的涌现，“Snapchats”们正在崛起，步向主流。</p>
                    <?php } ?>
                    <p class="innovators"><?php print t('The Innovators');?>: <a href="http://www.snapchat.com/">Snapchat</a>, <a href="https://www.mywickr.com/en/index.php">Wickr</a>, <a href="https://heml.is/">Heml</a>, <a href="http://gryphn.co/">Gryphn</a></p>
                </div>
                <div class="span6 animation"><img src="images/trend_1.gif" data-src-gif="images/trend_1_animated.gif" data-src-orig="images/trend_1.gif"></div>
                <div class="span6 voteBlock">
                    <h4><?php print t('What do you think?');?></h4>
                    <?php print get_poll(1); ?>
                    <?php print get_social_share(1);?>
                </div>
                <div class="clearfloat"></div>
            </div>
        </div>
    </section>
    
    <section id="trend-2" data-trend="2" class="background">
        <div class="container">
            <div class="row-fluid">
                <div class="span6 offset6">
                    <?php if($language->language == 'en'){?>
                        <h2>Drones. Everywhere. And Rapidly Evolving.</h2>
                        <h3>by Adam Pruden, Eric Boam, and Carlos Elena-Lenz</h3>
                        <p>Autonomous, miniature flying machines are nothing new. But they are more common than ever before. Soon, advancements in drone technology will make the sky a place ripe for innovation, leading to a proliferation of airborne applications. The design implications are huge, from the drones themselves down to the ecosystems that support them.</p>
                    <?php } else { ?>
                        <h2>无人机：无处不在，飞速前进。</h2>
                        <h3>by Adam Pruden, Eric Boam, and Carlos Elena-Lenz</h3>
                        <p>自控的微型飞行器并不是什么新鲜事，但现在，它们比以往更常见地出现在我们的天空。在不远的未来，无人机技术的蓬勃发展将使天空成为下一个创新的发源地，越来越多的机载应用程序将会涌现。设计的力量将会彰显——无论是在无人机本身，还是在支持他们的生态系统上。</p>
                    <?php } ?>
                    <p class="innovators"><?php print t('The Innovators');?>: <a href="http://3drobotics.com/">3D Robotics</a>, <a href="http://www.kickstarter.com/projects/914887915/spiri">Spiri</a></p>
                </div>
                <div class="span6 voteBlock">
                    <h4><?php print t('What do you think?');?></h4>
                    <?php print get_poll(2); ?>
                    <?php print get_social_share(2);?>
                </div>
                <div class="clearfloat"></div>
            </div>
        </div>
    </section>
    
    <section id="trend-3" data-trend="3" >
        <div class="container">
            <div class="row-fluid">
                <div class="span6">
                    <?php if($language->language == 'en'){?>
                        <h2>Disconnecting in the Modern, Digital World</h2>
                        <h3>by Timothy Morey</h3>
                        <p>You will step into a library and disconnect. The theater will hush and your GPS will shut off. The dark zone in your home will allow you to sink into a chair, web-free, and muse. Faraday Zones, as frog strategist Timothy Morey calls them, will become a ubiquity in 2014. From these dodgy origins, they will find mainstream acceptance on trains, planes, and automobiles, as well as certain public spaces such as libraries and cinemas. Back-to-nature resorts and vacation spots will pile on, offering the opportunity to be “beyond reach.”</p>
                    <?php } else { ?>
                        <h2>断网，在这个现代的数字世界</h2>
                        <h3>by Timothy Morey</h3>
                        <p>你将会进入一个图书馆，并断开一切与网络的连接。剧院逐渐安静下来，而你的GPS也将随之关闭。你家中的“黑暗地带”将会带你进入一个没有网络羁绊的沉思环境中——法拉第区，青蛙设计的策略师Timothy Morey这么称呼它，而这个领域，将在2014年的世界里无处不在。除了在这些私密的场所，我们将发现越来越多的“法拉第区”将会出现在诸如火车、飞机、汽车以及一些图书馆和电影院这样的公共场所，它们将能够和旅游胜地和度假景点一样，提供给我们更多“逃离“这个世界的机会。</p>
                    <?php } ?>
                    <p class="innovators"><?php print t('The Innovators');?>: <a href="http://www.nytimes.com/2013/07/07/fashion/a-trip-to-camp-to-break-a-tech-addiction.html">Camp Grounded</a></p>
                </div>
                <div class="span6 animation"><img src="images/trend_3.gif" data-src-gif="images/trend_3_animated.gif" data-src-orig="images/trend_3.gif"></div>
                <div class="span6 voteBlock">
                    <h4><?php print t('What do you think?');?></h4>
                    <?php print get_poll(3); ?>
                    <?php print get_social_share(3);?>
                </div>
                <div class="clearfloat"></div>
            </div>
        </div>
    </section>
    
    <section id="trend-4" data-trend="4" class="background">
        <div class="container">
            <div class="row-fluid">
                <div class="span6 offset6">
                    <?php if($language->language == 'en'){?>
                        <h2>Rise of the Chinese Internet Giants</h2>
                        <h3>by Steve Boswell</h3>
                        <p>In 2014, the world will discover WeChat. With its user base of 300 million and an innovative offering, including instant messaging, group chat, content sharing, payments, and e-commerce, WeChat has evolved from a messaging application to a truly integrated mobile Internet platform. Not only will they unseat Facebook, WeChat will also disrupt the enterprise communications, financial services, and retail industries on a large scale. </p>
                    <?php } else { ?>
                        <h2>崛起的中国互联网巨头</h2>
                        <h3>by Steve Boswell </h3>
                        <p>在2014年，世界将会真正发现微信的价值。凭借它3亿多的用户和创新的功能——包括即时通讯、群组聊天、内容共享、移动支付和电子商务，微信已经从一个即时通讯应用程序进化为一个集成化的移动互联网平台。不但会颠覆Facebook，微信还将在企业通信、金融服务、零售行业等领域向巨头们发出挑战。</p>
                    <?php } ?>
                    <p class="innovators"><?php print t('The Innovators');?>: <a href="http://www.tencent.com/en-us/index.shtml">Tencent</a></p>
                </div>
                <div class="span6 voteBlock">
                    <h4><?php print t('What do you think?');?></h4>
                    <?php print get_poll(4); ?>
                    <?php print get_social_share(4);?>
                </div>
                <div class="clearfloat"></div>
            </div>
        </div>
    </section>
    
    <section id="trend-5" data-trend="5">
        <div class="container">
            <div class="row-fluid">
                <div class="span6">
                    <?php if($language->language == 'en'){?>
                        <h2>Mind Control!</h2>
                        <h3>by Kenji Huang</h3>
                        <p>If someone from the 1500’s came to us now and looked at what technology has enabled us to do, they’d think we were superhuman. In 2014, we’ll make even greater advancements. Our ability to control objects with our minds will be within reach as more companies look toward experiences that directly harness electrical signals from our brain.</p>

                    <?php } else { ?>
                        <h2>精神控制!</h2>
                        <h3>by Kenji Huang </h3>
                        <p>如果有人从1500年来到现在，当他看到现代科技赋予我们的能力时，他会认为我们都是超人。而在2014年，超人还将进化。随着越来越多的企业的直接读取利用脑电波的研究不断深入，我们的思想将对更多的物体拥有更强的控制能力。</p>
                    <?php } ?>
                    <p class="innovators"><?php print t('The Innovators');?>: <a href="http://www.emotiv.com/apps/epoc/299/">EPOC</a>, <a href="http://www.kickstarter.com/projects/806146824/melon-a-headband-and-mobile-app-to-measure-your-fo">Melon</a></p>
                </div>
                <div class="span6 animation"><img src="images/trend_5.gif" data-src-gif="images/trend_5_animated.gif" data-src-orig="images/trend_5.gif"></div>
                <div class="span6 voteBlock">
                    <h4><?php print t('What do you think?');?></h4>
                    <?php print get_poll(5); ?>
                    <?php print get_social_share(5);?>
                </div>
                <div class="clearfloat"></div>
            </div>
        </div>
    </section>
    
    <section id="trend-6" data-trend="6" class="background">
        <div class="container">
            <div class="row-fluid">
                <div class="span6 offset6">
                    <?php if($language->language == 'en'){?>
                        <h2>Augmented Humanity</h2>
                        <h3>by Antonio De Pasquale</h3>
                        <p>Technology has always helped us solve problems and extend our potential. Until now our technological tools were external add-ons, largely separate from our bodies. Today they are evolving on a new path integrating with our physiology; we are “hacking” the human body and the senses. Wearable technology, such as Google Glass, is an example of the first generation of consumer products that is changing the way we think about technology extending our potential. But it’s only the beginning: system-powered exoskeletons, and bionic arms, feet, and eyes, are the next phase.</p>
                    <?php } else { ?>
                        <h2>增强现实技术</h2>
                        <h3>by Antonio DePasquale </h3>
                        <p>技术总是那把帮助我们扩展潜力和解决问题的钥匙，但直到不久前，我们的技术工具在很大程度上还是以独立于我们的身体的外部插件存在着。但今天，通过生理学及仿生学与工程学的结合，科学家们已经为我们找到了全新的工具模式。诸如谷歌眼镜的可穿戴技术是这个模式的第一代消费级产品，它生动展示了技术将如何拓展我们的潜力。但这只是开始机械外骨骼，仿生手臂、仿生脚甚至是仿生眼睛，将是下一阶段带给无数人的福音。</p>
                    <?php } ?>
                    <p class="innovators"><?php print t('The Innovators');?>: <a href="http://www.biom.com/">BioM</a>, <a href="http://www.touchbionics.com/">Touchbionics</a>, <a href="http://corporate.honda.com/innovation/walk-assist/">Honda</a></p>
                </div>
                <div class="span6 voteBlock">
                    <h4><?php print t('What do you think?');?></h4>
                    <?php print get_poll(6); ?>
                    <?php print get_social_share(6, 'color');?>
                </div>
                <div class="clearfloat"></div>
            </div>
        </div>
    </section>
    
    <section id="trend-7" data-trend="7">
        <div class="container">
            <div class="row-fluid">
                <div class="span6">
                    <?php if($language->language == 'en'){?>
                        <h2>Self-Driving Cars</h2>
                        <h3>by Jared Ficklin</h3>
                        <p>Our cars will tuck themselves into a driveway or garage with precision, leading to the convenience of being able to begin the ritual exit of the vehicle—gathering belongings, checking smartphones, looking for sunglasses—early. Self-driving cars are on the horizon in 2014, with practical elements like self-parking paving the way.</p>
                    <?php } else { ?>
                        <h2>自动驾驶汽车</h2>
                        <h3>by Jared Ficklin </h3>
                        <p>我们的汽车将无比聪明——自己从车库驶入车道，精确倒回车库，并如同管家一般代替你完成离车前的例行工作——收集随身物品，检查手机，寻找太阳眼镜。这样的智能汽车已经出现在离我们不远的地平线处，而诸如自动泊车这样的技术的成熟，正为它们驶向我们的路途铺平了道路。</p>
                    <?php } ?>
                    <p class="innovators"><?php print t('The Innovators');?>: <a href="http://www.latimes.com/business/autos/la-fi-hy-autos-ford-self-driving-fusion-hybrid-autonomous-20131218,0,7365826.story#axzz2nyFpoWbr">Ford</a></p>
                </div>
                <div class="span6 animation"><img src="images/trend_7.gif" data-src-gif="images/trend_7_animated.gif" data-src-orig="images/trend_7.gif"></div>
                <div class="span6 voteBlock">
                    <h4><?php print t('What do you think?');?></h4>
                    <?php print get_poll(7); ?>
                    <?php print get_social_share(7);?>
                </div>
                <div class="clearfloat"></div>
            </div>
        </div>
    </section>
        
    <section id="trend-8" data-trend="8" class="background">
        <div class="container">
            <div class="row-fluid">
                <div class="span6 offset6">
                    <?php if($language->language == 'en'){?>
                        <h2>The Internet of Things Goes Art School</h2>
                        <h3>by Robert Tuttle</h3>
                        <p>Everything around us is getting smarter. As the Internet of Things becomes ubiquitous, smart technology will move beyond “practical” uses (medical, fitness, security, etc.) and into more subjective, artistic scenarios. Riding the wave of connecting sensors, devices, and people, digitally augmenting live music performances will enhance the audience experience and deliver more entertainment value.</p>
                    <?php } else { ?>
                        <h2>物联网步入艺术学院</h2>
                        <h3>by Robert Tuttle</h3>
                        <p>我们周围的一切都将变得更加聪明。随着物联网变得越来越无处不在，智能技术将不再局限于“实用”（医疗、健康、安全等）的领域，而将进入更主观化的艺术场景中。借助传感器、数码设备与观众的连接，现场音乐表演将带给观众无与伦比的体验，带来更多的娱乐价值。</p>
                    <?php } ?>
                    <p class="innovators"><?php print t('The Innovators');?>: <a href="http://itp.nyu.edu/itp/">ITP at Tisch School of the Arts</a></p>
                </div>
                <div class="span6 voteBlock">
                    <h4><?php print t('What do you think?');?></h4>
                    <?php print get_poll(8); ?>
                    <?php print get_social_share(8);?>
                </div>
                <div class="clearfloat"></div>
            </div>
        </div>
    </section>
    
    <section id="trend-9" data-trend="9">
        <div class="container">
            <div class="row-fluid">
                <div class="span6">
                    <?php if($language->language == 'en'){?>
                        <h2>Product Data, Rich and Full of Value</h2>
                        <h3>by Patrick Kalaher</h3>
                        <p> As products become smarter and communicate with each other, rich product data—descriptive data, data about product use and compatibility, and most importantly, the 'data exhaust' that products generate—will be what sets best-in-class products apart from those that are merely sufficient.</p>
                    <?php } else { ?>
                        <h2>数据——丰富，富裕</h2>
                        <h3>by Patrick Kalaher </h3>
                        <p>我们所使用的技术创造了一个无比丰沛的数据流，这些“数字排放”形态各异，既有描述性信息，也有指引产品使用和兼容性的数据。在2014年，高质量和丰富的数据的重要性将被提升到前所未有的高度。</p>
                    <?php } ?>
                    <p class="innovators"><?php print t('The Innovators');?>: <a href="http://www.etilize.com/etilize-product-data-overview.htm">Etilize</a>, <a href="http://icecat.us/">Icecat</a></p>
                </div>
                <div class="span6 animation"><img src="images/trend_9.gif" data-src-gif="images/trend_9_animated.gif" data-src-orig="images/trend_9.gif"></div>
                <div class="span6 voteBlock">
                    <h4><?php print t('What do you think?');?></h4>
                    <?php print get_poll(9); ?>
                    <?php print get_social_share(9, 'color');?>
                </div>
                <div class="clearfloat"></div>
            </div>
        </div>
    </section>
    
    <section id="trend-10" data-trend="10" class="background">
        <div class="container">
            <div class="row-fluid">
                <div class="span6 offset6">
                    <?php if($language->language == 'en'){?>
                        <h2>The Re-interpretation of Craft</h2>
                        <h3>by Mark Weedon</h3>
                        <p>At a time when every new piece of tech or service seems to be an app or digital entity, we’re craving the tangible. Nike is a leader in reviving craft and skill, by combining advanced materials and 3D printing. Next year will fundamentally change the way we think of mass-produced objects, with the rise of emotionally driven customizations and stylized “imperfections.”</p>
                    <?php } else { ?>
                        <h2>工艺的重新定义</h2>
                        <h3>by Mark Weedon </h3>
                        <p>在这个每一个新技术或服务似乎都是数字化应用程序或服务的时代，我们反而更渴望有形的实体。而通过先进材料以及3D打印技术的使用，耐克已经在工艺和技术的复兴道路上位于前列。在2014年，工艺的复兴将从根本上改变我们的对批量生产的固有印象，由情感驱动的定制和“不完美”将步入中央舞台。</p>
                    <?php } ?>
                    <p class="innovators"><?php print t('The Innovators');?>: <a href="http://gizmodo.com/nike-and-adidas-are-3d-printing-prototypes-at-impossib-512305901">Nike</a></p>
                </div>
                <div class="span6 voteBlock">
                    <h4><?php print t('What do you think?');?></h4>
                    <?php print get_poll(10); ?>
                    <?php print get_social_share(10);?>
                </div>
                <div class="clearfloat"></div>
            </div>
        </div>
    </section>
    
    <section id="trend-11" data-trend="11">
        <div class="container">
            <div class="row-fluid">
                <div class="span6">
                    <?php if($language->language == 'en'){?>
                        <h2>Bucking the Price Norm</h2>
                        <h3>by Cormac Eubanks</h3>
                        <p>For years it was a common industry belief that very few people would shell out more than $100 for a pair of headphones. Then Beats by Dre dropped in and recalibrated an industry. They showed the world that people were willing to pay for a premium design and bass heavy sound all wrapped in an outstanding aspirational brand. Industries are waking up to the fact that people are eager to purchase products at prices never before considered, provided those products deliver excellent design and user experience. Good design involves envisioning a product and user experience from the ground up. For disruptive companies that can do that effectively, the sky’s the limit.</p>
                    <?php } else { ?>
                        <h2>掀翻价格体系</h2>
                        <h3>by Cormac Eubanks </h3>
                        <p>在我们的固有印象中，很少有人会愿意支付超过100美元来购买一副耳机。然后Beats by Dre站了出来，颠覆了手机产业。他们向世界证明，只要一个品牌能够向使用者提供优秀的重低音体验，消费者就愿意为这个体验支付更多溢价。现在，更多的行业也正在意识到，在产品价格之外，优秀的产品设计和用户体验对消费者而言有多么重要。而好的设计，意味着对用户体验的重视是从产品构思的起步阶段就已开始了。而颠覆性的公司可以有效地做到这一点，对它们而言，天空才是极限。</p>
                    <?php } ?>
                    <p class="innovators"><?php print t('The Innovators');?>: <a href="http://wwww.apple.com">Apple</a></p>
                </div>
                <div class="span6 animation"><img src="images/trend_11.gif" data-src-gif="images/trend_11_animated.gif" data-src-orig="images/trend_11.gif"></div>
                <div class="span6 voteBlock">
                    <h4><?php print t('What do you think?');?></h4>
                    <?php print get_poll(11); ?>
                    <?php print get_social_share(11, 'color');?>
                </div>
                <div class="clearfloat"></div>
            </div>
        </div>
    </section>
    
    <section id="trend-12" data-trend="12" class="background">
        <div class="container">
            <div class="row-fluid">
                <div class="span6 offset6">
                    <?php if($language->language == 'en'){?>
                        <h2>The Uber-fication of Services</h2>
                        <h3>by Michael Robertson</h3>
                        <p>San Francisco startup Uber has led the revolution of personal transportation: Click to order, and minutes later your personal, quality-checked driver arrives, with the payment taken care of behind the scenes. 2014 will see this “on-demand” model extend across other personal services, from home maintenance to dog walking. Appliance repair person? Your device says they’re only three minutes away. </p>
                    <?php } else { ?>
                        <h2>Uber服务模式</h2>
                        <h3>by Michael Robertson</h3>
                        <p>来自旧金山的创业项目Uber引发了个人交通的革命：点击下单，几分钟后，你的私人司机（已得到认证）已经来到你家门口，而费用结算已经在背地里完成。在2014年，这个“随需应变”的模型将有希望扩展到其他个人服务——比如房屋修葺，遛狗，等等。你在焦急地等待水管工人吗？你的手机提示，他们离你的家只有三分钟的路程了。</p>
                    <?php } ?>
                    <p class="innovators"><?php print t('The Innovators');?>: <a href="https://www.clublocal.com/">ClubLocal</a>, <a href="http://www.handybook.com/">HandyBook</a></p>
                </div>
                <div class="span6 voteBlock">
                    <h4><?php print t('What do you think?');?></h4>
                    <?php print get_poll(12); ?>
                    <?php print get_social_share(12);?>
                </div>
                <div class="clearfloat"></div>
            </div>
        </div>
    </section>
    
    <section id="trend-13" data-trend="13">
        <div class="container">
            <div class="row-fluid">
                <div class="span6">
                    <?php if($language->language == 'en'){?>
                        <h2>The Consumer Will Own Data</h2>
                        <h3>by Annie Hsu</h3>
                        <p>With companies like Google, Facebook, and Twitter making billions of dollars from what is essentially aggregated and analyzed user data, there will be a counter-movement of user-controlled data ownership (and even user-controlled data monetization) growing stronger over time. To quote a colleague here, ‘‘If you’re not paying for it, you’re not the customer—you’re the product being sold.” 2014 will be the year of data reclamation!</p>
                    <?php } else { ?>
                        <h2>消费者将拥有自己的数据</h2>
                        <h3>by Annie Hsu</h3>
                        <p>从本质上而言，诸如谷歌、Facebook和Twitter这样的超级企业都是数据公司——它们聚集和分析用户数据，反向控制用户数据的所有权（甚至控制用户数据货币化进程），而这一趋势随着时间的推移正愈演愈烈越来越强大。引用我的一位同事的话：“如果你没有为它买单，那么你就不是顾客——你只是商家正在出售的产品而已。”而2014年，将是数据业态矫正的元年!</p>
                    <?php } ?>
                    <p class="innovators"><?php print t('The Innovators');?>: <a href="https://www.personal.com/">Personal.com</a></p>
                </div>
                <div class="span6 animation"><img src="images/trend_13.gif" data-src-gif="images/trend_13_animated.gif" data-src-orig="images/trend_13.gif"></div>
                <div class="span6 voteBlock">
                    <h4><?php print t('What do you think?');?></h4>
                    <?php print get_poll(13); ?>
                    <?php print get_social_share(13, 'color');?>
                </div>
                <div class="clearfloat"></div>
            </div>
        </div>
    </section>
    <section id="trend-14" data-trend="14" class="background">
        <div class="container">
            <div class="row-fluid">
                <div class="span6 offset6">
                    <?php if($language->language == 'en'){?>
                        <h2>Quantified Self at the Office</h2>
                        <h3>by Clint Rule</h3>
                        <p>How long you slept and how fast you ran won’t be the only quantified elements of your life. Quantifying your time at work will become the norm: How, when, and where you spend your time at work will be automatically captured and translated into timesheets, project management software, and analytics dashboards. Expect debates about privacy rights and coercive versus caring uses of the technology.</p>                        
                    <?php } else { ?>
                        <h2>在办公室量化自我</h2>
                        <h3>by Clint Rule</h3>
                        <p>你睡多久，跑多快，这些生理数据，将不再会是量化你生活的唯一元素。量化你工作时的时间安排将成为一种常态：你“如何，在何时，在何处”完成你的工作将会被自动捕捉及转化进工时表、管理软件以及分析后台。但针对这一双刃剑所同时带来的对员工隐私权的挑战，专家们已经展开了激烈的讨论。</p>
                    <?php } ?>
                    <p class="innovators"><?php print t('The Innovators');?>: <a href="http://www.usepeak.com/">Peak</a></p>
                </div>
                <div class="span6 voteBlock">
                    <h4><?php print t('What do you think?');?></h4>
                    <?php print get_poll(14); ?>
                    <?php print get_social_share(14);?>
                </div>
                <div class="clearfloat"></div>
            </div>
        </div>
    </section>

    <section id="trend-15" data-trend="15">
        <div class="container">
            <div class="row-fluid">
                <div class="span6">
                    <?php if($language->language == 'en'){?>
                        <h2>Reinvention of PC as productivity tool</h2>
                        <h3>by Tjeerd Hoek</h3>
                        <p>Device manufacturers are primarily focusing their innovation on the high-volume mobile device market and the booming sales numbers of smart phones and tablets. But these consumption/communication-optimized devices aren't a good replacement of the PC when it comes to creation and productivity tasks. And yet no one is investing in its future. A reinvigorated interest in computing tools to make things will be news in 2014.</p>
                    <?php } else { ?>
                        <h2>赋予PC以更多生产力</h2>
                        <h3>by Tjeerd Hoek</h3>
                        <p>在这个移动互联网兴起的时代，设备制造商们都将主战场转移到移动设备市场中，智能手机和平板电脑的创新设计不断涌现，销售数据也节节攀高。但不可否认的现实是，这些致力于优化通讯体验的消费级数码设备，还远远没有到替代个人电脑这一生产力工具的时候——但是，很少有人站出来投资它们的未来。生产力工具在2014年 的复兴，值得期待。</p>
                    <?php } ?>
                    <p class="innovators"><?php print t('The Innovators');?>: <a href="http://www.theverge.com/2013/12/19/5227922/apple-mac-pro-hands-on-video">Apple</a></p>
                </div>
                <div class="span6 animation"><img src="images/trend_15.gif" data-src-gif="images/trend_15_animated.gif" data-src-orig="images/trend_15.gif"></div>
                <div class="span6 voteBlock">
                    <h4><?php print t('What do you think?');?></h4>
                    <?php print get_poll(15); ?>
                    <?php print get_social_share(15, 'color');?>
                </div>
                <div class="clearfloat"></div>
            </div>
        </div>
    </section>
    
    <footer>
        <div class="container">
            <div class="row-fluid">
                <div class="span4">
                    <p><span class="logo">frog</span></p>
                    <p><?php print t('frog is a global product strategy and design firm. We identify business opportunities and design meaningful products, services, and experiences that grow brands and delight customers.');?></p>
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
                        <li class="first"><a href="/contact#additional"><?php print t('East Africa');?></a></li>
                        <li><a href="/contact#additional"><?php print t('Dubai');?></a></li>
                        <li><a href="/contact#additional"><?php print t('London');?></a></li>
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
                <p class="legal">© 2013 frog design inc. <?php print t('All Rights Reserved');?>. <a href="/privacy-policy.html"><?php print t('Privacy Policy');?></a> | <a href="/terms-of-use.html"><?php print t('Terms of Use');?></a></p>
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
    <script type="text/javascript">
      (function(d,s,i,r) {
          if (d.getElementById(i)){return;}
          var n=d.createElement(s),e=d.getElementsByTagName(s)[0];
          n.id=i;n.src='//js.hubspot.com/analytics/'+(Math.ceil(new Date()/r)*r)+'/262724.js';
          e.parentNode.insertBefore(n, e);
      })(document,"script","hs-analytics",300000);
    </script>
</body>
</html>
<? } ?>
