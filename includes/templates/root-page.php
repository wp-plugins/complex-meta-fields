<?php

/**
 * Root plugin page UI
 */

?>

<div class="wrap about-wrap">

  <h1><?php printf(__('Welcome to Complex Meta Fields&nbsp;%s'), WP_CMF_VERSION); ?></h1>

  <div class="about-text"><?php printf(__('Plugin allows you to configure complex meta fields for any post type you need. Complex meta field is a field that contains some other sub-fields. Any amount of complex fields can be added to a post during editing.'), WP_CMF_VERSION); ?></div>

  <div class="changelog">

    <div class="feature-section col two-col">
      <div class="col-1">
        <h3><?php _e('Build your content easily'); ?></h3>
        <p><?php _e('Create custom complex fields for your posts or any other post types. Handy, real-time responsive drag-n-drop interface is really easy to manage.'); ?></p>
      </div>
      <div class="col-2 last-feature">
        <img src="//s.w.org/images/core/4.0/media.jpg" />
      </div>
    </div>

    <hr />

    <div class="feature-section col two-col">
      <div class="col-1">
        <img src="//s.w.org/images/core/4.0/media.jpg" />
      </div>
      <div class="col-2 last-feature">
        <h3><?php _e('Simple settings'); ?></h3>
        <p><?php _e('There is no bunch of useless options and settings. Just select where you need to use complex fields.'); ?></p>
      </div>
    </div>

    <hr />

    <div class="feature-section col two-col">
      <div class="col-1">
        <h3><?php _e('Convenience'); ?></h3>
        <p><?php _e('Add, edit, sort or delete complex fields with single click when editing post.'); ?></p>
      </div>
      <div class="col-2 last-feature">
        <img src="//s.w.org/images/core/4.0/media.jpg" />
      </div>
    </div>

  </div>

  <hr />

  <div class="changelog under-the-hood">
    <h3><?php _e('Even more'); ?></h3>

    <div class="feature-section col three-col">
      <div>
        <h4><?php _e('Front-end API'); ?></h4>
        <p><?php _e('Use predefined template functions to control displaying of complex fields.'); ?></p>
      </div>
      <div>
        <h4><?php _e('Complete support'); ?></h4>
        <p><?php _e('We guarantee answers to any questions in plugin\'s support threads on WordPress.org'); ?></p>
      </div>
      <div class="last-feature">
        <h4><?php _e('Future Upgrades'); ?></h4>
        <p><?php _e('Our aim is to make useful plugins and keep them up to date with modern needs.'); ?></p>
      </div>
    </div>

    <hr />

    <div class="return-to-dashboard">
      <a href="http://eney.solutions"><?php _e('Please visit plugin documentation and useful articles. Rate, discuss, comment and ask for help.') ?></a>
    </div>

  </div>

</div>