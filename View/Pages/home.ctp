<?php echo $this->element("home_search"); ?>
<div id="service">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Home at the first sight</h2>
            </div>
        </div>
    <!--
    <div class="row">
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="service-container">
          <div class="service-icon"><a href="#"><i class="fa fa-home"></i></a></div>
          <div class="service-content">
            <h3>Lorem ipsum dolor sit</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>
          </div>
        </div>
      </div>

      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="service-container">
          <div class="service-icon"><a href="#"><i class="fa fa-thumbs-up"></i></a></div>
          <div class="service-content">
            <h3>Lorem ipsum dolor sit</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="service-container">
          <div class="service-icon"><a href="#"><i class="fa fa-umbrella"></i></a></div>
          <div class="service-content">
            <h3>Lorem ipsum dolor sit</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="service-container">
          <div class="service-icon"><a href="#"><i class="fa fa-lock"></i></a></div>
          <div class="service-content">
            <h3>Lorem ipsum dolor sit</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>
          </div>
        </div>
      </div>
    </div>
    -->
  </div>
</div>
<?php echo $this->element("latest_properties"); ?>
<div id="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="blog-container">
                    <div class="blog-content">
                        <div class="blog-title">
                            <h2>About us</h2>
                        </div>

                        <div class="blog-text">
                            <?php if (!empty($about['body'])) {
                                $type_editor = Configure::read('type_editor');
                                if ($type_editor == "markup") {
                                    $Parsedown = new Parsedown(); 
                                    echo $Parsedown->text($about['body']);
                                } else {
                                    echo $about['body']; 
                                }
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="blog-container">
                    <div class="blog-content">
                        <div class="blog-title">
                            <h2>About Eastern Sicily</h2>
                        </div>

                        <div class="blog-text">
                            <? echo $this->element("page_content") ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>