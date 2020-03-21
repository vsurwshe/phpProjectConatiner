
<style>
#contact{
    padding:10px 0 10px;
  }

  .contact-text{
    margin:45px auto;
  }

  .mail-message-area{
    width:100%;
    padding:0 15px;
  }

  .mail-message{
    width: 100%;
    background:rgba(255,255,255, 0.8) !important;
    -webkit-transition: all 0.7s;
    -moz-transition: all 0.7s;
    transition: all 0.7s;
    margin:0 auto;
    border-radius: 0;
  }

  .not-visible-message{
    height:0px;
    opacity: 0;
  }

  .visible-message{
    height:auto;
    opacity: 1;
    margin:25px auto 0;
  }

/* Input Styles */

  .form{
    width: 100%;
    padding: 15px;
    background:#f8f8f8;
    border:1px solid rgba(0, 0, 0, 0.075);
    margin-bottom:25px;
    color:#727272 !important;
    font-size:13px;
    -webkit-transition: all 0.4s;
    -moz-transition: all 0.4s;
    transition: all 0.4s;
  }

  .select {
    width: 100%;
    background:#f8f8f8;
    margin-bottom:25px;
    color:#727272 !important;
    font-size:13px;
    height: 30px;
  }


  .form:hover{
    border:1px solid #8BC3A3;
  }

  .form:focus{
    color: white;
    outline: none;
    border:1px solid #8BC3A3;
  }

  .textarea{
    height: 50%;
    max-height: 50%;
    max-width: 100%;
  }
  
/* Generic Button Styles */

  .button{
    padding:8px 12px;
    background:#0A5175;
    display: block;
    width:120px;
    margin:10px 0 0px 0;
    border-radius:3px;
    -webkit-transition: all 0.3s;
    -moz-transition: all 0.3s;
    transition: all 0.3s;
    text-align:center;
    font-size:0.8em;
    box-shadow: 0px 1px 4px rgba(0,0,0, 0.10);
    -moz-box-shadow: 0px 1px 4px rgba(0,0,0, 0.10);
    -webkit-box-shadow: 0px 1px 4px rgba(0,0,0, 0.10);
  }

  .button:hover{
    background:#8BC3A3;
    color:white;
  }

/* Send Button Styles */

  .form-btn{
    width:180px;
    display: block;
    height: auto;
    padding:15px;
    color:#fff;
    background:#8BC3A3;
    border:none;
    border-radius:3px;
    outline: none;
    -webkit-transition: all 0.3s;
    -moz-transition: all 0.3s;
    transition: all 0.3s;
    margin:auto;
    box-shadow: 0px 1px 4px rgba(0,0,0, 0.10);
    -moz-box-shadow: 0px 1px 4px rgba(0,0,0, 0.10);
    -webkit-box-shadow: 0px 1px 4px rgba(0,0,0, 0.10);
  }

  .form-btn:hover{
    background:#111;
    color: white;
    border:none;
  }

  .form-btn:active{
    opacity: 0.9;
  }
/* center{
  margin-top:330px;
} */
input {
    position: relative;
    z-index: 9999;
}
</style>
<script>
function loadData(){
  let valueTextArea="<p>\n"+"\tBlogs Starting Informations\n"+"</p>\n"
      +"<p class='my-3'>\n"+"\tBlogs Sub Points heading\n"+"</p>\n"
    +"<p>\n"+"\tBlgos Sub points Infomrations\n"
        +"\t<span class='text-danger'>\n"+"\t\tHighlating Text\n"+"\t</span>\n"
    +"</p>\n"
    +"<div class='offset-lg-2 mt-5'>\n"
        +"\t<p>\n"+"\t\tBlogs Ending information\n"+"\t</p>\n"
    +"</div>\n";
    // +"<h2 class='mt-3'>\n"
    //     +"\t<a href='blogs.php' class='single-text text-dark font-weight-light'> Blogs Ending Title</a>\n"
    // +"</h2>\n"
    // +"<p class='my-3'>\n"+"\tBlogs Ending Details Informations\n"+"</p>\n"
    // +"<p></p>\n";
  document.getElementById('blogbody').value = valueTextArea;
}
</script>
<head><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css"></head>
<br />
<body onload="loadData()">
<div class="inner contact">
                <!-- Form Area -->
                <div class="contact-form">
                    <!-- Form -->
                    <form id="contact-us" method="post" action="#">
                        <!-- Left Inputs -->
                     <center><h1>Write Your Blog</h1></center>
                        <div class="col-xs-12  animated" data-wow-delay=".5s">
                            <!-- Title -->
                            <input type="text" name="blogtitle" id="blogtitle" required="required" class="form" placeholder="Blog Title" />
                             <!-- Name -->
                            <select name="blogwriter" id="blogwriter" required="required" class="select" >
                                    <option value="Mr.Yogesh Rakhewar(Software Developer)">Yogesh</option>
                                    <option value="Mr.Vishvanath Surwshe(Full-Stack Developer)">Vishva</option>
                            </select>
                             <!-- Message -->
                             <textarea name="blogbody" id="blogbody" class="form textarea"  placeholder="Message"></textarea>
                        </div><!-- End Left Inputs -->
                        <!-- Bottom Submit -->
                        <div class="relative fullwidth col-xs-12">
                            <!-- Send Button -->
                            <button type="submit" id="submit" name="submit" class="form-btn semibold">Save the Blog</button> 
                        </div><!-- End Bottom Submit -->
                        <!-- Clear -->
                        <div class="clear"></div>
                    </form>
                    <!-- Your Mail Message -->
                    <div class="mail-message-area">
                        <!-- Message -->
                        <div class="alert gray-bg mail-message not-visible-message">
                            <strong>Thank You !</strong> Your blog has been saved.
                        </div>
                    </div>
                </div><!-- End Contact Form Area -->
            </div><!-- End Inner -->

</body>