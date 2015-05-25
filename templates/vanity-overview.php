<div class="container">
  <form action="<?php echo $app->urlFor('vanity') . '/update' ?>" method="post" class="primary-form">
    <div class="section content">
      <h2>Vanity URL Redirects</h2>

      <p>Please read <a href="http://statamic.com/learn/advanced-features/vanity-urls" target="_blank">http://statamic.com/learn/advanced-features/vanity-urls</a> to see the full documentation on how to add vanity URL to your Statamic site.</p>

      <div class="input-block input-textarea">
        <textarea class="code" name="vars"><?php if (isset($vanity)){foreach ($vanity as $key => $value) {print $key . ": " . $value . "\r\n";}}?></textarea>
      </div>

      <div class="input-block input-btn">
        <input type="submit" class="btn" value="Save" id="publish-submit">
      </div>
    </div>

    <div id="publish-action" class="footer-controls push-down"></div>
  </form>
</div>