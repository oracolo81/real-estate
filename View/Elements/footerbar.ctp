<div id="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="widget">
                    <h3>PomHouses.com</h3>
                    <ul class="list-unstyled">
                        <li><a href="/about">About us</a></li>
                        <li><a href="/contact-us">Contact us</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="widget">
                    <h3>Location</h3>
                    <address><strong>Real estate agency.</strong><br>
                    <?php echo $contactInfo['Contact']['address']; ?></address>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="widget">
                    <h3>Contacts</h3>
                    Tel. : <?php echo $contactInfo['Contact']['telephone']; ?><br>
                    Mobile : <?php echo $contactInfo['Contact']['mobile']; ?><br>
                    Email : <?php echo $contactInfo['Contact']['email']; ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 copyright">
                <p>Copyright &copy; 2015 Hyblaean Properties, All Right Reserved.</p>
                <a href="#top" class="btn btn-warning scroltop"><i class="fa fa-angle-up"></i></a>
                <!--
                <ul class="list-inline social-links">
                    <li><a href="#" class="icon-twitter" rel="tooltip" title="" data-placement="bottom" data-original-title="Twitter"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#" class="icon-facebook" rel="tooltip" title="" data-placement="bottom" data-original-title="Facebook"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#" class="icon-gplus" rel="tooltip" title="" data-placement="bottom" data-original-title="Gplus"><i class="fa fa-google-plus"></i></a></li>
                </ul>
                -->
            </div>
        </div>
    </div>
</div>