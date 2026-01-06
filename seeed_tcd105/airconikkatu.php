<?php
/*
Template Name: エアコン見積り一括LP
*/
defined('ABSPATH') || exit;

/**
 * JSON-LD（構造化データ）
 * - microdataは使わずJSON-LDのみ
 * - URLは esc_url_raw()（表示用のエンティティ変換をしない）
 * - wp_head に出力
 */
$home_url = esc_url_raw(home_url('/'));

$logo_url = esc_url_raw(get_theme_file_uri('/img/ikkatu/logo.png'));
$mv_url   = esc_url_raw(get_theme_file_uri('/img/ikkatu/mv.jpg'));

$ld_json = [
  '@context'   => 'https://schema.org',
  '@type'      => 'LocalBusiness',
  '@id'        => $home_url . '#localbusiness',
  'name'       => '株式会社QUORIX',
  'url'        => $home_url,
  'telephone'  => '+81-52-932-5450',
  'logo'       => $logo_url,
  'image'      => [$mv_url],
  'address'    => [
    '@type'           => 'PostalAddress',
    'postalCode'      => '461-0002',
    'addressRegion'   => '愛知県',
    'addressLocality' => '名古屋市東区',
    'streetAddress'   => '3-3-8 SLX葵ビル4F 404',
  ],
  'areaServed' => ['愛知県', '岐阜県', '三重県', '静岡県'],
];

add_action('wp_head', static function () use ($ld_json) {
  echo "\n" . '<script type="application/ld+json">'
    . wp_json_encode($ld_json, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
    . '</script>' . "\n";
}, 1);

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
        <p>エアコンの一括見積サイトの端的な説明文</p>
        <a href="<?php echo esc_url(home_url('/ikkatu/')); ?>">
          <h1>
            <picture>
              <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/img/ikkatu/logo.avif" type="image/avif">
              <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/img/ikkatu/img/logo.webp" type="image/webp">
              <img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/ikkatu/img/logo.png"
                alt="東海エアコン見積ナビ"
                width="379" height="63"
                fetchpriority="high"
                loading="eager"
                decoding="async">
            </picture>
          </h1>
        </a>
      </section>
      <div class="header--btns">
        <div class="header--item">
          <a href="tel:052-932-5450" class="cv_button">
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
  <div class="mv">
    <div class="contents">
      <div class="mv--contents">
        <dl>
          <dt>愛知県・岐阜県・三重県・静岡県</dt>
          <dd>優良業者のみをご紹介</dd>
        </dl>
        <img src="<?php echo get_template_directory_uri(); ?>/img/ikkatu/mv_txt_01.png" alt="エアコンのトラブルを" width="609" height="88">
        <strong>最短当日対応の<span>一括見積り</span>で解決!!</strong>
        <p>最大<span class="mv--num">5<span class="mv--num -sm">社</span></span>から</p>
        <p><img src="<?php echo get_template_directory_uri(); ?>/img/ikkatu/mv_txt_02.png" alt="最適な1社" width="367" height="87"><span>を選べます</span></p>
        <a href="#contact" class="mv--link">一括見積りをする</a>
        <img src="<?php echo get_template_directory_uri(); ?>/img/ikkatu/mv_point.png" alt="" width="738" height="218">
      </div>
      <div class="mv--form">
        <?php echo apply_shortcodes('[contact-form-7 id="3d4e383" title="エアコン一括見積LPフォーム（MV）"]'); ?>
      </div>
    </div>
  </div>

  <section class="flow sec bg_skyblue">
    <div class="contents">
      <h2>ご利用の流れ<span>かんたん3つのステップ</span></h2>
      <ol>
        <li>
          <dl>
            <dt>①フォームから希望の内容を入力</dt>
            <dd>完全無料、登録なし、利用料なし。<br>
              フォームからご要望を<br class="is-hidden_sp">
              簡単にご記入ください。</dd>
          </dl>
        </li>
        <li>
          <dl>
            <dt>②ピッタリの業者を紹介します</dt>
            <dd>
              予算、ご要望、お悩みなどを<br class="is-hidden_sp">
              詳しくお聞かせください。
              現地調査の日程調整をします。
            </dd>
          </dl>
        </li>
        <li>
          <dl>
            <dt>③気に入った業者を選んでください</dt>
            <dd>
              見積もりを受け取り、<br class="is-hidden_sp">
              比較してご検討ください。
              すべて見送ってもかまいません。
            </dd>
          </dl>
        </li>
      </ol>
    </div>
  </section>

  <section class="">
    <div class="contents">
      <p>当サービスが全て解決します</p>
      <p>優良業者のみをご紹介</p>
      <h2>エアコン業者が<span>最短当日・即日</span>で見つかります</h2>
      <ol>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
      </ol>
    </div>
  </section>

  <section class="cvarea bg_blue sec">
    <div class="contents">
      <h2>業務用エアコンの見積りはお任せください。</h2>
    </div>
  </section>

  <section class="voice sec">
    <div class="contents">
      <h2 class="ttl">導入事例事例</h2>
      <div class="voice--inner">
        <div class="voice--item">
          <img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/ikkatu/voice_01.jpg" alt="" width="380" height="200" decoding="async">
          <div>
            <h3>オフィスの空気が一気に軽くなりました</h3>
            <span>名古屋市　IT企業　A様</span>
          </div>
          <p>クリーニング後は同じ設定温度でもムラなく冷え、
            会議室のこもったニオイも解消。<br>
            社員から「空気が変わった」と好評で、
            来客対応にも自信が持てるようになりました。</p>
        </div>
        <div class="voice--item">
          <img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/ikkatu/voice_02.jpg" alt="" width="380" height="200" decoding="async">
          <div>
            <h3>「前より居心地がいい」と言われました</h3>
            <span>岐阜市　飲食店　I様</span>
          </div>
          <p>油煙まじりの風がサラッと変わり、客席の
            カビっぽさもなくなりました。営業前後の
            冷暖房効率も上がり、ピークタイムでも安定
            して快適な温度を保てています。</p>
        </div>
        <div class="voice--item">
          <img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/ikkatu/voice_03.jpg" alt="" width="380" height="200" decoding="async">
          <div>
            <h3>「清潔感が増した」と評判です</h3>
            <span>四日市市　クリニック　T様</span>
          </div>
          <p>天井カセットを分解洗浄してもらったところ、
            見えない内部の汚れに驚きました。<br>
            クリーニング後は空気がすっきりし、
            患者様やスタッフからも好印象の声が
            増えています。</p>
        </div>

      </div>
    </div>
  </section>

  <section class="use bg_blue sec">
    <div class="contents">
      <h2 class="ttl">ご利用の流れ</h2>
      <ol>
        <li>
          <div class="use--txt">
            <h3>お問い合わせ</h3>
            <img class="is-hidden_pc" src="<?php echo esc_url(get_template_directory_uri()); ?>/img/ikkatu/use_01.jpg" alt="" width="250" height="250" decoding="async">
            <p>サービスの詳細、気になっている汚れやお掃除したい箇所についてなど、
              お電話またはメールフォームにてお気軽にお問い合わせください。</p>
          </div>
          <div>
            <img class="is-hidden_sp" src="<?php echo esc_url(get_template_directory_uri()); ?>/img/ikkatu/use_01.jpg" alt="" width="250" height="250" decoding="async">
          </div>
        </li>
        <li>
          <div class="use--txt">
            <h3>ヒアリング</h3>
            <img class="is-hidden_pc" src="<?php echo esc_url(get_template_directory_uri()); ?>/img/ikkatu/use_02.jpg" alt="" width="250" height="250" decoding="async">
            <p>
              お見積り訪問日時などを相談させていただきます。<br>
              ご希望のサービス内容を詳しくお伺いし、お掃除・お手伝いする
              箇所の確認をいたします。
            </p>
          </div>
          <div>
            <img class="is-hidden_sp" src="<?php echo esc_url(get_template_directory_uri()); ?>/img/ikkatu/use_02.jpg" alt="" width="250" height="250" decoding="async">
          </div>
        </li>
        <li>
          <div class="use--txt">
            <h3>お見積りご提示</h3>
            <img class="is-hidden_pc" src="<?php echo esc_url(get_template_directory_uri()); ?>/img/ikkatu/use_03.jpg" alt="" width="250" height="250" decoding="async">
            <p>
              担当スタッフが訪問し、お掃除対象箇所を確認後無料でお見積りを
              ご提示します。<br>
              お掃除の際の注意事項などもご説明します。
            </p>
          </div>
          <div>
            <img class="is-hidden_sp" src="<?php echo esc_url(get_template_directory_uri()); ?>/img/ikkatu/use_03.jpg" alt="" width="250" height="250" decoding="async">
          </div>
        </li>
        <li>
          <div class="use--txt">
            <h3>スケジュールの相談</h3>
            <img class="is-hidden_pc" src="<?php echo esc_url(get_template_directory_uri()); ?>/img/ikkatu/use_04.jpg" alt="" width="250" height="250" decoding="async">
            <p>お見積りから正式にご依頼をいただいたのち、サービス実施日時やスケジュールについて相談させていただきます。</p>
          </div>
          <div>
            <img class="is-hidden_sp" src="<?php echo esc_url(get_template_directory_uri()); ?>/img/ikkatu/use_04.jpg" alt="" width="250" height="250" decoding="async">
          </div>
        </li>
        <li>
          <div class="use--txt">
            <h3>サービス実施</h3>
            <img class="is-hidden_pc" src="<?php echo esc_url(get_template_directory_uri()); ?>/img/ikkatu/use_05.jpg" alt="" width="250" height="250" decoding="async">
            <p>担当スタッフが訪問し、サービスを実施します。お見積り以上の請求が発生することはありませんが、追加のご要望などがあれば請求額が変わる場合もございます。</p>
          </div>
          <div>
            <img class="is-hidden_sp" src="<?php echo esc_url(get_template_directory_uri()); ?>/img/ikkatu/use_05.jpg" alt="" width="250" height="250" decoding="async">
          </div>
        </li>
        <li>
          <div class="use--txt">
            <h3>お支払い</h3>
            <img class="is-hidden_pc" src="<?php echo esc_url(get_template_directory_uri()); ?>/img/ikkatu/use_06.jpg" alt="" width="250" height="250" decoding="async">
            <p>お支払い方法は現金・銀行振込・クレジットカードがご利用いただけます。 <br>
              銀行振込をご利用の場合の振込先はお見積りの際にご案内いたします。</p>
          </div>
          <div>
            <img class="is-hidden_sp" src="<?php echo esc_url(get_template_directory_uri()); ?>/img/ikkatu/use_06.jpg" alt="" width="250" height="250" decoding="async">
          </div>
        </li>
      </ol>
      <b>業者が確定したら、ご指定いただいた日時に作業を行います。<br>
        作業が完了しましたら、請求金額を作業員へお渡しください。</b>
      <span>※業者によってはクレジットカードや請求書払いに対応しているところもあります。</span>
      <p>現金払い以外でのお支払いをご希望の方は、お見積りの際にお伝えください。</p>
    </div>
  </section>

  <section class="region sec">
    <div class="contents -md">
      <h2 class="ttl">対応エリア</h2>
      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/ikkatu/map.png" alt="" width="518" height="534" decoding="async">
      <dl>
        <div>
          <dt>
            愛知エリア
          </dt>
          <dd>
            名古屋市（天白区・北区・昭和区・千種区・中区・中川区・西区・東区・瑞穂区・緑区・南区・港区・名東区・守山区）・
            愛西市・あま市・安城市・一宮市・稲沢市・大府市・岡崎市・尾張旭市・春日井市・刈谷市・北名古屋市・清須市・江南市・
            小牧市・瀬戸市・高浜市・知多市・知立市・津島市・東海市・常滑市・豊明市・豊田市・長久手市・西尾市・日進市・半田市・
            碧南市・みよし市・弥富市・東郷町・大治町・蟹江町・阿久比町・美浜町・扶桑町・新城市・豊川市・豊橋市・蒲郡市・幸田町
          </dd>
        </div>
        <div>
          <dt>
            岐阜エリア
          </dt>
          <dd>
            岐阜市・羽島市・各務原市・山県市・瑞穂市・本巣市・羽島郡・本巣郡・大垣市・海津市・養老郡・不破郡・安八郡・揖斐郡・
            関市・美濃市・美濃加茂市・可児市・多治見市・瑞浪市・恵那市
          </dd>
        </div>
        <div>
          <dt>
            三重エリア
          </dt>
          <dd>
            桑名市・いなべ市・木曽岬町・東員町・四日市市・朝日町・川越町・鈴鹿市・亀山市・津市・松阪市・多気町・明和町・大台町・伊勢市・
            鳥羽市・志摩市・玉城町・度会町・伊賀市・名張市
          </dd>
        </div>
        <div>
          <dt>
            静岡エリア
          </dt>
          <dd>
            浜松市・磐田市・掛川市・袋井市・湖西市・御前崎市・菊川市・森町・静岡市・島田市・焼津市・藤枝市・牧之原市・吉田町・
            川根本町・沼津市・熱海市・三島市・富士宮市・伊東市・富士市・御殿場市・裾野市・伊豆市・伊豆の国市・函南町・清水町・
            長泉町・小山町・下田市・東伊豆町・河津町・南伊豆町・松崎町・西伊豆町
          </dd>
        </div>
      </dl>
    </div>
  </section>

  <section class="faq sec bg_skyblue">
    <div class="contents -md">
      <h2 class="ttl">よくある質問</h2>

      <dl>
        <div>
          <dt>
            表示されている料金以外に、追加でかかる費用はありますか？
          </dt>
          <dd>
            エアコン本体の料金＋オプション（ご希望時のみ）が総額です。<br>
            出張費・基本的な養生・洗浄作業料はすべて含まれています。<br>
            勝手に追加請求することは一切ございません。<br>
            お客様にとって一番負担の少ない方法をご提案し、無理な工事を押しつけることもありません。
          </dd>
        </div>
        <div>
          <dt>
            支払い方法は何がありますか？
          </dt>
          <dd>
            お支払い方法はキャッシュレス決済、現金、お振り込みからお選びいただけます。<br>
            基本的にはクリーニング当日にお支払いをお願いしております。
          </dd>
        </div>
        <div>
          <dt>
            キャンセル料はかかりますか？
          </dt>
          <dd>
            お見積りをした後でも、納得がいかなければキャンセルいただけます。<br>
            作業着手前のキャンセルに関しては代金をいただいておりません。
          </dd>
        </div>
        <div>
          <dt>
            事前に準備しておくことはありますか？
          </dt>
          <dd>
            下記のご協力をお願いしています。
            <ul>
              <li>・エアコンの真下や周辺にある小物・壊れやすいものの移動</li>
              <li>・作業スペースとして1〜2畳ほどの空きスペースの確保</li>
              <li>・お風呂場またはベランダなど、部品洗浄に使用できる場所のご提供</li>
            </ul>
          </dd>
        </div>
        <div>
          <dt>
            猫や犬などのペットがいますが大丈夫ですか？
          </dt>
          <dd>
            エアコンクリーニングなどの作業には基本的にはオーガニック洗剤を使用しています<br>
            安心して下さい。
          </dd>
        </div>
      </dl>
    </div>
  </section>

  <section class="contact sec" id="contact">
    <div class="contents">
      <h2 class="ttl">お問い合わせフォーム</h2>
      <p class="contact--lead">
        料金の目安を知りたい方・具体的な日程のご相談をされたい方は、<br class="is-hidden_sp">
        こちらのフォームからご連絡ください。<br>
        無料でお見積もり・ご提案いたします。
      </p>
      <?php echo apply_shortcodes('[contact-form-7 id="aa1eb3f" title="エアコン一括見積LPフォーム（フッター）"]'); ?>
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