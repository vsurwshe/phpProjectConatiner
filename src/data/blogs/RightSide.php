<div class="col-lg-4 event-right mt-lg-0 mt-sm-5 mt-4">
                    <div class="event-right1">
                        <div class="category-story tech-btm">
                            <h3 class="blog-title text-dark mb-3">More Blogs</h3>
                            <ul class="list-unstyled">
                            <?php
                                $firstBlogsResult = mysqli_query($link, "SELECT * FROM `blogs`");
                                $blogsResult = mysqli_query($link, "SELECT * FROM `blogs`");
                                $josnarray=mysqli_fetch_assoc($firstBlogsResult);
                                while ($row = mysqli_fetch_array($blogsResult)) {
                            ?>
                            <li class="border-bottom mb-3 pb-3">
                                <i class="fa fa-caret-right mr-2"></i>
                                <a href="#" class="text-danger txt1" onclick="loadBody('<?php echo $row['blog_path']?>','<?php echo $row['blog_name']?>','<?php echo $row['blog_writer'] ?>')"><?php echo $row['blog_name']  ?></a>
                            </li>
                            <?php }?>
                            </ul>
                        </div>
                        <!-- <div class="categories my-4">
                            <h3 class="blog-title text-dark mb-3">Categories</h3>
                            <ul class="list-group single">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Cras justo odio
                                    <span class="badge badge-primary badge-pill">14</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Dapibus ac facilisis in
                                    <span class="badge badge-primary badge-pill">2</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Morbi leo risus
                                    <span class="badge badge-primary badge-pill">1</span>
                                </li>
                            </ul>
                        </div> -->
                        <div class="search1">
                            <h3 class="blog-title text-dark mb-3">Search</h3>
                            <form class="form-inline" action="#" method="post">
                                <input class="form-control rounded-0 mr-sm-2" type="search" placeholder="Search Here"
                                    aria-label="Search" required>
                                <button class="btn bg-dark text-white rounded-0 mt-3" type="submit">Search</button>
                            </form>
                        </div>
                        <!-- <div class="posts p-4 border my-4">
                            <h3 class="blog-title text-dark mb-3">Our Events</h3>
                            <div class="posts-grids">
                                <div class="row posts-grid">
                                    <div class="col-lg-4 col-md-3 col-4 posts-grid-left pr-0">
                                        <a href="single.html">
                                            <img src="images/w1.jpg" alt=" " class="img-fluid" />
                                        </a>
                                    </div>
                                    <div class="col-lg-8 col-md-7 col-8 posts-grid-right mt-lg-0 mt-sm-3">
                                        <h4>
                                            <a href="single.html" class="text-dark">Sed ut perspiciatis unde omni</a>
                                        </h4>
                                        <ul class="wthree_blog_events_list mt-2">
                                            <li class="mr-2 text-dark">
                                                <i class="fa fa-calendar mr-2" aria-hidden="true"></i>15/05/18</li>
                                            <li>
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                                <a href="single.html" class="text-dark ml-2">Admin</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row posts-grid mt-4">
                                    <div class="col-lg-4 col-md-3 col-4 posts-grid-left pr-0">
                                        <a href="single.html">
                                            <img src="images/w2.jpg" alt=" " class="img-fluid" />
                                        </a>
                                    </div>
                                    <div class="col-lg-8 col-md-7 col-8 posts-grid-right mt-lg-0 mt-sm-3">
                                        <h4>
                                            <a href="single.html" class="text-dark">Sed ut perspiciatis unde omni</a>
                                        </h4>
                                        <ul class="wthree_blog_events_list mt-2">
                                            <li class="mr-2 text-dark">
                                                <i class="fa fa-calendar mr-2" aria-hidden="true"></i>23/05/18</li>
                                            <li>
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                                <a href="single.html" class="text-dark ml-2">Admin</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row posts-grid mt-4">
                                    <div class="col-lg-4 col-md-3 col-4 posts-grid-left pr-0">
                                        <a href="single.html">
                                            <img src="images/blog2.jpg" alt=" " class="img-fluid" />
                                        </a>
                                    </div>
                                    <div class="col-lg-8 col-md-7 col-8 posts-grid-right mt-lg-0 mt-sm-3">
                                        <h4>
                                            <a href="single.html" class="text-dark">Sed ut perspiciatis unde omni</a>
                                        </h4>
                                        <ul class="wthree_blog_events_list mt-2">
                                            <li class="mr-2 text-dark">
                                                <i class="fa fa-calendar mr-2" aria-hidden="true"></i>13/06/18</li>
                                            <li>
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                                <a href="single.html" class="text-dark ml-2">Admin</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <!-- <div class="tags p-4 border">
                            <h3 class="blog-title text-dark">Recent Tags</h3>
                            <ul class="mt-4">
                                <li>
                                    <a href="single.html" class="text-dark border">Designs</a>
                                </li>
                                <li>
                                    <a href="single.html" class="text-dark border">Growth</a>
                                </li>
                                <li>
                                    <a href="single.html" class="text-dark border">Latest</a>
                                </li>
                                <li>
                                    <a href="single.html" class="text-dark border">Price</a>
                                </li>
                                <li>
                                    <a href="single.html" class="text-dark border">Tools</a>
                                </li>
                                <li>
                                    <a href="single.html" class="text-dark border">Style</a>
                                </li>
                                <li>
                                    <a href="single.html" class="text-dark border">Model</a>
                                </li>
                                <li>
                                    <a href="single.html" class="text-dark border">New Trends</a>
                                </li>
                                <li>
                                    <a href="single.html" class="text-dark border">Advantage</a>
                                </li>
                                <li>
                                    <a href="single.html" class="text-dark border">Excellent</a>
                                </li>
                                <li>
                                    <a href="single.html" class="text-dark border">Beautiful</a>
                                </li>
                                <li>
                                    <a href="single.html" class="text-dark border">Styles</a>
                                </li>
                                <li>
                                    <a href="single.html" class="text-dark border">Research</a>
                                </li>
                                <li>
                                    <a href="single.html" class="text-dark border">Trendy</a>
                                </li>
                            </ul>
                        </div> -->
                    </div>
                </div>