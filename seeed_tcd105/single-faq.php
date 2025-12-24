<?php
     // redirect to top page
     $archive_page = get_post_type_archive_link('faq');
     wp_safe_redirect( $archive_page );
     exit;
?>