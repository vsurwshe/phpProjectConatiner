    <div class="media">
        <div class="media-body pt-xl-2 pl-3">
            <?php 
                $query="SELECT * FROM `comments` WHERE `blog_id`=1";
                $commentQueryResult= mysqli_query($link, $query);
                while ($row = mysqli_fetch_array($commentQueryResult)) {
            ?>
            <img src="images/user.png" alt="" class="img-fluid rounded" />
            <h5 class="mb-2"><?php echo $row['comment_name'] ?></h5>
            <p><?php echo $row['comment_body'] ?></p>
            <?php }?>
        </div>

            <!-- This is the reply -->
          <!-- <div class="media my-5">
                        <a class="d-flex pr-3" href="#">
                        <img src="images/te2.jpg" alt="" class="img-fluid rounded" />
                        </a>
                    <div class="media-body pt-xl-2">
                        <h5 class="mb-2">Richard Spark</h5>
                        <p>Lorem Ipsum convallis diam consequat magna vulputate malesuada. id dignissim
                            sapien velit id felis.</p>
                    </div>
                </div> -->

        <!-- <div class="media">
        <img src="images/te1.jpg" alt="" class="img-fluid rounded" />
        <div class="media-body pt-xl-2 pl-3">
            <h5 class="mb-2">Joseph Goh</h5>
            <p>Lorem Ipsum convallis diam consequat magna vulputate malesuada. id dignissim sapien
                velit id felis ac
                cursus eros.
                Cras a ornare elit.</p>
            <div class="media my-5">
                <a class="d-flex pr-3" href="#">
                    <img src="images/te2.jpg" alt="" class="img-fluid rounded" />
                </a>
                <div class="media-body pt-xl-2">
                    <h5 class="mb-2">Richard Spark</h5>
                    <p>Lorem Ipsum convallis diam consequat magna vulputate malesuada. id dignissim
                        sapien velit id felis.</p>
                </div>
            </div>
        </div> -->

