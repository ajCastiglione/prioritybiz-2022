<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article">

  <header class="article-header entry-header">

    <h1 class="entry-title single-title" itemprop="headline" rel="bookmark"><?php the_title(); ?></h1>

    <p class="byline entry-meta vcard">

      <?php printf(
        __('Posted', 'pbltheme') . ' %1$s %2$s',
        /* the time the post was published */
        '<time class="updated entry-time" datetime="' . get_the_time('Y-m-d') . '" itemprop="datePublished">' . get_the_time(get_option('date_format')) . '</time>',
        /* the author of the post */
        '<span class="by">' . __('by', 'pbltheme') . '</span> <span class="entry-author author" itemprop="author" itemscope itemptype="http://schema.org/Person">' . get_the_author_link(get_the_author_meta('ID')) . '</span>'
      ); ?>

    </p>

  </header>

  <section class="entry-content " itemprop="articleBody">
    <?php
    the_content();
    ?>
  </section>

</article>