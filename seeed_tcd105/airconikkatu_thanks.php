<?php
/*
Template Name: エアコン見積り一括LPのサンクスページ
*/

get_header();
?>


<header class="header">
  <div class="header--catch">
    <p class="contents">
      <span>中小企業利用多数！</span>
      安心度・信頼感
      <img src="<?php echo get_template_directory_uri(); ?>/img/ikkatu/txt_no1.png" alt="NO.1" width="102" height="38">
    </p>
  </div>
  <div class="contents">
    <div class="header--inner">
      <section class="header--logo">
        <p>東海3県で最短当日！無料一括見積</p>
        <a href="<?php echo esc_url(home_url('/ikkatu/')); ?>">
          <h1>
            <picture>
              <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/img/ikkatu/logo.avif" type="image/avif">
              <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/img/ikkatu/logo.webp" type="image/webp">
              <img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/ikkatu/logo.png"
                alt="東海エアコン見積ナビ"
                width="414" height="62"
                fetchpriority="high"
                loading="eager"
                decoding="async">
            </picture>
          </h1>
        </a>
      </section>
      <div class="header--btns">
        <div class="header--item">
          <a href="#contact" class="cv_button">
            <picture>
              <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/img/ikkatu/mail.avif" type="image/avif">
              <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/img/ikkatu/mail.webp" type="image/webp">
              <img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/ikkatu/mail.png"
                alt="メールでお問い合わせ"
                width="327" height="82"
                decoding="async">
            </picture>
          </a>
        </div>
      </div>
    </div>
  </div>
</header>
<div id="js-fixed-header" class="fixed-header">
  <div class="header--btns">
    <div class="header--btn-item">
      <a href="tel:052-932-5450" class="cv_button gtm-click-tel">
        <picture>
          <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/img/ikkatu/tel.avif" type="image/avif">
          <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/img/ikkatu/tel.webp" type="image/webp">
          <img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/ikkatu/tel.png"
            alt="お電話でのご相談はこちら: 052-932-5450"
            width="327" height="82"
            decoding="async">
        </picture>
      </a>
    </div>
    <div class="header--btn-item">
      <a href="#contact" class="cv_button gtm-click-mail">
        <picture>
          <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/img/ikkatu/mail.avif" type="image/avif">
          <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/img/ikkatu/mail.webp" type="image/webp">
          <img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/ikkatu/mail.png"
            alt="メールでお問い合わせ"
            width="327" height="82"
            decoding="async">
        </picture>
      </a>
    </div>
  </div>
</div>

<main>
  <section class="thanks sec -sm">
    <div class="contents -md">
      <h2 class="ttl">お問い合わせありがとうございます</h2>
      <p>
        お問い合わせ頂き誠にありがとうございます。<br>
        お送り頂きました内容を確認の上、最短で折り返しご連絡させて頂きます。<br>
      </p>
      <a class="thanks--back" href="<?php echo esc_url(home_url('/ikkatu/')); ?>">ページのTOPに戻る</a>
    </div>
  </section>
</main>

<div class="footer_btn_fixed" id="js_fixed-btn">
  <p class="footer_btn_fixed--tel"><a href="tel:052-932-5450">電話で予約する</a></p>
  <p class="footer_btn_fixed--mail"><a href="#contact">メールで無料見積り</a></p>
</div>

<footer class="footer bg_blue">
  <div class="contents -md">
    <p>運営会社：株式会社QUORIX<br>
      〒461-0004 愛知県名古屋市東区葵3-3-8 SLX葵ビル4F 404<br>
      Copyright© 株式会社QUORIX All Rights Reserved.</p>
  </div>
</footer>

<?php get_footer(); ?>