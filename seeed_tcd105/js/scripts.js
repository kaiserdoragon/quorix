"use strict";

// console.log("エアコン一括見積");

// window.addEventListener("DOMContentLoaded", function () {
//   new ScrollHint(".js-scrollable", {
//     scrollHintIconAppendClass: "scroll-hint-icon-white",
//     suggestiveShadow: true,
//     i18n: {
//       scrollable: "スクロールできます",
//     },
//   });
// });

// SP(<=767px)のときだけフッター追従ボタンを有効化
(() => {
  const btn = document.getElementById("js_fixed-btn");
  if (!btn) return;

  const THRESHOLD = 500;
  const mql = window.matchMedia("(max-width: 767px)");
  let controller = null;

  const update = () => {
    btn.classList.toggle("is-active", window.scrollY >= THRESHOLD);
  };

  const enable = () => {
    if (controller) return; // すでに有効
    controller = new AbortController();
    const opts = { passive: true, signal: controller.signal };

    // 初期反映
    if (document.readyState === "loading") {
      document.addEventListener("DOMContentLoaded", update, { once: true });
    } else {
      update();
    }

    // スクロール/リサイズで状態更新（SP時のみ有効）
    window.addEventListener("scroll", update, opts);
    window.addEventListener("resize", update, opts);
  };

  const disable = () => {
    if (!controller) return;
    controller.abort(); // まとめてリスナー解除
    controller = null;
    btn.classList.remove("is-active"); // デスクトップへ戻ったら非表示に
  };

  // 初期判定
  mql.matches ? enable() : disable();

  // 767pxをまたいだら有効/無効を切り替え
  mql.addEventListener("change", (e) => (e.matches ? enable() : disable()));
})();

(function ($, root, undefined) {
  // #ページ内リンク
  $(function () {
    $('a[href^="#"]').click(function () {
      var speed = 600;
      var href = $(this).attr("href");
      var target = $(href === "#" || href === "" ? "html" : href);

      if (target.length) {
        var headerHeight = $(".header").outerHeight();
        if (!headerHeight) {
          headerHeight = 0;
        }
        var position = target.offset().top - headerHeight;
        $("body,html").stop().animate({ scrollTop: position }, speed, "swing");
      }
      return false;
    });
  });

  // どのデバイス幅でもスクロールで出現するヘッダーを有効化
  $(function () {
    var $win = $(window);
    var $header = $("#js-fixed-header");
    var $main = $("main");

    var threshold = 0;
    var ticking = false;
    var enabled = false;
    var initialized = false;

    function recalcThreshold() {
      threshold = $main.length ? $main.offset().top : 0;
      apply();
    }

    function apply() {
      var sc = $win.scrollTop();
      if (sc > threshold) {
        $header.addClass("is-visible");
      } else {
        $header.removeClass("is-visible");
      }

      // 初回 apply のあとでだけ is-ready を付ける
      if (!initialized) {
        $header.addClass("is-ready");
        initialized = true;
      }
    }

    function onScroll() {
      if (!ticking) {
        window.requestAnimationFrame(function () {
          apply();
          ticking = false;
        });
        ticking = true;
      }
    }

    function enable() {
      if (enabled) return;
      enabled = true;

      recalcThreshold();
      $win.on("scroll.fixedHeader", onScroll);
      $win.on("resize.fixedHeader", recalcThreshold);

      // 画像読み込み等で main の位置が変わるケースがあるなら保険で
      $win.on("load.fixedHeader", recalcThreshold);
    }

    // matchMedia による分岐をやめて常に有効化
    enable();
  });


})(jQuery, this);
