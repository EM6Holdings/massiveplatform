<?php
/**
 * @file
 * Returns the HTML for a single Drupal page.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728148
 */
?>

<div id="page">

  <header class="header" id="header" role="banner" <?php if ($is_front) {?>style="opacity: 0.9;"<?php } ?>>
    <div class="row">
      <h1 id="site-title">
        <a title="<?php print t('Home'); ?>" rel="home" href="<?php print $front_page; ?>">
          <img class='header-logo' src="<?php print $base_path . path_to_theme(); ?>/images/layout/tm-logo.svg" alt="<?php print t('Home'); ?>" width="104" height="48" />
          <span><?php print $site_name; ?></span>
        </a>
      </h1>
      <nav id="prime-nav" role="navigation">
        <h1><?= t('Primary navigation'); ?></h1>
        <ul class="prime-nav-wrappers">
          <?php if ($main_menu): ?>
          <li class="browse-wrapper" data-dropd-wrapper>
            <h2><a class="toggle" href="#browse-menu-blk" data-dropd-toggle><span class="hide"><?= t('Browse'); ?></span></a></h2>
            <div id="browse-menu-blk" class="inner dropd dropd-right" data-dropd>
              <?php
              print theme('links__system_main_menu', array(
                'links' => $main_menu,
                'attributes' => array(
                  'class' => array('links'),
                ),)); ?>
            </div>
          </li>
          <?php endif; ?>
          <li class="search-wrapper" data-dropd-wrapper>
            <h2><a class="toggle" href="#search-menu-blk" data-dropd-toggle><span class="hide"><?= t('Search'); ?></span></a></h2>
            <div id="search-menu-blk" class="inner dropd dropd-right" data-dropd>
              <?php $sf = drupal_get_form('search_form'); print render($sf); ?>
              <p class="helper"><?php print t('Search chapters, events, members or companies.'); ?></p>
            </div>
          </li>
          <li class="account-wrapper" data-dropd-wrapper>
            <?php print($page['account_menu']); ?>
          </li>
        </ul>
      </nav>
    </div>
  </header>

  <main id="main" role="main">
    <div class="row">
      <div id="content" role="main">
        <section>
          <header>
            <a id="main-content"></a>
            <?php print render($title_prefix); ?>
            <?php if ($title): ?>
              <h1 class="page__title title" id="page-title"><?php print $title; ?></h1>
            <?php endif; ?>
            <?php print render($title_suffix); ?>
            <?php print render($page['header']); ?>
            <?php print render($tabs); ?>
            <?php print $messages; ?>
            <?php print render($page['help']); ?>
            <?php if ($action_links): ?>
              <ul class="action-links"><?php print render($action_links); ?></ul>
            <?php endif; ?>
          </header>
          <div class="column">
            <?php print render($page['content']); ?>

            <?php
            // Enable wordpress feedme plugin
            // Show recent blog posts and more
            global $conf;
            $tm_enable_wordpress_feedme = false;
            if (@isset($conf["tm_enable_wordpress_feedme"])) {
              if ($conf["tm_enable_wordpress_feedme"]) {
                $tm_enable_wordpress_feedme = true;

            ?>
            <div id="frontpage_wordpress_content" style="margin-top: 64px; display: none;"></div>
            <?php } // end if
            } // end if
            ?>

            <div class="trilithon" id="frontpage_feed" style="margin-top: 64px;">
            
            <?php
              if ($tm_enable_wordpress_feedme) {
            ?>
            <div class="column first" id="frontpage_wordpress_feed" style="float: left;"></div>
              <script type="text/javascript">
                // hide frontpage feed until it's loaded
                document.getElementById('frontpage_feed').style.display = 'none';
                feedme_loaded = function() {

                  // show the font page feed
                  document.getElementById('frontpage_feed').style.display = 'block';

                  // show the front page content
                  document.getElementById('frontpage_wordpress_content').innerHTML = document.getElementById('feedme_frontpage_content').innerHTML;
                  document.getElementById('frontpage_wordpress_content').style.display = 'block';                  
                }
              </script>
            <?php include './'. path_to_theme() .'/templates/page--wordpress-feedme.tpl.php'; ?>
            <?php 
              } // end if
            ?>

            <?php
            if (@isset($conf["tm_enable_flags_feed"])) {
              if ($conf["tm_enable_flags_feed"]) {
            ?>
              <div class="<?php if($tm_enable_wordpress_feedme) { print("column second"); }?>" id="frontpage_flag_feed" style="float: right;">
                
            <?php include './'. path_to_theme() .'/templates/page--flagfeeds.tpl.php'; ?>
              </div> <!-- close second column -->
            <?php 
                } // end if
              } // end if
            ?>

            </div> <!-- close triliton -->

        </section>
      </div>
    </div>
  </main>

  <footer id="footer" role="contentinfo">
    <div class="row">
      <nav id="foot-nav" role="navigation">
        <div class="inner">

        <?php include './'. path_to_theme() .'/templates/block--footer-links.tpl.php';?>

        <!--<?php if ($foot_menu['links']): ?>
          <section class="foot">
          <?php
            print theme('links', array(
              'links' => $foot_menu['links'],
              'heading' => array(
                'text' => $foot_menu['title'],
                'level' => 'h2',
              ),
            ));
          ?>
          </section>
        <?php endif; ?>-->

        <?php if ($social_menu['links']): ?>
          <section class="social">
          <?php
            print theme('links', array(
              'links' => $social_menu['links'],
              'heading' => array(
                'text' => $social_menu['title'],
                'level' => 'h2',
              ),
            ));
          ?>
          </section>
        <?php endif ?>
        </div>
      </nav>
      <?php include './'. path_to_theme() .'/templates/block--footer-credits.tpl.php';?>
    </div>
    <?php include './'. path_to_theme() .'/templates/block--footer-sponsors.tpl.php';?>
  </footer>
</div>
