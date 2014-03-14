<?php
require_once 'core/init.php';
$member = new Member();
$member_data = $member->findByID(Input::get('id'));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/strapped.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Cinzel' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/bootstrap-image-gallery.min.css">
    <link rel="stylesheet" href="css/blueimp-gallery.min.css">
    <title>Profile</title>
</head>
<body>
    <?php require_once('classes/header-inc.php'); ?> 
    <div class ="col-md-3 noisy-net">
        <h1 style="text-align: center"><?php echo $member_data->name; ?></h1>
        <div class="location-block">
            <i class="glyphicon glyphicon-map-marker">
            </i>
            <h4 class="location">Moscow, Russia</h4>
        </div>
        <div>
            <img class = "profile-pic" src="https://graph.facebook.com/72612657/picture?width=90&height=90"/>
        </div>
        <div class="profile-list">
            <div>
                <h4>Skills</h4>
                <ul>
                    <li>Photography</li>
                    <li>Art</li>
                </ul>
            </div>
        </div>
        <div class="profile-list">
            <div >
                <h4>Experience</h4>
                <ul>
                    <li>Maecenas vitae euismod tortor.</li>
                    <li>Integer ornare nullam</li>
                </ul>
            </div>
        </div>
    </div>
    <div class ="col-md-9 noisy-net content">
        <h2>Bio</h2>
        <h4>
            <!--                         <?php echo $member_data->bio; ?> -->
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
            Praesent at ligula congue, sagittis eros ut, pulvinar erat.
            Praesent consequat laoreet dapibus.
            Aliquam eu sapien imperdiet, porttitor mi quis, volutpat neque
            Aenean lacus nunc, elementum ornare blandit sed, scelerisque eget libero.
            Praesent adipiscing semper ornare.
            Nunc eu cursus odio, eget porttitor ipsum.
            Cras elementum volutpat mauris, sed posuere nulla.
            Donec posuere mauris ac elit aliquam, at porta augue condimentum.
            Nulla posuere sit amet sapien vel consequat.
            Integer ac nulla congue, ultricies lectus sed, adipiscing metus.
            Quisque ut posuere quam, venenatis lobortis felis.
            Maecenas vitae euismod tortor.
            Integer ornare nullam
        </h4>
        <hr>
        <h2> Work Samples </h2>
        <div id="links">
            <a href="images/banner.png" data-description="Old banner" title="Banner">
                <img class="worksample" src="images/banner.png">
            </a>
            <a href="images/blue.jpg" data-description="Reminds of the sea" title="Deep Blue">
                <img class="worksample" src="images/blue.jpg">
            </a>
            <a href="images/grey-pattern.jpg" data-description="Street Art in brasil" title="Cool Grey">
                <img class="worksample" src="images/grey-pattern.jpg">
            </a>
            <a href="images/orange.png" data-description="Abstract Repersetation of the sun." title="Abstract sun">
                <img class="worksample" src="images/orange.png">
            </a>
            <a href="images/grey-pattern.jpg" data-description="Street Art in brasil" title="Cool Grey">
                <img class="worksample" src="images/grey-pattern.jpg">
            </a>
            <a href="images/orange.png" data-description="Abstract Repersetation of the sun." title="Abstract sun">
                <img class="worksample" src="images/orange.png">
            </a>
            <a href="images/grey-pattern.jpg" data-description="Street Art in brasil" title="Cool Grey">
                <img class="worksample" src="images/grey-pattern.jpg">
            </a>
            <a href="images/orange.png" data-description="Abstract Repersetation of the sun." title="Abstract sun">
                <img class="worksample" src="images/orange.png">
            </a>
        </div>
    </div>
    <!-- The Bootstrap Image Gallery lightbox, should be a child element of the document body -->
    <div id="blueimp-gallery" class="blueimp-gallery">
        <!-- The container for the modal slides -->
        <div class="slides"></div>
        <!-- Controls for the borderless lightbox -->
        <h3 class="title"></h3>

        <p class="description"></p>
        <a class="prev">‹</a>
        <a class="next">›</a>
        <a class="close">×</a>
        <a class="play-pause"></a>

        <ol class="indicator"></ol>
        <!-- The modal dialog, which will be used to wrap the lightbox content -->
        <div class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" style="color: black"></h4>
                    </div>
                    <div class="modal-body next"></div>
                    <p class="description" style="color: black"></p>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left prev"> <i class="glyphicon glyphicon-chevron-left"></i>
                            Previous</button>
                            <button type="button" class="btn btn-primary next">Next <i class="glyphicon glyphicon-chevron-right"></i>

                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="http://blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>   
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-image-gallery.min.js"></script>

    <script type="text/javascript">
       blueimp.Gallery(
        document.getElementById('links'), {
            onslide: function (index, slide) {
                var text = this.list[index].getAttribute('data-description'),
                node = this.container.find('.description');
                node.empty();
                if (text) {
                    node[0].appendChild(document.createTextNode(text));
                }
            }
        });

       document.getElementById('links').onclick = function (event) {
        event = event || window.event;
        var target = event.target || event.srcElement,
        link = target.src ? target.parentNode : target,
        options = {
            index: link,
            event: event,
            onslide: function (index, slide) {
                var text = this.list[index].getAttribute('data-description'),
                node = this.container.find('.description');
                node.empty();
                if (text) {
                    node[0].appendChild(document.createTextNode(text));
                }
            }
        },
        links = this.getElementsByTagName('a');
        blueimp.Gallery(links, options);
    };
    </script>
</body>
</html>
